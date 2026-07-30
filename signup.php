<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Insert the data into the database
    $sql = "INSERT INTO users (fullname, email, password) VALUES ('$fullname', '$email', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Show success message with JavaScript alert
        echo "<script type='text/javascript'>
                alert('New record created successfully!');
                window.location.href='index.html';  // Optional: Redirect back to the home page or stay on the same page
              </script>";
    } else {
        echo "<script type='text/javascript'>
                alert('Error: " . $conn->error . "');
              </script>";
    }

    $conn->close();
}
?>
