<?php
session_start();
$host = 'localhost:3306';
$user = 'root';
$pw = '1234';
$db_name = 'dbproject';
$conn = new mysqli($host, $user, $pw, $db_name); //db 연결

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from paylist table
$paylist_data_query = "SELECT * FROM paylist";
$paylist_data_result = $conn->query($paylist_data_query);

if ($paylist_data_result->num_rows > 0) {
    echo "Data in paylist table:<br>";
    while ($row = $paylist_data_result->fetch_assoc()) {
        foreach ($row as $key => $value) {
            echo "$key: $value<br>";
        }
        echo "<br>";
    }
} else {
    echo "No data found in paylist table";
}

// Fetch data from pay table
$pay_data_query = "SELECT * FROM pay";
$pay_data_result = $conn->query($pay_data_query);

if ($pay_data_result->num_rows > 0) {
    echo "<br>Data in pay table:<br>";
    while ($row = $pay_data_result->fetch_assoc()) {
        foreach ($row as $key => $value) {
            echo "$key: $value<br>";
        }
        echo "<br>";
    }
} else {
    echo "No data found in pay table";
}

// Close the connection
$conn->close();
?>
