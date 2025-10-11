<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $fname = $_POST['fname'];
  $lname = $_POST['lname'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $dob = $_POST['dob'];
  $phone = $_POST['phone'];
  $gender = $_POST['gender'];
  $subscription = $_POST['subscription'];

  $hashed_password = password_hash($password, PASSWORD_DEFAULT);

  $sql = "INSERT INTO users (fname, lname, email, password, dob, phone, gender, subscription)
          VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

  $stmt = $conn->prepare($sql);
  $stmt->bind_param("ssssssss", $fname, $lname, $email, $hashed_password, $dob, $phone, $gender, $subscription);

  if ($stmt->execute()) {
      header("Location: index.php");
      exit();
  } else {
      echo "<h3>Error: " . $stmt->error . "</h3>";
  }

  $stmt->close();
  $conn->close();
}
?>
