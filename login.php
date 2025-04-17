<?php
include('header.php');

$mysqli = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);

if ($mysqli->connect_error) {
    die('Error: (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

session_start();

if (isset($_POST['username']) && isset($_POST['password']) && $_POST['username'] != "" && $_POST['password'] != "") {
    
    // Secure username and password input
    $username = mysqli_real_escape_string($mysqli, $_POST['username']);
    $password_input = mysqli_real_escape_string($mysqli, $_POST['password']);
    
    // Query to fetch the user record based on username
    $fetch = $mysqli->query("SELECT * FROM `users` WHERE username='$username'");
    
    if ($fetch->num_rows > 0) {
        $row = mysqli_fetch_array($fetch);

        // Check if password matches the stored hashed password
        if (password_verify($password_input, $row['password'])) {
            $_SESSION['login_username'] = $row['username'];
            echo 1; // Successful login
        } else {
            echo 0; // Incorrect password
        }
    } else {
        echo 0; // User not found
    }
} else {
    // Redirect if username or password are not set
    header("Location:index.php");
    exit;
}

?>

<?php include('footer.php'); ?>
