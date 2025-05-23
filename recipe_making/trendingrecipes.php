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
        // Validate required fields
        if (empty($_POST['name']) || empty($_POST['ratings'])) {
            throw new Exception("name and ratings are required.");
        }

        // Get input values
        $name = $_POST['name'];
        $ratings = $_POST['ratings'];

        // Initialize variable to store image file names
        $imageNames = '';

        // Directory to store uploaded images
        $targetDir = "../uploads/";

        // Check if the directory exists, if not, create it
        if (!is_dir($targetDir)) {
            if (!mkdir($targetDir, 0777, true)) {
                throw new Exception("Failed to create directory: $targetDir");
            }
        }

        // Check if image files are uploaded
        if (!empty($_FILES['img']) && is_array($_FILES['img']['tmp_name'])) {
            // Loop through each uploaded file
            foreach ($_FILES['img']['tmp_name'] as $key => $tmp_name) {
                // Get the original file name
                $fileName = basename($_FILES['img']['name'][$key]);
                $targetFilePath = $targetDir . $fileName;

                // Check for file name collision and rename if needed
                if (file_exists($targetFilePath)) {
                    $fileName = time() . '_' . $fileName; // Add a timestamp to avoid collisions
                    $targetFilePath = $targetDir . $fileName;
                }

                // Upload file to the server
                if (move_uploaded_file($tmp_name, $targetFilePath)) {
                    // Append file name to the list
                    $imageNames .= (empty($imageNames) ? '' : ',') . $fileName;
                } else {
                    // Log detailed error and throw an exception
                    error_log("Failed to move file: $tmp_name to $targetFilePath");
                    throw new Exception("Error uploading file: " . $_FILES['img']['name'][$key]);
                }
            }
        }

        // Insert data into the database
        $sql = "INSERT INTO trendingrecipes (name, ratings, image_name) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Failed to prepare SQL statement: " . $conn->error);
        }
        $stmt->bind_param("sss", $name, $ratings, $imageNames);

        if ($stmt->execute()) {
            // Success response in desired format
            $response = array(
                'status' => true,
                'message' => 'Signup successfully',
                'data' => array(
                    array(
                        'recipename' => $name,
                        'image_name' => $imageNames
                    )
                )
            );
        } else {
            throw new Exception("Error executing query: " . $stmt->error);
        }

        // Close the prepared statement and connection
        $stmt->close();
        $conn->close();

        // Send success response
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
