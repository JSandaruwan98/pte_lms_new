<?php
$_SESSION['page_name'] = 'Assign Video';
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

    <div class="container-fluid py-4">
      <div class="row">

        
      </div>
    </div>  
      
<script>
  $(document).ready(function () {
    $.ajax({
      url: 'controlers/get.php?data_type=getBatch',
      method: 'GET',
      dataType: 'json', 
      success: function (data) {
        $('#batchItem').empty();
        for (var i = 0; i < data.length; i++) {
          var batchItem = `
            <div class="addTestLink col-xl-3 col-sm-6 mb-xl-0 mb-4 mt-4" data-id="${data[i].batch_id}">
              <div class="card">
                <div class="card-header p-3 pt-2">
                  <div class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                    <i class="fas fa-users"></i>
                  </div>
                  <div class="text-end pt-3">
                    <p class="text-sm mb-0 text-capitalize text-sm">BATCH00${data[i].batch_id}</p>
                  </div>
                </div>
                <div class="card-footer p-3">
                  <h4 class="mb-0 text-lg">${data[i].name}</h4>
                </div>
              </div>
            </div>
          `;
          $(".row").append(batchItem);
        }
      },
      error: function () {
        alert('Error fetching data.');
      }
    });
  });

  $('.row').on('click', '.addTestLink', function () {
    var batchId = $(this).data('id');
    $('#main').load('pages/admin/assign/videoBatch.php?id=' + batchId);
  });
</script>
</body>
</html>