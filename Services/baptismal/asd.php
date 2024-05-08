<?php

include '../connect.php';

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <?php

  // Fetch the image data from the database
  $result = $con->query("SELECT live_birth_name, live_birth_images FROM baptismal WHERE id = '32'");
  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $imageData = $row['live_birth_images'];
    $imageName = $row['live_birth_name'];

    // Output the image
    echo '<img src="data:image/jpeg;base64,' . base64_encode($imageData) . '" alt="' . $imageName . '">';
  } else {
    echo "No image found.";
  }

  ?>
</body>

</html>