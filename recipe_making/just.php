<?php
// Start the session
session_start();

// Include the database connection file
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the username and password from the POST request
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate inputs
    if (empty($username) || empty($password)) {
        echo json_encode(['status' => false, 'message' => 'Username and password are required']);
        exit();
    }

    try {
        // Prepare and execute query to check credentials
        $sql = "SELECT user_id, username, password FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if a user with the provided username exists
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();

            // Verify the password (assuming the password is stored in plain text for simplicity, 
            // but it should ideally be hashed in a real application)
            if ($password === $user['password']) {
                // Store user_id in the session
                $_SESSION['user_id'] = $user['user_id'];

                // Respond with success
                echo json_encode([
                    'status' => true,
                    'message' => 'Login successful',
                    'user_id' => $_SESSION['user_id']
                ]);
            } else {
                // Incorrect password
                echo json_encode(['status' => false, 'message' => 'Invalid credentials']);
            }
        } else {
            // User not found
            echo json_encode(['status' => false, 'message' => 'User not found']);
        }

        // Close the statement
        $stmt->close();
    } catch (Exception $e) {
        // Handle any errors
        echo json_encode(['status' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }

    // Close the connection
    $conn->close();
}
?>
