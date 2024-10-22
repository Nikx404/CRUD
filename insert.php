<?php
include('conn.php');
    $name = $_POST['name'];
    $roll = $_POST['roll'];
    $courseCat = $_POST['ccat'];
    $courseName = $_POST['cname'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $state = $_POST['state'];
    $gender = $_POST['gender'];
    $language = $_POST['lang'];
    $addre = $_POST['address'];

    $language = implode(",", $language);

    $stmt = $con->prepare('INSERT INTO `con2` (`name`, `roll`, `course_category`, `course_name`, `phone`, `email`, `state`, `gender`, `languages`, `address`) VALUES (?,?,?,?,?,?,?,?,?,?)');
    $stmt->bind_param('sississsss', $name, $roll, $courseCat, $courseName, $phone, $email, $state, $gender, $language, $addre);

    if ($stmt->execute()) {
        echo"<script>alert('Data inserted succesfully')</script>";
        echo"header('Location: insert.html')";
    } else {
        echo "Failed to insert data!";
    }

    // Close the statement and connection
    $stmt->close();
    $con->close();

?>