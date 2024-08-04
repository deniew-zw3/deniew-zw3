<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve POST data
    $gender = $_POST['gender'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO deniew3ite (gender_10, firstname_10, lastname_10, birthdate_10, address_10, email_10, tel_10) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $gender, $firstname, $lastname, $birthdate, $address, $email, $tel);

    // Execute the query
    if ($stmt->execute()) {
        // If successful, redirect back to the form with a success parameter
        header("Location: insert.php?success=1");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ເດນິວ ນວນດາລານ 3ite</title>
    <?php
    require 'boostrap/link.php'
    ?>
</head>

<body>
    <div class="container">
        <h1 class="name-add">Add Member/ຟອມເພີ່ມສະມາຊິກ</h1>
        <form action="insert.php" method="post" class="form">

            <label for="gender">Gender ເພດ:</label>
            <input type="text" id="gender" name="gender" require>

            <label for="firstname">Firstname ຊື່:</label>
            <input type="text" id="firstname" name="firstname" required>

            <label for="lastname">Lastname ນາມສະກຸນ:</label>
            <input type="text" id="lastname" name="lastname" required>

            <label for="birthdate">Birth Date ວັນ/ເດືອນ/ປີເກີດ:</label>
            <input type="date" id="birthdate" name="birthdate" required>

            <label for="address">Address ທີ່ຢູ່:</label>
            <input type="text" id="address" name="address" required>

            <label for="email">Email ອີເມວ:</label>
            <input type="email" id="email" name="email" required>

            <label for="tel">Tel ເບີໂທ:</label>
            <input type="tel" id="tel" name="tel" required>


            <div class="form-buttons">
                <button type="submit" class="add">Save/ບັນທຶກ</button>
                <button type="button" class="cancel" onclick="window.location.href='index.php';">Cancel/ຍົກເລີກ</button>
            </div>
        </form>


        <?php
        require 'boostrap/script.php'
        ?>

        <script>
            // Check for the success parameter in the URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success') === '1') {
                alert('Save successfully');
            }
        </script>
</body>

</html>