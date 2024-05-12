
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link rel="stylesheet" href="../assets/css/material-dashboard.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .my-button:hover {
            border: 1px solid rgb(60, 41, 116)
        }

    </style>
</head>
<body>

    <?php $_SESSION['page_name'] = "Test History"?>    

    <?php require '../navbar/navbar.php'?>

    <div class="py-4">
      <div class="row min-vh-80 h-100">
        <div class="col-12">
            <img src="../assets/img/item.png" class="img-fluid" style="border-radius: 12px; background: lightgray url(student/images/item.png) 0px -52.475px / 100% 190.82% no-repeat; height: 90px; width: 100%; filter: brightness(90%) sepia(10%);" alt="Responsive image">    
            <div id="mock-test">
                <h6 class="font-weight-bolder mt-3 ms-4">Tests</h6>
                <ul class="nav nav-tabs" style="margin: 20px 0px 0px 40px;">
                    <li class="nav-item">
                        <a id="tab-1" class="nav-link active" aria-current="page" href="#" style="font-size: 95%; padding: 0.5rem 0.75rem;">Full Test</a>
                    </li>
                    <li class="nav-item">
                        <a id="tab-2" class="nav-link" href="#" style="font-size: 95%; padding: 0.5rem 0.75rem;">Session Test</a>
                    </li>  
                </ul>   
                
                <div id="tab-content">
                    <div class="btn-primary-outline p-4" id="session-content"  style="display:none; margin: 0px 0px 0px 0px; border-radius: 5px;"></div>
                    <div id="tab-content-pending"></div>
                </div>
            </div>

            <div id="popup" class="popup">
                <div class="popup-card" style="width: 30rem;">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <p class="card-text"></p>
                        <div class="btn-section"></div>
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
                    url: "student/src/controllers/getController.php?data_type=pendingTest&category="+category,
                    data: {  },
                    dataType: "json",
                    success: function (response) {
    
                        
    
                        $('#tab-content-pending').empty()
                        $.each(response, function (index, item) {
                
                            $('#tab-content-pending').append(`
                            <div id="exam-division" class="exam-division-pending row" style="padding: 5px 60px;">
                                <div class="col-12">
                                    <div class="card" style = "cursor: pointer;"  data-id = `+item.test_id+` data-paid = `+item.paid+`>
                                        <div class="card-body" style=" height: 70%;">
                                            <div class="row" style=" border-radius: 20px;">
                                                <div class="col-1 d-flex align-items-center px-4">
                                                    <img id="exam-profile-img-1" class="rounded-circle shadow-1-strong"
                                                    src="student/images/fox.png" alt="avatar" width="40"
                                                    height="40" />
                                                </div>
                                                <div class="col-9 d-flex align-items-center px-4">
                                                    <div id="user-name-1" class="col-6 fw-bold text-primary">`+item.name+`</div>
                                                </div>    
                                                <div class="col-2 d-flex align-items-right">
                                                    <div id="status" class="col-12 fw-bold text-danger" style="font-size: 12px;">Not Completed</div>
                                                </div>   
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            `)
                            console.log(item.paid)
                            if(item.paid != 1){
                                $('#tab-content-pending #exam-division:last-child #status').css('display','none');
                            }
    
                            
                        })
    
                        
    
                        
    
                        $('.card').click(function (e) {
                            var test_id = $(this).data('id')
                            $.ajax({
                                url: `student/src/controllers/getController.php?data_type=checked_completed&test_id=${test_id}&category=${category}`,
                                method: 'GET',
                                success: function(data){ 
                                    console.log(data);
                                    if(data == 2){
    
                                        $('.btn-section').empty()
                                        $('.card-title').empty()
                                        $('.popup-card').css('width', '50rem')
                                        $("#popup").fadeIn();
                                        $('.card-text').text('You did not finish this test last time. Do you want to continue from your saved session?')
                                        $('.btn-section').append(`
                                            <a id="Continue" href="#"  class="btn btn-primary float-center me-3">Continue</a>
                                        `)
    
                                        $('#Continue').on('click', function() {
                                            $("#popup").fadeOut();
                                            $('.popup-card').css('width', '30rem')
                                            loadTheExamPage(test_id, category)
                                        });
                                        
    
                                    }else if(data == 1){
    
                                        loadTheExamPage(test_id, category)
    
                                    }else if(data == 0){
    
                                        $.ajax({
                                            url:'src/controllers/postController.php',
                                            type: 'POST',
                                            data: { task : 'attempted_data', test_id :  test_id, evaluated : 2},
                                            success: function(response){
                                                loadTheExamPage(test_id, category)
                                            }
                                        })
    
                                    }
                                 }
                            })
                            
                            
                            
                        })
    
                        
                        
    
                    },error: function() {
                        $('#tab-content-pending').empty()
                        $('#tab-content-pending').append(`
                            <div id="exam-division" class="exam-division-pending row" style="padding: 1% 0% 0% 5%;">
                                <p class="text-secondary">Aren't into the Assigning Exams.</p>
                            </div>
                            `)
                        console.log('asaa')
                    }
                })
            }
    
            function loadTheExamPage(test_id, category){
    
                var url = "index.php?url=/Exams#" + test_id;
                var newTab = window.open(url, '_blank');
    
                //send the message for new tab
                if (newTab) {
                    newTab.onload = function() {
                        const message = 'Hello from the original tab!';
                        newTab.postMessage(message, '*');
                    };
                }
    
                //receive the new tab message
                $(window).on('message', function(event) {
                    if (event.originalEvent.source === newTab) {
                        console.log(event.originalEvent.data)
                        loadPendingData(category)
                    }
                });
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
    
                    var button = $("<div></div>").addClass("col-6 col-sm-6 col-md-3 col-lg-3 text-center");
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
                $('#tab-3').removeClass('active')
                $('#session-content').css('display','none')
                loadPendingData('All')
    
            });
    
            $('#tab-2').click(function() {
                $(this).addClass('active')
                $('#tab-3').removeClass('active')
                $('#tab-1').removeClass('active')  
                $('#session-content').addClass('row') 
                $('#session-content').css('display','flex')  
                sessionContentBTN()
            });
    
            $('#tab-3').click(function() {
                $(this).addClass('active')
                $('#tab-2').removeClass('active')
                $('#tab-1').removeClass('active')  
                $('#tab-content-pending').empty() 
                $('#session-content').css('display','none') 
            });
    
        })
    </script>
    
</body>
</html>