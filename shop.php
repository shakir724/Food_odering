<?php
include ("header.php");

?>

        <div class="breadcrumb-area gray-bg">
            <div class="container">
                <div class="breadcrumb-content">
                    <ul >
                        <li ><a  href="shop.php">Shop</a></li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="shop-page-area pt-100 pb-100">
            <div class="container">
                <div class="row flex-row-reverse">
                <!--product part-->
                    <div class="col-lg-9">
                    <?php 
                     //we divide the sql statmet to show category wise product 
                     //here simple it take the  $product_sql and then go in if condition then take $product_sql and this make full sql query which further us in  $product_res=mysqli_query($con,*$product_sql*);
                     $product_sql="select * from dish where status=1 ";
                     if(isset($_GET['cat_id']) && $_GET['cat_id']>0){
                         $cat_id=$_GET['cat_id'];//if we get the id then we store in $cat_id
                         $product_sql.=" and category_id='$cat_id' ";
                     }
                      $product_sql.=" order by dish desc ";//here we divde the sql statment into two part
                     $product_res=mysqli_query($con,$product_sql);// we print the dish using dish name in descending order
                     $product_count=mysqli_num_rows($product_res);//here we check the output of data is gerter then zero using this we can print data found or not
                    ?>
                            <div class="grid-list-product-wrapper">
                            <div class="product-grid product-view pb-20">
                            <?php if($product_count>0){ ?> <!--if the data will gerter then zero then this loop exute-->
                                    <div class="row">
                                    <!--make while loop to fecth all the data-->
                                    <?php
                                    while($product_row=mysqli_fetch_assoc($product_res)){?>
                                        <div class="product-width col-xl-4 col-lg-4 col-md-4 col-sm-6 col-12 mb-30">
                                            <div class="product-wrapper">
                                                <div class="product-img">
                                                    <a href="product-details.php">
                                                        <img src="media/image/<?php echo $product_row['image'] ?>" width="150px" height="200px" ><!--here we give the path of the img and then call them using php-->
                                                    </a>
                                                </div>
                                                <div class="product-content">
                                                    <h4>
                                                    <?php
                                                        if($product_row['type']=='VEG'){
                                                                    echo "<img style='' src='assets/img/icon-img/VEG.png'>";
                                                        }else{
                                                                   echo "<img src='assets/img/icon-img/NON-VEG.png'>";
                                                        }
                                                        
                                                        ?>
                                                        <a href="product-details.php"><?php echo $product_row['dish'] ?></a>
                                                        
                                                    </h4>
                                                    <?php
                                                    $dish_attr_res=mysqli_query($con,"select * from dish_details where status='1' and dish_id='".$product_row['id']."' order by price asc");
                                                    ?>
                                                    <div class="product-price-wrapper">
                                                    <?php
                                                    while($dish_attr_row=mysqli_fetch_assoc($dish_attr_res)){
                                                        echo"<input  type='radio' name='radio_".$dish_attr_row['dish_id']."' id='radio_".$dish_attr_row['dish_id']."' value='".$dish_attr_row['id']."'style='height:20px; width:16px; margin-right:5px;'>";
                                                        echo  "<span style='font-family:Lemon/Milk;'>".$dish_attr_row['attribute']."</span>";
                                                        echo"&nbsp &nbsp ";
                                                        echo "<span style='color:red;'>".$dish_attr_row['price']."</span>";
                                                        echo"&nbsp ";
                                                    }?> 
                                                        
                                                    </div>
                                                    <div class="product-price-wrapper">
                                                    <select id="qty<?php echo $product_row['id']; ?>" style="height:24px; width:50%; border:1px solid black; margin-top:7px;">/**here we make id qty and id of that dish */
                                                        <option value="0"> Qty </option>
                                                        <?php
                                                         for($i=1;$i<=10;$i++){
                                                             echo"<option>$i </option>";
                                                         }
                                                        
                                                        ?>

                                                    </select>
                                                    <i class="fa fa-shopping-cart" style="font-size:25px; margin-left:5px; cursor:pointer;" onclick="add_to_cart('<?php echo $product_row['id'] ?>','add')" aria-hidden="true"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                         
                                                                    
                                    <?php } ?>
                                    
                                        
                                    </div>
                                <?php } else { //when product_count is less then zero means no data found
                                
                                echo "Sorry No Dish Found ...";
                                
                                } ?>
                            </div>
                            
                        </div>
                    </div>
                     <?php
                    $cat_res=mysqli_query($con,"select * from category where status=1 "); //here we show category from database whos status is active
                    ?>
                    <div class="col-lg-3">
                        <div class="shop-sidebar-wrapper gray-bg-7 shop-sidebar-mrg">
                            <div class="shop-widget">
                                <h4 class="shop-sidebar-title">Shop By Categories</h4>
                                <div class="shop-catigory">
                                    <ul id="faq">
                                    <?php 
                                        while($cat_row=mysqli_fetch_assoc($cat_res)){
                                        
                                       echo" <li class='nav-item'> <a class='nav-link' href='shop.php?cat_id=".$cat_row['id']."'><span style='a:link{color: green;}'>".$cat_row['category']."</span></a></li>" ;//we fetch data from $cat_row only category and in href we take the id of the cateogry for futher use 
                                       
                                        }?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       <script>
        
           function add_to_cart(id,type){
	var qty=jQuery('#qty'+id).val();
	var attr=jQuery('input[name="radio_'+id+'"]:checked').val();
	jQuery.ajax({
			url:'http://localhost/phpbasic/manage_cart.php',
			type:'post',
			data:'qty='+qty+'&attr='+attr+'&type='+type,
            success:function(result){
                swal("Congratulation!", "Dish added successfully", "success");
                
            }
		});
	
	
}
         
           
       </script>
<?php
include ("footer.php");
?>

