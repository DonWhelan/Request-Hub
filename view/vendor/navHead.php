<?php
    session_start();
    include('../../model/selectModel.php');
    include('../../controler/sessionManagment/session-1.php');
    include('../../controler/activeHighlightSidenav.php');
?>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap core CSS -->
    <!--<link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <?php include('../../includes/pageIncludes/head-3.php');?>
    <link href="../../style/sidenav.css" rel="stylesheet">
    <!--<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>-->
    
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css" integrity="sha384-5SOiIsAziJl6AWe0HWRKTXlfcSHKmYV4RBF18PPJ173Kzn7jzMyFuTtk8JA7QQG1" crossorigin="anonymous">
    <link href="https://colorlib.com/polygon/elaadmin/css/helper.css" rel="stylesheet">
    <!--<link href="https://colorlib.com/polygon/elaadmin/css/style.css" rel="stylesheet">-->
    <link href="../../assets/css/form-elements.css" rel="stylesheet">
    <script src="../../assets/js/jquery-1.10.2.min.js"></script>
    <script>
      $(document).ready(function(){
                $(".alert").delay(1500).fadeToggle("slow");
      });
    </script>
                 
  </head>

  <body>
    <!--referance: https://getbootstrap.com/docs/4.0/examples/-->
    <!-- ======================= top nav bar =========================== -->
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-1" href="dashboard.php">Request Hub <img src="../../images/icon.png" alt="" style="height:25px"></a>
      <a href="../../controler/logout.php"><button class="btn btn-outline-info my-sm-0" type="submit">Log out</button></a>
    </nav>
    
    <div class="container-fluid">
      <div class="row">
        <!-- ======================= side nav bar =========================== -->  
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link <?php echo $dashboardActive; ?>" href="dashboard.php">
                  <span data-feather="home"></span>
                  Dashboard 
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $inboxActive; ?>" href="inbox.php">
                  <span data-feather="inbox"></span>
                  Inbox
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $requestsActive; ?>" href="request.php">
                  <span data-feather="edit"></span>
                  Forms<span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $customersActive; ?>" href="customers.php">
                  <span data-feather="users"></span>
                  Customers
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $teamsActive; ?>" href="team.php">
                  <span data-feather="layers"></span>
                  Teams
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link <?php echo $reposrtsActive; ?>" href="reports.php">
                  <span data-feather="file"></span>
                  Requets
                </a>
              </li>
            </ul>

            <!--<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">-->
            <!--  <span>Saved reports</span>-->
            <!--  <a class="d-flex align-items-center text-muted" href="#">-->
            <!--    <span data-feather="plus-circle"></span>-->
            <!--  </a>-->
            <!--</h6>-->
            <!--<ul class="nav flex-column mb-2">-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" href="#">-->
            <!--      <span data-feather="file-text"></span>-->
            <!--      Current month-->
            <!--    </a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" href="#">-->
            <!--      <span data-feather="file-text"></span>-->
            <!--      Last quarter-->
            <!--    </a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" href="#">-->
            <!--      <span data-feather="file-text"></span>-->
            <!--      Social engagement-->
            <!--    </a>-->
            <!--  </li>-->
            <!--  <li class="nav-item">-->
            <!--    <a class="nav-link" href="#">-->
            <!--      <span data-feather="file-text"></span>-->
            <!--      Year-end sale-->
            <!--    </a>-->
            <!--  </li>-->
            <!--</ul>-->
          </div>
        </nav>
