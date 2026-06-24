<?php
$mysqli = new mysqli('localhost', 'root', '', 'liberchain');
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}
$res = $mysqli->query('SELECT id_user, username, email, password, role FROM tb_user');
if ($res) {
    while ($row = $res->fetch_assoc()) {
        echo "ID: {$row['id_user']} | Username: {$row['username']} | Email: {$row['email']} | Password (MD5 hash): {$row['password']} | Role: {$row['role']}\n";
    }
} else {
    echo "Query error: " . $mysqli->error . "\n";
}
?>
