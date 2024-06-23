<?php
include '../../database.php';

$length = 6;

function id_number($length)
{
  $characters = '0123456789';
  $randomNumber = '';
  for ($i = 0; $i < $length; $i++) {
    $randomNumber .= $characters[rand(0, strlen($characters) - 1)];
  }
  return $randomNumber;
}

function check_id_number($con, $randomNumber)
{
  $query = "SELECT COUNT(*) AS count FROM marriage WHERE id_number = '$randomNumber'";
  $result = mysqli_query($con, $query);
  $data = mysqli_fetch_assoc($result);
  return $data['count'] == 0;
}

$randomNumber = id_number($length);
while (!check_id_number($con, $randomNumber)) {
  $length++;
  $randomNumber = id_number($length);
}

if (isset($_POST['submit'])) {
  do {
    $random_number = id_number($length);
  } while (!check_id_number($con, $random_number));

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

  $wife_name = ucfirst($_POST['wife-name']);
  $wife_familyname = ucfirst($_POST['wife-familyname']);
  $wife_legal_status = ucfirst($_POST['wife-legal-status']);
  $wife_municipality = ucfirst($_POST['wife-municipality']);
  $wife_barangay = ucfirst($_POST['wife-barangay']);
  $wife_birth_municipality = ucfirst($_POST['wife-birth-municipality']);
  $wife_birth_barangay = ucfirst($_POST['wife-birth-barangay']);
  $wife_baptism_municipality = ucfirst($_POST['wife-baptism-municipality']);
  $wife_baptism_barangay = ucfirst($_POST['wife-baptism-barangay']);
  $wife_Mother_name = ucfirst($_POST['wife-Mother-name']);
  $wife_Mother_familyname = ucfirst($_POST['wife-Mother-familyname']);
  $wife_Father_name = ucfirst($_POST['wife-Father-name']);
  $wife_Father_familyname = ucfirst($_POST['wife-Father-familyname']);
  $Godmother1_name = ucfirst($_POST['Godmother1-name']);
  $Godmother1_familyname = ucfirst($_POST['Godmother1-familyname']);
  $Godfather1_name = ucfirst($_POST['Godfather1-name']);
  $Godfather1_familyname = ucfirst($_POST['Godfather1-familyname']);
  $husband_name = ucfirst($_POST['husband-name']);
  $husband_familyname = ucfirst($_POST['husband-familyname']);
  $husband_legal_status = ucfirst($_POST['husband-legal-status']);
  $husband_municipality = ucfirst($_POST['husband-municipality']);
  $husband_barangay = ucfirst($_POST['husband-barangay']);
  $husband_birth_municipality = ucfirst($_POST['husband-birth-municipality']);
  $husband_birth_barangay = ucfirst($_POST['husband-birth-barangay']);
  $husband_baptism_municipality = ucfirst($_POST['husband-baptism-municipality']);
  $husband_baptism_barangay = ucfirst($_POST['husband-baptism-barangay']);
  $husband_Mother_name = ucfirst($_POST['husband-Mother-name']);
  $husband_Mother_familyname = ucfirst($_POST['husband-Mother-familyname']);
  $husband_Father_name = ucfirst($_POST['husband-Father-name']);
  $husband_Father_familyname = ucfirst($_POST['husband-Father-familyname']);
  $Godmother2_name = ucfirst($_POST['Godmother2-name']);
  $Godmother2_familyname = ucfirst($_POST['Godmother2-familyname']);
  $Godfather2_name = ucfirst($_POST['Godfather2-name']);
  $Godfather2_familyname = ucfirst($_POST['Godfather2-familyname']);
  $minister = ucfirst($_POST['minister']);
  $priest = ucfirst($_POST['priest']);
  $Book_number = ucfirst($_POST['Book-number']);
  $Book_page = ucfirst($_POST['Book-page']);
  $Book_line = ucfirst($_POST['Book-line']);
  $license_number = ucfirst($_POST['license-number']);
  $allowed_ext = array('jpg', 'jpeg', 'png');
  function handleFileUpload($fileKey)
  {
    $fileInfo = $_FILES[$fileKey];
    $imageName = $fileInfo['name'];
    $imageTmp = $fileInfo['tmp_name'];
    $imageSize = $fileInfo['size'];
    $error = $fileInfo['error'];
    $imageType = $fileInfo['type'];
    $imageExt = explode('.', $imageName);
    $imageActExt = strtolower(end($imageExt));

    return [
      'name' => $imageName,
      'tmp_name' => $imageTmp,
      'size' => $imageSize,
      'error' => $error,
      'type' => $imageType,
      'ext' => $imageActExt
    ];
  }
  $wifeBaptismal = handleFileUpload('wife-baptismal');
  $wifeConfirmation = handleFileUpload('wife-confirmation');
  $husbandBaptismal = handleFileUpload('husband-baptismal');
  $husbandConfirmation = handleFileUpload('husband-confirmation');
  $marriageCert = handleFileUpload('marriage-cert');

  $query = "SELECT COUNT(*) AS count FROM marriage WHERE Book_number = '$Book_number' AND Book_page = '$Book_page' AND Book_line = '$Book_line'";
  $result = mysqli_query($con, $query);
  $data = mysqli_fetch_assoc($result);

  if ($data['count'] != 0) {
    echo '<script>alert("Data Already Exist!"); </script>';
  } else {
    if (
      (in_array($wifeBaptismal['ext'], $allowed_ext)) ||
      (in_array($wifeConfirmation['ext'], $allowed_ext)) ||
      (in_array($husbandBaptismal['ext'], $allowed_ext)) ||
      (in_array($husbandConfirmation['ext'], $allowed_ext)) ||
      (in_array($marriageCert['ext'], $allowed_ext))
    ) {
      if (
        ($wifeBaptismal['error'] === 0) ||
        ($wifeConfirmation['error'] === 0) ||
        ($husbandBaptismal['error'] === 0) ||
        ($husbandConfirmation['error'] === 0) ||
        ($marriageCert['error'] === 0)
      ) {
        if (
          ($wifeBaptismal['size'] < 500000) ||
          ($wifeConfirmation['size'] < 500000) ||
          ($husbandBaptismal['size'] < 500000) ||
          ($husbandConfirmation['size'] < 500000) ||
          ($marriageCert['size'] < 500000)
        ) {

          $folderPath = '../../images/Marriage/' . $random_number . '/';
          mkdir($folderPath, 0777, true);


          $wife_baptismal_imageNew_name = "Baptismal_" . $wife_familyname . "_" . $wife_name . "." . $wifeBaptismal['ext'];
          $wife_baptismal_folder = $folderPath . $wife_baptismal_imageNew_name;
          move_uploaded_file($wifeBaptismal['tmp_name'], $wife_baptismal_folder);

          $wife_confirmation_imageNew_name = "Confirmation_" . $wife_familyname . "_" . $wife_name . "." . $wifeConfirmation['ext'];
          $wife_confirmation_folder = $folderPath . $wife_confirmation_imageNew_name;
          move_uploaded_file($wifeConfirmation['tmp_name'], $wife_confirmation_folder);

          $husband_baptismal_imageNew_name = "Baptismal_" . $husband_familyname . "_" . $husband_name . "." . $husbandBaptismal['ext'];
          $husband_baptismal_folder = $folderPath . $husband_baptismal_imageNew_name;
          move_uploaded_file($husbandBaptismal['tmp_name'], $husband_baptismal_folder);

          $husband_confirmation_imageNew_name = "Confirmation_" . $husband_familyname . "_" . $husband_name . "." . $husbandConfirmation['ext'];
          $husband_confirmation_folder = $folderPath . $husband_confirmation_imageNew_name;
          move_uploaded_file($husbandConfirmation['tmp_name'], $husband_confirmation_folder);

          $marriage_certificate_imageNew_name = "Mr.&Mrs." . $wife_familyname . "_" . $wife_name . "." . $marriageCert['ext'];
          $marriage_certificate_folder = $folderPath . $marriage_certificate_imageNew_name;
          move_uploaded_file($marriageCert['tmp_name'], $marriage_certificate_folder);


          $sql = "insert into `marriage` (id_number, wife_name, wife_familyname, wife_legal_status, wife_municipality, wife_barangay, wife_month, wife_day, wife_year, wife_birth_municipality, wife_birth_barangay, wife_baptism_month, wife_baptism_day, wife_baptism_year,wife_baptism_municipality, wife_baptism_barangay, husband_name, husband_familyname, husband_legal_status, husband_municipality, husband_barangay, husband_month, husband_day, husband_year, husband_birth_municipality, husband_birth_barangay, husband_baptism_month, husband_baptism_day, husband_baptism_year,husband_baptism_municipality, husband_baptism_barangay, marriage_month, marriage_day, marriage_year, minister,license_number,husband_Father_name, husband_Father_familyname, husband_Mother_name, husband_Mother_familyname, wife_Father_name, wife_Father_familyname, wife_Mother_name, wife_Mother_familyname, Godfather1_name, Godfather1_familyname, Godmother1_name, Godmother1_familyname, Godfather2_name, Godfather2_familyname, Godmother2_name, Godmother2_familyname, priest, Book_number, Book_page, Book_line, wife_baptismal_image, wife_confirmation_image, husband_baptismal_image, husband_confirmation_image, marriage_cert_image) values ('$random_number', '$wife_name','$wife_familyname', '$wife_legal_status', '$wife_municipality', '$wife_barangay', '$wife_month', '$wife_day', '$wife_year','$wife_birth_municipality', '$wife_birth_barangay', '$wife_baptism_month', '$wife_baptism_day', '$wife_baptism_year','$wife_baptism_municipality', '$wife_baptism_barangay','$husband_name','$husband_familyname', '$husband_legal_status', '$husband_municipality', '$husband_barangay', '$husband_month', '$husband_day', '$husband_year','$husband_birth_municipality', '$husband_birth_barangay', '$husband_baptism_month', '$husband_baptism_day', '$husband_baptism_year','$husband_baptism_municipality', '$husband_baptism_barangay','$marriage_month', '$marriage_day', '$marriage_year', '$minister','$license_number', '$husband_Father_name', '$husband_Father_familyname', '$husband_Mother_name', '$husband_Mother_familyname', '$wife_Father_name', '$wife_Father_familyname', '$wife_Mother_name', '$wife_Mother_familyname', '$Godfather1_name', '$Godfather1_familyname', '$Godmother1_name', '$Godmother1_familyname', '$Godfather2_name', '$Godfather2_familyname', '$Godmother2_name', '$Godmother2_familyname','$priest', '$Book_number', '$Book_page', '$Book_line', '$wife_baptismal_imageNew_name', '$wife_confirmation_imageNew_name', '$husband_baptismal_imageNew_name', '$husband_confirmation_imageNew_name', '$marriage_certificate_imageNew_name')";
          $result = mysqli_query($con, $sql);
          if ($result) {
            echo "<div class=\"d-flex flex-column align-items-center\" style=\"position: fixed; padding: 5%; background-color:#fff; border: 1px solid #000; border-radius: 5px; top: 50%; left:50%; transform: translate(-50%, -50%);\">
          <p style=\"text-align: center;\">Data Added Successfully! <br> Identification Number: <span style=\"border-bottom: 1px solid #000; padding: 0 10px;\"> $random_number</span></p>
          <button class=\"btn btn-primary\" style=\"padding: 1.5% 5%; margin-top: 3%;\"><a style=\"text-decoration: none; color: #fff;\" href=\"marriage.php\">Proceed</a></button>
        </div>";
          } else {
            die(mysqli_error($con));
          }
        } else {
          echo "<script>alert(\"The File is too Big\")</script>";
        }
      } else {
        echo "<script>alert(\"Error Uploading File\")</script>";
      }
    } else {
      echo "<script>alert(\"This Type of File is not Acceptable!\") </script>";
    }
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
  <form method="post" class="d-flex flex-column align-items-center" enctype="multipart/form-data" style="min-width: 879px; padding:0 7%;">
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
            <input type="text" class="form-control" name="wife-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="wife-familyname" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3">
          <p>Legal Status <span style="font-weight: normal; color:red;">*</span></p>
          <select style="border: 1px solid #000; border-radius:0;" class="form-select" name="wife-legal-status" required>
            <option>Single</option>
            <option>Widow</option>
            <option>Widower</option>
            <option>Separated</option>
            <option>Annuled</option>
          </select>
        </div>
        <p>Actual Address</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="wife-municipality" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="wife-barangay" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Birth <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="wife-birth" autocomplete="off" required>
        </div>
        <p>Place of Birth</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="wife-birth-municipality" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="wife-birth-barangay" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Baptism <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="wife-baptism" autocomplete="off" required>
        </div>
        <p>Place of Baptism</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="wife-baptism-municipality" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="wife-baptism-barangay" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3">
          <p>Baptismal Certificate <span style="color: red; font-weight:normal">*</span></p>
          <input type="file" class="form-control" name="wife-baptismal" autocomplete="off" required>
        </div>
        <div class="mb-3">
          <p>Confirmation Certificate <span style="color: red; font-weight:normal">*</span></p>
          <input type="file" class="form-control" name="wife-confirmation" autocomplete="off" required>
        </div>
        <p>Mother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="wife-Mother-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="wife-Mother-familyname" autocomplete="off" required>
          </div>
        </div>
        <p>Father</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="wife-Father-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="wife-Father-familyname" autocomplete="off" required>
          </div>
        </div>
        <p>Godmother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother1-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother1-familyname" autocomplete="off" required>
          </div>
        </div>
        <p>Godfather</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather1-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather1-familyname" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Marriage <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="marriage-date" autocomplete="off" required>
        </div>
        <p>Marriage Certificate</p>
        <div>
          <div class="d-flex justify-content-start gap-4 mb-3">
            <div class="form-check">
              <input style="border: 1px solid #000;" class="form-check-input" type="radio" name="flexRadioDefault" value="married" id="married" onchange="toggleSelect(this)">
              <label class="form-check-label" for="flexRadioDefault1">
                Married
              </label>
            </div>
            <div class="form-check">
              <input style="border: 1px solid #000;" class="form-check-input" type="radio" name="flexRadioDefault" value="cohabitant" id="cohabitant" onchange="toggleSelect(this)">
              <label class="form-check-label" for="flexRadioDefault1">
                Cohabitant
              </label>
            </div>
          </div>
          <div class="mb-3">
            <select id="married-selected" style="border: 1px solid #000; border-radius:0; display:none;" class="form-select" name="married" required>
              <option>Marriage Contract or Marriage License</option>
              <option>Civil Marriage Contract</option>
            </select>
          </div>
          <div class="mb-3">
            <select id="cohabitant-selected" style="border: 1px solid #000; border-radius:0; display:none;" class="form-select" name="cohabitant" required>
              <option>Affidavit of Cohabitation (5 years or more)</option>
              <option>Marriage License (less than 5 years)</option>
            </select>
          </div>
          <div class="mb-3">
            <input id="file" style="display: none;" type="file" class="form-control" name="marriage-cert" autocomplete="off" required>
          </div>
        </div>
        <p>Book</p>
        <div class="d-flex gap-3">
          <div class="mb-3">
            <label>Number <span>*</span></label>
            <input type="text" class="form-control" name="Book-number" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Page <span>*</span></label>
            <input type="text" class="form-control" name="Book-page" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Line <span>*</span></label>
            <input type="text" class="form-control" name="Book-line" autocomplete="off" required>
          </div>
        </div>
      </div>
      <div style="width: 50%;">
        <p>Name of Husband</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-familyname" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3">
          <p>Legal Status <span style="font-weight: normal; color:red;">*</span></p>
          <select style="border: 1px solid #000; border-radius:0;" class="form-select" name="husband-legal-status" required>
            <option>Single</option>
            <option>Widow</option>
            <option>Widower</option>
            <option>Separated</option>
            <option>Annuled</option>
          </select>
        </div>
        <p>Actual Address</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="husband-municipality" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="husband-barangay" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Birth <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="husband-birth" autocomplete="off" required>
        </div>
        <p>Place of Birth</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="husband-birth-municipality" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="husband-birth-barangay" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Baptism <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="husband-baptism" autocomplete="off" required>
        </div>
        <p>Place of Baptism</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="husband-baptism-municipality" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="husband-baptism-barangay" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3">
          <p>Baptismal Certificate <span style="color: red; font-weight:normal">*</span></p>
          <input type="file" class="form-control" name="husband-baptismal" autocomplete="off" required>
        </div>
        <div class="mb-3">
          <p>Confirmation Certificate <span style="color: red; font-weight:normal">*</span></p>
          <input type="file" class="form-control" name="husband-confirmation" autocomplete="off" required>
        </div>
        <p>Mother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-Mother-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-Mother-familyname" autocomplete="off" required>
          </div>
        </div>
        <p>Father</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-Father-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="husband-Father-familyname" autocomplete="off" required>
          </div>
        </div>
        <p>Godmother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother2-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother2-familyname" autocomplete="off" required>
          </div>
        </div>
        <p>Godfather</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather2-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather2-familyname" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3">
          <p>License Number <span style="color: red; font-weight:normal">*</span></p>
          <input type="text" class="form-control" name="license-number" autocomplete="off" required>
        </div>
        <div class="mb-3">
          <p>Officiating Minister <span style="color: red; font-weight:normal">*</span></p>
          <div class="d-flex align-items-end gap-3" required>
            <input type="text" class="form-control" name="minister" autocomplete="off">
          </div>
        </div>
        <div class="mb-3">
          <p>Priest of the Week </p>
          <input type="text" class="form-control" name="priest" autocomplete="off">
        </div>
      </div>
    </div>
    <button id="submitt" type="submit" name="submit" class="btn btn-primary my-5" style="width: 50%; height:50px">SUBMIT</button>
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