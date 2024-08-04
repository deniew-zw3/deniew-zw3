<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'connect.php';

$record = null;

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    // Retrieve the ID from the GET request
    $id = $_GET['id'];
    
    // Fetch the existing record data
    $stmt = $conn->prepare("SELECT * FROM deniew3ite WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $record = $result->fetch_assoc();
    } else {
        die('Record not found.');
    }

    $stmt->close();
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Update record
    $id = $_POST['id'];
    $gender = $_POST['gender'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $birthdate = $_POST['birthdate'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    $stmt = $conn->prepare("UPDATE deniew3ite SET gender_10 = ?, firstname_10 = ?, lastname_10 = ?, birthdate_10 = ?, address_10 = ?, email_10 = ?, tel_10 = ? WHERE id = ?");
    $stmt->bind_param("sssssssi", $gender, $firstname, $lastname, $birthdate, $address, $email, $tel, $id);

    if ($stmt->execute()) {
        // Redirect with a success flag
        header("Location: index.php?updated=1");
        exit();
    } else {
        die('Update failed: ' . htmlspecialchars($stmt->error));
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Record</title>
    <?php require 'boostrap/link.php'; ?>
</head>

<body>
    <div class="container">
        <h1 class="name-edit">Edit Member/ຟອມເເກ້ໄຂ</h1>
        <form action="edit.php" method="post" class="form">
            <?php if ($record): ?>
                <input type="hidden" name="id" value="<?php echo htmlspecialchars($record['id']); ?>">

                <label for="gender">Gender ເພດ:</label>
                <input type="text" id="gender" name="gender" value="<?php echo htmlspecialchars($record['gender_10']); ?>" required>

                <label for="firstname">Firstname ຊື່:</label>
                <input type="text" id="firstname" name="firstname" value="<?php echo htmlspecialchars($record['firstname_10']); ?>" required>

                <label for="lastname">Lastname ນາມສະກຸນ:</label>
                <input type="text" id="lastname" name="lastname" value="<?php echo htmlspecialchars($record['lastname_10']); ?>" required>

                <label for="birthdate">Birth Date ວັນ/ເດືອນ/ປີເກີດ:</label>
                <input type="date" id="birthdate" name="birthdate" value="<?php echo htmlspecialchars($record['birthdate_10']); ?>" required>

                <label for="address">Address ທີ່ຢູ່:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($record['address_10']); ?>" required>

                <label for="email">Email ອີເມວ:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($record['email_10']); ?>" required>

                <label for="tel">Tel ປະເພດປ່ອນ:</label>
                <input type="tel" id="tel" name="tel" value="<?php echo htmlspecialchars($record['tel_10']); ?>" required>
            <?php else: ?>
                <p>No record found to edit.</p>
            <?php endif; ?>

            <div class="form-buttons">
                <button type="submit" class="add">Save/ບັນທຶກ</button>
                <button type="button" class="cancel" onclick="window.location.href='index.php';">Cancel/ຍົກເລີກ</button>
            </div>
        </form>

        <?php require 'boostrap/script.php'; ?>

        <script>
            // Check for the success parameter in the URL
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('success') === '1') {
                alert('Save successfully');
            }
        </script>
    </div>
</body>

</html>
