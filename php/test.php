<?php
$username = "cashcir1";
$password = "6gnn1Kn35W";
$hostname = "41.185.8.238"; 
$mydb = "cashcir1_exam"; 
$link = mysqli_connect($hostname, $username, $password, $mydb);
if (!$link) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

echo "Success: A proper connection to MySQL was made! The my_db database is great." . PHP_EOL;
echo "Host information: " . mysqli_get_host_info($link) . PHP_EOL;

mysqli_close($link);
?>