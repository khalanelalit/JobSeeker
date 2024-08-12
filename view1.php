<?php
// Include the database connection file
require 'DbConnection.php';

try {
    // Create database connection
    $con = DbConnection::connect();
    
    // Prepare the SQL statement
    $sql = "SELECT * FROM trip_tab";
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
        <th>SNo</th>
        <th>Name</th>
        <th>Email</th>
        <th>Pass</th>
        <th>Confirm Pass</th>
        <th>Date</th>
    </tr>
    </thead>
    <tbody>
    <?php if (count($results) > 0) {
        foreach ($results as $row) { ?>
            <tr>
                <td><?= htmlspecialchars($row['sno']) ?></td>
                <td><?= htmlspecialchars($row['Name']) ?></td>
                <td><?= htmlspecialchars($row['Email']) ?></td>
                <td><?= htmlspecialchars($row['Pass']) ?></td>
                <td><?= htmlspecialchars($row['Confir_Pass']) ?></td>
                <td><?= htmlspecialchars($row['Date']) ?></td>
            </tr>
        <?php }
    } else {
        echo "<tr><td colspan='6'>No records found</td></tr>";
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
