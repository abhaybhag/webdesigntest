<?php
// PHP code to handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $assessment = $_POST["assessment"];
    $subject = $_POST["subject"];
    $budget = $_POST["budget"];
    $pages = $_POST["pages"];
    $phone = $_POST["phone"];
    $deadline = $_POST["deadline"];

    // Handle file upload
    if(isset($_FILES["attachment"])) {
        $file_name = $_FILES["attachment"]["name"];
        $file_tmp = $_FILES["attachment"]["tmp_name"];
        move_uploaded_file($file_tmp, "uploads/" . $file_name);
    }

    // Here you would typically save this data to a database
    // and/or send an email notification

    echo "<script>alert('Thank you for your submission. We will contact you shortly.');</script>";
}
?>