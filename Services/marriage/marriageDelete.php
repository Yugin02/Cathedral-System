<?php
include '../../database.php';

if (isset($_GET['deleteid'])) {
  $id = $_GET['deleteid'];

  $sql_select = "SELECT * FROM `marriage` WHERE id=$id";
  $result_select = mysqli_query($con, $sql_select);
  $row = mysqli_fetch_assoc($result_select);
  $folder_name = $row['id_number'];

  $folderPath = '../../images/Marriage/' . $folder_name . '/';
  $dirHandle = opendir($folderPath);

  while (($item = readdir($dirHandle)) !== false) {
    if ($item != '.' && $item != '..') {
      $itemPath = $folderPath . $item;
      unlink($itemPath);
    }
  }
  closedir($dirHandle);
  rmdir($folderPath);

  $sql = "DELETE from `marriage` where id=$id";
  $result = mysqli_query($con, $sql);
  if ($result) {
    header('location:marriage.php');
  } else {
    die(mysqli_error($con));
  }
}
