<?php

$conn = mysqli_connect("localhost", "root", "", "notes");

if (!$conn) {
    die("Failed to connect " . mysqli_connect_error());
}

$id = $_GET['id'];
$sql = "DELETE FROM `notes` WHERE sno = '$id'";
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "Note Deleted";
    header("Location: index.php");
} else {
    echo "Note is not deleted";
}

?>