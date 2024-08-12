<?php
// Include the database connection file
require 'DbConnection.php';

try {
    // Create database connection
    $con = DbConnection::connect();
    
    // Prepare the SQL statement
    $sql = "SELECT * FROM app";
    $stmt = $con->prepare($sql);
    $stmt->execute();
    
    // Fetch all results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="ISO-8859-1">
    <title>Customer Data</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            border: 2px solid black;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Qualification</th>
        <th>Resume</th>
        <th>Cover Letter</th>
        <th>Date</th>
        <th>Image</th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($results) > 0) {
        foreach ($results as $row) { ?>
            <tr>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['Qualification']) ?></td>
                <td>
                    <a href="download.php?email=<?= htmlspecialchars($row['email']) ?>">Download Resume</a>
                </td>
                <td><?= htmlspecialchars($row['cover']) ?></td>
                <td><?= htmlspecialchars($row['Date']) ?></td>
                <td>
                    <?php
                    // Assuming $row['image'] contains the path to the image file
                    $imagePath = htmlspecialchars($row['resume']);
                    ?>
                    <a href="<?= $imagePath ?>" download>
                        <img alt="resume" src="<?= $imagePath ?>" style="height: 50px;width: 50px;" />
                    </a>
                </td>
            </tr>
        <?php }
    } else {
        echo "<tr><td colspan='7'>No records found</td></tr>";
    } ?>
    </tbody>
</table>
<div>
    <a href="index.php" class="btn rounded-pill py-2 px-4 ms-3 d-none d-lg-block">Back</a>
</div>
</body>
</html>

<?php
// Close the database connection
$con = null;
?>
