<?php
$mysqli = new mysqli("localhost", "root", "", "meb");
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$queries = [
    "ALTER TABLE satellite_centers ADD COLUMN coordinate VARCHAR(150) NULL AFTER barangay_id",
    "ALTER TABLE satellite_centers ADD COLUMN map TEXT NULL AFTER coordinate"
];

foreach ($queries as $q) {
    if ($mysqli->query($q)) {
        echo "Success: $q\n";
    } else {
        echo "Error: " . $mysqli->error . " for $q\n";
    }
}
$mysqli->close();
?>
