<?php
include '../../database.php';
$id = $_GET['editid'];


$sql = "SELECT * from `baptismal` where id=$id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$Child_name = ucfirst($row['Child_name']);
$Child_familyname = ucfirst($row['Child_familyname']);
$month = ucfirst($row['month']);
$day = ucfirst($row['day']);
$year = ucfirst($row['year']);
$baptism_month = ucfirst($row['baptism_month']);
$baptism_day = ucfirst($row['baptism_day']);
$baptism_year = ucfirst($row['baptism_year']);
$municipality = ucfirst($row['parents_residence_municipality']);
$barangay = ucfirst($row['parents_residence_barangay']);
$godmother_municipality = ucfirst($row['godmother_residence_municipality']);
$godmother_barangay = ucfirst($row['godmother_residence_barangay']);
$godfather_municipality = ucfirst($row['godfather_residence_municipality']);
$godfather_barangay = ucfirst($row['godfather_residence_barangay']);
$Godfather_name = ucfirst($row['Godfather_name']);
$Godfather_familyname = ucfirst($row['Godfather_familyname']);
$Godmother_name = ucfirst($row['Godmother_name']);
$Godmother_familyname = ucfirst($row['Godmother_familyname']);
$Mother_name = ucfirst($row['Mother_name']);
$Mother_familyname = ucfirst($row['Mother_familyname']);
$Father_name = ucfirst($row['Father_name']);
$Father_familyname = ucfirst($row['Father_familyname']);
$Father_municipality = ucfirst($row['father_origin_municipality']);
$Father_barangay = ucfirst($row['father_origin_barangay']);
$Mother_municipality = ucfirst($row['mother_origin_municipality']);
$Mother_barangay = ucfirst($row['mother_origin_barangay']);
$minister = ucfirst($row['minister']);
$priest = ucfirst($row['priest']);
$remarks = ucfirst($row['remarks']);
$Book_number = ucfirst($row['Book_number']);
$Book_page = ucfirst($row['Book_page']);
$Book_line = ucfirst($row['Book_line']);
$legitimity = ucfirst($row['legitimity']);

$folder = '../../images/Baptismal/' . $row['live_birth_image'];

$month1 = date('m', strtotime($month));
$birth_date = $year . "-" . str_pad($month1, 2, "0", STR_PAD_LEFT) . "-" . str_pad($day, 2, "0", STR_PAD_LEFT);
$month2 = date('m', strtotime($baptism_month));
$baptism_date = $baptism_year . "-" . str_pad($month2, 2, "0", STR_PAD_LEFT) . "-" . str_pad($baptism_day, 2, "0", STR_PAD_LEFT);

