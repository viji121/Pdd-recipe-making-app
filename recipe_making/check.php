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
            throw new Exception("Username and password are required");
        }

        // Query to validate user credentials
        $sql = "SELECT * FROM login WHERE username = ? AND password = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $password);

        if ($stmt->execute()) {
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                // Fetch user data
                $user = $result->fetch_assoc();

                // Construct the response
                $response = array(
                    'status' => true,
                    'message' => 'successfully',
                    'data' => array(
                        array(
                            'username' => $user['username']
                            // Avoid sending the password in the response
                        )
                    )
                );
            } else {
                // Invalid credentials
                throw new Exception("Invalid username or password");
            }
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
