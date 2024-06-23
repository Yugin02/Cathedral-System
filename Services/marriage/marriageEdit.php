<?php
include '../../database.php';
$id = $_GET['editid'];

$sql = "SELECT * from `marriage` where id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$wife_name = $row['wife_name'];
$wife_familyname = $row['wife_familyname'];
$wife_legal_status = $row['wife_legal_status'];
$wife_municipality = $row['wife_municipality'];
$wife_barangay = $row['wife_barangay'];
$wife_month = $row['wife_month'];
$wife_day = $row['wife_day'];
$wife_year = $row['wife_year'];
$wife_birth_municipality = $row['wife_birth_municipality'];
$wife_birth_barangay = $row['wife_birth_barangay'];
$wife_baptism_month = $row['wife_baptism_month'];
$wife_baptism_day = $row['wife_baptism_day'];
$wife_baptism_year = $row['wife_baptism_year'];
$wife_baptism_municipality = $row['wife_baptism_municipality'];
$wife_baptism_barangay = $row['wife_baptism_barangay'];
$husband_name = $row['husband_name'];
$husband_familyname = $row['husband_familyname'];
$husband_legal_status = $row['husband_legal_status'];
$husband_municipality = $row['husband_municipality'];
$husband_barangay = $row['husband_barangay'];
$husband_month = $row['husband_month'];
$husband_day = $row['husband_day'];
$husband_year = $row['husband_year'];
$husband_birth_municipality = $row['husband_birth_municipality'];
$husband_birth_barangay = $row['husband_birth_barangay'];
$husband_baptism_month = $row['husband_baptism_month'];
$husband_baptism_day = $row['husband_baptism_day'];
$husband_baptism_year = $row['husband_baptism_year'];
$husband_baptism_municipality = $row['husband_baptism_municipality'];
$husband_baptism_barangay = $row['husband_baptism_barangay'];
$marriage_month = $row['marriage_month'];
$marriage_day = $row['marriage_day'];
$marriage_year = $row['marriage_year'];
$husband_age = $row['husband_age'];
$wife_age = $row['wife_age'];
$wife_father_name = $row['wife_Father_name'];
$wife_father_familyname = $row['wife_Father_familyname'];
$wife_mother_name = $row['wife_Mother_name'];
$wife_mother_familyname = $row['wife_Mother_familyname'];
$husband_father_name = $row['husband_Father_name'];
$husband_father_familyname = $row['husband_Father_familyname'];
$husband_mother_name = $row['husband_Mother_name'];
$husband_mother_familyname = $row['husband_Mother_familyname'];
$Godfather1_name = $row['Godfather1_name'];
$Godfather1_familyname = $row['Godfather1_familyname'];
$Godmother1_name = $row['Godmother1_name'];
$Godmother1_familyname = $row['Godmother1_familyname'];
$Godfather2_name = $row['Godfather2_name'];
$Godfather2_familyname = $row['Godfather2_familyname'];
$Godmother2_name = $row['Godmother2_name'];
$Godmother2_familyname = $row['Godmother2_familyname'];
$license_number = $row['license_number'];
$minister = $row['minister'];
$priest = $row['priest'];
$Book_number = $row['Book_number'];
$Book_page = $row['Book_page'];
$Book_line = $row['Book_line'];

$month1 = date('m', strtotime($wife_month));
$wife_birth_date = $wife_year . "-" . str_pad($month1, 2, "0", STR_PAD_LEFT) . "-" . str_pad($wife_day, 2, "0", STR_PAD_LEFT);
$month2 = date('m', strtotime($wife_baptism_month));
$wife_baptism_date = $wife_baptism_year . "-" . str_pad($month2, 2, "0", STR_PAD_LEFT) . "-" . str_pad($wife_baptism_day, 2, "0", STR_PAD_LEFT);
$month3 = date('m', strtotime($husband_month));
$husband_date = $husband_year . "-" . str_pad($month3, 2, "0", STR_PAD_LEFT) . "-" . str_pad($husband_day, 2, "0", STR_PAD_LEFT);
$month4 = date('m', strtotime($husband_baptism_month));
$husband_baptism_date = $husband_baptism_year . "-" . str_pad($month4, 2, "0", STR_PAD_LEFT) . "-" . str_pad($husband_baptism_day, 2, "0", STR_PAD_LEFT);
$month5 = date('m', strtotime($marriage_month));
$marriage_date = $marriage_year . "-" . str_pad($month4, 2, "0", STR_PAD_LEFT) . "-" . str_pad($marriage_day, 2, "0", STR_PAD_LEFT);


