<?php
include('conn.php');

// Fetch data from POST method
$nm  = isset($_POST['name']) ? $_POST['name'] : '';
$rn  = isset($_POST['roll']) ? $_POST['roll'] : '';
$rcc = isset($_POST['rcc']) ? $_POST['rcc'] : '';
$rcn = isset($_POST['rcn']) ? $_POST['rcn'] : '';
$rph = isset($_POST['phone']) ? $_POST['phone'] : '';
$re  = isset($_POST['email']) ? $_POST['email'] : '';
$rs  = isset($_POST['state']) ? $_POST['state'] : '';
$rg  = isset($_POST['rg']) ? $_POST['rg'] : '';

$rl  = isset($_POST['rl']) ? $_POST['rl'] : [];
$ra  = isset($_POST['address']) ? $_POST['address'] : '';

// Check if $rl is an array before using implode
$rl = is_array($rl) ? implode(',', $rl) : '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $query = "UPDATE con2 SET name=?, course_category=?, course_name=?, phone=?, email=?, state=?, gender=?, languages=?, address=? WHERE roll=?";

    if ($stmt = $con->prepare($query)) {
        // Bind parameters with correct order and types
        $stmt->bind_param("sssisssssi", $nm, $rcc, $rcn, $rph, $re, $rs, $rg, $rl, $ra, $rn);

        if ($stmt->execute()) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $con->error;
    }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
</head>

