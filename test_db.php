<?php
$mysqli = new mysqli('localhost', 'root', '', 'liberchain');
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

ob_start();
function dump_table($mysqli, $table) {
    echo "=== Table: $table ===\n";
    $res = $mysqli->query("DESCRIBE $table");
    while ($row = $res->fetch_assoc()) {
        printf("%-20s %-20s %-5s %-5s %-15s %s\n", 
            $row['Field'], $row['Type'], $row['Null'], $row['Key'], 
            $row['Default'] === null ? 'NULL' : $row['Default'], $row['Extra']);
    }
    echo "\n";
}

dump_table($mysqli, 'tb_kurir');
$output = ob_get_clean();
file_put_contents('schema_dump.txt', $output);
$mysqli->close();
echo "Schema written to schema_dump.txt";
