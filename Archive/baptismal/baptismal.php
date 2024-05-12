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
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/baptismal.css">
  <link rel="stylesheet" href="../css/header.css">
  <link rel="stylesheet" href="../css/general.css">
  <link rel="stylesheet" href="../css/uploadSection.css">
  <link rel="stylesheet" href="../../Services/css/footer.css">
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
      <table class="table text-center table-responsive table-hover align-middle" style="background: #88CAD6; border:1px solid #000; box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25); font-size: 13px; width:100vw; min-width: 135rem">
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
                  <td >' . $row['legitimity'] . '</td>
                  <td ><div>' . $row['Mother_name'] . ' ' . $row['Mother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Father_name'] . ' ' . $row['Father_familyname'] . '</div></td>
                  <td ><div>' . $row['mother_origin_municipality'] . ' ' . $row['mother_origin_barangay'] . '</div><div style="border-top:1px solid #000;">' . $row['father_origin_municipality'] . ' ' . $row['father_origin_barangay'] . '</div></td>
                  <td >' . $row['parents_residence_municipality'] . ' ' . $row['parents_residence_barangay'] . '</td>
                  <td ><div>' . $row['Godmother_name'] . ' ' . $row['Godmother_familyname'] . '</div><div style="border-top:1px solid #000;">' . $row['Godfather_name'] . ' ' . $row['Godfather_familyname'] . '</div></td>
                  <td ><div>' . $row['godmother_residence_municipality'] . ' ' . $row['godmother_residence_barangay'] . '</div><div style="border-top:1px solid #000;">' . $row['godfather_residence_municipality'] . ' ' . $row['godfather_residence_barangay'] . '</div></td>
                  <td >' . $row['minister'] . '</td>
                  <td>' . $row['remarks'] . '</td>';
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
  <footer class="d-flex flex-column">
    <div style="background: linear-gradient(277deg, rgba(255, 255, 255, 0.95) -30.45%, rgba(26, 213, 245, 0.95) 58.3%); position:absolute; opacity:95%; height:100%; width:100%">
      <input type="hidden">
    </div>
    <div style="z-index: 3;">
      <div class="d-flex justify-content-around p-4" style="z-index: 3; border-bottom:#FFF 2px solid;">
        <div class="d-flex flex-column align-items-center">
          <div class="d-flex justify-content-center"><img style="width: 60%;" src="../images/logo.png" alt=""></div>
          <div class="d-flex align-items-center partnership gap-2">
            <div><img src="../../Services/images/DOST logo.png" alt=""></div>
            <div>
              <div><img src="../../Services/images/caritas1.png" alt=""></div>
            </div>
            <div><img src="../../Services/images/essu logo.png" alt=""></div>
          </div>
        </div>
        <div style="width: 42%;">
          <h5>DIOCESE OF BORONGAN NATIVITY OF OUR LADY CATHEDRAL CHURCH</h5>
          <p>Real St, Borongan City, 6800 Eastern Samar, Philippines</p>
          <h5>Services</h5>
          <div style="color: #FFF;">
            <a href="../marriage/marriage.php">Marriage</a> /
            <a href="../baptismal/baptismal.php">Baptism</a> /
            <a href="../death/deathAndBurial.php">Burial</a> /
            <a href="../confirmation/confirmation.php">Confirmation</a>
          </div>
        </div>
        <div class="d-flex flex-column gap-3">
          <div class="contact">
            <h6>GET IN TOUCH WITH US</h6>
            <div style="padding: 0 10px;">
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
                  <path d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414zM0 4.697v7.104l5.803-3.558zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586zm3.436-.586L16 11.801V4.697z" />
                </svg>
                (Email@gmail.com)
              </div>
              <div>
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-telephone-fill" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M1.885.511a1.745 1.745 0 0 1 2.61.163L6.29 2.98c.329.423.445.974.315 1.494l-.547 2.19a.68.68 0 0 0 .178.643l2.457 2.457a.68.68 0 0 0 .644.178l2.189-.547a1.75 1.75 0 0 1 1.494.315l2.306 1.794c.829.645.905 1.87.163 2.611l-1.034 1.034c-.74.74-1.846 1.065-2.877.702a18.6 18.6 0 0 1-7.01-4.42 18.6 18.6 0 0 1-4.42-7.009c-.362-1.03-.037-2.137.703-2.877z" />
                </svg>
                (Mobile Number ***)
              </div>
            </div>
          </div>
          <div>
            <h6>CONNECT WITH US</h6>
            <div class="d-flex align-items-center gap-2" style="padding-left: 10px;">
              <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 45 45" fill="none">
                  <ellipse cx="23.5" cy="22.5" rx="21.5" ry="22.5" fill="white" />
                  <path d="M45 22.6394C45 10.1325 34.9214 0 22.5 0C10.0702 0 0 10.1325 0 22.6394C0 33.9364 8.22516 43.3035 18.9844 45V29.185H13.2708V22.6408H18.9844V17.6502C18.9844 11.9776 22.3383 8.84492 27.4795 8.84492C29.9419 8.84492 32.5195 9.28639 32.5195 9.28639V14.8571H29.6775C26.8875 14.8571 26.0156 16.6046 26.0156 18.3945V22.6394H32.2552L31.2525 29.1836H26.0156V44.9986C36.7664 43.302 45 33.935 45 22.638V22.6394Z" fill="#1096E1" />
                </svg></a>
              <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 45 45" fill="none">
                  <g clip-path="url(#clip0_1224_1516)">
                    <path d="M34.4531 0H10.5469C4.722 0 0 4.722 0 10.5469V34.4531C0 40.278 4.722 45 10.5469 45H34.4531C40.278 45 45 40.278 45 34.4531V10.5469C45 4.722 40.278 0 34.4531 0Z" fill="url(#paint0_radial_1224_1516)" />
                    <path d="M34.4531 0H10.5469C4.722 0 0 4.722 0 10.5469V34.4531C0 40.278 4.722 45 10.5469 45H34.4531C40.278 45 45 40.278 45 34.4531V10.5469C45 4.722 40.278 0 34.4531 0Z" fill="url(#paint1_radial_1224_1516)" />
                    <path d="M22.5016 4.92188C17.7277 4.92188 17.1285 4.94279 15.2536 5.02805C13.3822 5.11383 12.1048 5.41002 10.9872 5.84473C9.83092 6.29367 8.85023 6.89432 7.87324 7.87166C6.89537 8.84883 6.29473 9.82951 5.84438 10.9853C5.40844 12.1032 5.11189 13.3812 5.0277 15.2517C4.94385 17.1267 4.92188 17.7261 4.92188 22.5002C4.92188 27.2742 4.94297 27.8715 5.02805 29.7464C5.11418 31.6178 5.41037 32.8952 5.84473 34.0128C6.29402 35.1691 6.89467 36.1498 7.87201 37.1268C8.84883 38.1046 9.82951 38.7067 10.9849 39.1556C12.1034 39.5903 13.381 39.8865 15.252 39.9723C17.1271 40.0576 17.7258 40.0785 22.4995 40.0785C27.2739 40.0785 27.8712 40.0576 29.7461 39.9723C31.6174 39.8865 32.8962 39.5903 34.0147 39.1556C35.1705 38.7067 36.1498 38.1046 37.1264 37.1268C38.1043 36.1498 38.7047 35.1691 39.1553 34.0133C39.5873 32.8952 39.8841 31.6174 39.972 29.7468C40.0562 27.8719 40.0781 27.2742 40.0781 22.5002C40.0781 17.7261 40.0562 17.1271 39.972 15.252C39.8841 13.3806 39.5873 12.1034 39.1553 10.9858C38.7047 9.82951 38.1043 8.84883 37.1264 7.87166C36.1487 6.89396 35.1708 6.29332 34.0137 5.8449C32.8931 5.41002 31.615 5.11365 29.7436 5.02805C27.8685 4.94279 27.2716 4.92188 22.4961 4.92188H22.5016ZM20.9246 8.08963C21.3928 8.08893 21.915 8.08963 22.5016 8.08963C27.1951 8.08963 27.7513 8.1065 29.6047 8.1907C31.3186 8.2691 32.2488 8.55545 32.8685 8.79609C33.6888 9.11461 34.2737 9.49553 34.8885 10.1109C35.5038 10.7262 35.8845 11.3121 36.2039 12.1324C36.4446 12.7512 36.7313 13.6814 36.8093 15.3953C36.8935 17.2484 36.9118 17.8049 36.9118 22.4961C36.9118 27.1874 36.8935 27.7441 36.8093 29.597C36.7309 31.3109 36.4446 32.2411 36.2039 32.86C35.8854 33.6804 35.5038 34.2645 34.8885 34.8794C34.2733 35.4946 33.6892 35.8754 32.8685 36.1941C32.2495 36.4358 31.3186 36.7214 29.6047 36.7998C27.7516 36.884 27.1951 36.9023 22.5016 36.9023C17.8079 36.9023 17.2515 36.884 15.3986 36.7998C13.6847 36.7207 12.7545 36.4344 12.1344 36.1937C11.3142 35.875 10.7281 35.4943 10.1129 34.879C9.49764 34.2638 9.11689 33.6793 8.7975 32.8586C8.55686 32.2397 8.27016 31.3095 8.19211 29.5956C8.10791 27.7425 8.09104 27.186 8.09104 22.4917C8.09104 17.7977 8.10791 17.244 8.19211 15.3909C8.27051 13.677 8.55686 12.7468 8.7975 12.1271C9.11619 11.3068 9.49764 10.7209 10.113 10.1057C10.7283 9.49043 11.3142 9.10951 12.1345 8.79029C12.7542 8.54859 13.6847 8.26295 15.3986 8.1842C17.0202 8.1109 17.6486 8.08893 20.9246 8.08523V8.08963ZM31.8848 11.0083C30.7202 11.0083 29.7754 11.9522 29.7754 13.117C29.7754 14.2815 30.7202 15.2263 31.8848 15.2263C33.0493 15.2263 33.9942 14.2815 33.9942 13.117C33.9942 11.9524 33.0493 11.0076 31.8848 11.0076V11.0083ZM22.5016 13.4729C17.5164 13.4729 13.4745 17.5148 13.4745 22.5002C13.4745 27.4855 17.5164 31.5255 22.5016 31.5255C27.4869 31.5255 31.5274 27.4855 31.5274 22.5002C31.5274 17.515 27.4866 13.4729 22.5012 13.4729H22.5016ZM22.5016 16.6407C25.7375 16.6407 28.3611 19.2639 28.3611 22.5002C28.3611 25.7361 25.7375 28.3597 22.5016 28.3597C19.2654 28.3597 16.6423 25.7361 16.6423 22.5002C16.6423 19.2639 19.2654 16.6407 22.5016 16.6407Z" fill="white" />
                  </g>
                  <defs>
                    <radialGradient id="paint0_radial_1224_1516" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(11.9531 48.4659) rotate(-90) scale(44.5983 41.48)">
                      <stop stop-color="#FFDD55" />
                      <stop offset="0.1" stop-color="#FFDD55" />
                      <stop offset="0.5" stop-color="#FF543E" />
                      <stop offset="1" stop-color="#C837AB" />
                    </radialGradient>
                    <radialGradient id="paint1_radial_1224_1516" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(-7.53768 3.24158) rotate(78.681) scale(19.9357 82.1756)">
                      <stop stop-color="#3771C8" />
                      <stop offset="0.128" stop-color="#3771C8" />
                      <stop offset="1" stop-color="#6600FF" stop-opacity="0" />
                    </radialGradient>
                    <clipPath id="clip0_1224_1516">
                      <rect width="45" height="45" fill="white" />
                    </clipPath>
                  </defs>
                </svg></a>
              <a href=""><svg style="color: #040404;" xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-twitter-x" viewBox="0 0 16 16">
                  <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865z" />
                </svg></a>
              <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="34" height="30" viewBox="0 0 49 35" fill="none">
                  <g clip-path="url(#clip0_1224_1529)">
                    <path d="M47.9178 5.45903C47.6368 4.40389 47.0885 3.44195 46.3277 2.669C45.5669 1.89605 44.62 1.33906 43.5813 1.0535C39.7789 0 24.4752 0 24.4752 0C24.4752 0 9.17069 0.0318888 5.36822 1.08539C4.32955 1.37097 3.38265 1.92799 2.62181 2.70097C1.86097 3.47395 1.31274 4.43593 1.03172 5.49111C-0.118444 12.3546 -0.564612 22.813 1.0633 29.4019C1.34435 30.4571 1.8926 31.419 2.65343 32.192C3.41427 32.9649 4.36116 33.5219 5.3998 33.8075C9.20228 34.861 24.5064 34.861 24.5064 34.861C24.5064 34.861 39.8102 34.861 43.6125 33.8075C44.6512 33.5219 45.5981 32.965 46.359 32.192C47.1199 31.4191 47.6681 30.4571 47.9492 29.4019C49.1624 22.5287 49.5362 12.0767 47.9178 5.45903Z" fill="#FF0000" />
                    <path d="M19.6055 24.9008L32.3011 17.4306L19.6055 9.96045V24.9008Z" fill="white" />
                  </g>
                  <defs>
                    <clipPath id="clip0_1224_1529">
                      <rect width="49" height="35" fill="white" />
                    </clipPath>
                  </defs>
                </svg></a>
            </div>
          </div>
        </div>
      </div>
      <div class="d-flex align-item-center justify-content-center" style="background: #29C3D8;">
        <p style="margin:0; padding: 10px 0">Copyright @2024 ESSU - Borongan. All rights reserved</p>
      </div>
    </div>
  </footer>
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