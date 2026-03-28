<?php
// include database connection
include 'db_connect.php';

// SQL query to join cars and car types tables
// this lets us show the type name for each car
$sql = "SELECT cars.car_id, cars.brand, cars.model, cars.year, cartypes.type_name, cars.availability
        FROM cars
        JOIN cartypes ON cars.type_id = cartypes.type_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Cars</title>

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
    table {
        border-collapse: collapse;
        width: 100%;
        margin-top: 15px;
    }
    th, td {
        border: 1px solid #ccc;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #eee;
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
        <h2>Car Records</h2>

        <table>
            <tr>
                <th>Car ID</th>
                <th>Brand</th>
                <th>Model</th>
                <th>Year</th>
                <th>Type</th>
                <th>Availability</th>
            </tr>

            <?php
            // check if there are rows returned from query
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["car_id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["brand"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["model"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["year"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["type_name"]) . "</td>";

                    // show friendly text instead of 1 or 0
                    if ($row["availability"] == 1) {
                        echo "<td>Available</td>";
                    } else {
                        echo "<td>Not Available</td>";
                    }

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No records found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>