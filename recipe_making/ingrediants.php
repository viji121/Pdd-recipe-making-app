<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include the database connection file
include 'config.php'; // Ensure this points to your actual database connection

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        // Fetch all rows from the ingrediants table
        $selectSql = "SELECT id, name, quantity FROM ingrediants";
        $selectStmt = $conn->prepare($selectSql);

        if (!$selectStmt) {
            throw new Exception("SQL prepare failed: " . $conn->error);
        }

        // Execute the query
        $selectStmt->execute();

        // Get the result of the query
        $result = $selectStmt->get_result();

        if ($result && $result->num_rows > 0) {
            // Fetch all rows as an associative array
            $ingrediantsList = [];
            while ($row = $result->fetch_assoc()) {
                $ingrediantsList[] = $row; // Add each row to the list
            }

            $response = array(
                'status' => true,
                'message' => 'Ingrediants retrieved successfully',
                'data' => $ingrediantsList
            );
            http_response_code(200); // OK
        } else {
            throw new Exception("No ingrediants found in the table.");
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
    // If method is not GET
    $response = array(
        'status' => false,
        'message' => $_SERVER['REQUEST_METHOD'] . ' Method Not Allowed',
        'data' => []
    );
    http_response_code(405); // Method Not Allowed
    echo json_encode($response);
}
?>
