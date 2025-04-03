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
        // Query to fetch data from the "dessert" table
        $sql = "SELECT recipename, image_name FROM dessert";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Prepare an array to hold the fetched data
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = array(
                    'recipename' => $row['recipename'],
                    'image_name' => $row['image_name']
                );
            }

            // Success response with the fetched data
            $response = array(
                'status' => true,
                'message' => 'Data fetched successfully',
                'data' => $data
            );
        } else {
            // If no data is found
            $response = array(
                'status' => false,
                'message' => 'No records found',
                'data' => []
            );
        }

        // Close the database connection
        $conn->close();

        // Send the response in JSON format
        http_response_code(200);
        echo json_encode($response);
    } catch (Exception $e) {
        // Handle exceptions and send error response
        $response = array(
            'status' => false,
            'message' => 'Server Error: ' . $e->getMessage(),
            'data' => [] // Ensure consistent structure
        );

        http_response_code(500);
        echo json_encode($response);
    }
} else {
    // Handle invalid HTTP methods
    $response = array(
        'status' => false,
        'message' => $RequestMethod . ' Method Not Allowed',
        'data' => [] // Ensure consistent structure
    );

    http_response_code(405);
    echo json_encode($response);
}
?>
