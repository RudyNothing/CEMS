<?php
include "includes/db.php";
session_start();

if(!isset($_SESSION['admin_id'])){
    header("Location: admin_login.php");
    exit();
}

$event_id = $_GET['event_id'];

$stmt = $conn->prepare("DELETE FROM events where event_id=?");
$stmt->bind_param("i", $event_id);

$stmt->execute();

header("Location: manage_events.php");
?>