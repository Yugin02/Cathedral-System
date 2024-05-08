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
  <link href="/bootstrap-5.3.3-dist/css/bootstrap.min.css">
  <script src="/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="../css/confirmation.css">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/general.css">
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
  <section class="px-2 py-3">
    <div class="d-flex justify-content-between my-4">
      <form class="d-flex searchbar" method="post" role="search">
        <input class="form-control me-2" type="search" placeholder="Search Book Number" name="search" aria-label="Search">
        <button class="btn btn-outline-info" type="submit" name="search1">Search</button>
      </form>
      <button style=" color:black; border: solid 1px black; padding:0; margin:0;" type="button" class="add_data_button btn btn-info"><a style="border:none; padding: 15px 20px; text-decoration:none; color:black; font-weight:600" href="confirmationAddData.php">Add Data</a></button>
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
      <table class="table text-center table-responsive table-hover align-middle" style="background: #88CAD6; border:1px solid #000; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); font-size: 13px; width: 86rem">
        <thead class="table-primary align-middle" style="border: 1px solid #000;">
          <tr style="border: 1px solid #000;">
            <th colspan="1" style="background-color: #88CAD6;">
              <p>No.</p>
            </th>
            <th colspan="1" style="background-color: #88CAD6;">
              <p>NAME OF CHILD</p>
            </th>
            <th colspan="1" style="background-color: #88CAD6;">
              <p>DATE AND PLACE OF BAPTISM</p>
            </th>
            <th colspan="1" style="background-color: #88CAD6;">
              <p>NAME OF PARENTS <br> (Mother's Maiden Name)</p>
            </th>
            <th colspan="1" style="background-color: #88CAD6;">
              <p>SPONSORS</p>
            </th>
            <th colspan="1" style="background-color: #88CAD6;">
              <p>DATE <br> CONFIRMED</p>
            </th>
            <th colspan="1" style="background-color: #88CAD6;">
              <p>MINISTER</p>
            </th>
            <th colspan="1" style="background-color: #88CAD6;">
              <p>REMARKS</p>
            </th>
            <th colspan="1" style="background-color: #88CAD6;">
              <p>SUBMITTED <br>DOCUMENTS</p>
            </th>
          </tr>
        </thead>
        <tbody>
          <?php
          if (isset($_POST['search1'])) {
            $book_number_value = mysqli_real_escape_string($con, $_POST['search']);
            $_SESSION['book_number'] = $book_number_value;
            $sql = "SELECT * FROM `confirmation` 
              WHERE Book_number = '$book_number_value'
              and Book_page = '1' ORDER BY Book_line ASC";
            $result = mysqli_query($con, $sql);
            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row['id'];
                  echo '<tr>
                      <td >' . $row['Book_line'] . '</td>
                      <td >' . $row['Child_name'] . ' ' . $row['Child_familyname'] . '</td>
                      <td ><div>' . $row['baptism_year'] . ' ' . $row['baptism_month'] . ' ' . $row['baptism_day'] . '</div><div style="border-top:1px solid #000;">' . $row['baptism_municipality'] . ' ' . $row['baptism_barangay'] . '</div></td>
                      <td ><div>' . $row['Mother_name'] . ' ' . $row['Mother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Father_name'] . ' ' . $row['Father_familyname'] . '</div></td>
                      <td ><div>' . $row['Godmother_name'] . ' ' . $row['Godmother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Godfather_name'] . ' ' . $row['Godfather_familyname'] . '</div></td>
                      <td >' . $row['confirmed_year'] . ' ' . $row['confirmed_month'] . ' ' . $row['confirmed_day'] . '</td>
                      <td >' . $row['minister'] . '</td>
                      <td ></td>
                      <td style="cursor:pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                      <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                      <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
                    </svg></td>
                      </tr>';
                }
              }
            }
          } elseif (isset($_POST["add"]) || isset($_POST["subtract"])) {
            if (isset($_SESSION['book_number'])) {
              $book_number_value = $_SESSION['book_number'];
              $sql = "SELECT * FROM `confirmation` 
              WHERE Book_page LIKE '$value' and Book_number LIKE '$book_number_value' ORDER BY Book_line ASC";
              $result = mysqli_query($con, $sql);
              if ($result) {
                if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    echo '<tr>
                      <td >' . $row['Book_line'] . '</td>
                      <td >' . $row['Child_name'] . ' ' . $row['Child_familyname'] . '</td>
                      <td ><div>' . $row['baptism_year'] . ' ' . $row['baptism_month'] . ' ' . $row['baptism_day'] . '</div><div style="border-top:1px solid #000;">' . $row['baptism_municipality'] . ' ' . $row['baptism_barangay'] . '</div></td>
                      <td ><div>' . $row['Mother_name'] . ' ' . $row['Mother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Father_name'] . ' ' . $row['Father_familyname'] . '</div></td>
                      <td ><div>' . $row['Godmother_name'] . ' ' . $row['Godmother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Godfather_name'] . ' ' . $row['Godfather_familyname'] . '</div></td>
                      <td >' . $row['confirmed_year'] . ' ' . $row['confirmed_month'] . ' ' . $row['confirmed_day'] . '</td>
                      <td >' . $row['minister'] . '</td>
                      <td ></td>
                      <td style="cursor:pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                      <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                      <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
                    </svg></td>
                      </tr>';
                  }
                }
              }
            }
          } else {
            $sql = "SELECT * FROM `confirmation` 
            WHERE Book_number = '1' and Book_page = '1' ORDER BY Book_line ASC";
            $result = mysqli_query($con, $sql);
            if ($result) {
              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  $id = $row['id'];
                  echo '<tr>
                      <td >' . $row['Book_line'] . '</td>
                      <td >' . $row['Child_name'] . ' ' . $row['Child_familyname'] . '</td>
                      <td ><div>' . $row['baptism_year'] . ' ' . $row['baptism_month'] . ' ' . $row['baptism_day'] . '</div><div style="border-top:1px solid #000;">' . $row['baptism_municipality'] . ' ' . $row['baptism_barangay'] . '</div></td>
                      <td ><div>' . $row['Mother_name'] . ' ' . $row['Mother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Father_name'] . ' ' . $row['Father_familyname'] . '</div></td>
                      <td ><div>' . $row['Godmother_name'] . ' ' . $row['Godmother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Godfather_name'] . ' ' . $row['Godfather_familyname'] . '</div></td>
                      <td >' . $row['confirmed_year'] . ' ' . $row['confirmed_month'] . ' ' . $row['confirmed_day'] . '</td>
                      <td >' . $row['minister'] . '</td>
                      <td ></td>
                      <td style="cursor:pointer;"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
                      <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
                      <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
                    </svg></td>
                      </tr>';
                }
              }
            }
          }
          ?>
        </tbody>
      </table>
    </div>
  </section>
  <script src="confirmation.js"></script>
</body>

</html>