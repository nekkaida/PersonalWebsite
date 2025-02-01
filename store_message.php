<?php
// Ensure error reporting is enabled for debugging during development.
// In production, you might want to log errors instead.
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize and retrieve form inputs
    $fullname = isset($_POST['fullname']) ? strip_tags(trim($_POST['fullname'])) : '';
    $email    = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $message  = isset($_POST['message']) ? strip_tags(trim($_POST['message'])) : '';

    // Create a formatted entry string
    $entry = "Time: " . date("Y-m-d H:i:s") . "\n" .
             "Name: " . $fullname . "\n" .
             "Email: " . $email . "\n" .
             "Message: " . $message . "\n" .
             "-----------------------\n";

    // Define the file path where messages will be stored
    $file = 'messages.txt';

    // Append the entry to the file
    if (file_put_contents($file, $entry, FILE_APPEND | LOCK_EX)) {
        // Redirect back to the form or show a success message
        echo "Thank you for your message!";
    } else {
        echo "There was an error saving your message. Please try again.";
    }
} else {
    // If the page was accessed without POST data, redirect or show an error.
    echo "Invalid request.";
}
?>
