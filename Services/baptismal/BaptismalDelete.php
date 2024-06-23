<?php
include '../../database.php';

if (isset($_GET['deleteid'])) {
  $id = $_GET['deleteid'];

  $sql_select = "SELECT * FROM `baptismal` WHERE id=$id";
  $result_select = mysqli_query($con, $sql_select);
  $row = mysqli_fetch_assoc($result_select);
  $file_name = $row['live_birth_image'];

  $filePath = '../../images/Baptismal/' . $file_name;
  unlink($filePath);

  $sql = "DELETE from `baptismal` where id=$id";
  $result = mysqli_query($con, $sql);
  if ($result) {
    header('location:baptismal.php');
  } else {
    die(mysqli_error($con));
  }
}