if (isset($_POST['submit'])) {
  $birth = new DateTime($_POST['Birth']);
  $baptismal = new DateTime($_POST['Baptismal']);
  $Child_name = ucfirst($_POST['Child-name']);
  $Child_familyname = ucfirst($_POST['Child-familyname']);
  $month = $birth->format('F');
  $day = $birth->format('d');
  $year = $birth->format('Y');
  $baptism_month = $baptismal->format('F');
  $baptism_day = $baptismal->format('d');
  $baptism_year = $baptismal->format('Y');
  $father_name = ucfirst($_POST['Father-name']);
  $father_familyname = ucfirst($_POST['Father-familyname']);
  $mother_name = ucfirst($_POST['Mother-name']);
  $mother_familyname = ucfirst($_POST['Mother-familyname']);
  $mother_origin_municipality = ucfirst($_POST['mother-origin-municipality']);
  $mother_origin_barangay = ucfirst($_POST['father-origin-barangay']);
  $father_origin_municipality = ucfirst($_POST['mother-origin-municipality']);
  $father_origin_barangay = ucfirst($_POST['father-origin-barangay']);
  $parents_residence_municipality = ucfirst($_POST['Parents-residence-municipality']);
  $parents_residence_barangay = ucfirst($_POST['Parents-residence-barangay']);
  $godfather_name = ucfirst($_POST['Godfather-name']);
  $godfather_familyname = ucfirst($_POST['Godfather-familyname']);
  $godfather_residence_municipality = ucfirst($_POST['Godfather-residence-municipality']);
  $godfather_residence_barangay = ucfirst($_POST['Godfather-residence-barangay']);
  $godmother_name = ucfirst($_POST['Godmother-name']);
  $godmother_familyname = ucfirst($_POST['Godmother-familyname']);
  $godmother_residence_municipality = ucfirst($_POST['Godmother-residence-municipality']);
  $godmother_residence_barangay = ucfirst($_POST['Godmother-residence-barangay']);
  $minister = ucfirst($_POST['minister']);
  $priest = ucfirst($_POST['priest']);
  $Book_number = $_POST['Book-number'];
  $Book_page = $_POST['Book-page'];
  $Book_line = $_POST['Book-line'];
  $remarks = ucfirst($_POST['Remarks']);
  $legitimity = ucfirst($_POST['legitimity']);

  $sql = "update `baptismal` set Child_name='$Child_name', Child_familyname='$Child_familyname', month='$month', day='$day', year='$year', baptism_month='$baptism_month', baptism_day='$baptism_day', baptism_year='$baptism_year', parents_residence_municipality='$municipality', parents_residence_barangay='$barangay', Godfather_name='$godfather_name', Godfather_familyname='$godfather_familyname', godfather_residence_municipality= '$godfather_residence_municipality', godfather_residence_barangay= '$godfather_residence_barangay', Godmother_name='$godmother_name', Godmother_familyname='$godmother_familyname',godmother_residence_municipality='$godmother_residence_municipality', godmother_residence_barangay='$godmother_residence_barangay', Mother_name='$mother_name', Mother_familyname='$mother_familyname', mother_origin_municipality='$mother_origin_municipality', mother_origin_barangay='$mother_origin_barangay', Father_name='$father_name', Father_familyname='$father_familyname', father_origin_municipality='$father_origin_municipality', father_origin_barangay='$father_origin_barangay', parents_residence_municipality='$parents_residence_municipality', parents_residence_barangay='$parents_residence_barangay', remarks='$remarks', minister='$minister', priest='$priest', Book_number='$Book_number', Book_page='$Book_page', Book_line='$Book_line', legitimity='$legitimity' where id=$id";
  $result = mysqli_query($con, $sql);
  if ($result) {
    header('location:baptismal.php');
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
  <form method="post" class="d-flex flex-column align-items-center" enctype="multipart/form-data" style="min-width: 879px; padding:0 7%;">
    <div class="form d-flex flex-column" style="width:100%; margin:50px 0">
      <div class="d-flex align-items-center align-self-start" id="back" style="letter-spacing: 3px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
          <path d="M10 12.796V3.204L4.519 8zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753" />
        </svg>
        <p style="margin-bottom: 0;">BACK</p>
      </div>
      <h1 class="align-self-center">BAPTISMAL RECORD</h1>
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
            <p>Date of Birth <span style="color: red; font-weight:normal">*</span></p>
            <input type="date" class="form-control" name="Birth" autocomplete="off" required value="<?php echo $birth_date ?>">
          </div>
          <div class="mb-3" style="flex: 1;">
            <p>Date of Baptism <span style="color: red; font-weight:normal">*</span></p>
            <input type="date" class="form-control" name="Baptismal" autocomplete="off" required value="<?php echo $baptism_date ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Legitimity <span style="font-weight: normal; color:red;">*</span></p>
          <select style="border: 1px solid #000; border-radius:0;" class="form-select" name="legitimity" required>
            <option <?php echo ($legitimity == 'Legitimate') ? 'selected' : ''; ?>>Legitimate</option>
            <option <?php echo ($legitimity == 'Illegitimate') ? 'selected' : ''; ?>>Illegitimate</option>
          </select>
        </div>
        <p>Godfather</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather-name" autocomplete="off" required value="<?php echo $Godfather_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godfather-familyname" autocomplete="off" required value="<?php echo $Godfather_familyname ?>">
          </div>
        </div>
        <p>Godfather Residence</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="Godfather-residence-municipality" autocomplete="off" required value="<?php echo $godfather_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="Godfather-residence-barangay" autocomplete="off" required value="<?php echo $godfather_barangay ?>">
          </div>
        </div>
        <p>Godmother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother-name" autocomplete="off" required value="<?php echo $Godmother_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Godmother-familyname" autocomplete="off" required value="<?php echo $Godmother_familyname ?>">
          </div>
        </div>
        <p>Godmother Residence</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="Godmother-residence-municipality" autocomplete="off" required value="<?php echo $godmother_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="Godmother-residence-barangay" autocomplete="off" required value="<?php echo $godmother_barangay ?>">
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
            <input type="text" class="form-control" name="Father-name" autocomplete="off" required value="<?php echo $Father_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Father-familyname" autocomplete="off" required value="<?php echo $Father_familyname ?>">
          </div>
        </div>
        <p>Place of Origin</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="father-origin-municipality" autocomplete="off" required value="<?php echo $Father_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="father-origin-barangay" autocomplete="off" required value="<?php echo $Father_barangay ?>">
          </div>
        </div>
        <p>Mother</p>
        <div>
          <div class="mb-3">
            <label>Name <span>*</span></label>
            <input type="text" class="form-control" name="Mother-name" autocomplete="off" required value="<?php echo $Mother_name ?>">
          </div>
          <div class="mb-3">
            <label>Family Name <span>*</span></label>
            <input type="text" class="form-control" name="Mother-familyname" autocomplete="off" required value="<?php echo $Mother_familyname ?>">
          </div>
        </div>
        <p>Place of Origin</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="mother-origin-municipality" autocomplete="off" required value="<?php echo $Mother_municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="mother-origin-barangay" autocomplete="off" required value="<?php echo $Mother_barangay ?>">
          </div>
        </div>
        <p>Residence</p>
        <div>
          <div class="mb-3">
            <label>Municipality <span>*</span></label>
            <input type="text" class="form-control" name="Parents-residence-municipality" autocomplete="off" required value="<?php echo $municipality ?>">
          </div>
          <div class="mb-3">
            <label>Barangay <span>*</span></label>
            <input type="text" class="form-control" name="Parents-residence-barangay" autocomplete="off" required value="<?php echo $barangay ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Remarks <span style="color: red; font-weight:normal">*</span></p>
          <input type="text" class="form-control" name="Remarks" autocomplete="off" required value="<?php echo $remarks ?>">
        </div>
        <div class="mb-3">
          <p>Officiating Minister <span style="color: red; font-weight:normal">*</span></p>
          <div class="d-flex align-items-end gap-3">
            <strong style="font-size: 17px;">Rev.</strong>
            <input type="text" class="form-control" name="minister" autocomplete="off" required value="<?php echo $minister ?>">
          </div>
        </div>
        <div class="mb-3">
          <p>Priest of the Week</p>
          <input type="text" class="form-control" name="priest" autocomplete="off" required value="<?php echo $priest ?>">
        </div>
      </div>
    </div>
    <button id="submitt" type="submit" name="submit" class="btn btn-primary my-5" style="width: 50%; height:50px">UPDATE</button>
  </form>
  <script>
    document.getElementById("back").addEventListener('click', function() {
      window.location.href = "baptismal.php"
    });
    window.addEventListener('DOMContentLoaded', function() {
      document.getElementById('live_birth').value = "<?php echo $folder; ?>";
    });
  </script>
</body>

</html>