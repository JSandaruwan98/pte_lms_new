<?php
$_SESSION['page_name'] = 'Add Batch';
?>
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
    <?php require '../../../navbar/navbar.php'?>

    <div class="p-4">
      <div class="row">
        <div class="col-12">
          <form class="row g-3" action="controlers/post.php" method="POST" id="batchAdd">
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
                <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
                </symbol>
                <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
                </symbol>
            </svg>
            
            <div id="alertSuccess" class="alert alert-success align-items-center" style="display: none; color:white;">
                
            </div>
            <div id="alertDanger" class="alert alert-danger align-items-center" style="display: none; color:white;">
                
            </div>
            <div class="col-md-6">
                <label for="inputBatch" class="form-label">Program</label>
                <select id="inputBatch" class="form-select" name="program">
                    <option selected>Choose...</option>
                    <option value="Program I">Program I</option>
                    <option value="Program I">Program II</option>
                    <option value="Program I">Program III</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="inputClass" class="form-label">Class</label>
                <select id="inputClass" class="form-select" name="class">
                    <option selected>Choose...</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="inputName" class="form-label">Batch Name</label>
                <input type="text" class="form-control" name="batchname" id="inputName" placeholder="Batch Name">
            </div>
            <div class="col-6"></div>
            <div class="col-md-6">
                <label for="inputFrom" class="form-label">Time from</label>
                <input type="time" class="form-control" name="timefrom" id="inputFrom">
            </div>
            <div class="col-md-6">
                <label for="inputTo" class="form-label">Time To</label>
                <input type="time" class="form-control" name="timeto" id="inputTo">
            </div>
            <div class="col-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
        </div> 
      </div>
    </div>
     

<!-- Batch Data Submit to the Database-->
<script>
    $(document).ready(function(){
        $('#batchAdd').submit(function (event){
            event.preventDefault();
            console.log($(this).serialize()+"&task=batchAdd")
            $.ajax({
                type: 'POST',
                url: 'controlers/post.php',
                data: $(this).serialize()+"&task=batchAdd",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        // Show success alert
                        $("#alertSuccess").css("display","flex")
                        $("#alertSuccess").html(`
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:"><use xlink:href="#check-circle-fill"/></svg>
                        <div>` + response.message + `</div>`
                        );
                        $("#alertSuccess").fadeIn();
                        $("#batchAdd")[0].reset();
                        setTimeout(function () {
                            $("#alertSuccess").fadeOut();
                        }, 3000)
                    } else {
                        // Show error alert
                        $("#alertDanger").css("display","flex")
                        $("#alertDanger").html(`
                        <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:"><use xlink:href="#exclamation-triangle-fill"/></svg>
                        <div>` + response.message + `</div>`
                        );
                        $("#alertDanger").fadeIn();
                        setTimeout(function () {
                            $("#alertDanger").fadeOut();
                        }, 3000)
                    }
                },
                error: function () {
                }
            })
        })
    })
</script>
<script>
    // Use jQuery to fetch data from the server-side script
    $(document).ready(function () {
        $.ajax({
            url: 'controlers/get.php?data_type=getClass', // Replace with the correct URL
            method: 'GET',
            success: function (data) {
                // Loop through the data and append it to the container
                for (var i = 0; i < data.length; i++) {
                    $('#inputClass').append('<option value="'+ data[i].class_id +'">' + data[i].name + '</option>');
                }
            },
            error: function () {
                alert('Error fetching data.');
            }
        });
    });
    </script>
</body>
</html>