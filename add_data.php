<?php
    // Connect to MySQL
    include("Conexao/dbconnect.php");

    $entrada=$_GET['serial'];
    $array=explode(",",$entrada);
    
    $identificador=$array[0];
    $temperatura_sup=$array[1]/100;
    $temperatura_inf=$array[2]/100;
    $ph=$array[3]/100;
    $oxigenio=$array[4]/100;
    
    // Prepare the SQL statement
    //$SQL = "INSERT INTO test.temperature (sensor ,celsius) VALUES ('".$_GET["serial"]."', '".$_GET["temperature"]."')";    
    $SQL = "INSERT INTO dados (identificador,
                               temperatura_sup,
                               temperatura_inf,
                               ph,
                               oxigenio,
                               data_dado) 
                               VALUES ('$identificador',"
                                        ."'$temperatura_sup',"
                                        ."'$temperatura_inf',"
                                        ."'$ph',"
                                        ."'$oxigenio',"
                                        ."now())"; 
    // Execute SQL statement
   pg_query($SQL);

    // Go to the review_data.php (optional)
    header("Location: review_data.php");
?>