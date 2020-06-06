<?php
require_once 'StartSession.php';
require_once "connex.php";

$sqlClient = "SELECT * FROM montrealtorent.client";
$stmtClient=$pdo->query($sqlClient);
$countClient = $stmtClient ->rowCount();

$sqlEmployee = "SELECT * FROM montrealtorent.employee";
$stmtEmployee=$pdo->query($sqlEmployee);
$countEmployee = $stmtEmployee ->rowCount();

$sqlProperty = "SELECT * FROM montrealtorent.property";
$stmtProperty=$pdo->query($sqlProperty);
$countProperty = $stmtProperty ->rowCount();

$sqlContract = "SELECT * FROM montrealtorent.contract";
$stmtContract = $pdo->query($sqlContract);
$countContract = $stmtContract ->rowCount();

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System | Dashboard</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
  </head>
  <body>

    <nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <img src="img\logo.png" width="50px" height="50px">
          <a class="navbar-brand" href="#"> Montreal to Rent</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#">Welcome, Diego</a></li>
            <li><a href="logout.php">Logout</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <header id="header">
      <div class="container">
        <div class="row">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</h1>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li class="active">Dashboard</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
          <div class="col-md-3">
            <div class="list-group">
              <a href="dashboard.php" class="list-group-item active main-color-bg">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
              <a href="#collapse1" class="list-group-item" data-toggle="collapse"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees </a>
                <div id="collapse1" class="list-group panel-collapse collapse">
                    <a href="insertEmployee.php" class="list-group-item"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Employee</center></a>
                    <a href="listEmployees.php" class="list-group-item"><center><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Employees List</center></a>
                </div>
              <a href="#collapse2" class="list-group-item" data-toggle="collapse"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Clients </a>
              <div id="collapse2" class="list-group panel-collapse collapse">
                  <a href="insertClient.php" class="list-group-item"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Client</center></a>
                  <a href="listClients.php" class="list-group-item"><center><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Clients List</center></a>
              </div>
              <a href="#collapse3" class="list-group-item" data-toggle="collapse"><span class="glyphicon glyphicon-tower" aria-hidden="true"></span> Properties </a>
              <div id="collapse3" class="list-group panel-collapse collapse">
                <a href="insertProperty.php" class="list-group-item"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Property</center></a>
                <a href="listProperties.php" class="list-group-item"><center><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Properties List</center></a>
              </div>
              <a href="#collapse4" class="list-group-item" data-toggle="collapse"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Contracts </a>
              <div id="collapse4" class="list-group panel-collapse collapse">
                <a href="insertContract.php" class="list-group-item"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Contract</center></a>
                <a href="listContracts.php" class="list-group-item"><center><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Contracts List</center></a>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">System Overview</h3>
              </div>
              <div class="panel-body">
                <div class="col-md-3">
                  <div class="well dash-box">
                                                                        <!--I reduced 1, I do not wanna show admin user-->
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $countEmployee - 1 ?></h2>
                    <h4>Employees</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <?php echo $countClient?></h2>
                    <h4>Clients</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-tower" aria-hidden="true"></span> <?php echo $countProperty?></h2>
                    <h4>Properties</h4>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="well dash-box">
                    <h2><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> <?php echo $countContract?></h2>
                    <h4>Contracts</h4>
                  </div>
                </div>
              </div>
              </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright Montreal to Rent, &copy; 2020</p>
    </footer>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
