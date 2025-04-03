<?php
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include the database connection file
include 'config.php'; // Ensure this points to your actual database connection file

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    try {
        // SQL query to fetch data from the table
        $sql = "SELECT id, username, ratings, review FROM shareyourexperience";
        $result = $conn->query($sql);

        $data = []; // Array to store fetched data

        if ($result->num_rows > 0) {
            // Output data for each row
            while ($row = $result->fetch_assoc()) {
                $data[] = [
                    "id" => $row["id"],
                    "username" => $row["username"],
                    "ratings" => $row["ratings"],
                    "review" => $row["review"]
                ];
            }
            // Return the data as a JSON response
            echo json_encode([
                "status" => "success",
                "data" => $data
            ]);
        } else {
            // No records found
            echo json_encode([
                "status" => "success",
                "data" => [],
                "message" => "No records found."
            ]);
        }
    } catch (Exception $e) {
        // Handle exceptions and errors
        echo json_encode([
            "status" => "error",
            "message" => "An error occurred: " . $e->getMessage()
        ]);
    } finally {
        // Close the database connection
        $conn->close();
    }
} else {
    // Handle invalid request methods
    echo json_encode([
        "status" => "error",
        "message" => "Invalid request method. Only GET is allowed."
    ]);
}
?>
