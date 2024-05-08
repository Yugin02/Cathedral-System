<?php
include '../connect.php'
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="../css/confirmation.css">
  <link rel="stylesheet" href="../css/header.css">
</head>

<body>
  <header style="height:13vw;" class="d-flex justify-content-center header">
    <div style="background-color:#FFF; opacity:50%; z-index:1; position:absolute; height:inherit; width:100%"></div>
    <div class="logo d-flex align-items-center justify-content-evenly" style="width: 100%;">
      <img style="width: 10%;" src="../images/logo.png" alt="">
      <p style="color: #040404;
        margin-bottom:0;
        text-align: center;
        -webkit-text-stroke-width: 0.5;
        -webkit-text-stroke-color: #FFF;
        font-family: Luxurious Roman; font-size: 2vw; font-style: normal; font-weight: 400; line-height: normal;" class="text-center">Diocese of Borongan <br> Nativity of Our Lady Cathedral Parish <br> Borongan City 6800</p>
      <img style="width: 7%;" src="../images/caritas.png" alt="">
    </div>
  </header>
  <div class="logo">
    <ul style="background-color: #88cad6; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.50);" class="d-flex justify-content-evenly align-items-center">
      <li><a href="">HOME</a></li>
      <li><a href="/Cathedral/Services/baptismal/baptismal.php">SERVICES</a></li>
      <li><a href="">PARISH ORGANIZATIONS</a></li>
      <li><a href="/Cathedral/Archive/baptismal/baptismal.php">ARCHIVE</a></li>
      <li><a href="">ABOUT</a></li>
      <li><a href="">LOGOUT</a></li>
    </ul>
  </div>
  <nav class="container-fluid">
    <ul>
      <li><a href="../baptismal/baptismal.php">BAPTISMAL</a></li>
      <li><a href="../confirmation/confirmation.php">CONFIRMATION</a></li>
      <li><a href="../death/deathAndBurial.php">DEATH AND BURIAL</a></li>
      <li><a href="../marriage/marriage.php">MARRIAGE</a></li>
    </ul>
  </nav>
  <section class="px-5 py-3">
    <div class="d-flex justify-content-between my-4">
      <form class="d-flex searchbar" method="post" role="search">
        <input class="form-control me-2" type="search" placeholder="Search" name="search" aria-label="Search">
        <button class="btn btn-outline-info" type="submit" name="search1">Search</button>
      </form>
      <button style=" color:black; border: solid 1px black; padding:0; margin:0;" type="button" class="add_data_button btn btn-info"><a style="border:none; padding: 15px 20px; text-decoration:none; color:black; font-weight:600" href="confirmationAddData.php">Add Data</a></button>
    </div>
    <table class="table table-responsive table-hover align-middle" style="background: #88CAD6;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25);">
      <thead class="table-primary align-middle">
        <tr>
          <th scope="col" style="background-color: #88CAD6;">No.</th>
          <th scope="col" style="background-color: #88CAD6;">Name</th>
          <th scope="col" style="background-color: #88CAD6;">Date Confirmed</th>
          <th scope="col" style="background-color: #88CAD6;"></th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (isset($_POST['search1'])) {
          $search = mysqli_real_escape_string($con, $_POST['search']);

          $sql = "SELECT *, CONCAT_WS(' ', Child_familyname, Child_name) AS fullname,
          CONCAT_WS(' ', confirmed_month, confirmed_day, confirmed_year) AS date FROM `confirmation` 
          WHERE confirmand_firstname LIKE '%$search%' 
          OR confirmand_lastname LIKE '%$search%' 
          OR confirmand_middlename LIKE '%$search%' 
          OR month LIKE '%$search%' 
          OR day LIKE '%$search%' 
          OR year LIKE '%$search%'
          OR id_number LIKE '%$search%'";

          $result = mysqli_query($con, $sql);
          if ($result) {
            if (mysqli_num_rows($result) > 0) {
              while ($row = mysqli_fetch_assoc($result)) {
                $id = $row['id'];
                echo '
              <tr>
              <td onclick="window.location=\'ConfirmationCert.php?certid=' . $id . '\';">' . $row['id_number'] . '</td>
              <td onclick="window.location=\'ConfirmationCert.php?certid=' . $id . '\';">' . $row['fullname'] . '</td>
              <td onclick="window.location=\'ConfirmationCert.php?certid=' . $id . '\';">' . $row['date'] . '</td>
              <td>
                <button class="btn btn-info" type="button"><a class="edit" style="text-decoration: none; color: #000;" href="ConfirmationEdit.php?editid=' . $id . '">Edit</a></button>
                <button class="btn btn-danger" type="button"><a class="delete" style="text-decoration: none; color: #000;" onclick="confirmDelete(' . $id . ')">Delete</a></button>
              </td>
              </tr>';
              }
            }
          }
        } else {
          $sql = "SELECT *, CONCAT_WS(' ', Child_familyname, Child_name) AS fullname, CONCAT_WS(' ', confirmed_month, confirmed_day, confirmed_year) AS date FROM `confirmation`";
          $result = mysqli_query($con, $sql);
          if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
              $id = $row['id'];
              echo '<tr>
                  <td onclick="window.location=\'ConfirmationCert.php?certid=' . $id . '\';">' . $row['id_number'] . '</td>
                  <td onclick="window.location=\'ConfirmationCert.php?certid=' . $id . '\';">' . $row['fullname'] . '</td>
                  <td onclick="window.location=\'ConfirmationCert.php?certid=' . $id . '\';">' . $row['date'] . '</td>
                  <td>
                    <button class="btn btn-info" type="button"><a class="edit" style="text-decoration: none; color: #000;" href="ConfirmationEdit.php?editid=' . $id . '">Edit</a></button>
                    <button class="btn btn-danger" type="button"><a class="delete" style="text-decoration: none; color: #000;" onclick="confirmDelete(' . $id . ')">Delete</a></button>
                  </td>
                  </tr>';
            }
          }
        }
        ?>
      </tbody>
    </table>
  </section>
  <div class="pop_up">
    <p>Are you sure you want to delete this item?</p>
    <div class="button d-flex justify-content-center flex-column flex-md-row gap-5">
      <button class="btn btn-info no">No</button>
      <button class="btn btn-danger yes">Yes</button>
    </div>
  </div>
  <script src="confirmation.js"></script>
</body>

</html>