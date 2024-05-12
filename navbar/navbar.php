<?php 
$name = $_SESSION['page_name'];
?>
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark text-decoration-none" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page"><?php echo $name; ?></li>
          </ol>
          <h6 class="font-weight-bolder mb-0"><?php echo $name; ?></h6>
        </nav>
        <li class="nav-item d-xl-none ps-3  d-flex align-items-center">
            <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
              <div class="sidenav-toggler-inner">
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
                <i class="sidenav-toggler-line"></i>
              </div>
            </a>
          </li>
        <div class="collapse navbar-collapse ms-5 ms-sm-5 ms-md-5 mt-sm-0 mt-2 me-md-0 me-sm-4">
          <div class="ms-md-auto pe-md-2 d-flex align-items-center  pt-2">
            <div id="btn-section" class="input-group input-group-outline">
              
            </div>
          </div>      
        </div>
      </div>
    </nav>