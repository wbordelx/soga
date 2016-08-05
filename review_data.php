<?php
    // Start MySQL Connection
    include('Conexao/dbconnect.php');
?>

<html>
<head>
    <link href="css/Flat-UI-master/dist/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/Flat-UI-master/dist/css/vendor/bootstrap/css/estilo.css" rel="stylesheet">
    <!-- Loading Flat UI -->
    <link href="../../dist/css/flat-ui.css" rel="stylesheet">

    <link rel="shortcut icon" href="../../dist/img/favicon.ico">
<div class="btn-group btn-group-justified">
    <a class="btn btn-default" href="Relatorios/geral.php">Relatório Geral</a>
    <a class="btn btn-default" href="Cadastros/cad_produtor.php">Cadastro de Produtor</a>
      <a class="btn btn-default" href="#">Right</a>
</div>
   
    <title>Ultima Leitura de Cada Sensor da Propriedade</title>
    <style type="text/css">
        .table_titles, .table_cells_odd, .table_cells_even {
                padding-right: 20px;
                padding-left: 20px;
                color: #000;
        }
        .table_cells_odd {
            background-color: #ff0033;
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
        <?php
            // Retrieve all records and display them
            $result = pg_query("SELECT m.identificador, 
                                       m.ph,
                                       m.temperatura_sup, 
                                       m.temperatura_inf,
                                       m.ph,
                                       m.oxigenio,
                                       mx_data_dado 
                                 FROM ( SELECT identificador, MAX(data_dado) AS mx_data_dado  FROM dados GROUP BY identificador ) t 
                                 JOIN dados m ON m.identificador = t.identificador AND t.mx_data_dado = m.data_dado 
                                 ORDER BY m.identificador;");
            // Used for row color toggle
            $oddrow = true;

            // process every record
            while( $row = pg_fetch_array($result) )
            {               
                if($row["temperatura_sup"]==0 || $row["temperatura_inf"]==0 || $row["ph"]==0 || $row["oxigenio"]==0){            
                    $css_class=' class="table_cells_odd"';         
                }
                else
                {
                    $css_class=' class="table_cells_even"';
                }       
                echo '<a href="Relatorios/geral.php?identificador='.$row["identificador"].'">';
                echo '<div class="col-sm-6 col-md-4">';
                echo '<div class="thumbnail">';
                echo    '<div class="captionBlue">';
                echo        '<h3>'.$row["identificador"].'</h3>';
                      echo '   <p'.$css_class.'>Temperatura Superficie :<br>'.$row["temperatura_sup"].'°C</p>';
                      echo '   <p'.$css_class.'>Temperatura Submersso :<br>'.$row["temperatura_inf"].'°C</p>';
                      echo '   <p'.$css_class.'>Ph :<br>'.$row["ph"].'</p>';
                      echo '   <p'.$css_class.'>Oxigenio :<br>'.$row["oxigenio"].' mg/L</p>';
                      echo '   <p'.$css_class.'>Última Coleta :<br>'.$row["mx_data_dado"].'</p>';
                echo    '</div>';
                echo  '</div>';
                echo '</div>';
                echo '</a>';
            }
        ?>
    </body>
</html>