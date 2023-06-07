<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

if (!isset($_SESSION['username'])) {
  header('Location: index.php');
  exit();
}

  $email = $_SESSION['email'];

  if (isset($_POST['submit']))
  {
    $new_name = trim($_POST['name']);
		$new_email = trim($_POST['email']);
    $new_num = trim($_POST['mobilenumber']);


		if (!empty($new_name) && !empty($new_email) ) {

	

			$query = $db->query("SELECT * FROM tbladmin WHERE Email = '$email'");

			if ($query->rowCount() === 1) {
				
				try {
					$sql = $db->query(" UPDATE tbladmin SET AdminName = '$new_name', Email = '$new_email', MobileNumber = '$new_num' WHERE email = '$email' ");
					$_SESSION['update_success'] = "You have successfully updated your account details.";
				} catch (PDOException $e) {
					echo 'Email is already taken';
				}
	
			} else {
				$_SESSION['update_fail'] = 'Password does not exist';
				echo 'Password not found';
			}
		}
	}
  
  ?>
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
              <h3 class="page-title">Teacher Profile </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Teacher Profile</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title" style="text-align: center;">Teacher Profile</h4>
                   
                    <form class="forms-sample" method="post">
                    <?php 
						$query = $db->query("SELECT * FROM tbladmin");
						if ($query->rowCount() === 1) {
							while ($row = $query->fetch(PDO::FETCH_OBJ)) {						
					?> 
                      <div class="form-group">
                        <label for="exampleInputName1">Teacher Name</label>
                        <input type="text" name="adminname" value="<?php  echo $row->AdminName;?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputEmail3">User Name</label>
                        <input type="text" name="username" value="<?php  echo $row->UserName;?>" class="form-control" readonly="">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputPassword4">Contact Number</label>
                        <input type="text" name="mobilenumber" value="<?php  echo $row->MobileNumber;?>"  class="form-control" maxlength='10' required='true' pattern="[0-9]+">
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">Email</label>
                         <input type="email" name="email" value="<?php  echo $row->Email;?>" class="form-control" required='true'>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputCity1">Registration Date</label>
                         <input type="text" name="" value="<?php  echo $row->RegDate;?>" readonly="" class="form-control">
                      </div><?php $cnt=$cnt+1;}} ?> 
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
</html> 