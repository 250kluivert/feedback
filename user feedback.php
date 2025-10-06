<?php
// --- Database configuration ---
$host = "localhost";     // Database host
$user = "root";          // Database username
$pass = "";              // Database password
$dbname = "feedback_db"; // Database name

// --- Create database connection ---
$conn = new mysqli($host, $user, $pass, $dbname);

// --- Check connection ---
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// --- Check if the form was submitted ---
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize and validate inputs
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $rating = trim($_POST['rating']);
    $comments = trim($_POST['comments']);

    if (empty($name) || empty($email) || empty($rating)) {
        die("Please fill in all required fields.");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email format.");
    }

    // --- Prepare SQL statement ---
    $stmt = $conn->prepare("INSERT INTO feedback (name, email, rating, comments) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $rating, $comments);

    // --- Execute query ---
    if ($stmt->execute()) {
        echo "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Feedback Submitted</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                    background-color: #f3f7f9;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                }
                .message-box {
                    background-color: #fff;
                    padding: 40px;
                    border-radius: 10px;
                    text-align: center;
                    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
                }
                h2 {
                    color: #2ecc71;
                }
                a {
                    display: inline-block;
                    margin-top: 20px;
                    text-decoration: none;
                    color: #3498db;
                }
                a:hover {
                    text-decoration: underline;
                }
            </style>
        </head>
        <body>
            <div class='message-box'>
                <h2>Thank you for your feedback!</h2>
                <p>We appreciate you taking the time to help us improve.</p>
                <a href='user feedback.html'>Go Back</a>
            </div>
        </body>
        </html>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // --- Close connection ---
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
