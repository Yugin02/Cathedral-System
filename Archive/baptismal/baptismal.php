<?php
include '../connect.php';

session_start();
if (!isset($_POST['search1']) && !isset($_POST["add"]) && !isset($_POST["subtract"])) {
  session_destroy();
  session_start();
  $_SESSION['book_number'] = 1;
}

$value = isset($_POST['value1']) ? (int)$_POST['value1'] : 1;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST["add"])) {
    $value += 1;
  } elseif (isset($_POST["subtract"]) && $value > 1) {
    $value -= 1;
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link href="/node_modules/bootstrap/dist/css/bootstrap.min.css">
  <script src="/node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="../css/baptismal.css">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/general.css">
  <link rel="stylesheet" href="../css/uploadSection.css">
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
      <li><a href="baptismal.php">BAPTISMAL</a></li>
      <li><a href="../confirmation/confirmation.php">CONFIRMATION</a></li>
      <li><a href="../death/deathAndBurial.php">DEATH AND BURIAL</a></li>
      <li><a href="../marriage/marriage.php">MARRIAGE</a></li>
    </ul>
  </nav>
  <section class="px-2 py-3">
    <div class="d-flex justify-content-between my-4">
      <form class="d-flex searchbar" method="post" role="search">
        <input class="form-control me-2" type="search" placeholder="Search Book Number" name="search" aria-label="Search" autocomplete="off">
        <button class="btn btn-outline-info" type="submit" name="search1">Search</button>
      </form>
      <button style=" color:black; border: solid 1px black; padding:0; margin:0;" type="button" class="add_data_button btn btn-info"><a style="border:none; padding: 15px 20px; text-decoration:none; color:black; font-weight:600" href="BaptismalAddData.php">Add Data</a></button>
    </div>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" class="d-flex align-items-center gap-2 page" style="margin-bottom: 10px;">
      <p style="margin: 0;">Page</p>
      <button type="submit" name="subtract" <?php if ($value <= 1) echo "disabled"; ?>><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
        </svg></button>
      <input style="width: 5%; text-align:center" type="text" name="value1" value="<?php echo $value; ?>" disabled>
      <button type="submit" name="add"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-arrow-right-short" viewBox="0 0 16 16">
          <path fill-rule="evenodd" d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
        </svg></button>
      <input type="hidden" name="value1" value="<?php echo $value; ?>">
    </form>

    <div class="table-responsive">
      <table class="table text-center table-responsive table-hover align-middle" style="background: #88CAD6; border:1px solid #000; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); font-size: 13px; width: 135rem">
        <thead class="table-primary align-middle" style="border: 1px solid #000;">
          <tr style="border: 1px solid #000;">
            <th colspan="1" style="background-color: #88CAD6;">
              <p></p>
            </th>
            <th colspan="2" style="background-color: #88CAD6;">
              <p>DATE OF BAPTISM</p>
            </th>
            <th colspan="1" style="background-color: #88CAD6;">
              <p>NAME OF THE BAPTIZED</p>
            </th>
            <th colspan="3" style="background-color: #88CAD6;">
              <p>BIRTH</p>
            </th>
            <th colspan="3" style="background-color: #88CAD6;">
              <p>PARENTS</p>
            </th>
            <th colspan="2" style="background-color: #88CAD6;">
              <p>GODPARENTS</p>
            </th>
          </tr>
          <tr style="border: 1px solid #000;">
            <th style="background-color: #88CAD6;">
              <p>No.</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Year</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Month and Day</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Name and the Family Name</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Year</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Month and Day</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Legitimity</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Name and Family Name</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Place of Origin</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Residence</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Name and Family Name</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Residence</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Minister</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>Remarks</p>
            </th>
            <th style="background-color: #88CAD6;">
              <p>SUBMITTED <br>DOCUMENTS</p>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_POST['search1'])) {
            $book_number_value = mysqli_real_escape_string($con, $_POST['search']);
            $_SESSION['book_number'] = $book_number_value;
            $sql = "SELECT * FROM `baptismal` 
              WHERE Book_number = '$book_number_value'
              and Book_page = '1'";
            $result = mysqli_query($con, $sql);
            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row['id'];
                  echo '<tr>
                  <td >' . $row['Book_line'] . '</td>
                  <td >' . $row['baptism_year'] . '</td>
                  <td >' . $row['baptism_month'] . ' ' . $row['baptism_day'] . '</td>
                  <td >' . $row['Child_name'] . ' ' . $row['Child_familyname'] . '</td>
                  <td >' . $row['year'] . '</td>
                  <td >' . $row['month'] . ' ' . $row['day'] . '</td>
                  <td "></td>
                  <td ><div>' . $row['Mother_name'] . ' ' . $row['Mother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Father_name'] . ' ' . $row['Father_familyname'] . '</div></td>
                  <td ><div>' . $row['mother_origin_municipality'] . ' ' . $row['mother_origin_barangay'] . '</div><div style="border-top:1px solid #000;">' . $row['father_origin_municipality'] . ' ' . $row['father_origin_barangay'] . '</div></td>
                  <td >' . $row['parents_residence_municipality'] . ' ' . $row['parents_residence_barangay'] . '</td>
                  <td ><div>' . $row['Godmother_name'] . ' ' . $row['Godmother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Godfather_name'] . ' ' . $row['Godfather_familyname'] . '</div></td>
                  <td ><div>' . $row['godmother_residence_municipality'] . ' ' . $row['godmother_residence_barangay'] . '</div><div style="border-top:1px solid #000;">' . $row['godfather_residence_municipality'] . ' ' . $row['godfather_residence_barangay'] . '</div></td>
                  <td >' . $row['minister'] . '</td>
                  <td></td>';
          ?>
                  <td style="cursor:pointer;">
                    <form class="image_form" action="baptismal.php" method="get">
                      <input type="hidden" value="<?php echo $id ?>" name="id">
                      <button class="show_img_button" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                          <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                          <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z" />
                        </svg></button>
                    </form>
                  </td>
                  </tr>
                  <?php
                }
              }
            }
          } elseif (isset($_POST["add"]) || isset($_POST["subtract"])) {
            if (isset($_SESSION['book_number'])) {
              $book_number_value = $_SESSION['book_number'];
              $sql = "SELECT * FROM `baptismal` 
              WHERE Book_page LIKE '$value' and Book_number LIKE '$book_number_value'";
              $result = mysqli_query($con, $sql);
              if ($result) {
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    echo '<tr>
                  <td >' . $row['Book_line'] . '</td>
                  <td >' . $row['baptism_year'] . '</td>
                  <td >' . $row['baptism_month'] . ' ' . $row['baptism_day'] . '</td>
                  <td >' . $row['Child_name'] . ' ' . $row['Child_familyname'] . '</td>
                  <td >' . $row['year'] . '</td>
                  <td >' . $row['month'] . ' ' . $row['day'] . '</td>
                  <td "></td>
                  <td ><div>' . $row['Mother_name'] . ' ' . $row['Mother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Father_name'] . ' ' . $row['Father_familyname'] . '</div></td>
                  <td ><div>' . $row['mother_origin_municipality'] . ' ' . $row['mother_origin_barangay'] . '</div><div style="border-top:1px solid #000;">' . $row['father_origin_municipality'] . ' ' . $row['father_origin_barangay'] . '</div></td>
                  <td >' . $row['parents_residence_municipality'] . ' ' . $row['parents_residence_barangay'] . '</td>
                  <td ><div>' . $row['Godmother_name'] . ' ' . $row['Godmother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Godfather_name'] . ' ' . $row['Godfather_familyname'] . '</div></td>
                  <td ><div>' . $row['godmother_residence_municipality'] . ' ' . $row['godmother_residence_barangay'] . '</div><div style="border-top:1px solid #000;">' . $row['godfather_residence_municipality'] . ' ' . $row['godfather_residence_barangay'] . '</div></td>
                  <td >' . $row['minister'] . '</td>
                  <td></td>';
                  ?>
                    <td style="cursor:pointer;">
                      <form class="image_form" action="baptismal.php" method="get">
                        <input type="hidden" value="<?php echo $id ?>" name="id">
                        <button class="show_img_button" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                            <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                            <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z" />
                          </svg></button>
                      </form>
                    </td>
                    </tr>
                  <?php
                  }
                }
              }
            }
          } else {
            $sql = "SELECT * FROM `baptismal` 
            WHERE Book_number = '1' and Book_page = '1' ORDER BY Book_line ASC";
            $result = mysqli_query($con, $sql);
            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row['id'];
                  echo '<tr>
                  <td >' . $row['Book_line'] . '</td>
                  <td >' . $row['baptism_year'] . '</td>
                  <td >' . $row['baptism_month'] . ' ' . $row['baptism_day'] . '</td>
                  <td >' . $row['Child_name'] . ' ' . $row['Child_familyname'] . '</td>
                  <td >' . $row['year'] . '</td>
                  <td >' . $row['month'] . ' ' . $row['day'] . '</td>
                  <td "></td>
                  <td ><div>' . $row['Mother_name'] . ' ' . $row['Mother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Father_name'] . ' ' . $row['Father_familyname'] . '</div></td>
                  <td ><div>' . $row['mother_origin_municipality'] . ' ' . $row['mother_origin_barangay'] . '</div><div style="border-top:1px solid #000;">' . $row['father_origin_municipality'] . ' ' . $row['father_origin_barangay'] . '</div></td>
                  <td >' . $row['parents_residence_municipality'] . ' ' . $row['parents_residence_barangay'] . '</td>
                  <td ><div>' . $row['Godmother_name'] . ' ' . $row['Godmother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Godfather_name'] . ' ' . $row['Godfather_familyname'] . '</div></td>
                  <td ><div>' . $row['godmother_residence_municipality'] . ' ' . $row['godmother_residence_barangay'] . '</div><div style="border-top:1px solid #000;">' . $row['godfather_residence_municipality'] . ' ' . $row['godfather_residence_barangay'] . '</div></td>
                  <td >' . $row['minister'] . '</td>
                  <td></td>';
                  ?>
                  <td style="cursor:pointer;">
                    <form class="image_form" action="baptismal.php" method="get">
                      <input type="hidden" value="<?php echo $id ?>" name="id">
                      <button class="show_img_button" type="submit"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                          <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                          <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z" />
                        </svg></button>
                    </form>
                  </td>
                  </tr>
          <?php
                }
              }
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </section>

  <?php
  if (isset($_GET["id"])) {
    $live_birth_id = $_GET["id"];
    $sql1 = "SELECT * from `baptismal` where id='$live_birth_id'";
    $result1 = mysqli_query($con, $sql1);
    $row1 = mysqli_fetch_assoc($result1);
    $Child_name = $row1['Child_name'];
    $Child_familyname = $row1['Child_familyname'];
    $live_birth_name = $row1['live_birth_image'];
  ?>
    <?php
    echo
    "<div class=\"p-3 d-flex flex-column\" id=\"uploadFile\">
    <h3>Upload Section</h3>
    <p>Name: <span>$Child_name $Child_familyname</span> </p>
    <table class=\"table text-center table-hover\" style=\"font-size: 14px !important;\">
      <thead class=\"align-middle\">
        <tr>
          <th>File</th>
          <th style=\"width: 30%;\">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td style = \" padding:10px;\">$live_birth_name</td>
          <td id=\"show_image\" style = \" padding:10px; cursor:pointer;\"><svg  xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" fill=\"currentColor\" class=\"bi bi-eye-fill\" viewBox=\"0 0 16 16\">
          <path d=\"M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0\"/>
          <path d=\"M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7\"/>
        </svg></td>
        </tr>
      </tbody>
    </table>";
    ?>
    <div style="border-top:#000 1px solid; padding-top:15px" class="d-flex justify-content-end">
      <button id="close" type="button" class="btn btn-secondary" style="padding: 5px 20px;">Close</button>
    </div>
    </div>
    <?php
    echo
    "<div id=\"live_birth_img\" class=\"d-flex flex-column justify-content-between gap-2\">
    <div class=\"d-flex justify-content-between\">
    <div style= \"cursor:pointer;\" id=\"full_screen\">
      <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" fill=\"currentColor\" class=\"bi bi-fullscreen\" viewBox=\"0 0 16 16\">
        <path d=\"M1.5 1a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4A1.5 1.5 0 0 1 1.5 0h4a.5.5 0 0 1 0 1zM10 .5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 16 1.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5M.5 10a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 0 14.5v-4a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5\"/>
      </svg>
    </div>
    <svg style= \"cursor:pointer;\" id=\"close_image\" xmlns=\"http://www.w3.org/2000/svg\" width=\"25\" height=\"25\" fill=\"currentColor\" class=\"bi bi-x-circle\" viewBox=\"0 0 16 16\">
      <path d=\"M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16\" />
      <path d=\"M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708\" />
    </svg>
    </div>
    <div class=\"d-flex justify-content-center\" style=\"height: 90%; width:95%; align-self:center;\">
      <img style=\"width:100%; object-fit:contain; object-position:center\" src=\"../../images/Baptismal/$live_birth_name\">
    </div>
  </div>"
    ?>
  <?php
    echo "<script>
    document.getElementById(\"close\").addEventListener(\"click\", function() {
      window.location.href = \"baptismal.php\";
    });
    var image = document.getElementById(\"live_birth_img\");
    document.getElementById(\"close_image\").addEventListener(\"click\", function() {
      image.style.visibility = \"hidden\";
      image.style.zIndex = \"4\";
    });
    document.getElementById(\"show_image\").addEventListener(\"click\", function() {
      image.style.visibility = \"visible\";
      image.style.zIndex = \"6\";
    });
    </script>
    ";
    echo '<script>
    var min_max_screen = document.getElementById("full_screen");
    min_max_screen.addEventListener("click", function(){
      var min_screen = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-fullscreen-exit" viewBox="0 0 16 16">
        <path d="M5.5 0a.5.5 0 0 1 .5.5v4A1.5 1.5 0 0 1 4.5 6h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5m5 0a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 10 4.5v-4a.5.5 0 0 1 .5-.5M0 10.5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 6 11.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5m10 1a1.5 1.5 0 0 1 1.5-1.5h4a.5.5 0 0 1 0 1h-4a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0z"/>
      </svg>`;
      var full_screen = `<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-fullscreen" viewBox="0 0 16 16">
        <path d="M1.5 1a.5.5 0 0 0-.5.5v4a.5.5 0 0 1-1 0v-4A1.5 1.5 0 0 1 1.5 0h4a.5.5 0 0 1 0 1zM10 .5a.5.5 0 0 1 .5-.5h4A1.5 1.5 0 0 1 16 1.5v4a.5.5 0 0 1-1 0v-4a.5.5 0 0 0-.5-.5h-4a.5.5 0 0 1-.5-.5M.5 10a.5.5 0 0 1 .5.5v4a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 0 14.5v-4a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v4a1.5 1.5 0 0 1-1.5 1.5h-4a.5.5 0 0 1 0-1h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 1 .5-.5"/>
      </svg>`;  
      if (image.style.width === "45%") {
        image.style.width = "100%";
        image.style.height = "100%";
        min_max_screen.innerHTML = min_screen;
      } else {
        image.style.width = "45%";
        image.style.height = "90%";
        min_max_screen.innerHTML = full_screen;
      }
    });
    </script>';
  } else {
  }
  ?>
</body>

</html>