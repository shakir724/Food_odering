<?php 
ob_start();//to solve warring header can not modify
include('top(header).php');
include('../function.inc.php');
#define("path", "C:/xampp/htdocs/phpbasic/media/image/");

$msg="";
$category_id="";
$dish="";
$dish_detail="";
$image="";
$food_type="";
$id="";
$image_status='required';

if(isset($_GET['id']) && $_GET['id']>0)
{
$id=$_GET['id'];
$row=mysqli_fetch_assoc(mysqli_query($con,"select * from dish where id='$id'"));
$category_id=$row['category_id']; //retrive the value from database and store in variable
$dish=$row['dish']; //retrive the value from database and store in variable
$dish_detail=$row['dish_detail'];//retrive the value from database and store in variable
$image=$row['image'];

$image_status="";//it will empty meeans not required in uploads 
}

//to remove data from edit button
if(isset($_GET['dish_details_id']) && $_GET['dish_details_id']>0){//here we go on this condtion if dish_details_id and dish_details_id is getrethen 0 then excute this
  $dish_details_id=$_GET['dish_details_id'];//here we store the value of dish_deatlis_id http://localhost/phpbasic/mange_dish.php?id=3&**(dish_details_id=6)***
  $id=$_GET['id'];////here we store the value of id http://localhost/phpbasic/mange_dish.php?**(id=3)**&dish_details_id=6
  mysqli_query($con,"delete from dish_details where id='$dish_details_id'");
  header('location:mange_dish.php?id='.$id);

}

if(isset($_POST['submit'])){ //when we submiting the from
    
  #prx($_POST);
  
  $category_id=$_POST['category_id'];    
    $dish=$_POST['dish'];
    $food_type=$_POST['type'];
    #$dish_detail=$_POST['dish_detail'];
    $added_on=date('y-m-d h:i:s');

    if($id=='')
    {
       $sql="select * from dish where dish='$dish'"; //uniuqe value is 
    }else
    {
      $sql="select * from dish where dish='$dish' and id!='$id'"; // curent id ke alwa koi aur id mein ye category match ho rahi hai ye nhe (check cstegory of cureent id  not same in other id)
    }

    if(mysqli_num_rows(mysqli_query($con,$sql))>0)//agr query ka output 0 se greter raha tu vallue phley se exixts hai
    {
        $msg="Dish Alredy Exists ";
    }else

    {
      
      if($id=='')
      {
      $image=$_FILES['image']['name'];#we get the img from input text whos name is image and $image contain img detail in array
      move_uploaded_file($_FILES['image']['tmp_name'],"C:/xampp/htdocs/phpbasic/media/image/".$_FILES['image']['name']);
      
        mysqli_query($con,"insert into dish(category_id,dish,dish_detail,status,added_on,image,type) values('$category_id','$dish','$dish_detail','1','$added_on','$image','$food_type')");
        //-----code for the attributr data its take the data and store in dish_deteils------//
        $did=mysqli_insert_id($con);//last record which is enter when submit the page
        $attributeArr=$_POST['attribute'];//store the data to attribute text box in $attributeArr
        $priceArr=$_POST['price'];//store the data to price text box in $priceArr
        foreach($attributeArr as $key=>$val){
          $attribute=$val;
          $price=$priceArr[$key];
        mysqli_query($con,"insert into dish_details(dish_id,attribute,price,status,added_on) values('$did','$attribute','$price',1,'$added_on',)");
        }


        
        }else
        {
          $image_condition='';
          if($_FILES['image']['name']!=''){//here we check the image file array not empty its has img name , tmp_name etc..
              $image=$_FILES['image']['name'];
              move_uploaded_file($_FILES['image']['tmp_name'],"C:/xampp/htdocs/phpbasic/media/image/".$_FILES['image']['name']);
              $image_condition=", image='$image'";//this is sql statment
            }
          
            $sql="update dish set category_id='$category_id', dish='$dish',  type='$food_type', dish_detail='$dish_detail' $image_condition where id='$id'";
            mysqli_query($con,$sql);

              //here we check attributes is going to upadte or insert//
         $attributeArr=$_POST['attribute'];//store the data to attribute text box in $attributeArr
        $priceArr=$_POST['price'];//store the data to price text box in $priceArr
        $dishDetailsIdArr=$_POST['dish_details_id'];
            foreach($attributeArr as $key=>$val){
          $attribute=$val;
          $price=$priceArr[$key];         

          if(isset($dishDetailsIdArr[$key]))//if  the key exixt then it goin to update 
          {
            $did=$dishDetailsIdArr[$key];
              mysqli_query($con,"update dish_details set attribute='$attribute',price='$price' where id='$did'");
          }
          else{
              mysqli_query($con,"insert into dish_details(dish_id,attribute,price,status,added_on) values('$id','$attribute','$price',1,'$added_on')");
          }
        
        }
      
           
          
        }
        
        header('location:dish.php');
    }
}
$res_category=mysqli_query($con,"select * from category where status='1' order by category asc");
$arrtype=array("VEG","NON-VEG");//array for type to show dropdown with two options
ob_end_flush();
?>
<!doctype html>
<html lang="en">

<head>
  <title>Title</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/css/bootstrap-datepicker.min.css">
  <link rel="stylesheet" href="assets/css/font.css"> <!-- font aowse icon cdn-->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/style.css">


</head>

