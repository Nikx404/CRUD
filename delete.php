<?php
include('conn.php');
$roll = $_POST['roll'];
$stmt = $con->prepare('DELETE FROM con2
WHERE roll = ?');

$stmt->bind_param('i',$roll);

if ($stmt->execute()) {
    echo"<script>alert('Data deleted successfully')</script>";
    echo"header('Location: Dispplay.php')";
} else {
    echo "Failed to delete data!";
}

// Close the statement and connection
$stmt->close();
$con->close();

?>