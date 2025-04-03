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
        // Get the POST data from form data (not JSON)
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

        // Validate the id
        if ($id <= 0) { // Fix: id must be positive
            throw new Exception("Invalid or missing id");
        }

        // Debugging: Log the received id
        error_log("Received id: " . $id);

        // Fetch user details from the database
        $selectSql = "SELECT id, username, profile_image, followers, followings, posts FROM displayprofile WHERE id = ?";
        $selectStmt = $conn->prepare($selectSql);

        if (!$selectStmt) {
            // Log and throw SQL preparation error
            throw new Exception("SQL prepare failed: " . $conn->error);
        }

        // Bind parameters and execute the query
        $selectStmt->bind_param("i", $id);
        $selectStmt->execute();

        // Get the result of the query
        $result = $selectStmt->get_result();

        if ($result && $result->num_rows > 0) {
            // Fetch the user details
            $userDetails = $result->fetch_assoc();

            $response = array(
                'status' => true,
                'message' => 'User details retrieved successfully',
                'data' => $userDetails
            );
            http_response_code(200); // OK
        } else {
            throw new Exception("User not found");
        }

        // Close the prepared statement and connection
        $selectStmt->close();
        $conn->close();

        // Send the response
        echo json_encode($response);
    } catch (Exception $e) {
        // Handle errors
        $response = array(
            'status' => false,
            'message' => 'Error: ' . $e->getMessage(),
            'data' => []
        );
        http_response_code(400); // Bad Request
        echo json_encode($response);
    }
} else {
    // If method is not POST
    $response = array(
        'status' => false,
        'message' => $RequestMethod . ' Method Not Allowed',
        'data' => []
    );
    http_response_code(405); // Method Not Allowed
    echo json_encode($response);
}
?>
