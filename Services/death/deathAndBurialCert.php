<?php
include '../connect.php';
$id = $_GET['certid'];


$sql = "SELECT *, CONCAT_WS(' ', deceased_name, deceased_familyname) AS deceased_name, CONCAT(deceased_municipality, ', ', deceased_barangay) AS address, CONCAT(burial_municipality, ', ', burial_barangay) AS burial_address FROM `death_and_burial` where id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$deceased_name = $row['deceased_name'];
$address = $row['address'];
$death_month = $row['death_month'];
$death_day = $row['death_day'];
$death_year = $row['death_year'];
$age = $row['age'];
$burial_address = $row['burial_address'];
$burial_month = $row['burial_month'];
$burial_day = $row['burial_day'];
$burial_year = $row['burial_year'];
$minister = $row['minister'];
$priest = $row['priest'];
$Book_number = $row['Book_number'];
$Book_page = $row['Book_page'];
$Book_line = $row['Book_line'];
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
    <div class="d-flex gap-4">
      <button class="certbutton" onclick="printCertificate()">Print<img src="../icon/print.png" alt=""></button>
    </div>
    <div><a href="./deathAndBurial.php"><img src="../icon/close.png" alt=""></a></div>
  </div>
  <section class="d-flex flex-column" id="certificate" style="width: 78rem; text-align: center; padding: 50px 0;">
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
    <h1 style="color: #000;
      font-family: Old English Text MT;
      font-size: 64px;
      font-style: normal;
      font-weight: 500;
      line-height: normal;
      letter-spacing: 6px;">
      Certificate of Death and Burial</h1>
    <div class="align-self-center" style="width: 85%; border: solid 3px #000; font-size:24px; padding: 8% 7%; text-align:start; font-weight:500">
      <p>This is to certify that <span><?php echo $deceased_name ?></span></p>
      <p>Resident of <span><?php echo $address ?></span></p>
      <p>died on the <span><?php echo $death_day ?></span> day of <span><?php echo $death_month ?></span> , <span><?php echo $death_year ?></span> at the age of <span><?php echo $age ?></span></p>
      <p style="color: #000;
      text-align: center;
      font-family: Old English Text MT;
      font-size: 24px;
      font-style: normal;
      font-weight: 500;
      line-height: normal;
      letter-spacing: 2.4px;
      margin: 7% 0;">He/She was given the solemn Funeral Rites <br> according to the Roman Catholic Church</p>
      <p>Officiated by the <span><?php echo $minister ?></span></p>
      <p>and was buried at the <span><?php echo $burial_address ?></span></p>
      <p>of Borongan, Eastern Samar on the <span><?php echo $burial_day ?></span> day of <span><?php echo $burial_month ?></span></p>
      <p>as appears on the Parish Death Register Book: <span><?php echo $Book_number ?></span> Page: <span><?php echo $Book_page ?></span> Line: <span><?php echo $Book_line ?></span></p>
      <p style="margin-top: 5%;">Given this <span><?php echo $currentDay ?></span> day of <span><?php echo $currentMonth ?></span> <?php echo $currentYear ?> at the Parish Office, <br> Borongan City Eastern Samar, Philippines.</p>
    </div>
    <p class="align-self-end" style="color: #000;
      text-align: center;
      font-size: 30px;
      margin:3% 10% 0"> <span><?php echo $priest ?></span> <br>Pastor</p>
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
        win.document.write('@page { margin: 0; size: auto; } body { margin: 0; } img { width: 100%; height: 100vh; object-fit: contain; }');
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