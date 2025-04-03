<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include the database connection file
include 'config.php';

$RequestMethod = $_SERVER["REQUEST_METHOD"];

if ($RequestMethod == "POST") {
    try {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validate inputs
        if (empty($username) || empty($password)) {
            throw new Exception("username and password are required");
        }

        // Insert QUERY for User details
        $sql = "INSERT INTO login (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            // Response on successful insertion
            $response = array(
                'status' => true,
                'message' => 'Signup successfully',
                'data' => array(
                    array(
                        'username' => $username,
                        'password' => $password // Note: Ideally, do not return the password in production
                    )
                )
            );
        } else {
            throw new Exception("Database error: " . $stmt->error);
        }

        // Close the prepared statement
        $stmt->close();

        // Close the database connection
        $conn->close();

        http_response_code(200);
        echo json_encode($response);
    } catch (Exception $e) {
        // Response on error
        $response = array(
            'status' => false,
            'message' => 'Server Error: ' . $e->getMessage(),
            'data' => []
        );

        http_response_code(500);
        echo json_encode($response);
    }
} else {
    // Response for unsupported methods
    $response = array(
        'status' => false,
        'message' => $RequestMethod . ' Method Not Allowed',
        'data' => []
    );

    http_response_code(405);
    echo json_encode($response);
}
?>