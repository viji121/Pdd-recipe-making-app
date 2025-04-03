<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include the database connection file
include 'config.php'; // Ensure that you replace this with your actual database connection file.

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Get the 'id' from the FormData (POST request)
        // 'id' will be retrieved from $_POST['id'] because it was sent as form data
        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

        // Validate the id
        if ($id <= 0) {
            throw new Exception("Invalid or missing id.");
        }

        // Debugging: Log the received id
        error_log("Received id: " . $id);

        // Fetch the recipe overview details from the database
        $selectSql = "SELECT id, title, recipeimage, preparationtime, cookingtime, servings FROM recipeoverview WHERE id = ?";
        $selectStmt = $conn->prepare($selectSql);

        if (!$selectStmt) {
            throw new Exception("SQL prepare failed: " . $conn->error);
        }

        // Bind parameters and execute the query
        $selectStmt->bind_param("i", $id);
        $selectStmt->execute();

        // Get the result of the query
        $result = $selectStmt->get_result();

        if ($result && $result->num_rows > 0) {
            // Fetch the recipe overview details
            $recipeDetails = $result->fetch_assoc();

            $response = array(
                'status' => true,
                'message' => 'Recipe details retrieved successfully',
                'data' => $recipeDetails
            );
            http_response_code(200); // OK
        } else {
            throw new Exception("Recipe not found.");
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
        'message' => $_SERVER['REQUEST_METHOD'] . ' Method Not Allowed',
        'data' => []
    );
    http_response_code(405); // Method Not Allowed
    echo json_encode($response);
}
?>
