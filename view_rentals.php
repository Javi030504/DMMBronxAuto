<?php
// include database connection
include 'db_connect.php';

// query to join rentals, customers, and cars tables
// this shows customer name, car details, rental dates, and status together
$sql = "SELECT customers.first_name, customers.last_name, cars.brand, cars.model, rentals.rental_date, rentals.return_date, rentals.status
        FROM rentals
        JOIN customers ON rentals.customer_id = customers.customer_id
        JOIN cars ON rentals.car_id = cars.car_id";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Rentals</title>

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
        <h2>Rental Records</h2>

        <table>
            <tr>
                <th>Customer Name</th>
                <th>Car</th>
                <th>Rental Date</th>
                <th>Return Date</th>
                <th>Status</th>
            </tr>

            <?php
            // display rental records in table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["first_name"] . " " . $row["last_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["brand"] . " " . $row["model"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["rental_date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["return_date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No rental records found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>