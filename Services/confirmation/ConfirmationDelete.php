<?php
include '../../database.php';

if (isset($_GET['deleteid'])) {
  $id = $_GET['deleteid'];

  $sql_select = "SELECT * FROM `confirmation` WHERE id=$id";
  $result_select = mysqli_query($con, $sql_select);
  $row = mysqli_fetch_assoc($result_select);
  $file_name = $row['child_baptismal_image'];

  $filePath = '../../images/Confirmation/' . $file_name;
  unlink($filePath);

  $sql = "DELETE from `confirmation` where id=$id";
  $result = mysqli_query($con, $sql);
  if ($result) {
    header('location:confirmation.php');
  } else {
    die(mysqli_error($con));
  }
}
