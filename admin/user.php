<?php 
ob_start(); //to solve warring header can not modify
include('top(header).php');



if(isset($_GET['type']) && $_GET['type']!=='' && isset($_GET['id']) && $_GET['id']>0){


  $type=$_GET['type'];
  $id=$_GET['id'];

  /*pehle type  check ho ga then wo database may active or deactive insert kr dee*/
  if($type=='active' || $type=='deactive' ){
    $status=1; #defualt status is 1 
    if($type=='deactive')
    {
      $status=0;
    }
    mysqli_query($con,"update user set status='$status' where id='$id'");
    
    header('location:user.php');
  }
  
}
$sql="select * from user order by id desc";//The DESC command is used to sort the data returned in descending order.
$res=mysqli_query($con,$sql);
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Food Ordering Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
      
        
          <div class="card">
            <div class="card-body  ">
              <h4 class="card-titl h1" style="text-size:60px; text-decoration:bold; color:red; ">User Master</h4>
              <br><br>              
              <div class="row">
                <div class="col-12">
                  <div class="table-responsive">
                    <table id="order-listing" class="table">
                      <thead>
                        <tr>
                            <th width="10%">S.no</th>
                            <th width="25%">Name</th>
                            <th width="25%">Email</th>
                            <th width="25%">Mobile</th>
                            <th width="25%">Joining Date</th>
                            <th width="15%">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php if (mysqli_num_rows($res)>0)
                      {
                      $i=1;
                      while($row=mysqli_fetch_assoc($res)){
                      ?>
                        <tr>
                            <td><?php echo $i ?></td>
                            <td><?php echo($row['name'])?></td>
                            <td><?php echo($row['email'])?></td>
                            <td><?php echo($row['mobile'])?></td>
                            <td><?php echo($row['added_on'])?></td>
                            <td>
                            <?php
								if($row['status']==1){
								?>
								<a href="?id=<?php echo $row['id']?>&type=deactive"><label class="badge badge-danger  ">Active</label></a>
								<?php
								}else{
								?>
								<a href="?id=<?php echo $row['id']?>&type=active"><label class="badge badge-info">Deactive</label></a>
								<?php
								}
								
								?>
							
                
              </td>
                            
                        </tr>
                      <?php
                    $i++;
                    } } else {?>
                        <tr>
                        <td colspan="5">No Data Found</td>
                        
                        </tr>


                       <?php } ?>
                        
                      </tbody>
                    </table>
                  </div>
				</div>
              </div>
            </div>
          </div>
        
		</div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright ?? 2018 <a href="https://www.urbanui.com/" target="_blank">Urbanui</a>. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    


  <!-- plugins:js -->
  <script src="assets/js/vendor.bundle.base.js"></script>
  <script src="assets/js/jquery.dataTables.js"></script>
  <script src="assets/js/dataTables.bootstrap4.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/js/Chart.min.js"></script>
  <script src="assets/js/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/template.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="assets/js/dashboard.js"></script>
  <script src="assets/js/data-table.js"></script>
  <!-- End custom js for this page-->
</body>
</html>
<?php include('footer.php');?>