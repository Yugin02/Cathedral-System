<?php

$con = new mysqli('localhost', 'root', '', 'archive');

if (!$con) {
  die(mysqli_error($con));
}
