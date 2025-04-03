<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include the database connection file
include 'config.php';

$RequestMethod = $_SERVER["REQUEST_METHOD"];

if ($RequestMethod == "GET") {
    try {
        // SQL query to fetch data from the 'breakfast' table
        $sql = "SELECT * FROM breakfast";
        $result = $conn->query($sql);

        if ($result && $result->num_rows > 0) {
            $data = array();

            // Loop through the result set and fetch rows
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            // Success response
            $response = array(
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => $data
            );
        } else {
            // No data found or query failed
            $response = array(
                'status' => true,
                'message' => 'Failed to fetch the data',
                'data' => [] // Empty array
            );
        }

        http_response_code(200);
        echo json_encode($response);

        // Close the database connection
        $conn->close();
    } catch (Exception $e) {
        // Handle exceptions and send error response
        $response = array(
            'status' => false,
            'message' => 'Server Error: ' . $e->getMessage(),
            'data' => [] // Empty array in case of error
        );

        http_response_code(500);
        echo json_encode($response);
    }
} else {
    // Handle invalid HTTP methods
    $response = array(
        'status' => false,
        'message' => $RequestMethod . ' Method Not Allowed',
        'data' => [] // Empty array for unsupported methods
    );

    http_response_code(405);
    echo json_encode($response);
}
?>
