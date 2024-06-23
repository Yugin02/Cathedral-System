<?php
include '../../database.php';
$id = $_GET['editid'];

$sql = "select * from `death_and_burial` where id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$deceased_name = $row['deceased_name'];
$deceased_familyname = $row['deceased_familyname'];
$deceased_municipality = $row['deceased_municipality'];
$deceased_barangay = $row['deceased_barangay'];
$death_month = $row['death_month'];
$death_day = $row['death_day'];
$death_year = $row['death_year'];
$age = $row['age'];
$burial_month = $row['burial_month'];
$burial_day = $row['burial_day'];
$burial_year = $row['burial_year'];
$burial_municipality = $row['burial_municipality'];
$burial_barangay = $row['burial_barangay'];
$relative_name = $row['relative_name'];
$relative_familyname = $row['relative_familyname'];
$sacraments = $row['sacraments'];
$minister = $row['minister'];
$priest = $row['priest'];
$Book_number = $row['Book_number'];
$Book_page = $row['Book_page'];
$Book_line = $row['Book_line'];

$month1 = date('m', strtotime($death_month));
$death_date = $death_year . "-" . str_pad($month1, 2, "0", STR_PAD_LEFT) . "-" . str_pad($death_day, 2, "0", STR_PAD_LEFT);
$month2 = date('m', strtotime($burial_month));
$burial_date = $burial_year . "-" . str_pad($month2, 2, "0", STR_PAD_LEFT) . "-" . str_pad($burial_day, 2, "0", STR_PAD_LEFT);

if (isset($_POST['submit'])) {
  $burial = new DateTime($_POST['burial']);
  $death = new DateTime($_POST['death']);
  $death_month = $death->format('F');
  $death_day = $death->format('d');
  $death_year = $death->format('Y');
  $burial_month = $burial->format('F');
  $burial_day = $burial->format('d');
  $burial_year = $burial->format('Y');
  $deceased_name = $_POST['deceased-name'];
  $deceased_familyname = $_POST['deceased-familyname'];
  $age = $_POST['age'];
  $burial_municipality = $_POST['burial-municipality'];
  $burial_barangay = $_POST['burial-barangay'];
  $relative_name = $_POST['relative-name'];
  $relative_familyname = $_POST['relative-familyname'];
  $deceased_municipality = $_POST['municipality'];
  $deceased_barangay = $_POST['barangay'];
  $sacraments = $_POST['sacraments'];
  $minister = $_POST['minister'];
  $priest = $_POST['priest'];
  $Book_number = $_POST['Book-number'];
  $Book_page = $_POST['Book-page'];
  $Book_line = $_POST['Book-line'];

  $sql = "update `death_and_burial` set deceased_name='$deceased_name', deceased_familyname='$deceased_familyname', deceased_municipality='$deceased_municipality', deceased_barangay='$deceased_barangay', death_month='$death_month', death_day='$death_day', death_year='$death_year', burial_month='$burial_month', age='$age', burial_day='$burial_day', burial_year='$burial_year', burial_municipality='$burial_municipality', burial_barangay='$burial_barangay', relative_name='$relative_name', relative_familyname='$relative_familyname',priest='$priest',sacraments='$sacraments', minister='$minister', Book_number='$Book_number', Book_page='$Book_page', Book_line='$Book_line' where id='$id'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    header('location:deathAndBurial.php');
  } else {
    die(mysqli_error($con));
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="../css/addData.css">
  <link rel="stylesheet" href="../css/header.css">
</head>

<body>
  <form method="post" class="d-flex flex-column align-items-center" style="min-width: 879px; padding:0 7%;">
    <div class="form d-flex flex-column" style="width:100%; margin:50px 0">
      <div class="d-flex align-items-center align-self-start" id="back" style="letter-spacing: 3px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
          <path d="M10 12.796V3.204L4.519 8zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753" />
        </svg>
        <p style="margin-bottom: 0;">BACK</p>
      </div>
      <h1 class="align-self-center">DEATH AND BURIAL RECORD</h1>
    </div>
    <div class="container-fluid d-flex justify-content-center gap-5" style="padding: 0;">
      <div style="width: 50%;">
        <p>Name of Deceased</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="deceased-name" autocomplete="off" required value="<?php echo $deceased_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="deceased-familyname" autocomplete="off" required value="<?php echo $deceased_familyname ?>">
          </div>
        </div>
        <p>Residence</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="municipality" autocomplete="off" required value="<?php echo $deceased_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="barangay" autocomplete="off" required value="<?php echo $deceased_barangay ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Sacraments Received <span style="color: red; font-weight:normal">*</span></p>
          <input type="text" class="form-control" name="sacraments" autocomplete="off" required value="<?php echo $sacraments ?>">
        </div>
        <p>Book</p>
        <div class="d-flex gap-3">
          <div class="mb-3">
            <label>Number <span>*</span></label>
            <input type="text" class="form-control" name="Book-number" autocomplete="off" required value="<?php echo $Book_number ?>">
          </div>
          <div class="mb-3">
            <label>Page <span>*</span></label>
            <input type="text" class="form-control" name="Book-page" autocomplete="off" required value="<?php echo $Book_page ?>">
          </div>
          <div class="mb-3">
            <label>Line <span>*</span></label>
            <input type="text" class="form-control" name="Book-line" autocomplete="off" required value="<?php echo $Book_line ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Priest of the Week <span style="font-style: italic; font-weight:normal">(Signaturies)</span></p>
          <input type="text" class="form-control" name="priest" autocomplete="off" value="<?php echo $priest ?>">
        </div>
      </div>
      <div style="width: 50%;">
        <p>Parents, Wife or Husband</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="relative-name" autocomplete="off" required value="<?php echo $relative_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="relative-familyname" autocomplete="off" required value="<?php echo $relative_familyname ?>">
          </div>
        </div>
        <div class="d-flex gap-3">
          <div class="mb-3" style="flex: 1;">
            <p>Date of Death <span style="color: red; font-weight:normal">*</span></p>
            <input type="date" class="form-control" name="death" autocomplete="off" required value="<?php echo $death_date ?>">
          </div>
          <div class="mb-3">
            <p>Age <span style="color: red; font-weight:normal">*</span></p>
            <input type="text" class="form-control" name="age" autocomplete="off" required value="<?php echo $age ?>">
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Burial <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="burial" autocomplete="off" required value="<?php echo $burial_date ?>">
        </div>
        <p>Place of Burial</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="burial-municipality" autocomplete="off" required value="<?php echo $burial_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="burial-barangay" autocomplete="off" required value="<?php echo $burial_barangay ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Officiating Minister <span style="color: red; font-weight:normal">*</span></p>
          <div class="d-flex align-items-end gap-3">
            <input type="text" class="form-control" name="minister" autocomplete="off" required value="<?php echo $minister ?>">
          </div>
        </div>
      </div>
    </div>
    <button id="submitt" type="submit" name="submit" class="btn btn-primary my-5" style="width: 50%; height:50px">UPDATE</button>
  </form>
  <script>
    document.getElementById("back").addEventListener('click', function() {
      window.location.href = "deathAndBurial.php"
    })
  </script>
</body>

</html>