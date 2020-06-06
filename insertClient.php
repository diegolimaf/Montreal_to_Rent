<?php
require_once 'StartSession.php';
require_once "connex.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (isset($_POST['submit'])){
    $v_name = $_POST['clientName'];

    if (empty($v_name))
    {
      $nameError = "Field required!";
    }
    if (!preg_match("/^[A-Za-z]+$", $v_name) && strlen($v_name) < 2)
    {
      $nameError = "Invalid name";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System | New Client</title>
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Clients</h1>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li>Dashboard</li>
          <li>Clients</li>
          <li class="active">New Client</li>
        </ol>
      </div>
    </section>

    <section id="main">
      <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="list-group">
                    <a href="dashboard.php" class="list-group-item main-color-bg">
                    <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Dashboard</a>
                    <a href="#collapse1" class="list-group-item" data-toggle="collapse"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Employees </a>
                    <div id="collapse1" class="list-group panel-collapse collapse">
                        <a href="insertEmployee.php" class="list-group-item"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Employee</center></a>
                        <a href="listEmployees.php" class="list-group-item"><center><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Employees List</center></a>
                    </div>
                    <a href="#collapse2" class="list-group-item" data-toggle="collapse"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Clients </a>
                    <div id="collapse2" class="list-group panel-collapse">
                        <a href="insertClient.php" class="list-group-item active"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Client</center></a>
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
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title"><center>New Client</center></h3>
              </div>
              <div class="panel-body">
                <form class="well form-horizontal" action="handleClient.php" method="post"  id="newEmployee">
                  <fieldset>
                    <!-- Form Name -->
                    <legend><center><h2><b>Registration Form</b></h2></center></legend><br>

                    <?php
                      if(isset($_GET['msg'])){
                        if($_GET['msg']==2){
                          ?>
                          <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <strong>Client</strong> REGISTERED with success!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <?php
                        }
                        
                      }
                    ?>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Name</label>  
                      <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <input name="clientName" placeholder="Full Name" class="form-control" type="text" maxlength="40">
                        </div>
                      </div>
                    </div>

                <!-- Text input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Birthday</label> 
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                          <input name="clientBirthday" class="form-control"  type="date">
                        </div>
                      </div>
                    </div>

                <!-- Text input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Email</label> 
                      <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                          <input name="clientEmail" placeholder="Email" class="form-control"  type="email" maxlength="40">
                        </div>
                      </div>
                    </div>

                <!-- number input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Phone number</label>  
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                          <input name="clientPhone" class="form-control" type="tel" mxlength="15">
                        </div>
                      </div>
                    </div>

                    <!-- Select option-->
                    <div class="form-group"> 
                      <label class="col-md-4 control-label">City</label>
                      <div class="col-md-4 selectContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                          <select name="userCityId" class="form-control selectpicker">

                            <?php
                            $select = "SELECT cityId, cityName FROM montrealtorent.city ORDER BY cityName;";
                            $statement = $pdo -> query($select);
                            foreach($statement as $row){
                              ?>
                              <option value="<?php echo $row['cityId'];?>"><?php echo $row['cityName'];?></option>
                            <?php
                            }
                            ?>

                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Address</label>  
                      <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                          <input  name="clientStreet" placeholder="number and street" class="form-control"  type="text" maxlength="30">
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Address Complement</label>  
                      <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                          <input  name="clientAddressComp" placeholder="Complement..." class="form-control"  type="text"  maxlength="30">
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Zip Code</label>  
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                          <input  name="clientZipCode" placeholder="Ex: H3T 2Y6" class="form-control"  type="text"  maxlength="7">
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Username</label> 
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <input name="userUsername" placeholder="Username" class="form-control"  type="Username" maxlength="15">
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >User Privilege</label> 
                      <div class="col-md-4 selectContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <select name="userPrivilegeId" class="form-control selectpicker" readonly="readonly">

                            <?php
                            $select = "SELECT privilegeId, privilegeName FROM montrealtorent.privilege WHERE privilegeName = 'Client';";
                            $statement = $pdo -> query($select);
                            foreach($statement as $row){
                              ?>
                              <option value="<?php echo $row['privilegeId'];?>"><?php echo $row['privilegeName'];?></option>
                            <?php
                            }
                            ?>

                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Password</label> 
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                          <input name="userPassword" placeholder="Password" class="form-control"  type="password" maxlength="15">
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Confirm Password</label> 
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                          <input name="confirm_password" placeholder="Confirm Password" class="form-control"  type="password" maxlength="15">
                        </div>
                      </div>
                    </div>

                <!-- Button -->
                <div class="form-group">
                <label class="col-md-4 control-label"></label>
                <div class="col-md-4"><br>
                &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="SEND" class="btn btn-warning" >&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                </div>
                </div>

                </fieldset>
                </form>
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

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>