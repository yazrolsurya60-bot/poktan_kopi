<?php
$mysqli = new mysqli('localhost', 'root', '', 'liberchain');
if ($mysqli->connect_errno) {
    echo 'Failed to connect to MySQL: ' . $mysqli->connect_error;
    exit;
}
$result = $mysqli->query('DESCRIBE tb_petani');
while ($row = $result->fetch_assoc()) {
    echo $row['Field'] . ' (' . $row['Type'] . ")\n";
}
