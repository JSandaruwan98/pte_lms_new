<?php
  if(!isset($_SESSION['u_id'])){
    header("Location: ../login/login.html");
  }
  $jsonData = file_get_contents('json/navbar.json');

  $tabsData = json_decode($jsonData, true);

  $userType = $_SESSION['u_id'];

  $tabs = ($userType === 'admin') ? $tabsData['adminTabs'] : $tabsData['studentTabs'];
  $tabs_name = ($userType === 'admin') ? 'admin' : 'student';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="assets/img/logo-icon.png">
  <title>
    PTE Learning Management System
  </title>
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
  <link id="pagestyle" href="assets/css/material-dashboard.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <style>
    .primary{
      background-color: #007bff;
    }
  </style>
  <script>
    const userRole = "<?= $tabs_name ?>";
  </script>
  <script src="../route/router.js"></script>

  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-200">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3   bg-gradient-dark" id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="assets/img/logo-icon.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold text-white">PTE LMS</span>
      </a>
    </div>
    <hr class="horizontal light mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">

        <!--side bar item loop that data get in to navbar.json file-->
        <?php foreach ($tabs as $tab): ?>
          <li class="nav-item">
            <a id=<?php echo $tab['id']; ?> href="#<?php echo $tab['id']; ?>" class="nav-link text-white ">
              <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                <i class="material-icons opacity-10">dashboard</i>
              </div>
              <span class="nav-link-text mx-1"><?php echo $tab['name'];?></span>  
            </a>
            <ul class="submenu" aria-labelledby="" style="display: none; list-style: none;">
            <?php if(isset($tab['sub-route'])):?>
                <script>
                    $('.nav-item').addClass('dropdown')
                    $('#<?php echo $tab['id']; ?>').addClass('dropdown-toggle')
                </script>
                <?php foreach ($tab['sub-route'] as $tab_item): ?>
                    <li><a id=<?php echo $tab_item['id']; ?> class="item nav-link text-white" href="#"><?php echo $tab_item['name'];?></a></li>
                <?php endforeach;?>
            <?php else:?>
                <script>$('.nav-item').addClass('direct')</script>
            <?php endif;?>    
            </ul>
          </li>
        <?php endforeach;?>



      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn bg-gradient-primary mt-4 w-100" href="https://www.creative-tim.com/product/material-dashboard-pro?ref=sidebarfree" type="button">Log Out</a>
      </div>
    </div>
  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!--Main Div-->
    <div class="container-fluid" id="main">


    </div>

    
  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

    <!-- ################################################################################## -->
    <!-- ############################### Side Bar Dropdown ################################ -->
    <!-- ################################################################################## -->
  <script>
    $(document).ready(function(){
      $('.nav-link').click(function() {
        $('.nav-link').removeClass('primary');
        $(this).addClass('primary');      
      });

      
      $('.nav-link').click(function() {
        $('.nav-link').removeClass('primary');
        $('.item').removeClass('primary');
        $(this).addClass('primary');
      });
      $('.item').click(function(){
        $('.nav-link').removeClass('primary');
        $('.item').removeClass('primary');
        $(this).addClass('primary');
      })
      $('.direct').click(function(){
        $('.dropdown').not(this).find('.submenu').slideUp();
      })
      $('.dropdown').click(function () {
        const $submenu = $(this).find('.submenu');

        $submenu.slideToggle();
  
        $('.dropdown').not(this).find('.submenu').slideUp();

        event.stopPropagation();
      });

      $('.submenu').click(function (event) {
        event.stopPropagation();
      });
    });
  </script>


  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/material-dashboard.min.js?v=3.0.0"></script>
</body>

</html>
