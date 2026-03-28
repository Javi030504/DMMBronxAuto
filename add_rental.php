<?php
// include database connection
include 'db_connect.php';

// message for success or error
$message = "";

// get customers for dropdown
$customers = $conn->query("SELECT customer_id, first_name, last_name FROM customers");

// get cars for dropdown
$cars = $conn->query("SELECT car_id, brand, model FROM cars");

// check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // sanitize input (remove spaces)
    $customer_id = trim($_POST["customer_id"]);
    $car_id = trim($_POST["car_id"]);
    $rental_date = trim($_POST["rental_date"]);
    $return_date = trim($_POST["return_date"]);
    $status = trim($_POST["status"]);

    // validation: check if any field is empty
    if (empty($customer_id) || empty($car_id) || empty($rental_date) || empty($return_date) || empty($status)) {
        $message = "All fields are required.";
    }
    // validation: return date must be after rental date
    elseif ($return_date < $rental_date) {
        $message = "Return date cannot be earlier than rental date.";
    }
    else {
        // use prepared statement for security
        $stmt = $conn->prepare("INSERT INTO rentals (customer_id, car_id, rental_date, return_date, status)
                               VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param("iisss", $customer_id, $car_id, $rental_date, $return_date, $status);

        // execute query
        if ($stmt->execute()) {
            $message = "Rental added successfully.";
        } else {
            $message = "Error: " . $stmt->error;
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Rental</title>

    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background-color: #f4f4f4;
    }

    .header {
        background-color: #222;
        color: white;
        padding: 20px;
        text-align: center;
    }

    nav {
        background-color: #333;
        padding: 12px;
        text-align: center;
    }

    nav a {
        color: white;
        text-decoration: none;
        margin: 0 12px;
        font-weight: bold;
    }

    nav a:hover {
        text-decoration: underline;
    }

    .container {
        width: 90%;
        margin: 30px auto;
    }

    .box {
        background-color: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 10px lightgray;
    }

    input, select {
        width: 300px;
        padding: 8px;
        margin-top: 5px;
        margin-bottom: 12px;
    }

    input[type="submit"] {
        width: auto;
        background-color: #333;
        color: white;
        border: none;
        padding: 10px 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    input[type="submit"]:hover {
        background-color: #555;
    }

    .message {
        font-weight: bold;
        margin-bottom: 15px;
        color: green;
    }
    </style>
</head>
<body>

<div class="header">
    <h1>DMM Bronx Auto System</h1>
    <p>Car Rental Management Application</p>
</div>

<nav>
    <a href="index.php">Home</a>
    <a href="view_cars.php">View Cars</a>
    <a href="view_customers.php">View Customers</a>
    <a href="view_rentals.php">View Rentals</a>
    <a href="add_customer.php">Add Customer</a>
    <a href="add_rental.php">Add Rental</a>
</nav>

<div class="container">
    <div class="box">
        <h2>Add Rental</h2>

        <?php
        // show success or error message
        if ($message != "") {
            echo "<p class='message'>" . htmlspecialchars($message) . "</p>";
        }
        ?>

        <form method="POST">

            <label>Customer:</label><br>
            <select name="customer_id" required>
                <?php
                // display customers in dropdown
                while ($row = $customers->fetch_assoc()) {
                    echo "<option value='" . $row["customer_id"] . "'>" .
                         htmlspecialchars($row["first_name"] . " " . $row["last_name"]) .
                         "</option>";
                }
                ?>
            </select><br>

            <label>Car:</label><br>
            <select name="car_id" required>
                <?php
                // display cars in dropdown
                while ($row = $cars->fetch_assoc()) {
                    echo "<option value='" . $row["car_id"] . "'>" .
                         htmlspecialchars($row["brand"] . " " . $row["model"]) .
                         "</option>";
                }
                ?>
            </select><br>

            <label>Rental Date:</label><br>
            <input type="date" name="rental_date" required><br>

            <label>Return Date:</label><br>
            <input type="date" name="return_date" required><br>

            <!-- status dropdown (standardized values) -->
            <label>Status:</label><br>
            <select name="status" required>
                <option value="Booked">Booked</option>
                <option value="Active">Active</option>
                <option value="Returned">Returned</option>
            </select><br>

            <input type="submit" value="Add Rental">
        </form>
    </div>
</div>

</body>
</html>