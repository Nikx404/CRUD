<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Records</title>
</head>
<body>
    <div class="container">
        <table border="1">
            <tr>
                <th>Name</th>
                <th>Roll no</th>
                <th>Course category</th>
                <th>Course Name</th>
                <th>Phone no.</th>
                <th>Email</th>
                <th>State</th>
                <th>Sex</th>
                <th>Language</th>
                <th>Address</th>
                <th colspan=2>Action</th>
            </tr>
            <?php
            include('conn.php');

            $query = 'SELECT * FROM con2';
            $data = mysqli_query($con, $query);
            $total = mysqli_num_rows($data);

            if ($total != 0) {
                while ($res = mysqli_fetch_assoc($data)) {
                    echo "<tr>
                        <td>{$res['name']}</td>
                        <td>{$res['roll']}</td>
                        <td>{$res['course_category']}</td>
                        <td>{$res['course_name']}</td>
                        <td>{$res['phone']}</td>
                        <td>{$res['email']}</td>
                        <td>{$res['state']}</td>
                        <td>{$res['gender']}</td>
                        <td>{$res['languages']}</td>
                        <td>{$res['address']}</td>
                        <td>
                            <form method='POST' action='update.php'>
                                <input type='hidden' name='nm' value='{$res['name']}'>
                                <input type='hidden' name='rn' value='{$res['roll']}'>
                                <input type='hidden' name='rcc' value='{$res['course_category']}'>
                                <input type='hidden' name='rcn' value='{$res['course_name']}'>
                                <input type='hidden' name='rph' value='{$res['phone']}'>
                                <input type='hidden' name='re' value='{$res['email']}'>
                                <input type='hidden' name='rs' value='{$res['state']}'>
                                <input type='hidden' name='rg' value='{$res['gender']}'>
                                <input type='hidden' name='rl' value='{$res['languages']}'>
                                <input type='hidden' name='ra' value='{$res['address']}'>
                                <button type='submit'>Update</button>
                            </form>
                        </td>
                       <td>
                           <form action='delete.php' method='POST'>
                            <input type='hidden' name='rn' value='{$res['roll']}'>
                            <button type='submit'>Delete</button>
                           </form>
                        </td>
                    </tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No record found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>
