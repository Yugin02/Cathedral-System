<?php
include '../connect.php';
$id = $_GET['certid'];


$sql = "SELECT *, CONCAT_WS(' ', husband_name, husband_familyname) AS husband_name, CONCAT_WS(' ', wife_name, wife_familyname) AS wife_name, CONCAT_WS(' ', husband_Father_name, husband_Father_familyname) AS husband_father_name, CONCAT_WS(' ', husband_Mother_name, husband_Mother_familyname) AS husband_mother_name, CONCAT_WS(' ', wife_Father_name, wife_Father_familyname) AS wife_father_name, CONCAT_WS(' ', wife_Mother_name, wife_Mother_familyname) AS wife_mother_name FROM `marriage` where id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$groom_name = $row['husband_name'];
$bride_name = $row['wife_name'];
$bride_father_name = $row['wife_father_name'];
$bride_mother_name = $row['wife_mother_name'];
$groom_father_name = $row['husband_father_name'];
$groom_mother_name = $row['husband_mother_name'];
$marriage_month = $row['marriage_month'];
$marriage_day = $row['marriage_day'];
$marriage_year = $row['marriage_year'];
$groom_age = $row['husband_age'];
$bride_age = $row['wife_age'];
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
    <div><a href="./marriage.php"><img src="../icon/close.png" alt=""></a></div>
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
      Certificate of Marriage</h1>
    <div class="align-self-center" style="width: 85%; border: solid 3px #000; font-size:24px; margin-top: -30px; padding: 7% 4%; text-align:start; font-weight:500">
      <p style="line-height: 50px;">This is to certify that <span><?php echo $groom_name, ', ', $groom_age ?></span> years old, single son of <span><?php echo $groom_father_name ?></span> and <span><?php echo $groom_mother_name ?></span> and <span><?php echo $bride_name, ', ', $bride_age ?></span> years old single, daughter of <span><?php echo $bride_father_name ?></span> and <span><?php echo $bride_mother_name ?></span></p>
      <p style="color: #000;
        text-align: center;
        font-family: Luxurious Script;
        font-size: 35px;
        font-style: normal;
        font-weight: 400;
        line-height: normal;
        letter-spacing: 3.5px;
        margin: 7% 0">
        received the Sacrament of Matrimony <br> according to the rites of the Roman Catholic Church</p>
      <p>on the <span><?php echo $marriage_day ?></span> day of <span><?php echo $marriage_month ?></span> , <span><?php echo $marriage_year ?></span> before the</p>
      <p>Fr. <span><?php echo $minister ?></span> at the Cathedral Parish of the Nativity of our Lady, <br> Borongan, Eastern Samar, <br> the witness being; <br> as it appears in the MARRIAGE REGISTER,</p>
      <p>Book No: <span><?php echo $Book_number ?></span> Page: <span><?php echo $Book_page ?></span> Line: <span><?php echo $Book_line ?></span></p>
      <p style="margin-top: 6%;">Given this <span><?php echo $currentDay ?></span> day of <span><?php echo $currentMonth ?></span> <?php echo $currentYear ?> at the Parish Office, <br> Borongan City Eastern Samar, Philippines.</p>
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
          var groomName = "<?php echo $groom_name ?>";
          var link = document.createElement('a');
          link.download = groomName + '.png';
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
    }
  </script>
</body>

</html>