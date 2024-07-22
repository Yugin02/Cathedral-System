<?php
include '../../database.php';

$book_number = $_GET['bookNumber'];
$book_page = $_GET['bookPage'];

$sql = "CREATE TABLE IF NOT EXISTS baptismal_evidence (
  id INT (100) UNSIGNED
  AUTO_INCREMENT,
  book_number BIGINT(100),
  book_page BIGINT(100),
  image1 VARCHAR(100),
  PRIMARY KEY (id) );";
$con->query($sql);

$sql = "SELECT * FROM baptismal_evidence WHERE book_number = '$book_number' && book_page = '$book_page'";
$result = mysqli_query($con, $sql);
if ($result && mysqli_num_rows($result) == 0) {
  $sql = "INSERT INTO baptismal_evidence (book_number, book_page) VALUES (?, ?)";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("ss", $book_number, $book_page);
  if (!$stmt->execute()) {
    echo '<script>alert("Error in locating image!");</script>';
    exit();
  }
  $stmt->close();
}

$sql = "SELECT * FROM baptismal_evidence WHERE book_number = '$book_number' AND book_page = '$book_page'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$image1 = $row['image1'];

$noImage = false;

if (!$image1) {
  $noImage = true;
}

function getRelativePath($fullPath, $baseDir)
{
  return str_replace($baseDir, '', $fullPath);
}
$upload_dir = '../../images/Evidence/baptismal/';



if (isset($_FILES['baptismal-evidence'])) {
  $book_number = $_POST['book-number'];
  $book_page = $_POST['book-page'];

  // Handle file upload
  $uploaded_files = [];
  $files = $_FILES['baptismal-evidence'];
  $increment = 1; // Start incrementing from 1 for each new upload session
  foreach ($files['tmp_name'] as $key => $tmp_name) {
    $file_name = $files['name'][$key];
    $file_tmp = $files['tmp_name'][$key];
    $file_size = $files['size'][$key];
    $file_error = $files['error'][$key];
    $image_ext = explode('.', $file_name);
    $imageAct_ext = strtolower(end($image_ext));

    if ($file_error === UPLOAD_ERR_OK) {
      $upload_dir = '../../images/Evidence/baptismal/';
      $new_file_name = "Book_Number(" . $book_number . ")_Page(" . $book_page . ")_" . $increment . "." . $imageAct_ext;
      $destination = $upload_dir . $new_file_name;

      $increment++;

      if (move_uploaded_file($file_tmp, $destination)) {
        $uploaded_files[] = $new_file_name;
        echo "<script>alert('File uploaded successfully: " . htmlspecialchars($new_file_name, ENT_QUOTES) . "');
        history.go(-1);
        </script>";
      } else {
        echo "<script>alert('Failed to upload file: " . htmlspecialchars($new_file_name, ENT_QUOTES) . "');</script>";
      }
    } else {
      echo "<script>alert('Error uploading file: " . htmlspecialchars($file_name, ENT_QUOTES) . "');</script>";
    }
  }
  $serialized_array = serialize($uploaded_files);


  $sql = "UPDATE baptismal_evidence SET image1 = ? WHERE book_number = ? AND book_page = ?";
  $stmt = $con->prepare($sql);
  $stmt->bind_param("sss", $serialized_array, $book_number, $book_page);
  if (!$stmt->execute()) {
    echo '<script>alert("Error updating image!");</script>';
    exit();
  }
  $stmt->close();
}


$current_index = isset($_GET['index']) ? (int)$_GET['index'] : 0;

// Query to get image data
$sql = "SELECT image1 FROM baptismal_evidence WHERE book_number = ? AND book_page = ?";
$stmt = $con->prepare($sql);
$stmt->bind_param("ss", $book_number, $book_page);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if ($row && !empty($row['image1'])) {
  $serialized_array = $row['image1'];
  $uploaded_files = unserialize($serialized_array);
} else {
  $uploaded_files = [];
}

$stmt->close();

