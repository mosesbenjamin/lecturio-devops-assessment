<!DOCTYPE html>
<html>
<head>
    <title>PHP MongoDB Example</title>
</head>
<body>
    <h1>Example app..</h1>
    <?php

    // Replace the values in the $dbHost, $dbUsername, $dbPassword, and $dbName variables with your own values
    $dbHost = 'mysql';
    $dbUsername = 'root';
    $dbPassword = 'rootpassword';
    $dbName = 'testdb';

    // Create a MySQL connection
    $mysqli = new mysqli($dbHost, $dbUsername, $dbPassword);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Drop
    $sql = "DROP DATABASE IF EXISTS $dbName";
    if ($mysqli->query($sql) === false) {
        die("Error creating database: " . $mysqli->error);
    }

    // Create the database
    $sql = "CREATE DATABASE IF NOT EXISTS $dbName";
    if ($mysqli->query($sql) === false) {
        die("Error creating database: " . $mysqli->error);
    }

    // Select the database
    $mysqli->select_db($dbName);

    // Create the users table
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT(11) NOT NULL AUTO_INCREMENT,
        name VARCHAR(50) NOT NULL,
        email VARCHAR(50) NOT NULL,
        PRIMARY KEY (id)
    )";
    if ($mysqli->query($sql) === false) {
        die("Error creating table: " . $mysqli->error);
    }

    // Insert dummy data into the users table
    $sql = "INSERT INTO users (name, email) VALUES 
        ('John Doe', 'john@example.com'),
        ('Jane Smith', 'jane@example.com'),
        ('Bob Johnson', 'bob@example.com')";

    if ($mysqli->query($sql) === false) {
        die("Error inserting data: " . $mysqli->error);
    }

    // Query to select all users from the users table
    $sql = "SELECT * FROM users";
    $result = $mysqli->query($sql);

    // Display data in a table
    echo '<h3>MySQL Data:</h3>';
    echo '<table>';
    echo '<tr><th>ID</th><th>Name</th><th>Email</th></tr>';

    while ($row = $result->fetch_assoc()) {
        echo '<tr><td>' . $row['id'] . '</td><td>' . $row['name'] . '</td><td>' . $row['email'] . '</td></tr>';
    }

    echo '</table>';

    // Close the connections
    $mysqli->close();

    // Connect to MongoDB
    $username = 'root';
    $password = 'rootpassword';
    $authMechanism = 'SCRAM-SHA-1';
    $mongoUri = sprintf(
        'mongodb://%s:%s@mongo:27017',
        urlencode($username),
        urlencode($password)
    );
    $options = [
        'authMechanism' => $authMechanism,
        'ssl' => false
    ];
    $manager = new MongoDB\Driver\Manager($mongoUri, $options);

    // Seed the database with some data
    $bulk = new MongoDB\Driver\BulkWrite();
    $bulk->insert(['name' => 'John', 'age' => 30]);
    $bulk->insert(['name' => 'Jane', 'age' => 25]);
    $manager->executeBulkWrite('database.collection', $bulk);

    // Query the database for all documents in the "collection" collection
    $query = new MongoDB\Driver\Query([]);
    $rows = $manager->executeQuery('database.collection', $query);

    // Create a table to display the data
    echo '<h3>MongoDB Data:</h3>';
    echo '<table>';
    echo '<tr><th>Name</th><th>Age</th></tr>';
    foreach ($rows as $row) {
        echo '<tr>';
        echo '<td>' . $row->name . '</td>';
        echo '<td>' . $row->age . '</td>';
        echo '</tr>';
    }

    // Close the table
    echo '</table>';

    // Remove the seeded data
    $bulk = new MongoDB\Driver\BulkWrite();
    $bulk->delete([], ['limit' => 0]);
    $manager->executeBulkWrite('database.collection', $bulk);

    // Close the MongoDB connection
    unset($manager);

    ?>
</body>
</html>
