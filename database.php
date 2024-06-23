<?php
$serverName = "localhost";
$username = "root";
$password = "";

// Create connection
$con = new mysqli($serverName, $username, $password);

// Check connection
if ($con->connect_error) {
  die("Connection failed: " . $con->connect_error);
}

$dbname = "archive";
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($con->query($sql) === FALSE) {
  echo "Error creating database: " . $con->error;
}

// Select the database
$con->select_db($dbname);

$sql = "CREATE TABLE IF NOT EXISTS baptismal (
  id INT (100) UNSIGNED
  AUTO_INCREMENT,
  id_number INT(10),
  Child_name VARCHAR(100),
  Child_familyname VARCHAR(100),
  month VARCHAR(100),
  day VARCHAR(100),
  year VARCHAR(100),
  baptism_month VARCHAR(100),
  baptism_day VARCHAR(100),
  baptism_year VARCHAR(100),
  legitimity VARCHAR(100),
  Father_name VARCHAR(100),
  Father_familyname VARCHAR(100),
  Mother_name VARCHAR(100),
  Mother_familyname VARCHAR(100),
  mother_origin_municipality VARCHAR(100),
  mother_origin_barangay VARCHAR(100),
  father_origin_municipality VARCHAR(100),
  father_origin_barangay VARCHAR(100),
  parents_residence_municipality VARCHAR(100),
  parents_residence_barangay VARCHAR(100),
  Godfather_name VARCHAR(100),
  Godfather_familyname VARCHAR(100),
  godfather_residence_municipality VARCHAR(100),
  godfather_residence_barangay VARCHAR(100),
  Godmother_name VARCHAR(100),
  Godmother_familyname VARCHAR(100),
  godmother_residence_municipality VARCHAR(100),
  godmother_residence_barangay VARCHAR(100),
  minister VARCHAR(100),
  Book_number int(100),
  Book_page int(100),
  Book_line int(100),
  priest VARCHAR(100),
  remarks VARCHAR(100),
  live_birth_image VARCHAR(250),
  PRIMARY KEY (id) );";
$con->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS confirmation (
  id INT (100) UNSIGNED
  AUTO_INCREMENT,
  id_number INT(10),
  Child_name VARCHAR(100),
  Child_familyname VARCHAR(100),
  confirmed_month VARCHAR(100),
  confirmed_day VARCHAR(100),
  confirmed_year VARCHAR(100),
  baptism_month VARCHAR(100),
  baptism_day VARCHAR(100),
  baptism_year VARCHAR(100),
  baptism_municipality VARCHAR(100),
  baptism_barangay VARCHAR(100),
  Father_name VARCHAR(100),
  Father_familyname VARCHAR(100),
  Mother_name VARCHAR(100),
  Mother_familyname VARCHAR(100),
  Godfather_name VARCHAR(100),
  Godfather_familyname VARCHAR(100),
  Godmother_name VARCHAR(100),
  Godmother_familyname VARCHAR(100),
  minister VARCHAR(100),
  Book_number int(100),
  Book_page int(100),
  Book_line int(100),
  priest VARCHAR(100),
  remarks VARCHAR(100),
  child_baptismal_image VARCHAR(250),
  PRIMARY KEY (id) );";
$con->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS confirmation (
  id INT (100) UNSIGNED
  AUTO_INCREMENT,
  id_number INT(10),
  Child_name VARCHAR(100),
  Child_familyname VARCHAR(100),
  confirmed_month VARCHAR(100),
  confirmed_day VARCHAR(100),
  confirmed_year VARCHAR(100),
  baptism_month VARCHAR(100),
  baptism_day VARCHAR(100),
  baptism_year VARCHAR(100),
  baptism_municipality VARCHAR(100),
  baptism_barangay VARCHAR(100),
  Father_name VARCHAR(100),
  Father_familyname VARCHAR(100),
  Mother_name VARCHAR(100),
  Mother_familyname VARCHAR(100),
  Godfather_name VARCHAR(100),
  Godfather_familyname VARCHAR(100),
  Godmother_name VARCHAR(100),
  Godmother_familyname VARCHAR(100),
  minister VARCHAR(100),
  Book_number int(100),
  Book_page int(100),
  Book_line int(100),
  priest VARCHAR(100),
  remarks VARCHAR(100),
  child_baptismal_image VARCHAR(250),
  PRIMARY KEY (id) );";
