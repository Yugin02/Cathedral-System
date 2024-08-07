<?php
include '../../database.php';
$id = $_GET['certid'];


$sql = "SELECT *, CONCAT(Child_name, ' ', Child_familyname) AS child_name, CONCAT(month, ' ', day, ', ', year) AS date_of_birth, CONCAT(parents_residence_barangay, ', ', parents_residence_municipality) AS place_of_birth, CONCAT(Mother_familyname, ' ', Mother_name) AS mother_name, CONCAT(Father_familyname, ' ', Father_name) AS father_name, baptism_month, baptism_day, baptism_year, minister, priest, CONCAT(Godmother_familyname, ' ', Godmother_name) AS godmother_name, CONCAT(Godfather_familyname, ' ', Godfather_name) AS godfather_name , Book_number, Book_page, Book_line, id FROM `baptismal` where id=$id";
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

$noGodParents = false;
$noGodMother = false;
$noGodFather = false;
if (($row['Godfather_name'] && $row['Godfather_familyname'] == " ") || ($row['Godfather_name'] && $row['Godfather_familyname'] == "N/A") || ($row['Godfather_name'] && $row['Godfather_familyname'] == "n/a") && ($row['Godfather_name'] && $row['Godfather_familyname'] == "n/A" || ($row['Godfather_name'] && $row['Godfather_familyname'] == "N/a"))) {
  $noGodParents = true;
} elseif (($row['Godfather_name'] == " ") || ($row['Godfather_name'] == "N/A") || ($row['Godfather_name'] == "n/a") || ($row['Godfather_name'] == "n/A") || ($row['Godfather_name'] == "N/a")) {
  $noGodFather = true;
} elseif (($row['Godmother_name'] == " ") || ($row['Godmother_name'] == "N/A") || ($row['Godmother_name'] == "n/a") || ($row['Godmother_name'] == "n/A") || ($row['Godmother_name'] == "N/a")) {
  $noGodMother = true;
}

