<?php
include '../connect.php';

if(isset($_GET['deleteid'])){
  $id = $_GET['deleteid'];

  $sql = "delete from `death_and_burial` where id=$id";
  $result = mysqli_query($con, $sql);
  if($result){
    header('location:deathAndBurial.php');
  } else {
    die(mysqli_error($con));
  }
}
?>