<?php
// include database connection
include 'db_connect.php';

// query to get all customer records
$sql = "SELECT customer_id, first_name, last_name, email, phone FROM customers";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Customers</title>

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

    .delete-link {
        color: red;
        font-weight: bold;
        text-decoration: none;
    }

    .delete-link:hover {
        text-decoration: underline;
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
        <h2>Customer Records</h2>

        <table>
            <tr>
                <th>Customer ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>

            <?php
            // display customer records in table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["customer_id"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["first_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["last_name"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["email"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["phone"]) . "</td>";
                    echo "<td><a class='delete-link' href='delete_customer.php?id=" . $row["customer_id"] . "' onclick=\"return confirm('Are you sure you want to delete this customer?');\">Delete</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No customers found</td></tr>";
            }
            ?>
        </table>
    </div>
</div>

</body>
</html>