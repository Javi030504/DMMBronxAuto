<?php
// include database connection file
include 'db_connect.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>DMM Bronx Auto System</title>

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
        text-align: center;
    }

    .welcome-box {
        background-color: white;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 10px lightgray;
        margin-bottom: 30px;
    }

    .cards {
        display: flex;
        justify-content: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .card {
        background-color: white;
        width: 250px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px lightgray;
        text-align: center;
    }

    .card h3 {
        margin-bottom: 10px;
    }

    .card p {
        margin-bottom: 15px;
    }

    .card a {
        display: inline-block;
        padding: 10px 15px;
        background-color: #333;
        color: white;
        text-decoration: none;
        border-radius: 5px;
    }

    .card a:hover {
        background-color: #555;
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
    <div class="welcome-box">
        <h2>Welcome</h2>
        <p>This system allows users to manage cars, customers, and rentals for DMM Bronx Auto.</p>
    </div>

    <div class="cards">
        <div class="card">
            <h3>Cars</h3>
            <p>View available cars and car type information.</p>
            <a href="view_cars.php">Go to Cars</a>
        </div>

        <div class="card">
            <h3>Customers</h3>
            <p>View customer records and add new customers.</p>
            <a href="view_customers.php">Go to Customers</a>
        </div>

        <div class="card">
            <h3>Rentals</h3>
            <p>View rental records and add new rentals.</p>
            <a href="view_rentals.php">Go to Rentals</a>
        </div>
    </div>
</div>

</body>
</html>