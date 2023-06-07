<?php
session_start();
error_reporting(0);
if (strlen($_SESSION['sturecmsstuid']==0)) {
  header('Location: logout.php');
  exit();
} else {

include 'includes/dbconnect.php';
$email = $_SESSION['email'];

if (isset($_POST['submit'])) {
  $name = trim($_POST['StudentName']);
  $old_password = trim($_POST['old_password']);
  $new_password = trim($_POST['new_password']);
  $new_address = trim($_POST['Address']);
  $new_email = trim($_POST['StudentEmail']);


  if (!empty($old_password) && !empty($new_password) && !empty($name) && !empty($new_email) && !empty($new_address)) {

    $old_password = md5($old_password);
    $new_password = md5($new_password);

    $query = $db->query("SELECT * FROM tblstudent WHERE Password = '$old_password' AND StudentEmail = '$email'");

    if ($query->rowCount() === 1) {
      
      try {
        $sql = $db->query(" UPDATE tblstudent SET StudentName = '$name', Password = '$new_password', StudentEmail = '$new_email', Address = '$new_address'  WHERE StudenEmail = '$email' ");
        $_SESSION['update_success'] = "You have successfully updated your account details.";
      } catch (PDOException $e) {
        echo 'Email is already taken';
      }

    } else {
      $_SESSION['update_fail'] = 'Password does not exist';
      echo 'Password not found';
    }
  }
}?>
<!DOCTYPE html>
<html lang="en">
  <head>
   
    <title>Student  Management System|| Profile</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/select2/select2.min.css">
    <link rel="stylesheet" href="vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="css/style.css" />
    
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
     <?php include_once('includes/header.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
      <?php include_once('includes/sidebar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Student Profile </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Student Profile</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Student Profile</h4>
                   
                    <form class="forms-sample" method="post">
                      <?php

$sql="SELECT * from  tblstudent where StudentEmail=:$email";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $row)
{               ?>
                      <div class="form-group">
                        <label for="exampleInputName1">User Name</label>
                        <input type="text" name="username" value="<?php  echo $row->UserName;?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">Student Name</label>
                        <input type="text" name="studentname" value="<?php  echo $row->StudentName;?>" class="form-control" readonly="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Contact Number</label>
                        <input type="text" name="contactnumber" value="<?php  echo $row->ContactNumber;?>"  class="form-control" maxlength='10' required='true' pattern="[0-9]+">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">Email</label>
                         <input type="email" name="email" value="<?php  echo $row->StudentEmail;?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">Address</label>
                         <input type="text" name="address" value="<?php  echo $row->Address;?>" class="form-control" required='true'>
                      </div>
                     <?php $cnt=$cnt+1;}} ?> 
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Update</button>
                     
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         <?php include_once('includes/footer.php');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/select2/select2.min.js"></script>
    <script src="vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="js/typeahead.js"></script>
    <script src="js/select2.js"></script>
    <!-- End custom js for this page -->
  </body>
</html> <?php } ?>