$total_files = count($uploaded_files);
if ($total_files > 0) {
  $current_index = max(0, min($current_index, $total_files - 1));
  $current_file = $uploaded_files[$current_index];
  $file_path = $upload_dir . $current_file;
} else {
  $current_file = '';
  $file_path = '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_FILES['new_image']) && $current_file) {
    $new_image = $_FILES['new_image'];
    $file_tmp = $new_image['tmp_name'];
    $file_name = $new_image['name'];
    $file_error = $new_image['error'];
    $image_ext = explode('.', $file_name);
    $imageAct_ext = strtolower(end($image_ext));

    if ($file_error === UPLOAD_ERR_OK) {
      // Generate new file name and path
      $new_file_name = "Book_Number(" . $book_number . ")_Page(" . $book_page . ")_" . ($current_index + 1) . "." . $imageAct_ext;
      $new_file_path = $upload_dir . $new_file_name;
      // Delete old file
      if (file_exists($file_path)) {
        unlink($file_path);
      }

      // Move the uploaded file to the destination
      if (move_uploaded_file($file_tmp, $new_file_path)) {
        // Update the database
        $uploaded_files[$current_index] = $new_file_name;
        $serialized_array = serialize($uploaded_files);

        $sql = "UPDATE baptismal_evidence SET image1 = ? WHERE book_number = ? AND book_page = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sss", $serialized_array, $book_number, $book_page);
        if ($stmt->execute()) {
          echo '<script>alert("Image updated successfully!");</script>';
          header("Location: ?bookNumber=" . urlencode($book_number) . "&bookPage=" . urlencode($book_page) . "&index=" . $current_index);
          exit();
        } else {
          echo '<script>alert("Error updating image in database!");</script>';
        }
        $stmt->close();
      } else {
        echo '<script>alert("Error moving uploaded file!");</script>';
      }
    } else {
      echo '<script>alert("Error uploading file!");</script>';
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
  <link rel="stylesheet" href="../css/baptismal.css">
  <link rel="stylesheet" href="../css/evidence.css">
</head>

<body id="evidenceBody">

  <header class="evidenceHeading">
    <h1 class="align-self-center">BAPTISMAL EVIDENCE <br> Book <span><?php echo $book_number; ?></span> Page <span><?php echo $book_page; ?></span> </h1>
  </header>
  <section class="evidenceImagePage">
    <?php
    if ($noImage) { ?>
      <div class="drop_box">
        <header>
          <h4>No Uploaded Image, Select File here</h4>
        </header>
        <p>Files Supported: IMG, JPG, JPEG</p>
        <form method="post" class="d-flex justify-content-center align-items-center fileContainer" enctype="multipart/form-data">
          <input type="hidden" name="book-number" value="<?php echo $book_number; ?>">
          <input type="hidden" name="book-page" value="<?php echo $book_page; ?>">
          <input name="baptismal-evidence[]" type="file" id="fileID" class="form-control" style="position:absolute; width:126px; padding:10px 0; opacity:0" multiple>
          <button class="btn1">Choose File</button>
        </form>
      </div>
      <?php } else {

      if ($file_path && file_exists($file_path)) : ?>
        <div class="imageAdi">
          <div class="prevNext">
            <a style="align-self: start !important;" href="?bookNumber=<?php echo urlencode($book_number); ?>&bookPage=<?php echo urlencode($book_page); ?>&index=<?php echo $current_index - 1; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left-circle">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 8 8 12 12 16"></polyline>
                <line x1="16" y1="12" x2="8" y2="12"></line>
              </svg></a>

            <a style="align-self: end !important;" href="?bookNumber=<?php echo urlencode($book_number); ?>&bookPage=<?php echo urlencode($book_page); ?>&index=<?php echo $current_index + 1; ?>"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right-circle">
                <circle cx="12" cy="12" r="10"></circle>
                <polyline points="12 16 16 12 12 8"></polyline>
                <line x1="8" y1="12" x2="16" y2="12"></line>
              </svg></a>
          </div>
          <form method="post" enctype="multipart/form-data" class="updateImage">
            <input type="file" name="new_image" id="new_image" class="form-control">
            <button class="btn1">Update File</button>
          </form>

          <img src="<?php echo htmlspecialchars($file_path, ENT_QUOTES); ?>" alt="<?php echo htmlspecialchars($current_file, ENT_QUOTES); ?>" style="width: 100%;">
        </div>
    <?php endif;
    }
    ?>
  </section>
  <script>
    <?php
    if ($noImage) { ?>
      document.getElementById('fileID').addEventListener('change', function() {
        this.form.submit();
      });
    <?php } ?>
    document.getElementById('new_image').addEventListener('change', function() {
      this.form.submit();
    });
  </script>
</body>

</html>