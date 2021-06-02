<?php
session_start();
include ("function.inc.php");
include ("database.inc.php");


$attr=$_POST['attr'];
$qty=$_POST['qty'];
$type=$_POST['type'];
if($type=='add'){//here we check the type and then check user is login or not
    if(isset($_SESSION['FOOD_USER_ID'])){
        $id=$_SESSION['FOOD_USER_ID'];
        $check=mysqli_query($con,"select * from dish_cart where user_id=$id and dish_detail_id='$attr'");
        if(mysqli_num_rows($check)>0){//if date alerdy persent then we update 
            $row=mysqli_fetch_assoc($check);
            $cid=$row['id'];
            mysqli_query($con,"update dish_cart set qty='$qty' where id='$cid'");
        }else{//if data no alerdy persent then we insert
            $added_on=date('Y-m-d h:i:s');
                mysqli_query($con,"insert into  dish_cart(user_id,dish_detail_id,qty,added_on) values('$id','$attr','$qty','$added_on')");
        }
    }else{
        $_SESSION['cart'][$attr]['qty']=$qty;//if product alredy in cart then update the qty
        
    }
}


?>
 