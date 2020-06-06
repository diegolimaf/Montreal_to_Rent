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
    <title>System | Contracts</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
            <h1><span class="glyphicon glyphicon-cog" aria-hidden="true"></span> Contracts</h1>
        </div>
      </div>
    </header>

    <section id="breadcrumb">
      <div class="container">
        <ol class="breadcrumb">
          <li>Dashboard</li>
          <li>Contracts</li>
          <li class="active">Contracts List</li>
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
                    <div id="collapse3" class="list-group panel-collapse collapse">
                        <a href="insertProperty.php" class="list-group-item"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Property</center></a>
                        <a href="listProperties.php" class="list-group-item"><center><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Properties List</center></a>
                    </div>
                    <a href="#collapse4" class="list-group-item" data-toggle="collapse"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Contracts </a>
                    <div id="collapse4" class="list-group panel-collapse">
                        <a href="insertContract.php" class="list-group-item"><center><span class="glyphicon glyphicon-user" aria-hidden="true"></span> New Contract</center></a>
                        <a href="listContracts.php" class="list-group-item active"><center><span class="glyphicon glyphicon-list" aria-hidden="true"></span> Contracts List</center></a>
                    </div>
                </div>
            </div>
          <div class="col-md-9">
            <!-- Website Overview -->
            <div class="panel panel-default">
              <div class="panel-heading main-color-bg">
                <h3 class="panel-title">Contracts List</h3>
              </div>
              <div class="panel-body table-responsive">
                <table class="table table-striped table-hover table-bordered" id="dataTable">
                  <thead>
                    <tr>
                      <th scope="col">#ID</th>
                      <th scope="col">Client</th>
                      <th scope="col">Address</th>
                      <th scope="col">Start Date</th>
                      <th scope="col">End Date</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                    $sql = "SELECT contractId, contractClientId, clientName, contractPropertyId, propertyStreet, contractStart, contractEnd 
                            FROM montrealtorent.contract INNER JOIN montrealtorent.client on (contractClientId = clientUserId)
                            INNER JOIN montrealtorent.property on (contractPropertyId = propertyId);";
                    
                    $stmt=$pdo->query($sql);
                    foreach($stmt as $row){
                      $date = $row['contractStart'];
                      $year = date('Y', strtotime($date));
                  ?>
                    <tr>
                    <th scope="row"><?php echo $row['contractId'];?></th>
                      <td><?php echo $row['clientName'];?></td>
                      <td><?php echo $row['propertyStreet'];?></td>
                      <td><?php echo $row['contractStart'];?></td>
                      <td><?php echo $row['contractEnd'];?></td>
                      <td><a href="listContracts.php?edit=<?php echo $row['contractId']?>" class="btn btn-primary">View</a></td>
                      <!--<td><a href="" class="btn btn-primary" >View</a></td>-->
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
        $contractId = $_GET['edit'];
        $sql = "SELECT * FROM montrealtorent.contract WHERE contractId = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($contractId));
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
            <center><h3 class="modal-title" id="label">View Contract</h3></center>
          </div>
          <div class="modal-body">
          <form class="well form-horizontal" action="handleContract.php" method="post"  id="newEmployee">
                  <fieldset>
                    
                    <!-- Select input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label">Client</label>
                      <div class="col-md-7 selectContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                          <select name="contractClientId" class="form-control selectpicker" readonly="readonly">
                              <option value="">Select</option>

                            <?php
                            $select = "SELECT clientUserId, clientName, clientBirthday FROM montrealtorent.client ORDER BY clientName;";
                            $statement = $pdo -> query($select);
                            foreach($statement as $row){
                              ?>
                              <option value="<?php echo $row['clientUserId'];?>" <?php if ($row['clientUserId'] == $contractClientId){echo "selected";}?>><?php echo $row['clientName']." / DOB: ".$row['clientBirthday']; ?></option>
                            <?php
                            }
                            ?>

                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- Select input-->

                    <div class="form-group">
                      <label class="col-md-4 control-label">Property</label>
                      <div class="col-md-8 selectContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-tent"></i></span>
                          <select name="contractPropertyId" class="form-control selectpicker" readonly="readonly">
                              <option value="">Select</option>

                            <?php
                            $select = "SELECT propertyId, propertyStreet, propertyAddressComp, propertyZipCode, typeName
                                        FROM montrealtorent.property INNER JOIN montrealtorent.type on (propertyTypeId = typeId)
                                        ORDER BY typeName, propertyStreet;";
                            $statement = $pdo -> query($select);
                            foreach($statement as $row){
                              ?>
                              <option value="<?php echo $row['propertyId'];?>" <?php if ($row['propertyId'] == $contractPropertyId){echo "selected";}?>><?php echo $row['typeName']." - Address: ".$row['propertyStreet']." ".$row['propertyAddressComp'].", ".$row['propertyZipCode']; ?></option>
                            <?php
                            }
                            ?>

                          </select>
                        </div>
                      </div>
                    </div>

                    <!-- Date input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Start Date</label>  
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                          <input  name="contractStart" class="form-control" value="<?php echo $contractStart;?>" type="date" disabled>
                        </div>
                      </div>
                    </div>

                    <!-- Date input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">End Date</label>  
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                          <input  name="contractEnd" class="form-control" value="<?php echo $contractEnd;?>" type="date" disabled>
                        </div>
                      </div>
                    </div>

                    <!-- Number input-->
                    <div class="form-group">
                      <label class="col-md-4 control-label">Price per Month</label>  
                      <div class="col-md-4 inputGroupContainer">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-usd"></i></span>
                          <input  name="contractPrice" class="form-control" value="<?php echo $contractPrice;?>" type="number" disabled>
                        </div>
                      </div>
                    </div>
                  </fieldset>
                </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
          </div>
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
