<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "loader";
$display_errors = false;

$connection_options = array(
    'disable_curl' => false,
    'local_cafile' => false,
    'force_ipv4' => false    // cURL only
);


// dsn - Data Source Name
// if you use MySQL, leave it as is
// more information:
// http://php.net/manual/en/pdo.construct.php
$dbdsn = "mysql:host=$dbhost;dbname=$dbname";


try {
    $pdosql = new PDO($dbdsn, $dbuser, $dbpass, array(PDO::ATTR_PERSISTENT => true,
                                                   PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
} catch(PDOException $e) {
    if ($display_errors) die("Can't connect to database: ".$e->getMessage());
    else die("Can't connect to database. Check your config or set \$display_errors = true; to see details.");
}



 ?>