<body>




  <form method="post" enctype="multipart/form-data">
    <!-- enctype to uplod file on server -->
    <div class="form-group">
      <label for="exampleInputName">Dish</label>
      <!-- Specifies the id of the form element the label should be bound to -->
      <br>
    </div>
    <div class="form-group">
      <label for="exampleInputName1 ">Category</label>
      <select class="form-control" name="category_id" required>
        <option value="">Select Category</option>
        <?php
  while($row_category=mysqli_fetch_assoc($res_category))
  {
    if($row_category['id']==$category_id){ //when we go to edit then they call the value from this condition
      echo "<option value='".$row_category['id']."'selected>".$row_category['category']."</option>";
    }else{
    echo "<option value='".$row_category['id']."'>".$row_category['category']."</option>";
  }
  }
  ?>
      </select>
    </div>
        <div class="form-group">
      <label for="exampleInputName1 ">Type</label>
      <select class="form-control" name="type" required>
        <option value="">Select Type</option>
        <?php
        foreach($arrtype as $list){
          if($list==$food_type){
              echo "<option value='$list' selected> $list</option>";
          }else{
            echo "<option value='$list'> $list</option>";
          }
          
        }
        
        ?>
        
      </select>
    </div>
    <div class="form-group">
      <label for="exampleInputName">Dish</label>

      <input type="text" class="form-control" placeholder="Dish" name="dish" value="<?php echo $dish ?>" required>
      <!--value is used to show if duplicate entery enter then without erasing the textbox show alrdy exixts-->
      <div style="color:red;"><?php echo $msg ?></div>
    </div>

    <label for="exampleInputName">Dish Image</label> &nbsp &nbsp

    <input type="file" placeholder="Dish Image" name="image" <?php echo $image_status ?>>
    <!-- create a variable to which change if we add any data then its requred and if we edit then it not requred-->

    <br><br>
    <div class="form-group" id="box">
      <!--give id to call jquery div colse after php tag -->
      <label>Dish Details</label>
      <?php if($id==0){?>
      <!--php code for attribute when the id (getting from url ) is 0 then this condition is for addingn data-->
      <div class="form-group" id="box">
        <!--give id to call jquery -->
        <div class="row ">
          <div class="col-6">
            <input type="text" class="form-control" placeholder="Attribute" name="attribute[]" required>
          </div>
          <div class="col-6">
            <input type="text" class="form-control" placeholder="Price" name="price[]" required>
          </div>
      </div>
    </div>
      

      <?php } else {
          $dish_details_res=mysqli_query($con,"select * from dish_details where dish_id='$id'");
          $ii=1;
          while($dish_details_row=mysqli_fetch_assoc($dish_details_res)){
          ?>
      <!--if id is not 0 then the gievn code is excute we put this in while loop to get data of id we get from url-->
      <div class="form-group " id="box">
        <!--give id to call jquery -->
        <div class="row ">
          <!--this tag give id to data is store in database and if we clk on add more then this not gat any id using this logic we can update the value which have id and insert value which not have any id -->
              <input type="hidden" class="form-control" name="dish_details_id[]" required
                value="<?php echo $dish_details_row['id']?>">
           
          <div class="col-5">
            <input type="text" class="form-control" placeholder="Attribute" name="attribute[]" required
              value="<?php echo $dish_details_row['attribute']?>">
          </div>
          <div class="col-5">
            <input type="text" class="form-control" placeholder="Price" name="price[]" required
              value="<?php echo $dish_details_row['price']?>">
          </div>
          <?php if($ii!=1){?><!--we force fully put remove button on attributr excpet 1sr one-->
          
                <div class="col-2"><button type="button" class="btn  btn-link" onclick="remove_new('<?php echo $dish_details_row['id']?>')"><i class="fa fa-close " style="font-size:30px;color:red;text-align:center; width:100%;"></i></button></div><!--here we add evnt to remove the one attribute from database -->

          <?php } ?>
        </div>
      </div>

      <?php $ii++;  } } ?>
    </div>
    <!--div colse-->




    <!-- *option in our case*
<div class="form-group">
<label for="exampleInputName">Dish_Detail</label>
  <textarea class="form-control" name="Dish_Detail" id="dish_detail" rows="3"><?php #echo $row['dish_detail'] ?></textarea>
</div>
  </div> -->

    <button type="button" class="btn  btn-link" onclick=addmore()>Add More</button>&nbsp
    <!--when cilck on button addmore fuction is call using javascrpit-->
    <br>
    <br>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>

  </form>
  <input type="hidden" id="add_more" value="1">
  <!--When new row add we also add one ID which hlep to remove the row-->
  <script>
    function addmore() {
      var add_more = $('#add_more').val(); //here we take the value of textbox who's id is add_more and incress by on
      add_more++;
      $('#add_more').val(
      add_more); //here the incress value is add to the variable add_more futher use to remove the row
      var a = '<div class="row" id="b' + add_more +'"><div class="col-5"> <input type="text" class="form-control" placeholder="Attribute" name="attribute[]" required></div><div class="col-5"><input type="text" class="form-control" placeholder="Price" name="price[]" required></div><div class="col-2"><button type="button" class="btn  btn-link" onclick=remove("'+add_more +'")><i class="fa fa-close " style="font-size:30px;color:red;text-align:center; width:100%;"></i></button></div></div>'; //here in first div we crete a id whos id is increse as the text box add_more increaes
      $('#box').append(a);
    }

    function remove(id) {
      $('#b' + id).remove();

    }
    function remove_new(id) {
     var result=confirm('Are You Sure');//we want to confirm to remove this 
     if(result==true){
       var  cur_path=window.location.href; //its give the current url 
       window.location.href=cur_path+"&dish_details_id="+id; //http://localhost/phpbasic/mange_dish.php?id=3&dish_details_id=6 here we get the id of the that data know we can remove this data using this id
     }

    }
  </script>


  <!-- Optional JavaScript -->

  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
</body>

</html>




<?php include('footer.php');?>