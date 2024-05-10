<?php
include '../connect.php';

if (isset($_GET['deleteid'])) {
  $id = $_GET['deleteid'];

  $sql_select = "SELECT * FROM `death_and_burial` WHERE id=$id";
  $result_select = mysqli_query($con, $sql_select);
  $row = mysqli_fetch_assoc($result_select);
  $file_name = $row['death_cert_images'];

  $filePath = '../../images/Death and Burial/' . $file_name;
  unlink($filePath);

  $sql = "DELETE from `death_and_burial` where id=$id";
  $result = mysqli_query($con, $sql);
  if ($result) {
    header('location:deathAndBurial.php');
  } else {
    die(mysqli_error($con));
  }
}
