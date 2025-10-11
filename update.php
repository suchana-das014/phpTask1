<?php
header('Content-Type: application/json');
include 'config.php';

// Validate inputs
if (!isset($_POST['id'])) {
    echo json_encode(["status" => "error", "message" => "Missing ID"]);
    exit;
}

$id = intval($_POST['id']);
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$email = $_POST['email'] ?? '';
$phone = $_POST['phone'] ?? '';

$sql = "UPDATE users SET fname=?, lname=?, email=?, phone=? WHERE id=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssi", $fname, $lname, $email, $phone, $id);

if ($stmt->execute()) {
    echo json_encode(["status" => "success", "message" => "User updated successfully"]);
} else {
    echo json_encode(["status" => "error", "message" => "Error updating user"]);
}

$stmt->close();
$conn->close();
?>
