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
      <a id="download" class="certbutton" download="certificate.jpg">Download<img src="../icon/download.png" alt=""></a>
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
    $(document).ready(function() {
      var element = document.getElementById("certificate");
      $("#download").on('click', function() {
        downloadImage();
      });

      function downloadImage() {
        html2canvas(element).then(function(canvas) {
          var imageData = canvas.toDataURL("image/jpeg").replace("image/jpeg", "image/octet-stream");
          var deceasedName = "<?php echo $deceased_name ?>";
          var link = document.createElement('a');
          link.download = deceasedName + '.png';
          link.href = imageData;
          link.click();
        });
      }
    });

    function printCertificate() {

      html2canvas(document.getElementById("certificate")).then(function(canvas) {
        var win = window.open();
        win.document.write('<!DOCTYPE html><html><head><title>Certificate</title></head><body style="margin: 0;"><img src="' + canvas.toDataURL() + '" style="width: 100%; height: auto;" /></body></html>');
        win.print();
        win.close();
      });
      win.document.body.onload = function() {
        win.print();
        win.close();
      };
    }
  </script>
</body>

</html>