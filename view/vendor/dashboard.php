<?php 
include("navHead.php");
include("../../model/selectModel_dashboard.php");
?>

       <!-- ======================= dashboard =========================== --> 
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2"><?php echo $_SESSION['company']; ?></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              Requests Per Queue
            </div>
          </div>
          Customer login URL: <a href="https://www.request-hub.com/view/vendor/<?php echo $_SESSION['company']; ?>/login.php">https://www.request-hub.com/view/vendor/<?php echo $_SESSION['company']; ?>/login.php</a>
          <canvas class="my-4" id="myChart" width="900" height="380"></canvas>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../../../assets/js/vendor/popper.min.js"></script>
    <script src="../../../../dist/js/bootstrap.min.js"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <!-- Graphs -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
    <script>
      var ctx = document.getElementById("myChart");
      var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
           labels: <?php $arrayOfTeamNames = select_prepared_dashboardGetTeams("../../",$_SESSION['company']); ?> 
          datasets: [{
            data: <?php select_prepared_dashboardGetQTYs("../../",$arrayOfTeamNames); ?> 
            lineTension: 0,
            backgroundColor: '#36a2eb',
            borderColor: '#007bff',
            borderWidth: 2,
            pointBackgroundColor: '007bff#'
          }]
        },
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          },
          legend: {
            display: false,
          }
        }
      });
    </script>
  </body>
</html>
