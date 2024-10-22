<?php
include('conn.php');

// Check if the form is submitted to update data
if (isset($_POST['update'])) {
    $nm  = $_POST['nm'];
    $rn  = $_POST['rn']; // Roll number passed as hidden field
    $rcc = $_POST['rcc'];
    $rcn = $_POST['rcn'];
    $rph = $_POST['rph'];
    $re  = $_POST['re'];
    $rs  = $_POST['rs'];
    $rg  = $_POST['rg'];
    $rl  = isset($_POST['rl']) ? implode(",", $_POST['rl']) : ''; // Concatenate checkbox values
    $ra  = $_POST['ra'];

    // Update the record in the database
    $stmt = $con->prepare('UPDATE con2 SET name = ?, course_category = ?, course_name = ?, phone = ?, email = ?, state = ?, gender = ?, languages = ?, address = ? WHERE roll = ?');
    $stmt->bind_param('ssissssssi', $nm, $rcc, $rcn, $rph, $re, $rs, $rg, $rl, $ra, $rn);

    if ($stmt->execute()) {
        echo "<script>alert('Record updated successfully');</script>";
        echo "<script>window.location.href = 'update.php?roll=$rn';</script>";
    } else {
        echo "Failed to update record!";
    }
    $stmt->close();
}

// Fetch the current data if roll is passed via GET
if (isset($_GET['roll'])) {
    $roll = $_GET['roll'];

    $stmt = $con->prepare('SELECT * FROM con2 WHERE roll = ?');
    $stmt->bind_param('i', $roll);
    $stmt->execute();
    $result = $stmt->get_result();
    $res = $result->fetch_assoc();

    $nm  = $res['name'];
    $rcc = $res['course_category'];
    $rcn = $res['course_name'];
    $rph = $res['phone'];
    $re  = $res['email'];
    $rs  = $res['state'];
    $rg  = $res['gender'];
    $rl  = explode(",", $res['languages']); // Convert comma-separated languages back to array
    $ra  = $res['address'];

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Record</title>
</head>

<body>
    <form method="POST" action="update.php?roll=<?php echo $roll; ?>">
        <!-- Hidden field to pass roll number -->
        <input type="hidden" name="rn" value="<?php echo $roll; ?>">

        <label>Name:</label>
        <input type="text" name="nm" value="<?php echo $nm; ?>" required><br>

        <label>Course Category:</label>
        <select id="ccat" name="rcc" onchange="showCourse(this.value)" required>
            <option value="UG" <?php if ($rcc === "UG") echo "selected"; ?>>UG</option>
            <option value="PG" <?php if ($rcc === "PG") echo "selected"; ?>>PG</option>
        </select><br>

        <label>Course Name:</label>
        <select id="cname" name="rcn" required>
            <option value="BCA" <?php if ($rcn === "BCA") echo "selected"; ?>>BCA</option>
            <option value="BBA" <?php if ($rcn === "BBA") echo "selected"; ?>>BBA</option>
            <option value="Computer Science" <?php if ($rcn === "Computer Science") echo "selected"; ?>>Computer Science</option>
        </select><br>

        <label>Phone:</label>
        <input type="text" name="rph" value="<?php echo $rph; ?>" required><br>

        <label>Email:</label>
        <input type="email" name="re" value="<?php echo $re; ?>" required><br>

        <label>State:</label>
        <select name="rs" required>
            <option value="Andhra Pradesh" <?php if ($rs === "Andhra Pradesh") echo "selected"; ?>>Andhra Pradesh</option>
            <!-- Add other states here -->
        </select><br>

        <label>Gender:</label>
        <input type="radio" name="rg" value="Male" <?php if ($rg === "Male") echo "checked"; ?>> Male
        <input type="radio" name="rg" value="Female" <?php if ($rg === "Female") echo "checked"; ?>> Female
        <input type="radio" name="rg" value="Custom" <?php if ($rg === "Custom") echo "checked"; ?>> Custom<br>

        <label>Languages:</label>
        <input type="checkbox" name="rl[]" value="English" <?php if (in_array("English", $rl)) echo "checked"; ?>> English
        <input type="checkbox" name="rl[]" value="Hindi" <?php if (in_array("Hindi", $rl)) echo "checked"; ?>> Hindi
        <input type="checkbox" name="rl[]" value="Bengali" <?php if (in_array("Bengali", $rl)) echo "checked"; ?>> Bengali<br>

        <label>Address:</label>
        <textarea name="ra" required><?php echo $ra; ?></textarea><br>

        <button type="submit" name="update">Update</button>
    </form>

    <script>
        function showCourse(ccat) {
            var cname = document.getElementById("cname");
            cname.options.length = 0;
            var opt0 = cname.options[0] = new Option("--SELECT--", "");
            opt0.setAttribute("selected", "true");
            opt0.setAttribute("disabled", "true");

            if (ccat === "UG") {
                cname.options[1] = new Option("BCA");
                cname.options[2] = new Option("BBA");
                // Add more UG options here
            } else if (ccat === "PG") {
                cname.options[1] = new Option("Computer Science");
                // Add more PG options here
            }
        }
    </script>
</body>

</html>
