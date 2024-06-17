<?php

include '../connect.php';
$id = $_GET['editid'];

$sql = "SELECT * from `confirmation` where id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$Child_name = $row['Child_name'];
$Child_familyname = $row['Child_familyname'];
$godfather_name = $row['Godfather_name'];
$godfather_familyname = $row['Godfather_familyname'];
$godmother_name = $row['Godmother_name'];
$godmother_familyname = $row['Godmother_familyname'];
$father_name = $row['Father_name'];
$father_familyname = $row['Father_familyname'];
$mother_name = $row['Mother_name'];
$mother_familyname = $row['Mother_familyname'];
$baptism_municipality = $row['baptism_municipality'];
$baptism_barangay = $row['baptism_barangay'];
$baptism_month = $row['baptism_month'];
$baptism_day = $row['baptism_day'];
$baptism_year = $row['baptism_year'];
$confirmed_month = $row['confirmed_month'];
$confirmed_day = $row['confirmed_day'];
$confirmed_year = $row['confirmed_year'];
$minister = $row['minister'];
$priest = $row['priest'];
$remarks = $row['remarks'];
$Book_number = $row['Book_number'];
$Book_page = $row['Book_page'];
$Book_line = $row['Book_line'];

$month1 = date('m', strtotime($confirmed_month));
$confirmed_date = $confirmed_year . "-" . str_pad($month1, 2, "0", STR_PAD_LEFT) . "-" . str_pad($confirmed_day, 2, "0", STR_PAD_LEFT);
$month2 = date('m', strtotime($baptism_month));
$baptism_date = $baptism_year . "-" . str_pad($month2, 2, "0", STR_PAD_LEFT) . "-" . str_pad($baptism_day, 2, "0", STR_PAD_LEFT);

if (isset($_POST['submit'])) {
  $confirmation = new DateTime($_POST['Confirmation']);
  $baptismal = new DateTime($_POST['Baptismal']);
  $Child_name = ucfirst($_POST['Child-name']);
  $Child_familyname = ucfirst($_POST['Child-familyname']);
  $confirmed_month = $confirmation->format('F');
  $confirmed_day = $confirmation->format('d');
  $confirmed_year = $confirmation->format('Y');
  $baptism_month = $baptismal->format('F');
  $baptism_day = $baptismal->format('d');
  $baptism_year = $baptismal->format('Y');
  $Child_name = $_POST['Child-name'];
  $Child_familyname = $_POST['Child-familyname'];
  $father_name = $_POST['Father-name'];
  $father_familyname = $_POST['Father-familyname'];
  $mother_name = $_POST['Mother-name'];
  $mother_familyname = $_POST['Mother-familyname'];
  $baptism_municipality = $_POST['municipality'];
  $baptism_barangay = $_POST['barangay'];
  $godfather_name = $_POST['Godfather-name'];
  $godfather_familyname = $_POST['Godfather-familyname'];
  $godmother_name = $_POST['Godmother-name'];
  $godmother_familyname = $_POST['Godmother-familyname'];
  $minister = $_POST['minister'];
  $priest = $_POST['priest'];
  $remarks = $_POST['remarks'];
  $Book_number = $_POST['Book-number'];
  $Book_page = $_POST['Book-page'];
  $Book_line = $_POST['Book-line'];

  $sql = "update `confirmation` set Child_name='$Child_name', Child_familyname='$Child_familyname', Godfather_name='$godfather_name', Godfather_familyname='$godfather_familyname', Godmother_name='$godmother_name', Godmother_familyname='$godmother_familyname', Father_name='$father_name', Father_familyname='$father_familyname',Mother_name='$mother_name', Mother_familyname='$mother_familyname', baptism_municipality='$baptism_municipality', baptism_barangay='$baptism_barangay', baptism_month='$baptism_month', baptism_day='$baptism_day', baptism_year='$baptism_year', confirmed_month='$confirmed_month', confirmed_day='$confirmed_day', confirmed_year='$confirmed_year', priest='$priest', minister='$minister', Book_number='$Book_number', Book_page='$Book_page', Book_line='$Book_line', remarks='$remarks' where id='$id'";
  $result = mysqli_query($con, $sql);
  if ($result) {
    header('location:confirmation.php');
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
      <h1 class="align-self-center">CONFIRMATION RECORD</h1>
    </div>
    <div class="container-fluid d-flex justify-content-center gap-5" style="padding: 0;">
      <div style="width: 50%;">
        <p>Name of the Child</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Child-name" autocomplete="off" required value="<?php echo $Child_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Child-familyname" autocomplete="off" required value="<?php echo $Child_familyname ?>">
          </div>
        </div>
        <div class="d-flex gap-3">
          <div class="mb-3" style="flex: 1;">
            <p>Date of Confirmed</p>
            <input type="date" class="form-control" name="Confirmation" autocomplete="off" required value="<?php echo $confirmed_date ?>">
          </div>
          <div class="mb-3" style="flex: 1;">
            <p>Date of Baptism</p>
            <input type="date" class="form-control" name="Baptismal" autocomplete="off" required value="<?php echo $baptism_date ?>">
          </div>
        </div>
        <p>Place of Baptism</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="municipality" autocomplete="off" required value="<?php echo $baptism_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="barangay" autocomplete="off" required value="<?php echo $baptism_barangay ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Officiating Minister <span style="color: red; font-weight:normal">*</span></p>
          <div class="d-flex align-items-end gap-3">
            <input type="text" class="form-control" name="minister" autocomplete="off" required value="<?php echo $minister ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Remarks <span style="color: red; font-weight:normal">*</span></p>
          <div class="d-flex align-items-end gap-3">
            <input type="text" class="form-control" name="remarks" autocomplete="off" required value="<?php echo $remarks ?>">
          </div>
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
        <p>Father</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Father-name" autocomplete="off" required value="<?php echo $father_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Father-familyname" autocomplete="off" required value="<?php echo $father_familyname ?>">
          </div>
        </div>
        <p>Mother <span style="font-weight: 400; font-style:italic;">(Mother's Maiden Name)</span></p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Mother-name" autocomplete="off" required value="<?php echo $mother_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Mother-familyname" autocomplete="off" required value="<?php echo $mother_familyname ?>">
          </div>
        </div>
        <p>Godfather</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather-name" autocomplete="off" required value="<?php echo $godfather_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather-familyname" autocomplete="off" required value="<?php echo $godfather_familyname ?>">
          </div>
        </div>
        <p>Godmother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother-name" autocomplete="off" required value="<?php echo $godmother_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother-familyname" autocomplete="off" required value="<?php echo $godmother_familyname ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Priest of the Week <span style="font-weight: 400; font-style:italic;">(Signaturies)</span></p>
          <input type="text" class="form-control" name="priest" autocomplete="off" required value="<?php echo $priest ?>">
        </div>
      </div>
    </div>
    <button id="submitt" type="submit" name="submit" class="btn btn-primary my-5" style="width: 50%; height:50px">UPDATE</button>
  </form>
  <script>
    document.getElementById("back").addEventListener('click', function() {
      window.location.href = "confirmation.php"
    })
  </script>
</body>

</html>