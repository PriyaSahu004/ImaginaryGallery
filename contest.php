<?php
session_start();
include 'db.php';

// Only allow if user is logged in
if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('Access Denied! Please log in first.');
            window.history.back(); // Go back to index.html
          </script>";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $photo = $_FILES['photo']['name'];

    // File handling
    $target_dir = "uploads/";
    $target_file = $target_dir . time() . "_" . basename($photo); // Unique name
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (!getimagesize($_FILES['photo']['tmp_name'])) {
        echo "<script>alert('File is not an image!'); window.history.back();</script>";
        $uploadOk = 0;
    }

    if (file_exists($target_file)) {
        echo "<script>alert('File already exists!'); window.history.back();</script>";
        $uploadOk = 0;
    }

    if ($_FILES['photo']['size'] > 5000000) {
        echo "<script>alert('File too large!'); window.history.back();</script>";
        $uploadOk = 0;
    }

    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "<script>alert('Only JPG, JPEG, PNG, GIF allowed!'); window.history.back();</script>";
        $uploadOk = 0;
    }

    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            $submitted_at = date('Y-m-d H:i:s');
            $sql = "INSERT INTO contest_entries (fullname, email, age, category, description, photo_path, submitted_at)
                    VALUES ('$fullname', '$email', '$age', '$category', '$description', '$target_file', '$submitted_at')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Contest registration successful!'); window.history.back();</script>";
            } else {
                echo "<script>alert('Database Error: " . $conn->error . "'); window.history.back();</script>";
            }
        } else {
            echo "<script>alert('Error uploading your file!'); window.history.back();</script>";
        }
    }

    $conn->close();
}
?>
