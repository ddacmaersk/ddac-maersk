<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:ddac-sql-apu-sea.database.windows.net,1433; Database = ddac-sql-apu-sea", "ddac-admin", "Password123");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "ddac-admin@ddac-sql-apu-sea", "pwd" => "Password123", "Database" => "ddac-sql-apu-sea", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:ddac-sql-apu-sea.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);