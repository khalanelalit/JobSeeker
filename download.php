<?php
require 'DbConnection.php';

if (isset($_GET['email'])) {
    $email = $_GET['email'];
    
    try {
        $con = DbConnection::connect();
        $sql = "SELECT resume FROM app WHERE email = :email";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            $pdfData = $row['resume'];
            
            // Set headers to download the file
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="resume.pdf"');
            header('Content-Length: ' . strlen($pdfData));
            echo $pdfData;
            exit;
        } else {
            echo "No record found.";
        }
    } catch (PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
} else {
    echo "Invalid request.";
}
?>
