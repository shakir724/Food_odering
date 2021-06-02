<?php
session_start();
unset($_SESSION['FOOD_USER_ID']);
unset( $_SESSION['FOOD_USER_NAME']);
header("location:shop.php");



?> 