<?php
include '../connect.php';

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
  $confirmed_month = $confirmation->format('F');
  $confirmed_day = $confirmation->format('d');
  $confirmed_year = $confirmation->format('Y');
  $baptism_month = $baptismal->format('F');
  $baptism_day = $baptismal->format('d');
  $baptism_year = $baptismal->format('Y');
  $Child_name = ucfirst($_POST['Child-name']);
  $Child_familyname = ucfirst($_POST['Child-familyname']);
  $father_name = ucfirst($_POST['Father-name']);
  $father_familyname = ucfirst($_POST['Father-familyname']);
  $mother_name = ucfirst($_POST['Mother-name']);
  $mother_familyname = ucfirst($_POST['Mother-familyname']);
  $baptism_municipality = ucfirst($_POST['municipality']);
  $baptism_barangay = ucfirst($_POST['barangay']);
  $godfather_name = ucfirst($_POST['Godfather-name']);
  $godfather_familyname = ucfirst($_POST['Godfather-familyname']);
  $godmother_name = ucfirst($_POST['Godmother-name']);
  $godmother_familyname = ucfirst($_POST['Godmother-familyname']);
  $minister = ucfirst($_POST['minister']);
  $priest = ucfirst($_POST['priest']);
  $remarks = ucfirst($_POST['remarks']);
  $Book_number = ucfirst($_POST['Book-number']);
  $Book_page = ucfirst($_POST['Book-page']);
  $Book_line = ucfirst($_POST['Book-line']);

  $query = "SELECT COUNT(*) AS count FROM confirmation WHERE Book_number = '$Book_number' AND Book_page = '$Book_page' AND Book_line = '$Book_line'";
  $result = mysqli_query($con, $query);
  $data = mysqli_fetch_assoc($result);

  if ($data['count'] != 0) {
    //   echo '<div id=\"data_exist\" class="d-flex flex-column align-items-center" style="position: absolute; padding: 3% 5%; background-color:#fff; border: 1px solid #000; border-radius: 5px; top: 50%; left:50%; transform: translate(-50%, -50%); position:fixed;">
    //   <p style="text-align: center;">Data Already Exist!</p>
    //   <button id="okay" class="btn btn-danger" style="padding: 1.5% 5%; margin-top: 3%;">OKAY</button>
    // </div>';
    echo '<script>alert("Data Already Exist!"); </script>';
  } else {
    $sql = "insert into `confirmation` (id_number, Child_name, Child_familyname, confirmed_month, confirmed_day, confirmed_year, baptism_month, baptism_day, baptism_year, Father_name, Father_familyname , Mother_name, Mother_familyname, baptism_municipality, baptism_barangay, Godfather_name, Godfather_familyname, Godmother_name, Godmother_familyname, minister, priest, Book_number, Book_page, Book_line, remarks) values ('$random_number','$Child_name','$Child_familyname', '$confirmed_month', '$confirmed_day', '$confirmed_year', '$baptism_month', '$baptism_day', '$baptism_year', '$father_name', '$father_familyname', '$mother_name', '$mother_familyname', '$baptism_municipality', '$baptism_barangay', '$godfather_name', '$godfather_familyname', '$godmother_name', '$godmother_familyname', '$minister', '$priest', '$Book_number', '$Book_page', '$Book_line', '$remarks')";
    $result = mysqli_query($con, $sql);
    if ($result) {
      header("location: confirmation.php");
    } else {
      die(mysqli_error($con));
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
  <form method="post" class="d-flex flex-column align-items-center" style="min-width: 879px; padding:0 7%;">
    <div class="form d-flex flex-column" style="width:100%; margin:50px 0">
      <div class="d-flex align-items-center align-self-start" id="back" style="letter-spacing: 3px;">
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
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Child-familyname" autocomplete="off" required>
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
          <p>Officiating Minister <span style="color: red; font-weight:normal">*</span></p>
          <div class="d-flex align-items-end gap-3">
            <input type="text" class="form-control" name="minister" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3">
          <p>Priest of the Week <span style="font-weight: 400; font-style:italic;">(Signaturies)</span></p>
          <input type="text" class="form-control" name="priest" autocomplete="off" required>
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
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Father-familyname" autocomplete="off" required>
          </div>
        </div>
        <p>Mother <span style="font-weight: 400; font-style:italic;">(Mother's Maiden Name)</span></p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Mother-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Mother-familyname" autocomplete="off" required>
          </div>
        </div>
        <p>Godfather</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather-familyname" autocomplete="off" required>
          </div>
        </div>
        <p>Godmother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother-name" autocomplete="off" required>
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother-familyname" autocomplete="off" required>
          </div>
        </div>
        <div class="mb-3">
          <p>Remarks <span style="color: red; font-weight:normal">*</span></p>
          <div class="d-flex align-items-end gap-3">
            <input type="text" class="form-control" name="remarks" autocomplete="off" required>
          </div>
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