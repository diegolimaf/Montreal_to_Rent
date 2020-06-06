<?php
require_once 'StartSession.php';
require_once "connex.php";

if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "DELETE FROM montrealtorent.client WHERE clientUserId = ?;";
  $stmt = $pdo->prepare($sql);
  if($stmt->execute(array($id))){
    $sql = "DELETE FROM montrealtorent.user WHERE userId = ?;";
    $stmt = $pdo->prepare($sql);
    if($stmt->execute(array($id))){
      header("Location:listClients.php?msg=1");
    }else{
      print_r($stmt->errorInfo());
    }
  }else{
    print_r($stmt->errorInfo());
  }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>System | Clients</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <script src="http://cdn.ckeditor.com/4.6.1/standard/ckeditor.js"></script>
    <script src="js/jquery-3.4.1.min.js"></script>

    <?php
      if (isset($_GET['edit'])){
        echo "<script>
        $(document).ready(function(){
            $('#modal').modal('show');
        });
        </script>";
      }
    ?>
    
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
          <div class="col-md-10">
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Clients</h1>
          </div>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li>Dashboard</li>
          <li>Clients</li>
          <li class="active">Clients List</li>
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
                        <a href="insertClient.php" class="list-group-item"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Client</center></a>
                        <a href="listClients.php" class="list-group-item active"><center><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Clients List</center></a>
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
                <h3 class="panel-title">Clients List</h3>
              </div>
              <div class="panel-body table-responsive">
                <?php
                  if(isset($_GET['msg'])){
                    if($_GET['msg']==1){
                      ?>
                      <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <strong>Client</strong> DELETED with success!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php
                    }
                    else if($_GET['msg']==2){
                      ?>
                      <div class="alert alert-success alert-dismissible fade in" role="alert">
                        <strong>Client</strong> UPDATED with success!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php
                    }
                  }
                ?>
                <table class="table table-striped table-hover table-bordered" id="dataTable">
                  <thead>
                    <tr>
                      <th scope="col">#ID</th>
                      <th scope="col">Name</th>
                      <th scope="col">Email</th>
                      <th scope="col">Phone</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                        $sql = "SELECT clientUserId, clientName, clientEmail, clientPhone 
                                FROM montrealtorent.client ORDER BY clientName;";
                        
                        $stmt=$pdo->query($sql);
                        foreach($stmt as $row){
                    ?>
                    <tr>
                      <th scope="row"><?php echo $row['clientUserId'];?></th>
                      <td><?php echo $row['clientName'];?></td>
                      <td><?php echo $row['clientEmail'];?></td>
                      <td><?php echo $row['clientPhone'];?></td>
                      <td><a href="listClients.php?edit=<?php echo $row['clientUserId']?>" class="btn btn-primary">Edit</a>
                       <a href="listClients.php?id=<?php echo $row['clientUserId']?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <footer id="footer">
      <p>Copyright Montreal to Rent, &copy; 2020</p>
    </footer>

    <?php

      if(isset($_GET['edit'])){
        $clientUserId = $_GET['edit'];
        $sql = "SELECT * FROM montrealtorent.client INNER JOIN montrealtorent.user on (userId = clientUserId) WHERE clientUserId = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($clientUserId));
        $count = $stmt ->rowCount();
        if($count == 1){
        $info = $stmt->fetchAll();
        
        foreach($info[0] as $index=>$value){
          $$index = $value;
        }
        }else{
          echo "User does not exist!";
        }
      }

    ?>

    <!--Modal for edit content-->
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
          <center><h3 class="modal-title" id="label">Edit Client</h3></center>
          </div>
          <div class="modal-body">
          <form class="well form-horizontal" action="handleClient.php" method="post"  id="newEmployee">
                  <fieldset>

                  <input type="hidden" name="clientUserId" value="<?php echo $clientUserId;?>">
                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Name</label>
                      <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <input name="clientName" placeholder="Full Name" value="<?php echo $clientName;?>" class="form-control" type="text" maxlength="40" required>
                        </div>
                      </div>
                    </div>

                <!-- Text input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Birthday</label> 
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                          <input name="clientBirthday" class="form-control" value="<?php echo $clientBirthday;?>" type="date" required>
                        </div>
                      </div>
                    </div>

                <!-- Text input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Email</label> 
                      <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                          <input name="clientEmail" placeholder="Email" class="form-control" value="<?php echo $clientEmail;?>" type="email" maxlength="40" required>
                        </div>
                      </div>
                    </div>

                <!-- number input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Phone number</label>  
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-earphone"></i></span>
                          <input name="clientPhone" value="<?php echo $clientPhone;?>" class="form-control" type="tel" mxlength="15" required>
                        </div>
                      </div>
                    </div>

                    <!-- Select option-->
                    <div class="form-group"> 
                      <label class="col-md-4 control-label">City</label>
                      <div class="col-md-4 selectContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                          <select name="userCityId" class="form-control selectpicker" required>

                            <?php
                            $select = "SELECT cityId, cityName FROM montrealtorent.city ORDER BY cityName;";
                            $statement = $pdo -> query($select);
                            foreach($statement as $row){
                              ?>
                              <option value="<?php echo $row['cityId'];?>" <?php if ($row['cityId'] == $userCityId){echo "selected";}?>><?php echo $row['cityName'];?></option>
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
                          <input  name="clientStreet" placeholder="number and street" class="form-control" value="<?php echo $clientStreet;?>" type="text" maxlength="30" required>
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Address Complement</label>  
                      <div class="col-md-6 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                          <input  name="clientAddressComp" placeholder="Complement..." class="form-control" value="<?php echo $clientAddressComp;?>" type="text"  maxlength="30">
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Zip Code</label>  
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-globe"></i></span>
                          <input  name="clientZipCode" placeholder="Ex: H3T 2Y6" class="form-control" value="<?php echo $clientZipCode;?>" type="text"  maxlength="7" required>
                        </div>
                      </div>
                    </div>

                    <!-- Text input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label" >Username</label> 
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <input name="userUsername" placeholder="Username" class="form-control" value="<?php echo $userUsername;?>" type="Username" maxlength="15" required>
                        </div>
                      </div>
                    </div>

                </fieldset>
              </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                  <input type="submit" class="btn btn-primary" value="Save changes">
                </div>

                </form>
          
          
        </div>
      </div>
    </div>

  <script>
     CKEDITOR.replace( 'editor1' );
 </script>   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <!-- Page level plugins -->
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/datatables-demo.js"></script>
  </body>
</html>
