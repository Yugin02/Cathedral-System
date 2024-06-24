<?php
include '../../database.php';
$id = $_GET['certid'];


$sql = "SELECT *, CONCAT(Child_familyname, ' ', Child_name) AS child_name, CONCAT(month, '/', day, '/', year) AS date_of_birth, CONCAT(parents_residence_municipality, ', ', parents_residence_barangay) AS place_of_birth, CONCAT(Mother_familyname, ' ', Mother_name) AS mother_name, CONCAT(Father_familyname, ' ', Father_name) AS father_name, baptism_month, baptism_day, baptism_year, minister, priest, CONCAT(Godmother_familyname, ' ', Godmother_name) AS godmother_name, CONCAT(Godfather_familyname, ' ', Godfather_name) AS godfather_name , Book_number, Book_page, Book_line, id FROM `baptismal` where id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$child_name = $row['child_name'];
$date_of_birth = $row['date_of_birth'];
$place_of_birth = $row['place_of_birth'];
$mother_name = $row['mother_name'];
$father_name = $row['father_name'];
$godmother_name = $row['godmother_name'];
$godfather_name = $row['godfather_name'];
$minister = $row['minister'];
$priest = $row['priest'];
$Book_number = $row['Book_number'];
$Book_page = $row['Book_page'];
$Book_line = $row['Book_line'];
$baptism_month = $row['baptism_month'];
$baptism_day = $row['baptism_day'];
$baptism_year = $row['baptism_year'];
$currentMonth = date('F');
$currentDay = date('j');
$currentYear = date('Y');
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
  <link href="https://fonts.googleapis.com/css2?family=Luxurious+Roman&family=Luxurious+Script&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <link rel="stylesheet" href="../css/certificate.css">
</head>

<body class="d-flex flex-column align-items-center">
  <div class="d-flex justify-content-between align-items-center align-self-stretch p-5">
    <div>
      <button class="certbutton" onclick="printCertificate()">Print<img src="../icon/print.png" alt=""></button>
    </div>
    <div><a href="./baptismal.php"><img src="../icon/close.png" alt=""></a></div>
  </div>
  <section class="d-flex flex-column" id="certificate" style="width: 78rem; text-align: center; padding:50px 0;">
    <div class="d-flex justify-content-center align-items-center">
      <img src="../images/logo.png" alt="">
      <p style="color: #000;
        text-align: center;
        -webkit-text-stroke-width: 0.5;
        -webkit-text-stroke-color: #000;
        font-family: Luxurious Roman;
        font-size: 25px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;">
        Diocese of Borongan <br> Nativity of Our Lady Cathedral Parish <br> Borongan City 6800</p>
    </div>
    <h1 style="color: #7AE7FA;
      font-family: Luxurious Script;
      font-size: 90px;
      font-style: normal;
      font-weight: 400;
      line-height: normal;
      letter-spacing: 9px;
      -webkit-text-stroke-width:.03cm;
      -webkit-text-stroke-color: #000;">
      Certificate of Baptism</h1>
    <div class="align-self-center" style="width: 85%; border: solid 3px #000; font-size:24px; margin-top: -30px; padding: 1% 7%; text-align:start; font-weight:500">
      <p style="text-align: center; margin-bottom:7%">This is to certify that</p>
      <p style="font-weight: 600;">CHILD: <span><?php echo $child_name ?></span></p>
      <p style="font-weight: 600;">FATHER: <span><?php echo $father_name ?></span></p>
      <p style="font-weight: 600;">MOTHER: <span><?php echo $mother_name ?></span></p>
      <p style="font-weight: 600;">Date of Birth: <span><?php echo $date_of_birth ?></span></p>
      <p style="font-weight: 600;">Place of Birth: <span><?php echo $place_of_birth ?></span></p>
      <p style="text-align: center; margin:7% 0; letter-spacing: 2.4px">was solemnly BAPTIZED according to the <br> rites of the Roman Catholic Church </p>

      <p>on <span><?php echo $baptism_month ?> <?php echo $baptism_day ?>, <?php echo $baptism_year  ?></span></p>
      <p>at the Cathedral Parish of the Nativity of Our Lady, <br>Borongan City, Eastern Samar</p>
      <p>by the <strong style="font-weight: 600;">Rev.</strong> <span> <?php echo $minister ?> </span> </p>
      <p>and the sponsors being: <span><?php echo $godfather_name ?> and <?php echo $godmother_name ?></span></p>
      <p>as it appears in the BAPTISMAL REGISTER</p>
      <p>Book: <span><?php echo $Book_number ?></span> Page: <span><?php echo $Book_page ?></span> Line: <span><?php echo $Book_line ?></span></p>
      <p style="margin-top: 5%;">Given this <span><?php echo $currentDay ?></span> day of <span><?php echo $currentMonth ?></span> <?php echo $currentYear ?> at the Parish Office, <br> Borongan City, Eastern Samar, Philippines.</p>
    </div>
    <p class="align-self-end" style="color: #000;
      text-align: center;
      font-size: 30px;
      font-weight: 400;
      margin:3% 10% 0"> <span><?php echo $priest ?></span><br>Pastor</p>
  </section>
  <script type="text/javascript">
    function printCertificate() {
      var certificateElement = document.getElementById("certificate");

      var originalBorder = certificateElement.style.border;
      certificateElement.style.border = 'none';

      html2canvas(document.getElementById("certificate")).then(function(canvas) {

        certificateElement.style.border = originalBorder;
        var win = window.open('', '_blank');
        win.document.open();
        win.document.write('<!DOCTYPE html>');
        win.document.write('<html><head><title>Certificate</title>');
        win.document.write('<link rel="stylesheet" href="certificate.css">');
        win.document.write('<style>');
        win.document.write('@page { margin: 0; size: auto; } body { margin: 0; } img { width: 100%; height: 100vh; object-fit: cover; }');
        win.document.write('html, body { width: 100%; height: 100%; margin: 0; padding: 0; overflow: hidden; }');
        win.document.write('</style>');
        win.document.write('</head><body>');
        win.document.write('<img src="' + canvas.toDataURL() + '" />');
        win.document.write('</body></html>');
        win.document.close();

        win.onload = function() {
          win.print();
          win.close();
        };
      });
    }
  </script>
</body>

</html>