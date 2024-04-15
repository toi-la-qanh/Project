<?php

require "sql_connection.php";

if (isset ($_POST['name'])) {

    $Name = $_POST['name'];
    $query = connect_to_sql();
    $ExecQuery = $query->prepare("SELECT * FROM product WHERE name LIKE '{$Name}%'");
    $ExecQuery->execute();

    if ($ExecQuery->rowCount() > 0) {
        while ($row = $ExecQuery->fetch()) {
            echo "<p>" . $row["name"] . "</p>";
        }
    } else {
        echo "<p>No matches found</p>";
    }
}

?>