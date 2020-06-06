<?php
require_once 'StartSession.php';
require_once "connex.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System | New Property</title>
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Properties</h1>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li>Dashboard</li>
          <li>Properties</li>
          <li class="active">New Property</li>
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
                    <div id="collapse2" class="list-group panel-collapse collapse">
                        <a href="insertClient.php" class="list-group-item"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Client</center></a>
                        <a href="listClients.php" class="list-group-item"><center><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Clients List</center></a>
                    </div>
                    <a href="#collapse3" class="list-group-item" data-toggle="collapse"><span class="glyphicon glyphicon-tower" aria-hidden="true"></span> Properties </a>
                    <div id="collapse3" class="list-group panel-collapse">
                        <a href="insertProperty.php" class="list-group-item active"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Property</center></a>
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
                <h3 class="panel-title"><center>New Property</center></h3>
              </div>
              <div class="panel-body">
                <form class="well form-horizontal" action="handleProperty.php" method="post"  id="newEmployee">
                  <fieldset>
                    <!-- Form Name -->
                    <legend><center><h2><b>Property Form</b></h2></center></legend><br>

                    <?php
                      if(isset($_GET['msg'])){
                        if($_GET['msg']==1){
                          ?>
                          <div class="alert alert-success alert-dismissible fade in" role="alert">
                            <strong>Property</strong> registered with success!
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <?php
                        }
                      }
                    ?>
                    
                    <!-- Select input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label">Property Type</label>
                      <div class="col-md-4 selectContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-th-list"></i></span>
                          <select name="propertyTypeId" class="form-control selectpicker" required>

                            <?php
                            $select = "SELECT typeId, typeName FROM montrealtorent.type ORDER BY typeName;";
                            $statement = $pdo -> query($select);
                            foreach($statement as $row){
                              ?>
                              <option value="<?php echo $row['typeId'];?>"><?php echo $row['typeName'];?></option>
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
                          <input  name="propertyStreet" placeholder="number and street" class="form-control"  type="text" maxlength="30" required>
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Address Complement</label>  
                      <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                          <input  name="propertyAddressComp" placeholder="Complement..." class="form-control"  type="text"  maxlength="30">
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Zip Code</label>  
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                          <input  name="propertyZipCode" placeholder="Ex: H3T 2Y6" class="form-control"  type="text"  maxlength="7" required>
                        </div>
                      </div>
                    </div>

                    <!-- Number input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Area m²</label> 
                      <div class="col-md-2 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-screenshot"></i></span>
                          <input name="propertyArea" class="form-control"  type="number" required>
                        </div>
                      </div>
                    </div>

                    <!-- Number input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Bedrooms</label> 
                      <div class="col-md-2 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-bed"></i></span>
                          <input name="propertyBedrooms" class="form-control"  type="number" required>
                        </div>
                      </div>
                    </div>

                    <!-- Number input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Bathrooms</label> 
                      <div class="col-md-2 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-inbox"></i></span>
                          <input name="propertyBathrooms" class="form-control"  type="number" required>
                        </div>
                      </div>
                    </div>

                <!-- Text input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Description</label> 
                      <div class="col-md-8 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-text-size"></i></span>
                          <textarea name="propertyDescription" rows="6" placeholder="Describe the property" class="form-control" required></textarea>
                        </div>
                      </div>
                    </div>

                    <!-- Number input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Price per Month</label>  
                      <div class="col-md-3 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                          <input  name="propertyPrice" class="form-control"  type="number" required>
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