$con->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS death_and_burial (
  id INT (100) UNSIGNED
  AUTO_INCREMENT,
  id_number INT(10),
  deceased_name VARCHAR(100),
  deceased_familyname VARCHAR(100),
  deceased_municipality VARCHAR(100),
  deceased_barangay VARCHAR(100),
  death_month VARCHAR(100),
  death_day VARCHAR(100),
  death_year VARCHAR(100),
  age VARCHAR(100),
  relative_name VARCHAR(100),
  relative_familyname VARCHAR(100),
  burial_municipality VARCHAR(100),
  burial_barangay VARCHAR(100),
  burial_month VARCHAR(100),
  burial_day VARCHAR(100),
  burial_year VARCHAR(100),
  sacraments VARCHAR(100),
  minister VARCHAR(100),
  Book_number int(100),
  Book_page int(100),
  Book_line int(100),
  priest VARCHAR(100),
  death_cert_images VARCHAR(250),
  PRIMARY KEY (id) );";
$con->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS marriage (
  id INT (100) UNSIGNED
  AUTO_INCREMENT,
  id_number INT(10),
  wife_name VARCHAR(100),
  wife_familyname VARCHAR(100),
  wife_legal_status VARCHAR(100),
  wife_municipality VARCHAR(100),
  wife_barangay VARCHAR(100),
  wife_month VARCHAR(100),
  wife_day VARCHAR(100),
  wife_year VARCHAR(100),
  wife_birth_municipality VARCHAR(100),
  wife_birth_barangay VARCHAR(100),
  wife_baptism_month VARCHAR(100),
  wife_baptism_day VARCHAR(100),
  wife_baptism_year VARCHAR(100),
  wife_baptism_municipality VARCHAR(100),
  wife_baptism_barangay VARCHAR(100),

  husband_legal_status VARCHAR(100),
  husband_name VARCHAR(100),
  husband_familyname VARCHAR(100),
  husband_municipality VARCHAR(100),
  husband_barangay VARCHAR(100),
  husband_month VARCHAR(100),
  husband_day VARCHAR(100),
  husband_year VARCHAR(100),
  husband_birth_municipality VARCHAR(100),
  husband_birth_barangay VARCHAR(100),
  husband_baptism_month VARCHAR(100),
  husband_baptism_day VARCHAR(100),
  husband_baptism_year VARCHAR(100),
  husband_baptism_municipality VARCHAR(100),
  husband_baptism_barangay VARCHAR(100),
  marriage_month VARCHAR(100),
  marriage_day VARCHAR(100),
  marriage_year VARCHAR(100),
  husband_age VARCHAR(100),
  wife_age VARCHAR(100),
  wife_Father_name VARCHAR(100),
  wife_Father_familyname VARCHAR(100),
  wife_Mother_name VARCHAR(100),
  wife_Mother_familyname VARCHAR(100),
  husband_Father_name VARCHAR(100),
  husband_Father_familyname VARCHAR(100),
  husband_Mother_name VARCHAR(100),
  husband_Mother_familyname VARCHAR(100),
  Godfather1_name VARCHAR(100),
  Godfather1_familyname VARCHAR(100),
  Godmother1_name VARCHAR(100),
  Godmother1_familyname VARCHAR(100),
  Godfather2_name VARCHAR(100),
  Godfather2_familyname VARCHAR(100),
  Godmother2_name VARCHAR(100),
  Godmother2_familyname VARCHAR(100),
  minister VARCHAR(100),
  license_number VARCHAR(100),
  Book_number int(100),
  Book_page int(100),
  Book_line int(100),
  priest VARCHAR(100),
  remarks VARCHAR(100),
  wife_baptismal_image VARCHAR(250),
  wife_confirmation_image VARCHAR(250),
  husband_baptismal_image VARCHAR(250),
  husband_confirmation_image VARCHAR(250),
  marriage_cert_images VARCHAR(250),
  PRIMARY KEY (id) );";
$con->query($sql);
