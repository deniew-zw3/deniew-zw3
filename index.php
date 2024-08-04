<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ເດນິວ ນວນດາລານ 3ite</title>
    <?php require 'boostrap/link.php'; ?>
    <script>
        // Function to clean up URL parameters
        function cleanUrlParameter(param) {
            const url = new URL(window.location.href);
            url.searchParams.delete(param);
            window.history.replaceState({}, '', url);
        }

        window.onload = function() {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.get('updated') === '1') {
                alert('Record updated successfully');
                cleanUrlParameter('updated');
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <div>
            <h1 class="name">ເດນິວ ນວນດາລານ 3ITE (2023-2024)</h1>
        </div>

        <a href="insert.php"><button class="add">Add/ເພີ່ມ</button></a>

        <table class="table">
            <thead class="table-primary">
                <tr>
                    <th scope="col" width="5%">Id ລຳດັບ</th>
                    <th scope="col" width="10%">Gender ເພດ</th>
                    <th scope="col" width="15%">Firstname ຊື່</th>
                    <th scope="col" width="15%">Lastname ນາມສະກຸນ</th>
                    <th scope="col" width="20%">Birth Date ວັນ/ເດືອນ/ປີເກີດ</th>
                    <th scope="col" width="15%">Address ທີ່ຢູ່</th>
                    <th scope="col" width="15%">Email ອີເມວ</th>
                    <th scope="col" width="15%">Tel ເບີໂທ</th>
                    <th scope="col" width="10%">Option ຈັດການ</th>
                </tr>
            </thead>
            <tbody>
            <?php
            include 'connect.php';

            // Fetch data from the database
            $sql = "SELECT id, gender_10, firstname_10, lastname_10, birthdate_10, address_10, email_10, tel_10 FROM deniew3ite";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<th scope='row'>" . htmlspecialchars($row['id']) . "</th>";
                    echo "<td>" . htmlspecialchars($row['gender_10']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['firstname_10']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['lastname_10']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['birthdate_10']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['address_10']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['email_10']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['tel_10']) . "</td>";
                    echo "<td>
                    <form action='edit.php' method='get' style='display:inline;'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                        <button type='submit' class='btn btn-warning'>Edit</button>
                    </form>
                    <form action='delete.php' method='post' style='display:inline;' onsubmit='confirmDelete(event);'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($row['id']) . "'>
                        <button type='submit' class='btn btn-danger mt-1'>Delete</button>
                    </form>
                </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No records found</td></tr>";
            }

            // Close the connection
            $conn->close();
            ?>
            </tbody>
        </table>
    </div>
    <script>
        // Check for the success parameters in the URL
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.get('deleted') === '1') {
            alert('Record deleted successfully');
        }
    </script>
    <?php require 'boostrap/script.php'; ?>
</body>

</html>
