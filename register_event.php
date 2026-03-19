<?php
include "includes/db.php";
session_start();

if(!isset($_SESSION['student_id'])){
    header("Location: student_login.php");
    exit();
}

$student_id = $_SESSION['student_id'];
$event_id = $_GET['event_id'];

$stmt = $conn->prepare("INSERT INTO registrations (event_id, student_id) VALUES (?, ?)");

$stmt->bind_param("ii", $event_id, $student_id);

if($stmt->execute()){
    echo "<span style='color:#ff7a18; font-weight:600;'>Event Registered Successfully!</span>";
}
else{
    echo "<span style='color:#ff7a18; font-weight:600;'>You are already registered for this event</span>";
}
?>