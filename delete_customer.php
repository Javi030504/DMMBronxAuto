<?php
// include database connection
include 'db_connect.php';

// check if customer_id is passed in URL
if (isset($_GET['id'])) {

    // get id and sanitize it
    $customer_id = intval($_GET['id']);

    // prepared statement for security
    $stmt = $conn->prepare("DELETE FROM customers WHERE customer_id = ?");
    $stmt->bind_param("i", $customer_id);

    // execute delete
    if ($stmt->execute()) {
        // redirect back to customers page
        header("Location: view_customers.php");
        exit();
    } else {
        echo "Error deleting customer.";
    }

    $stmt->close();
} else {
    echo "No customer selected.";
}
?>