function ordinalSuffix($day)
{
  $day = (int)$day;
  if (!in_array(($day % 100), array(11, 12, 13))) {
    switch ($day % 10) {
      case 1:
        return $day . 'st';
      case 2:
        return $day . 'nd';
      case 3:
        return $day . 'rd';
    }
  }
  return $day . 'th';
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
  <link href="https://fonts.googleapis.com/css2?family=Luxurious+Roman&family=Luxurious+Script&display=swap" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <link href="https://fonts.cdnfonts.com/css/trajan-pro" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="../css/certificate.css">
</head>

<body class="d-flex flex-column align-items-center">
  <div class="d-flex justify-content-between align-items-center align-self-stretch p-5">
    <div class="d-flex gap-2">
      <button class="certbutton" onclick="printCertificate()">Print<img src="../icon/print.png" alt=""></button>
      <select id="certificatePurpose" style="border: 2px solid #000;" class="form-select" aria-label="Default select example">
        <option selected>Certificate purposes</option>
        <option value="marriage">Marriage</option>
        <option value="burial">Burial</option>
      </select>
    </div>
    <div><a href="./baptismal.php"><img src="../icon/close.png" alt=""></a></div>
  </div>
  <section class="d-flex flex-column" id="certificate" style="width: 78rem; text-align: center; padding:50px 0;">
    <div class="d-flex justify-content-center align-items-center">
      <img style="position: absolute; left:15%; margin-top:-30px" src="../images/logo.png" alt="">
      <p style="color: #000;
        text-align: center;
        -webkit-text-stroke-width: 0.5;
        -webkit-text-stroke-color: #000;
        font-family: Luxurious Roman;
        font-size: 18px;
        font-style: normal;
        font-weight: 600;
        line-height: normal;
        margin-bottom:60px;
        margin-top:40px;
        font-family: 'Trajan Pro', sans-serif;">
        Diocese of Borongan <br> Nativity of Our Lady Cathedral Parish <br> Borongan City 6800</p>
    </div>
    <h1 style="color: #0AE7FA;
      font-family: Luxurious Script;
      font-size: 100px;
      font-style: normal;
      font-weight: 400;
      line-height: normal;
      letter-spacing: 9px;">
      Certificate of Baptism</h1>
    <div class="align-self-center fontSize" style="width: 85%; font-size:24px; margin-top: -30px; padding: 1% 7%; text-align:start; font-weight:500">
      <p style="text-align: center; margin-bottom:7%">This is to certify that</p>
      <p style="font-weight: 600; font-size:27px">CHILD: <span style="border-bottom:none; margin-left:75px; font-weight:700"><?php echo strtoupper($child_name) ?> <?php echo $row['Child_suffix']; ?></span></p>
      <p style="font-weight: 600; font-size:27px">FATHER: <span style="border-bottom:none; margin-left:55px; font-weight:700"><?php echo $father_name ?> <?php echo $row['Father_suffix']; ?></span></p>
      <p style="font-weight: 600; font-size:27px">MOTHER: <span style="border-bottom:none; margin-left:45px; font-weight:700"><?php echo $mother_name ?> <?php echo $row['Mother_suffix']; ?></span></p>
      <p style="font-weight: 600; font-size:27px">Date of Birth: <span style="border-bottom:none; margin-left:8px; font-weight:700"><?php echo $date_of_birth ?></span></p>
      <p style="font-weight: 600; font-size:27px">Place of Birth: <span style="border-bottom:none; margin-left:0px; font-weight:700"><?php echo $place_of_birth ?></span></p>
      <p style="text-align: center; margin:7% 0; letter-spacing: 2.4px">was solemnly BAPTIZED according to the <br> rites of the Roman Catholic Church </p>

      <p>on the <span><?php echo ordinalSuffix($baptism_day) ?></span> day of <span><?php echo $baptism_month ?></span>, <span><?php echo $baptism_year ?></span></p>
      <p>at the Cathedral Parish of the Nativity of Our Lady, <br>Borongan City, Eastern Samar</p>
      <p>by the <strong style="font-weight: 600;">Rev.</strong> <span style="font-weight: 600;"> <?php echo $minister ?> </span> </p>
      <p>and the sponsors being:
        <span>
          <?php if ($noGodParents) {
          } elseif ($noGodFather) {
            echo $godmother_name . " " . $row['Godmother_suffix'];
          } elseif ($noGodMother) {
            echo $godfather_name . " " . $row['Godfather_suffix'];
          } else {
            echo $godfather_name . " " . $row['Godfather_suffix'] ?> and
          <?php echo $godmother_name . " " . $row['Godmother_suffix'];
          } ?>
        </span>
      </p>
      <p>as it appears in the BAPTISMAL REGISTER</p>
      <p>Book: <span><?php echo $Book_number ?></span> Page: <span><?php echo $Book_page ?></span> Line: <span><?php echo $Book_line ?></span></p>
      <p style="margin-top: 5%;">Given this <span> <?php echo ordinalSuffix($currentDay) ?></span> day of <span> <?php echo $currentMonth ?> </span>, <span> <?php echo $currentYear ?> </span> at the Parish Office, <br> Borongan City, Eastern Samar, Philippines.</p>
      <p id="purpose" style="display: none;">For Marriage purposes only.</p>
    </div>
    <p class="align-self-end" style="color: #000;
      text-align: center;
      font-size: 21.328px;
      font-weight: 400;
      margin:3% 15% 0"> <span><?php echo $priest ?></span><br>Pastor</p>
  </section>
  <script type="text/javascript">
    const purpose = document.getElementById("certificatePurpose");
    const purpose1 = document.getElementById("purpose");
    purpose.addEventListener('change', function() {
      purpose1.style.display = "block"
      if (purpose.value == "marriage") {
        purpose1.innerText = "For Marriage purposes only.";
      } else if (purpose.value == "burial") {
        purpose1.innerText = "For Burial purposes only.";
      } else {
        purpose1.style.display = "none";
      }

    })

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
        win.document.write('@page { margin: 96px; size: auto; } body { margin: 0; } img { width: 98%; height: 98vh; object-fit: cover; border:5px solid #5BB4F4 }');
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