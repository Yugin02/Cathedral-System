<?php
include '../connect.php';

if(isset($_GET['deleteid'])){
  $id = $_GET['deleteid'];

  $sql = "delete from `baptismal` where id=$id";
  $result = mysqli_query($con, $sql);
  if($result){
    header('location:baptismal.php');
  } else {
    die(mysqli_error($con));
  }
}
?>