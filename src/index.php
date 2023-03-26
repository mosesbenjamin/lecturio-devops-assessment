<!DOCTYPE html>
<html>
<head>
    <title>Setup containerised system using Docker</title>
</head>
<body>
    <h1>Setup containerised system using Docker</h1>
    <?php

    $phpEnv = getenv('PHP_ENV');
    echo '<h3>Running ' . $phpEnv . ' version of build.</h3>';

    /////////////////// MYSQL //////////////////////   
    // Get env vars
    $mysqlDbHost = getenv('MYSQL_HOST');
    $mysqlDBUsername = getenv('MYSQL_USER');
    $mysqlDbPassword = getenv('MYSQL_PASSWORD');
    $mysqlDbName = getenv('MYSQL_DATABASE');

    // Create a connection
    $mysqli = new mysqli($mysqlDbHost, $mysqlDBUsername, $mysqlDbPassword);

    // Check connection
    if ($mysqli->connect_error) {
        die("Connection failed: " . $mysqli->connect_error);
    }

    // Drop if already exists
    $sql = "DROP DATABASE IF EXISTS $mysqlDbName";
    if ($mysqli->query($sql) === false) {
        die("Error creating database: " . $mysqli->error);
    }

    // Create the database
    $sql = "CREATE DATABASE IF NOT EXISTS $mysqlDbName";
    if ($mysqli->query($sql) === false) {
        die("Error creating database: " . $mysqli->error);
    }

    // Select the database
    $mysqli->select_db($mysqlDbName);

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

    ///////////// MONGODB ////////////////////////////////////
    // Get env vars
    $mongoUsername = getenv('MONGO_USER');
    $mongoPassword = getenv('MONGO_PASSWORD');
    $authMechanism = 'SCRAM-SHA-1';
    $mongoUri = sprintf(
        'mongodb://%s:%s@mongo:27017',
        urlencode($mongoUsername),
        urlencode($mongoPassword)
    );
    $options = [
        'authMechanism' => $authMechanism,
        'ssl' => false
    ];

    // Connect to MongoDB
    $mongoClient = new MongoDB\Driver\Manager($mongoUri, $options);

    // Seed the database with some data
    $bulk = new MongoDB\Driver\BulkWrite();
    $bulk->insert(['name' => 'John', 'age' => 30]);
    $bulk->insert(['name' => 'Jane', 'age' => 25]);
    $mongoClient->executeBulkWrite('database.collection', $bulk);

    // Query the database for all documents in the "collection" collection
    $query = new MongoDB\Driver\Query([]);
    $rows = $mongoClient->executeQuery('database.collection', $query);

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
    $mongoClient->executeBulkWrite('database.collection', $bulk);

    // Close the MongoDB connection
    unset($mongoClient);

    ?>
</body>
</html>
