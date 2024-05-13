
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Material Dashboard 2 by Creative Tim
  </title>
  <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show bg-gray-200">
    <?php $_SESSION['page_name'] = "Test"?>    
    <?php require '../../navbar/navbar.php'?>
    <div class="container-fluid px-2 px-md-4">
      <div class="page-header min-height-150 border-radius-xl mt-3" style="background-image: linear-gradient(to bottom, rgba(0,0,0,0.0), #3B71CA), url('assets/img/item.png');">
        <span class="mask  .bg-gradient-success  opacity-6"></span>
      </div>
      <div class="card card-body mx-3 mx-md-4 mt-n7">
        <div class="col-12 mt-4">
          <div class="mb-3 ps-3">
            <h6 class="mb-1">Test</h6>
            <p class="text-sm">Choose from diverse academic assessment options.</p>
          </div>
          <div class="row mb-3 ps-3">
            <div id="mock-test">
                <ul class="nav nav-tabs mb-3">
                    <li class="nav-item">
                        <a id="tab-1" class="nav-link active" aria-current="page" href="#" style="font-size: 95%; padding: 0.5rem 0.75rem;">Full Test</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-2" class="nav-link" href="#" style="font-size: 95%; padding: 0.5rem 0.75rem;">Session Test</a>
                    </li>  
                </ul>   
                <div id="tab-content">
                    <div class="btn-primary-outline" id="session-content"  style="display:none; margin: 0px 0px 0px 0px; border-radius: 5px;">
                    </div>
                    <div id="tab-content-pending"></div>
                </div>
            </div>
          </div>
        </div>
      </div>  
    </div>


<script>
$(document).ready(function(){
    /**##############################################################################
    *                   Not attempted Test Data fetching Function
    * ##############################################################################**/
    function loadPendingData(category){
        $.ajax({
            type: "GET",
            url: "controlers/get.php?data_type=pendingExam&category="+category,
            data: {  },
            dataType: "json",
            success: function (response) {
                $('#tab-content-pending').empty()
                $.each(response, function (index, item) {
                    $('#tab-content-pending').append(`
                        <div id="exam-division" class="exam-division-pending row" style="padding: 0% 3%;">
                        <ul class="list-group" style = "cursor: pointer;" data-id = `+item.test_id+` data-paid = `+item.paid+`>
                            <li class="list-group-item border-0 d-flex align-items-center px-0 pt-0">
                                <div class="avatar me-3">
                                    <img src="../assets/img/voice-kola3.jpg" alt="kal" class="border-radius-lg shadow h-100">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">`+item.name+`</h6>
                                    <p class="mb-0 text-xs"></p>
                                </div>
                                <div class="d-flex pe-3 ps-0 ms-auto w-md-auto">
                                    <div id="status" class="fw-bold text-danger" style="font-size: 12px;">Not Completed</div>
                                </div>
                            </li>
                        </ul>
                        <hr>
                        </div>
                    `)
                    if(item.paid != 1){
                        $('#tab-content-pending #exam-division:last-child #status').css('display','none');
                    }
                })
            },error: function() {
                $('#tab-content-pending').empty()
                $('#tab-content-pending').append(`
                    <div id="exam-division" class="exam-division-pending row" style="padding: 1% 0% 0% 5%;">
                        <p class="text-secondary">Aren't into the Assigning Exams.</p>
                    </div>
                `)
            }
        })
    }
    
    /**##############################################################################
    *                           Session Test Content Buttons
    * ##############################################################################**/
    function sessionContentBTN(){
        var topics = ["Speaking", "Writing", "Reading", "Listening"];
        var contentDiv = $("#session-content");
        contentDiv.empty()
        loadPendingData("Speaking")
    
        for (var i = 0; i < topics.length; i++) {
            var button = $("<div></div>").addClass("col-12 col-sm-6 col-md-6 col-lg-3 text-center");
            var innerDiv = $("<div></div>").attr("data-tab", topics[i]).css({"width": "200px", "height": "30px", "font-size": "10px", "border": "1px solid"});
            innerDiv.addClass("btn-outline-primary tab-a1 pronun btn  my-button").attr("id", topics[i]).text(topics[i]);
                    
            $('#Speaking').addClass('active')
    
            innerDiv.click(function() {
                $('#Speaking, #Writing, #Reading, #Listening').removeClass("active");
                $('#'+$(this).attr("data-tab")).toggleClass('active')
                loadPendingData($(this).attr("data-tab"))
            });
    
            button.append(innerDiv);
            contentDiv.append(button);
        }
    }
    
    loadPendingData('All')
    
    $('#tab-1').click(function() {
        $(this).addClass('active')
        $('#tab-2').removeClass('active')
        $('#session-content').css('display','none')
        loadPendingData('All')
    });
    
    $('#tab-2').click(function() {
        $(this).addClass('active')
        $('#tab-1').removeClass('active')  
        $('#session-content').addClass('row') 
        $('#session-content').css('display','flex')  
        sessionContentBTN()
    })
})
</script>
  
</body>

</html>