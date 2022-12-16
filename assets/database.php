<?php
    function connect() {
        // $host = "127.0.0.1";
        $host = "localhost";
        $username = "jmorin_user";
        $password = "Jigglypants1";
        $database = "jmorin_mmda225_ecommerce";
        $connection = mysqli_connect($host, $username, $password, $database);
        if ($connection) {
          return $connection;
        } else {
          echo "Connection to database error : " . mysqli_connect_error() ;
        }
    }
    function db_query($con, $querystr) {
        $rows = [];
        $data = mysqli_query($con, $querystr);
        while ($row = mysqli_fetch_assoc($data)) {
            array_push($rows, $row);
        }
        return $rows;
    }
?>