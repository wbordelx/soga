<?php
    // Start MySQL Connection
    include('../Conexao/dbconnect.php');
?>

<html>
<head>
    <link href="../css/Flat-UI-master/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/Flat-UI-master/dist/css/vendor/bootstrap/css/estilo.css" rel="stylesheet">
    <!-- Loading Flat UI -->
    <link href="../css/Flat-UI-master/dist/css/flat-ui.css" rel="stylesheet">

    <link rel="shortcut icon" href="../../dist/img/favicon.ico">
    
    <title>Ultima Leitura de Cada Sensor da Propriedade</title>
    <style type="text/css">
        .table_titles, .table_cells_odd, .table_cells_even {
                padding-right: 20px;
                padding-left: 20px;
                color: #000;
        }
        .table_titles {
            color: #FFF;
            background-color: #666;
        }
        .table_cells_odd {
            background-color: #CCC;
        }
        .table_cells_even {
            background-color: #FAFAFA;
        }
        table {
            border: 2px solid #333;
        }
        body { font-family: "Trebuchet MS", Arial; }
    </style>
</head>

<body>      
    <h1>Última Leitura de Cada Sensor da Propriedade</h1>
<table border="0" cellspacing="0" cellpadding="4">
        <tr>            
            <td class="table_titles">Identificador</td>
            <td class="table_titles">Temperatura Água Superior</td>
            <td class="table_titles">Temperatura Água Submerso</td>
            <td class="table_titles">PH</td>
            <td class="table_titles">Oxigênio</td>
            <td class="table_titles">Data da Coléta</td>           
        </tr>
<?php
    // Retrieve all records and display them
    if($_GET["identificador"]!=null && $_GET["identificador"]!=""){
        $result = pg_query("SELECT * FROM dados where identificador='".$_GET["identificador"]."'ORDER BY identificador ASC");
    }else{
         $result = pg_query("SELECT * FROM dados ORDER BY identificador ASC");
    }
    // Used for row color toggle
    $oddrow = true;

    // process every record
    while( $row = pg_fetch_array($result) )
    {
        if ($oddrow)
        {
            $css_class=' class="table_cells_odd"';
        }
        else
        {
            $css_class=' class="table_cells_even"';
        }

        $oddrow = !$oddrow;

        echo '<tr>';
        echo '   <td'.$css_class.'>'.$row["identificador"].'</td>';
        echo '   <td'.$css_class.'>'.$row["temperatura_sup"].'</td>';
        echo '   <td'.$css_class.'>'.$row["temperatura_inf"].'</td>';
        echo '   <td'.$css_class.'>'.$row["ph"].'</td>';
        echo '   <td'.$css_class.'>'.$row["oxigenio"].'</td>';
        echo '   <td'.$css_class.'>'.$row["data_dado"].'</td>';
        echo '</tr>';
    }
?>
    </table>
    </body>
</html>