if (isset($_POST['submit'])) {

  $husband_birth = new DateTime($_POST['husband-birth']);
  $wife_birth = new DateTime($_POST['wife-birth']);
  $husband_baptism = new DateTime($_POST['husband-baptism']);
  $wife_baptism = new DateTime($_POST['wife-baptism']);
  $marriage = new DateTime($_POST['marriage-date']);

  $wife_month = $wife_birth->format('F');
  $wife_day = $wife_birth->format('d');
  $wife_year = $wife_birth->format('Y');
  $wife_baptism_month = $wife_baptism->format('F');
  $wife_baptism_day = $wife_baptism->format('d');
  $wife_baptism_year = $wife_baptism->format('Y');
  $husband_month = $husband_birth->format('F');
  $husband_day = $husband_birth->format('d');
  $husband_year = $husband_birth->format('Y');
  $husband_baptism_month = $husband_baptism->format('F');
  $husband_baptism_day = $husband_baptism->format('d');
  $husband_baptism_year = $husband_baptism->format('Y');
  $marriage_month = $marriage->format('F');
  $marriage_day = $marriage->format('d');
  $marriage_year = $marriage->format('Y');
  $wife_name = $_POST['wife-name'];
  $wife_familyname = $_POST['wife-familyname'];
  $wife_legal_status = $_POST['wife-legal-status'];
  $wife_municipality = $_POST['wife-municipality'];
  $wife_barangay = $_POST['wife-barangay'];
  $wife_birth_municipality = $_POST['wife-birth-municipality'];
  $wife_birth_barangay = $_POST['wife-birth-barangay'];
  $wife_baptism_municipality = $_POST['wife-baptism-municipality'];
  $wife_baptism_barangay = $_POST['wife-baptism-barangay'];
  $wife_Mother_name = $_POST['wife-Mother-name'];
  $wife_Mother_familyname = $_POST['wife-Mother-familyname'];
  $wife_Father_name = $_POST['wife-Father-name'];
  $wife_Father_familyname = $_POST['wife-Father-familyname'];
  $Godmother1_name = $_POST['Godmother1-name'];
  $Godmother1_familyname = $_POST['Godmother1-familyname'];
  $Godfather1_name = $_POST['Godfather1-name'];
  $Godfather1_familyname = $_POST['Godfather1-familyname'];
  $husband_name = $_POST['husband-name'];
  $husband_familyname = $_POST['husband-familyname'];
  $husband_legal_status = $_POST['husband-legal-status'];
  $husband_municipality = $_POST['husband-municipality'];
  $husband_barangay = $_POST['husband-barangay'];
  $husband_birth_municipality = $_POST['husband-birth-municipality'];
  $husband_birth_barangay = $_POST['husband-birth-barangay'];
  $husband_baptism_municipality = $_POST['husband-baptism-municipality'];
  $husband_baptism_barangay = $_POST['husband-baptism-barangay'];
  $husband_Mother_name = $_POST['husband-Mother-name'];
  $husband_Mother_familyname = $_POST['husband-Mother-familyname'];
  $husband_Father_name = $_POST['husband-Father-name'];
  $husband_Father_familyname = $_POST['wife-Father-familyname'];
  $Godmother2_name = $_POST['Godmother2-name'];
  $Godmother2_familyname = $_POST['Godmother2-familyname'];
  $Godfather2_name = $_POST['Godfather2-name'];
  $Godfather2_familyname = $_POST['Godfather2-familyname'];
  $license_number = $_POST['license-number'];
  $minister = $_POST['minister'];
  $priest = $_POST['priest'];
  $Book_number = $_POST['Book-number'];
  $Book_page = $_POST['Book-page'];
  $Book_line = $_POST['Book-line'];

  $sql = "UPDATE `marriage` set wife_name='$wife_name', wife_familyname='$wife_familyname', wife_legal_status='$wife_legal_status', wife_municipality='$wife_municipality', wife_barangay= '$wife_barangay', wife_month='$wife_month', wife_day='$wife_day', wife_year='$wife_year', wife_birth_municipality='$wife_birth_municipality', wife_birth_barangay='$wife_birth_barangay', wife_baptism_month='$wife_baptism_month', wife_baptism_day='$wife_baptism_day', wife_baptism_year='$wife_baptism_year', wife_baptism_municipality='$wife_baptism_municipality', wife_baptism_barangay='$wife_baptism_barangay', wife_age='$wife_age', wife_Father_name='$wife_Father_name', wife_Father_familyname='$wife_Father_familyname', wife_Mother_name='$wife_Mother_name', wife_Mother_familyname='$wife_Mother_familyname', husband_name='$husband_name', husband_familyname='$husband_familyname', husband_legal_status='$husband_legal_status', husband_municipality='$husband_municipality', husband_barangay= '$husband_barangay', husband_month='$husband_month', husband_day='$husband_day', husband_year='$husband_year', husband_birth_municipality='$husband_birth_municipality', husband_birth_barangay='$husband_birth_barangay', husband_baptism_month='$husband_baptism_month', husband_baptism_day='$husband_baptism_day', husband_baptism_year='$husband_baptism_year', husband_baptism_municipality='$husband_baptism_municipality', husband_baptism_barangay='$husband_baptism_barangay', husband_age='$husband_age', husband_Father_name='$husband_Father_name', husband_Father_familyname='$husband_Father_familyname', husband_Mother_name='$husband_Mother_name', husband_Mother_familyname='$husband_Mother_familyname', Godfather1_name='$Godfather1_name', Godfather1_familyname='$Godfather1_familyname', Godmother1_name='$Godmother1_name', Godmother1_familyname='$Godmother1_familyname', Godfather2_name='$Godfather2_name', Godfather2_familyname='$Godfather2_familyname', Godmother2_name='$Godmother2_name', Godmother2_familyname='$Godfather2_familyname', license_number='$license_number', priest='$priest', minister='$minister', book_number='$Book_number', book_page='$Book_page', book_line='$Book_line' where id='$id'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    header('location:marriage.php');
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
      <h1 class="align-self-center">MARRIAGE RECORD</h1>
    </div>
    <div class="container-fluid d-flex justify-content-center gap-5" style="padding: 0;">
      <div style="width: 50%;">
        <p>Name of Wife</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="wife-name" autocomplete="off" required value="<?php echo $wife_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="wife-familyname" autocomplete="off" required value="<?php echo $wife_familyname ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Legal Status <span style="font-weight: normal; color:red;">*</span></p>
          <select style="border: 1px solid #000; border-radius:0;" class="form-select" name="wife-legal-status" required>
            <option <?php echo ($wife_legal_status == 'Single') ? 'selected' : ''; ?>>Single</option>
            <option <?php echo ($wife_legal_status == 'Widow') ? 'selected' : ''; ?>>Widow</option>
            <option <?php echo ($wife_legal_status == 'Widower') ? 'selected' : ''; ?>>Widower</option>
            <option <?php echo ($wife_legal_status == 'Separated') ? 'selected' : ''; ?>>Separated</option>
            <option <?php echo ($wife_legal_status == 'Annuled') ? 'selected' : ''; ?>>Annuled</option>
          </select>
        </div>
        <p>Actual Address</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="wife-municipality" autocomplete="off" required value="<?php echo $wife_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="wife-barangay" autocomplete="off" required value="<?php echo $wife_barangay ?>">
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Birth <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="wife-birth" autocomplete="off" required value="<?php echo $wife_birth_date ?>">
        </div>
        <p>Place of Birth</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="wife-birth-municipality" autocomplete="off" required value="<?php echo $wife_birth_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="wife-birth-barangay" autocomplete="off" required value="<?php echo $wife_birth_barangay ?>">
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Baptism <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="wife-baptism" autocomplete="off" required value="<?php echo $wife_baptism_date ?>">
        </div>
        <p>Place of Baptism</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="wife-baptism-municipality" autocomplete="off" required value="<?php echo $wife_baptism_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="wife-baptism-barangay" autocomplete="off" required value="<?php echo $wife_baptism_barangay ?>">
          </div>
        </div>
        <p>Mother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="wife-Mother-name" autocomplete="off" required value="<?php echo $wife_mother_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="wife-Mother-familyname" autocomplete="off" required value="<?php echo $wife_mother_familyname ?>">
          </div>
        </div>
        <p>Father</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="wife-Father-name" autocomplete="off" required value="<?php echo $wife_father_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="wife-Father-familyname" autocomplete="off" required value="<?php echo $wife_father_familyname ?>">
          </div>
        </div>
        <p>Godmother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother1-name" autocomplete="off" required value="<?php echo $Godmother1_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother1-familyname" autocomplete="off" required value="<?php echo $Godmother1_familyname ?>">
          </div>
        </div>
        <p>Godfather</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather1-name" autocomplete="off" required value="<?php echo $Godfather1_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather1-familyname" autocomplete="off" required value="<?php echo $Godfather1_familyname ?>">
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Marriage <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="marriage-date" autocomplete="off" required value="<?php echo $marriage_date ?>">
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
      </div>
      <div style="width: 50%;">
        <p>Name of Husband</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-name" autocomplete="off" required value="<?php echo $husband_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-familyname" autocomplete="off" required value="<?php echo $husband_familyname ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Legal Status <span style="font-weight: normal; color:red;">*</span></p>
          <select style="border: 1px solid #000; border-radius:0;" class="form-select" name="husband-legal-status" required>
            <option <?php echo ($husband_legal_status == 'Single') ? 'selected' : ''; ?>>Single</option>
            <option <?php echo ($husband_legal_status == 'Widow') ? 'selected' : ''; ?>>Widow</option>
            <option <?php echo ($husband_legal_status == 'Widower') ? 'selected' : ''; ?>>Widower</option>
            <option <?php echo ($husband_legal_status == 'Separated') ? 'selected' : ''; ?>>Separated</option>
            <option <?php echo ($husband_legal_status == 'Annuled') ? 'selected' : ''; ?>>Annuled</option>
          </select>
        </div>

        <p>Actual Address</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="husband-municipality" autocomplete="off" required value="<?php echo $husband_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="husband-barangay" autocomplete="off" required value="<?php echo $husband_barangay ?>">
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Birth <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="husband-birth" autocomplete="off" required value="<?php echo $husband_date ?>">
        </div>
        <p>Place of Birth</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="husband-birth-municipality" autocomplete="off" required value="<?php echo $husband_birth_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="husband-birth-barangay" autocomplete="off" required value="<?php echo $husband_birth_barangay ?>">
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Baptism <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="husband-baptism" autocomplete="off" required value="<?php echo $husband_baptism_date ?>">
        </div>
        <p>Place of Baptism</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="husband-baptism-municipality" autocomplete="off" required value="<?php echo $husband_baptism_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="husband-baptism-barangay" autocomplete="off" required value="<?php echo $husband_baptism_barangay ?>">
          </div>
        </div>
        <p>Mother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-Mother-name" autocomplete="off" required value="<?php echo $husband_mother_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-Mother-familyname" autocomplete="off" required value="<?php echo $husband_mother_familyname ?>">
          </div>
        </div>
        <p>Father</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-Father-name" autocomplete="off" required value="<?php echo $husband_father_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-Father-familyname" autocomplete="off" required value="<?php echo $husband_father_familyname ?>">
          </div>
        </div>
        <p>Godmother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother2-name" autocomplete="off" required value="<?php echo $Godmother2_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother2-familyname" autocomplete="off" required value="<?php echo $Godmother2_familyname ?>">
          </div>
        </div>
        <p>Godfather</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather2-name" autocomplete="off" required value="<?php echo $Godfather2_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather2-familyname" autocomplete="off" required value="<?php echo $Godfather2_familyname ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>License Number <span style="color: red; font-weight:normal">*</span></p>
          <input type="text" class="form-control" name="license-number" autocomplete="off" required value="<?php echo $license_number ?>">
        </div>
        <div class="mb-3">
          <p>Officiating Minister <span style="color: red; font-weight:normal">*</span></p>
          <div class="d-flex align-items-end gap-3" required>
            <input type="text" class="form-control" name="minister" autocomplete="off" value="<?php echo $minister ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Priest of the Week </p>
          <input type="text" class="form-control" name="priest" autocomplete="off" value="<?php echo $priest ?>">
        </div>
      </div>
    </div>
    <button id="submitt" type="submit" name="submit" class="btn btn-primary my-5" style="width: 50%; height:50px">UPDATE</button>
  </form>
  <script>
    function toggleSelect(radio) {
      var married = document.getElementById('married-selected');
      var cohabitant = document.getElementById('cohabitant-selected');
      var file = document.getElementById('file');

      if (radio.value === 'married') {
        married.style.display = 'block';
        cohabitant.style.display = 'none';
      } else if (radio.value === 'cohabitant') {
        cohabitant.style.display = 'block';
        married.style.display = 'none';
      } else {
        cohabitant.style.display = 'none';
        married.style.display = 'none';
      }
      file.style.display = 'block';
    }
    document.getElementById("back").addEventListener('click', function() {
      window.location.href = "marriage.php"
    })
  </script>
</body>

</html>