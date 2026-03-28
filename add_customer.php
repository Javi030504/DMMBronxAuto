<?php
// include database connection
include 'db_connect.php';

// variable to store success or error message
$message = "";

// check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // sanitize input by trimming extra spaces
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $email = trim($_POST["email"]);
    $phone = trim($_POST["phone"]);

    // validation: make sure no field is empty
    if (empty($first_name) || empty($last_name) || empty($email) || empty($phone)) {
        $message = "All fields are required.";
    }
    // validation: check email format
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = "Please enter a valid email address.";
    }
    // validation: phone number should only have numbers and be reasonable length
    elseif (!preg_match("/^[0-9]{10,15}$/", $phone)) {
        $message = "Phone number must be 10 to 15 digits only.";
    }
    else {
        // use prepared statement for better security
        $stmt = $conn->prepare("INSERT INTO customers (first_name, last_name, email, phone) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $first_name, $last_name, $email, $phone);

        // run insert query
        if ($stmt->execute()) {
            $message = "New customer added successfully.";
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
    <title>Add Customer</title>

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
        <h2>Add Customer</h2>

        <?php
        // display status message
        if ($message != "") {
            echo "<p class='message'>" . htmlspecialchars($message) . "</p>";
        }
        ?>

        <form method="POST" action="">
            <label>First Name:</label><br>
            <input type="text" name="first_name" required><br>

            <label>Last Name:</label><br>
            <input type="text" name="last_name" required><br>

            <label>Email:</label><br>
            <input type="email" name="email" required><br>

            <label>Phone:</label><br>
            <input type="text" name="phone" required><br>

            <input type="submit" value="Add Customer">
        </form>
    </div>
</div>

</body>
</html>