<body>
    <div class="container">
        <form action="update.php" method="post">
            <table>
                <tr>
                    <td>Name: </td>
                    <td><input type="text" value="<?php echo htmlspecialchars($nm); ?>" name="name" id="name" required></td>
                </tr>
                <tr>
                    <td>Roll</td>
                    <td><input type="number" value="<?php echo htmlspecialchars($rn); ?>" name="roll" id="roll" required></td>
                </tr>
                <tr>
                    <td>Course Category:</td>
                    <td>
                        <select id="ccat" name="rcc" onchange="showCourse(this.value)" required>
                            <option value selected
                                disabled <?php if ($rcc == '') echo 'selected' ?>>-SELECT-</option>
                            <option value="UG" <?php if ($rcc = 'UG') echo 'selected' ?>>UG</option>
                            <option value="PG" <?php if ($rcc = 'PG') echo 'selected' ?>>PG</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Course:</td>
                    <td>
                        <select id="cname" name="rcn" required>
                            <option value="" disabled <?php if ($rcn == '') echo 'selected'; ?>>--SELECT--</option>
                            <?php if ($rcc == 'UG'): ?>
                                <option value="BCA" <?php if ($rcn == 'BCA') echo 'selected'; ?>>BCA</option>
                                <option value="BBA" <?php if ($rcn == 'BBA') echo 'selected'; ?>>BBA</option>
                                <!-- Add more UG courses -->
                            <?php elseif ($rcc == 'PG'): ?>
                                <option value="Computer Science" <?php if ($rcn == 'Computer Science') echo 'selected'; ?>>Computer Science</option>
                                <option value="Digital marketing" <?php if ($rcn == 'Digital marketing') echo 'selected'; ?>>Digital marketing</option>
                                <!-- Add more PG courses -->
                            <?php endif; ?>
                        </select>
                    </td>

                <tr>
                    <td>Phone:</td>
                    <td><input type="number" name="phone" id="phone" value="<?php echo htmlspecialchars($rph); ?>" required></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><input type="email" value="<?php echo htmlspecialchars($re); ?>" name="email" id="email" required></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td>
                        <select name="state" id="state" required>
                            <option value selected
                                disabled>-SELECT-</option>

                            <option value="Andhra Pradesh" <?php if ($rs == '') echo 'selected'; ?>>Andhra Pradesh</option>
                            <option value="Arunachal Pradesh" <?php if ($rs == 'Arunachal') echo 'selected'; ?>>Arunachal Pradesh</option>
                            <option value="Assam" <?php if ($rs == 'Assam') echo 'selected'; ?>>Assam</option>
                            <option value="Bihar" <?php if ($rs == 'Bihar') echo 'selected'; ?>>Bihar</option>
                            <option value="Chhattisgarh" <?php if ($rs == 'Chhattisgarh') echo 'selected'; ?>>Chhattisgarh</option>
                            <option value="Goa" <?php if ($rs == 'Goa') echo 'selected'; ?>>Goa</option>
                            <option value="Gujarat" <?php if ($rs == 'Gujarat') echo 'selected'; ?>>Gujarat</option>
                            <option value="Haryana" <?php if ($rs == 'Haryana') echo 'selected'; ?>>Haryana</option>
                            <option value="Himachal Pradesh" <?php if ($rs == 'Himachal') echo 'selected'; ?>>Himachal Pradesh</option>
                            <option value="Jharkhand" <?php if ($rs == 'Jharkhand') echo 'selected'; ?>>Jharkhand</option>
                            <option value="Karnataka" <?php if ($rs == 'Karnataka') echo 'selected'; ?>>Karnataka</option>
                            <option value="Kerala" <?php if ($rs == 'Kerala') echo 'selected'; ?>>Kerala</option>
                            <option value="Madhya Pradesh" <?php if ($rs == 'Madhya') echo 'selected'; ?>>Madhya Pradesh</option>
                            <option value="Maharashtra" <?php if ($rs == 'Maharashtra') echo 'selected'; ?>>Maharashtra</option>
                            <option value="Manipur" <?php if ($rs == 'Manipur') echo 'selected'; ?>>Manipur</option>
                            <option value="Meghalaya" <?php if ($rs == 'Meghalaya') echo 'selected'; ?>>Meghalaya</option>
                            <option value="Mizoram" <?php if ($rs == 'Mizoram') echo 'selected'; ?>>Mizoram</option>
                            <option value="Nagaland" <?php if ($rs == 'Nagaland') echo 'selected'; ?>>Nagaland</option>
                            <option value="Odisha" <?php if ($rs == 'Odisha') echo 'selected'; ?>>Odisha</option>
                            <option value="Punjab" <?php if ($rs == 'Punjab') echo 'selected'; ?>>Punjab</option>
                            <option value="Rajasthan" <?php if ($rs == 'Rajasthan') echo 'selected'; ?>>Rajasthan</option>
                            <option value="Sikkim" <?php if ($rs == 'Sikkim') echo 'selected'; ?>>Sikkim</option>
                            <option value="Tamil Nadu" <?php if ($rs == 'Tamil') echo 'selected'; ?>>Tamil Nadu</option>
                            <option value="Telangana" <?php if ($rs == 'Telangana') echo 'selected'; ?>>Telangana</option>
                            <option value="Tripura" <?php if ($rs == 'Tripura') echo 'selected'; ?>>Tripura</option>
                            <option value="Uttarakhand" <?php if ($rs == 'Uttarakhand') echo 'selected'; ?>>Uttarakhand</option>
                            <option value="Uttar Pradesh" <?php if ($rs == 'Uttar') echo 'selected'; ?>>Uttar Pradesh</option>
                            <option value="West Bengal" <?php if ($rs == 'West') echo 'selected'; ?>>West Bengal</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td>
                        <input type="radio" name="rg" value="Male" <?php if ($rg == 'Male') echo "checked"; ?>
                            id="gender_male" required>Male
                        <input type="radio" name="rg" value="Female" <?php if ($rg == 'Female') echo "checked"; ?>
                            id="gender_female">Female
                        <input type="radio" name="rg" value="Custom" <?php if ($rg == 'Custom') echo "checked"; ?>
                            id="gender_custom">Custom
                    </td>
                </tr>
                <tr>
                    <td>Language</td>
                    <tr>
    <td>Language</td>
    <td>
        <input type="checkbox" value="English" name="rl[]" <?php if (in_array('English', explode(',', $rl))) echo 'checked'; ?> id="lang_eng">English
        <input type="checkbox" value="Bengali" name="rl[]" <?php if (in_array('Bengali', explode(',', $rl))) echo 'checked'; ?> id="lang_ben">Bengali
        <input type="checkbox" value="Hindi" name="rl[]" <?php if (in_array('Hindi', explode(',', $rl))) echo 'checked'; ?> id="lang_hin">Hindi
    </td>
</tr>

                </tr>
                <tr>
                    <td>Address</td>
                    <td><input type="text" value="<?php echo htmlspecialchars($ra); ?>" name="address" id="address" required></td>
                </tr>
            </table>
            <button type="submit">Submit</button>
        </form>
    </div>

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
                cname.options[2] = new Option("Digital marketing");
                // Add more PG options here
            }
        }
    </script>
</body>

</html>