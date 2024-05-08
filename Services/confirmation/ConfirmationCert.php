<?php
include '../connect.php';
$id = $_GET['certid'];


$sql = "SELECT *, CONCAT_WS(' ', Child_familyname, Child_name) AS fullname, CONCAT_WS(' ', baptism_month, baptism_day, baptism_year) AS baptized_date, CONCAT_WS(' ', baptism_municipality, baptism_barangay) AS parish_address, CONCAT_WS(' ', Mother_familyname, Mother_name) AS mother_name, CONCAT_WS(' ', Father_familyname, Father_name) AS father_name, CONCAT_WS(' ', Godmother_familyname, Godmother_name) AS godmother_name, CONCAT_WS(' ', Godfather_familyname, Godfather_name) AS godfather_name FROM `confirmation` where id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
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
    <div><a href="./confirmation.php"><img src="../icon/close.png" alt=""></a></div>
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
    <h1 style="color: #7AE7FA;
      font-family: Luxurious Script;
      font-size: 90px;
      font-style: normal;
      font-weight: 400;
      line-height: normal;
      letter-spacing: 9px;
      -webkit-text-stroke-width:.03cm;
      -webkit-text-stroke-color: #000;">
      Certificate of Confirmation</h1>
    <div class="align-self-center" style="font-weight:500; width: 85%; border: solid 3px #000; font-size:24px; margin-top: -30px; padding: 1% 7%; text-align:start">
      <p style="text-align: center; margin-bottom:7%">This is to Certify that</p>
      <p style="font-weight: 600;">NAME: <span><?php echo $row['fullname'] ?></span></p>
      <p style="font-weight: 600;">FATHER: <span><?php echo $row['father_name'] ?></span></p>
      <p style="font-weight: 600;">MOTHER: <span><?php echo $row['mother_name'] ?></span></p>
      <p style="font-weight: 600;">Bapized on: <span><?php echo $row['baptized_date'] ?></span></p>
      <p style="font-weight: 600;">Place of Baptism: <span><?php echo $row['parish_address'] ?></span></p>
      <p style="text-align: center; margin:7% 0; letter-spacing: 2.4px">was solemnly CONFIRMED according to the <br> rites of the Roman Catholic Church </p>
      <p>on the <span><?php echo $row['confirmed_day'] ?></span> day of <span> <?php echo $row['confirmed_month'] ?></span></p>
      <p>at the Nativity of our Lady Cathedral Parish Church, <br>Borongan City, Eastern Samar</p>
      <p>By his excellency <strong style="font-weight: 600;">Most. Rev. Crispin B. Varquez D.D</strong></p>
      <p>and the sponsor being: <span><?php echo $row['godfather_name'] ?> and <?php echo $row['godmother_name'] ?></span></p>
      <p>as it appears in the CONFIRMATION REGISTER</p>
      <p>Book: <span> <?php echo $row['Book_number'] ?></span> Page: <span> <?php echo $row['Book_page'] ?></span> Line: <span><?php echo $row['Book_line'] ?></span></p>
      <p style="margin-top: 5%;">Given this <span></span> day of <span></span> 2024 at the Parish Office, <br> Borongan City Eastern Samar, Philippines.</p>
    </div>
    <p class="align-self-end" style="color: #000;
      text-align: center;
      font-size: 30px;
      margin:3% 10% 0"> <span><?php echo $row['priest'] ?></span> <br>Pastor</p>
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
          var childName = "<?php echo $child_name ?>";
          var link = document.createElement('a');
          link.download = childName + '.png';
          link.href = imageData;
          link.click();
          console.log("asd")
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
      console.log("asd")
    }
  </script>
</body>

</html>