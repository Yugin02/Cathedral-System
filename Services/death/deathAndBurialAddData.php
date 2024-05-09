<?php

include '../connect.php';
function id_number($length = 6)
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
  $query = "SELECT COUNT(*) AS count FROM death_and_burial WHERE id_number = '$randomNumber'";
  $result = mysqli_query($con, $query);
  $data = mysqli_fetch_assoc($result);
  return $data['count'] == 0;
}

if (isset($_POST['submit'])) {
  do {
    $random_number = id_number();
  } while (!check_id_number($con, $random_number));

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

  $imageName = $_FILES['death-cert']['name'];
  $imageTmp = $_FILES['death-cert']['tmp_name'];
  $imageSize = $_FILES['death-cert']['size'];
  $error = $_FILES['death-cert']['error'];
  $imageType = $_FILES['death-cert']['type'];

  $image_ext = explode('.', $imageName);
  $imageAct_ext = strtolower(end($image_ext));

  $allowed_ext = array('jpg', 'jpeg', 'png');

  if (in_array($imageAct_ext, $allowed_ext)) {
    if ($error === 0) {
      if ($imageSize < 500000) {
        $imageNew_name = $deceased_name . "_" . $deceased_familyname . "." . $imageAct_ext;
        $folder = '../../images/Death and Burial/' . $imageNew_name;
        move_uploaded_file($imageTmp, $folder);

        $sql = "insert into `death_and_burial` (id_number, deceased_name, deceased_familyname, age, death_month, death_day, death_year, burial_month, burial_day, burial_year, relative_name, relative_familyname, deceased_municipality, deceased_barangay, minister, burial_municipality, burial_barangay, sacraments, priest, Book_number, Book_page, Book_line, death_cert_images) values ('$random_number', '$deceased_name','$deceased_familyname', '$age', '$death_month', '$death_day', '$death_year', '$burial_month', '$burial_day', '$burial_year', '$relative_name', '$relative_familyname', '$deceased_municipality', '$deceased_barangay', '$minister','$burial_municipality', '$burial_barangay', '$sacraments' ,'$priest', '$Book_number', '$Book_page', '$Book_line', '$imageNew_name')";
        $result = mysqli_query($con, $sql);
        if ($result) {
          echo "<div class=\"d-flex flex-column align-items-center\" style=\"position: absolute; padding: 5%; background-color:#fff; border: 1px solid #000; border-radius: 5px; top: 50%; left:50%; transform: translate(-50%, -50%);\">
          <p style=\"text-align: center;\">Data Added Successfully! <br> Identification Number: <span style=\"border-bottom: 1px solid #000; padding: 0 10px;\"> $random_number</span></p>
          <button class=\"btn btn-primary\" style=\"padding: 1.5% 5%; margin-top: 3%;\"><a style=\"text-decoration: none; color: #fff;\" href=\"deathAndBurial.php\">Proceed</a></button>
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
      <h1 class="align-self-center">DEATH AND BURIAL RECORD</h1>
    </div>
    <div class="container-fluid d-flex justify-content-center gap-5" style="padding: 0;">
      <div style="width: 50%;">
        <p>Name of Deceased</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="deceased-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="deceased-familyname" autocomplete="off" required>
          </div>
        </div>
        <p>Residence</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="municipality" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="barangay" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3">
          <p>Sacraments Received <span style="color: red; font-weight:normal">*</span></p>
          <input type="text" class="form-control" name="sacraments" autocomplete="off" required>
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
        <div class="mb-3">
          <p>Priest of the Week <span style="font-style: italic; font-weight:normal">(Signaturies)</span></p>
          <input type="text" class="form-control" name="priest" autocomplete="off">
        </div>
      </div>
      <div style="width: 50%;">
        <p>Parents, Wife or Husband</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="relative-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="relative-familyname" autocomplete="off" required>
          </div>
        </div>
        <div class="d-flex gap-3">
          <div class="mb-3" style="flex: 1;">
            <p>Date of Death <span style="color: red; font-weight:normal">*</span></p>
            <input type="date" class="form-control" name="death" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <p>Age <span style="color: red; font-weight:normal">*</span></p>
            <input type="text" class="form-control" name="age" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3" style="flex: 1;">
          <p>Date of Burial <span style="color: red; font-weight:normal">*</span></p>
          <input type="date" class="form-control" name="burial" autocomplete="off" required>
        </div>
        <p>Place of Burial</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="burial-municipality" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="burial-barangay" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3">
          <p>Death Certificate <span style="color: red; font-weight:normal">*</span></p>
          <input type="file" class="form-control" name="death-cert" autocomplete="off" required>
        </div>
        <div class="mb-3">
          <p>Officiating Minister <span style="color: red; font-weight:normal">*</span></p>
          <div class="d-flex align-items-end gap-3">
            <input type="text" class="form-control" name="minister" autocomplete="off" required>
          </div>
        </div>
      </div>
    </div>
    <button id="submitt" type="submit" name="submit" class="btn btn-primary my-5" style="width: 50%; height:50px">SUBMIT</button>
  </form>
  <script>
    document.getElementById("back").addEventListener('click', function() {
      window.location.href = "deathAndBurial.php"
    })
  </script>
</body>

</html>