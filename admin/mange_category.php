<?php 
ob_start();//to solve warring header can not modify
include('top(header).php');
$msg="";
$order_number="";
$category="";
$id="";

if(isset($_GET['id']) && $_GET['id']>0)
{
$id=$_GET['id'];
$row=mysqli_fetch_assoc(mysqli_query($con,"select * from category where id='$id'"));
$category=$row['category'];//retrive the value from database and store in variable
$order_number=$row['order_number'];//retrive the value from database and store in variable
}

if(isset($_POST['submit'])){
    $category=$_POST['category'];
    $order_number=$_POST['order_number'];
    $added_on=date('y-m-d h:i:s');

    if($id=='')
    {
       $sql="select * from category where category='$category'";
    }else
    {
      $sql="select * from category where category='$category' and id!='$id'"; // curent id ke alwa koi aur id mein ye category match ho rahi hai ye nhe (check cstegory of cureent id  not same in other id)
    }

    if(mysqli_num_rows(mysqli_query($con,$sql))>0)//agr query ka output 0 se greter raha tu vallue phley se exixts hai
    {
        $msg="category Alredy Exists ";
    }else
    {
      if($id=='')
      {
        mysqli_query($con,"insert into category(category,order_number,status,added_on) values('$category','$order_number','1','$added_on')");
        
        }else
        {
          mysqli_query($con,"update category set category='$category', order_number='$order_number'  where id='$id'");
     
        }
        header('location:Category.php ');
        
    }
   
  }
  ob_end_flush();//to solve warring header can not modify
?>
<!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  </head>
  <body>
      



        <form method="post">
        <div class="form-group" >
          <label for="exampleInputName">Category</label>
          
          <input type="text" class="form-control" placeholder="Category" name="category" value="<?php echo $category ?>" required><!--value is used to show if duplicate entery enter then without erasing the textbox show alrdy exixts-->
          <div style="color:red;"><?php echo $msg ?></div>
        </div>
        <div class="form-group">
          <label for="exampleInputOrder_Numaber">Order_Number</label>
          <input type="text" class="form-control"  placeholder="Order_Number" name="order_number" value="<?php echo $order_number ?>" required >
        </div>
  
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
</form>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>




<?php include('footer.php');?>