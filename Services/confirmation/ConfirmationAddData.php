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
  $query = "SELECT COUNT(*) AS count FROM confirmation WHERE id_number = '$randomNumber'";
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

  $confirmation = new DateTime($_POST['Confirmation']);
  $baptismal = new DateTime($_POST['Baptismal']);
  $Child_name = ucfirst($_POST['Child-name']);
  $Child_familyname = ucfirst($_POST['Child-familyname']);
  $Child_suffix = ucfirst($_POST['Child-suffix']);
  $confirmed_month = $confirmation->format('F');
  $confirmed_day = $confirmation->format('d');
  $confirmed_year = $confirmation->format('Y');
  $baptism_month = $baptismal->format('F');
  $baptism_day = $baptismal->format('d');
  $baptism_year = $baptismal->format('Y');
  $father_name = ucfirst($_POST['Father-name']);
  $father_familyname = ucfirst($_POST['Father-familyname']);
  $Father_suffix = ucfirst($_POST['Father-suffix']);
  $mother_name = ucfirst($_POST['Mother-name']);
  $mother_familyname = ucfirst($_POST['Mother-familyname']);
  $Mother_suffix = ucfirst($_POST['Mother-suffix']);
  $baptism_municipality = ucfirst($_POST['municipality']);
  $baptism_barangay = ucfirst($_POST['barangay']);
  $godfather_name = ucfirst($_POST['Godfather-name']);
  $godfather_familyname = ucfirst($_POST['Godfather-familyname']);
  $Godfather_suffix = ucfirst($_POST['Godfather-suffix']);
  $godmother_name = ucfirst($_POST['Godmother-name']);
  $godmother_familyname = ucfirst($_POST['Godmother-familyname']);
  $Godmother_suffix = ucfirst($_POST['Godmother-suffix']);
  $minister = ucfirst($_POST['minister']);
  $priest = ucfirst($_POST['priest']);
  $remarks = ucfirst($_POST['remarks']);
  $Book_number = ucfirst($_POST['Book-number']);
  $Book_page = ucfirst($_POST['Book-page']);
  $Book_line = ucfirst($_POST['Book-line']);
  $imageName = $_FILES['baptismal_certificate']['name'];
  $imageTmp = $_FILES['baptismal_certificate']['tmp_name'];
  $imageSize = $_FILES['baptismal_certificate']['size'];
  $error = $_FILES['baptismal_certificate']['error'];
  $imageType = $_FILES['baptismal_certificate']['type'];
  $image_ext = explode('.', $imageName);
  $imageAct_ext = strtolower(end($image_ext));
  $allowed_ext = array('jpg', 'jpeg', 'png');

  $query = "SELECT COUNT(*) AS count FROM confirmation WHERE Book_number = '$Book_number' AND Book_page = '$Book_page' AND Book_line = '$Book_line'";
  $result = mysqli_query($con, $query);
  $data = mysqli_fetch_assoc($result);

  if ($data['count'] != 0) {
    echo '<script>alert("Data Already Exist!"); </script>';
  } else {
    if (in_array($imageAct_ext, $allowed_ext)) {
      if ($error === 0) {
        if ($imageSize < 5000000) {
          $imageNew_name = $Child_familyname . "_" . $Child_name . "." . $imageAct_ext;
          $folder = '../../images/Confirmation/' . $imageNew_name;
          move_uploaded_file($imageTmp, $folder);

          $sql = "insert into `confirmation` (id_number, Child_name, Child_familyname, confirmed_month, confirmed_day, confirmed_year, baptism_month, baptism_day, baptism_year, Father_name, Father_familyname , Mother_name, Mother_familyname, baptism_municipality, baptism_barangay, Godfather_name, Godfather_familyname, Godmother_name, Godmother_familyname, minister, priest, Book_number, Book_page, Book_line, child_baptismal_image, remarks, Child_suffix, Father_suffix, Mother_suffix, Godmother_suffix, Godfather_suffix) values ('$random_number','$Child_name','$Child_familyname', '$confirmed_month', '$confirmed_day', '$confirmed_year', '$baptism_month', '$baptism_day', '$baptism_year', '$father_name', '$father_familyname', '$mother_name', '$mother_familyname', '$baptism_municipality', '$baptism_barangay', '$godfather_name', '$godfather_familyname', '$godmother_name', '$godmother_familyname', '$minister', '$priest', '$Book_number', '$Book_page', '$Book_line', '$imageNew_name', '$remarks', '$Child_suffix', '$Father_suffix', '$Mother_suffix', '$Godmother_suffix', '$Godfather_suffix')";
          $result = mysqli_query($con, $sql);
          if ($result) {
            echo "<div class=\"d-flex flex-column align-items-center\" style=\"position: fixed; padding: 5%; background-color:#fff; border: 1px solid #000; border-radius: 5px; top: 50%; left:50%; transform: translate(-50%, -50%);\">
          <p style=\"text-align: center;\">Data Added Successfully! <br> Identification Number: <span style=\"border-bottom: 1px solid #000; padding: 0 10px;\"> $random_number</span></p>
          <button class=\"btn btn-primary\" style=\"padding: 1.5% 5%; margin-top: 3%;\"><a style=\"text-decoration: none; color: #fff;\" href=\"confirmation.php\">Proceed</a></button>
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
      <div class="d-flex align-items-center align-self-start" onclick="window.location.href='confirmation.php'" style="letter-spacing: 3px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
          <path d="M10 12.796V3.204L4.519 8zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753" />
        </svg>
        <p style="margin-bottom: 0;">BACK</p>
      </div>
      <h1 class="align-self-center">CONFIRMATION RECORD</h1>
    </div>
    <div class="container-fluid d-flex justify-content-center gap-5" style="padding: 0;">
      <div style="width: 50%;">
        <p>Name of the Child</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Child-name" autocomplete="off" required>
          </div>
          <div class="mb-3 d-flex gap-2">
            <div class="flex-grow-1">
              <label>Family Name <span>*</span></label>
              <input type="text" class="form-control" name="Child-familyname" autocomplete="off" required>
            </div>
            <div>
              <label>Suffix <span style="font-weight: 400; font-style:italic; color:gray">(If Applicable)</span></label>
              <input type="text" class="form-control" name="Child-suffix" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="d-flex gap-3">
          <div class="mb-3" style="flex: 1;">
            <p>Date of Confirmed</p>
            <input type="date" class="form-control" name="Confirmation" autocomplete="off" required>
          </div>
          <div class="mb-3" style="flex: 1;">
            <p>Date of Baptism</p>
            <input type="date" class="form-control" name="Baptismal" autocomplete="off" required>
          </div>
        </div>
        <p>Place of Baptism</p>
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
          <p>Baptismal Certificate <span style="color: red; font-weight:normal">*</span></p>
          <input type="file" class="form-control" name="baptismal_certificate" autocomplete="off" required>
        </div>
        <div class="mb-3">
          <p>Officiating Minister <span style="color: red; font-weight:normal">*</span></p>
          <div class="d-flex align-items-end gap-3">
            <input type="text" class="form-control" name="minister" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3">
          <p>Remarks <span style="font-weight: 400; font-style:italic; color:gray">(Optional)</span></p>
          <div class="d-flex align-items-end gap-3">
            <input type="text" class="form-control" name="remarks" autocomplete="off">
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
        <p>Father</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Father-name" autocomplete="off" required>
          </div>
          <div class="mb-3 d-flex gap-2">
            <div class="flex-grow-1">
              <label>Family Name <span>*</span></label>
              <input type="text" class="form-control" name="Father-familyname" autocomplete="off" required>
            </div>
            <div>
              <label>Suffix</label>
              <input type="text" class="form-control" name="Father-suffix" autocomplete="off">
            </div>
          </div>
        </div>
        <p>Mother <span style="font-weight: 400; font-style:italic;">(Mother's Maiden Name)</span></p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Mother-name" autocomplete="off" required>
          </div>
          <div class="mb-3 d-flex gap-2">
            <div class="flex-grow-1">
              <label>Family Name <span>*</span></label>
              <input type="text" class="form-control" name="Mother-familyname" autocomplete="off" required>
            </div>
            <div>
              <label>Suffix <span style="font-weight: 400; font-style:italic; color:gray">(If Applicable)</span></label>
              <input type="text" class="form-control" name="Mother-suffix" autocomplete="off">
            </div>
          </div>
        </div>
        <p>Godfather <span style="font-style: italic; color:grey; font-weight:400">(Optional)</span></p>
        <div>
          <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" name="Godfather-name" autocomplete="off">
          </div>
          <div class="mb-3 d-flex gap-2">
            <div class="flex-grow-1">
              <label>Family Name</label>
              <input type="text" class="form-control" name="Godfather-familyname" autocomplete="off">
            </div>
            <div>
              <label>Suffix</label>
              <input type="text" class="form-control" name="Godfather-suffix" autocomplete="off">
            </div>
          </div>
        </div>
        <p>Godmother <span style="font-style: italic; color:grey; font-weight:400">(Optional)</span></p>
        <div>
          <div class="mb-3">
            <label>Name</label>
            <input type="text" class="form-control" name="Godmother-name" autocomplete="off">
          </div>
          <div class="mb-3 d-flex gap-2">
            <div class="flex-grow-1">
              <label>Family Name</label>
              <input type="text" class="form-control" name="Godmother-familyname" autocomplete="off">
            </div>
            <div>
              <label>Suffix</label>
              <input type="text" class="form-control" name="Godmother-suffix" autocomplete="off">
            </div>
          </div>
        </div>
        <div class="mb-3">
          <p>Priest of the Week <span style="font-weight: 400; font-style:italic; color:gray">(Signatories)</span></p>
          <input type="text" class="form-control" name="priest" autocomplete="off">
        </div>
      </div>
    </div>
    <button id="submitt" type="submit" name="submit" class="btn btn-primary my-5" style="width: 50%; height:50px">SUBMIT</button>
  </form>
  <script>
    document.getElementById("back").addEventListener('click', function() {
      window.location.href = "confirmation.php"
    })
  </script>
</body>

</html>