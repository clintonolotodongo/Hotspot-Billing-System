<?php 
include('header.php');
include('functions.php');

ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == UPLOAD_ERR_OK) {

    $file = $_FILES['csv_file']['tmp_name'];

    if (($handle = fopen($file, "r")) !== FALSE) {
        $db = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

        if ($db->connect_error) {
            die("Database connection failed: " . $db->connect_error);
        }

        $insert_count = 0;
        $row_number = 0;

        // Skip header
        fgetcsv($handle);
        $row_number++;

        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $row_number++;

            if (count($data) < 4) {
                echo "Row $row_number skipped: not enough columns.<br>";
                continue;
            }

            $username = $db->real_escape_string(trim($data[0]));
            $password = $db->real_escape_string(trim($data[1]));
            $uptime = (int)trim($data[2]);
            $price = (int)trim($data[3]);

            if (empty($username) || empty($password) || !$uptime || !$price) {
                echo "Row $row_number skipped: invalid or empty values.<br>";
                continue;
            }

            $query = "INSERT INTO vochure (username, password, uptime, price) 
                      VALUES ('$username', '$password', '$uptime', '$price')";

            if ($db->query($query)) {
                $insert_count++;
            } else {
                echo "Row $row_number insert error: " . $db->error . "<br>";
            }
        }

        fclose($handle);
        $db->close();

        echo "<script>alert('$insert_count vouchers uploaded successfully!'); window.location.href='create-vochure.php';</script>";

    } else {
        echo "<script>alert('Failed to open CSV file.'); window.location.href='create-vochure.php';</script>";
    }

} else {
    echo "<script>alert('No valid file uploaded.'); window.location.href='create-vochure.php';</script>";
}
?>
