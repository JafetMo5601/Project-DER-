<?php

function conectarBD(){ 

    $server = "localhost";
    $usuario = "ProjectDER";
    $pass = "ProjectDER";
    $BD = "System_Recognition";

    $conexion = mysqli_connect($server, $usuario, $pass, $BD); 

    if(!$conexion){ 

       echo 'Ha sucedido un error inexperado en la conexion de la base de datos<br>'; 

    } 

    return $conexion; 

}  

function desconectarBD($conexion){

    $close = mysqli_close($conexion); 

    if(!$close){  

        echo 'Ha sucedido un error inexperado en la desconexion de la base de datos<br>'; 

    }    

    return $close;         

}

function getArraySQL($sql){
      
    $conexion = conectarBD();
        
    if(!$result = mysqli_query($conexion, $sql)) die();

    $rawdata = array();
    $i=0;
        
    while($row = mysqli_fetch_array($result)){   

        $rawdata[$i] = $row;
        $i++;
    
    }

    desconectarBD($conexion);

    return $rawdata;

}


$sql = "SELECT ID, Date, Temperature, Humidity, Heat_Index, Hydrogen, Carbon_Monoxide, CO_Ratio, Metane, Propane from Recognition_Data;";

$rawdata = getArraySQL($sql);


for($i=0;$i<count($rawdata);$i++){

    $time = $rawdata[$i]["Date"];
    $date = new DateTime($time);
    $rawdata[$i]["Date"]=$date->getTimestamp()*1000;
    
}

?>


<html lang="en">

<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="./RS.css">
<link rel="stylesheet" href="Icon/Icon.css">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">﻿
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<!-- Latest compiled and minified JavaScript -->
<script src="https://code.jquery.com/jquery.js"></script>
    <!-- Importo el archivo Javascript de Highcharts directamente desde su servidor -->
<script src="http://code.highcharts.com/stock/highstock.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>


<head>

    <title>System Recognition</title>
    <link rel="shortcut icon" href="./Images/DER.ico">

</head>

<body>

        <div class="Header-with-Icons">
            
            <header class="Header">

                <img src="../Images/Logo.jpg" class="Logo_Project" alt="Project Logo" width="252.5" height="98.75">
                <img src="../Images/Logo_Fire.png" class="Logo_Bomberos" alt="Bomberos Logo" width="293.75" height="116.75">
            
            </header>

            <nav id="Displeceable">
                
                <ul class="Menu">
                    <li><a href="../../Main.php"><span class="Home"><i class="Icon icon-home"></i></span>  Home</a></li>
                    <li><a href=""><span class="RS"><i class="Icon icon-chart-line"></i></span>  Recognition System</a>
                    <li><a href="https://localhost/phpmyadmin" target="blank"><span class="DB"><i class="Icon icon-chart-pie"></i></span>  Data Base</a>   
                    <li><a href="../../Logout.php"><span class="Exit"><i class="Icon icon-logout"></i></span>  Exit</a>
                </ul>   

            </nav>

            <nav id="Icons">
                
                <a href="https://www.instagram.com/project.der/"><span class="Social-Icons icon-instagrem"></span></a>
                <a href="https://www.facebook.com/project.der/"><span class="Social-Icons icon-facebook"></span></a>
                <a href=""><span class="Social-Icons icon-twitter"></span></a>
                <a href=""><span class="Social-Icons icon-mail"></span></a>

            </nav>

        </div>

        <div style="min-width: 400px; height: 170px; margin: 0 auto;"></div>

        <div id="container" style="min-width: 400px; height: 400px; margin: 0 auto;"></div>
            
            <script type='text/javascript'>
            $(function () {
                $(document).ready(function() {
                    Highcharts.setOptions({
                        global: {
                            useUTC: false
                        }
                    });
                
                    var chart;
                    $('#container').highcharts({
                        chart: {
                            type: 'spline',
                            animation: Highcharts.svg, // don't animate in old IE
                            marginRight: 10,
                            events: {
                                load: function() {
                                    
                                }
                            }
                        },
                        title: {
                            text: ' '
                        },
                        xAxis: {
                            type: 'datetime',
                            tickPixelInterval: 150
                        },
                        yAxis: {
                            title: {
                                text: 'Values'
                            },
                            plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#fff'
                            }]
                        },
                        tooltip: {
                            formatter: function() {
                                    return '<b>'+ this.series.name +'</b><br/>'+
                                    Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                                    Highcharts.numberFormat(this.y, 2);
                            }
                        },
                        legend: {
                            enabled: true
                        },
                        exporting: {
                            enabled: true
                        },
                        series: [{
                            name: 'Temperature',
                            data: (function() {
                               var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Temperature"];?>]);
                                <?php } ?>
                            return data;
                            })()
                        },{
                            name: 'Humidity',
                                 data: (function() {
                                    var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Humidity"];?>]);
                                <?php } ?>
                            return data;
                                 })() 
                        },{
                            name: 'Heat_Index',
                                 data: (function() {
                                    var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Heat_Index"];?>]);
                                <?php } ?>
                            return data;
                                 })() 
                        },{
                            name: 'Hydrogen',
                                 data: (function() {
                                    var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Hydrogen"];?>]);
                                <?php } ?>
                            return data;
                                 })() 
                        },{
                            name: 'Carbon_Monoxide',
                                 data: (function() {
                                    var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Carbon_Monoxide"];?>]);
                                <?php } ?>
                            return data;
                                 })() 
                        },{
                            name: 'Metane',
                                 data: (function() {
                                    var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Metane"];?>]);
                                <?php } ?>
                            return data;
                                 })() 
                        },{
                            name: 'Propane',
                                 data: (function() {
                                     var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Propane"];?>]);
                                <?php } ?>
                            return data;
                                 })()     
                        }]
                    });
                });
                
            });


            </script>

        <div id="Container">

            <!--<script type='text/javascript'>
            $(function () {
                $(document).ready(function() {
                    Highcharts.setOptions({
                        global: {
                            useUTC: false
                        }
                    });
                
                    var chart;
                    $('#container').highcharts({
                        chart: {
                            type: 'spline',
                            animation: Highcharts.svg, // don't animate in old IE
                            marginRight: 10,
                            events: {
                                load: function() {
                                    
                                }
                            }
                        },
                        title: {
                            text: 'System Recognition'
                        },
                        subtitle: {
                            text: 'by Project DER developers.'
                        },
                        xAxis: {
                            type: 'datetime',
                            tickPixelInterval: 150
                        },
                        yAxis: {
                            title: {
                                text: 'Values'
                            },
                            plotLines: [{
                                value: 0,
                                width: 1,
                                color: '#808080'
                            }]
                        },
                        tooltip: {
                            formatter: function() {
                                    return '<b>'+ this.series.name +'</b><br/>'+
                                    Highcharts.dateFormat('%Y-%m-%d %H:%M:%S', this.x) +'<br/>'+
                                    Highcharts.numberFormat(this.y, 2);
                            }
                        },
                        legend: {
                            enabled: true
                        },
                        exporting: {
                            enabled: true
                        },
                        series: [{
                            name: 'Temperature',
                            data: (function() {
                               var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Temperature"];?>]);
                                <?php } ?>
                            return data;
                            })()
                        },{
                            name: 'Humidity',
                                 data: (function() {
                                    var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Humidity"];?>]);
                                <?php } ?>
                            return data;
                                 })() 
                        },{
                            name: 'Heat_Index',
                                 data: (function() {
                                    var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Heat_Index"];?>]);
                                <?php } ?>
                            return data;
                                 })() 
                        },{
                            name: 'Hydrogen',
                                 data: (function() {
                                    var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Hydrogen"];?>]);
                                <?php } ?>
                            return data;
                                 })() 
                        },{
                            name: 'Carbon_Monoxide',
                                 data: (function() {
                                    var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Carbon_Monoxide"];?>]);
                                <?php } ?>
                            return data;
                                 })() 
                        },{
                            name: 'Metane',
                                 data: (function() {
                                    var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Metane"];?>]);
                                <?php } ?>
                            return data;
                                 })() 
                        },{
                            name: 'Propane',
                                 data: (function() {
                                     var data = [];
                                <?php
                                    for($i = 0 ;$i<count($rawdata);$i++){
                                ?>
                                data.push([<?php echo $rawdata[$i]["Date"];?>,<?php echo $rawdata[$i]["Propane"];?>]);
                                <?php } ?>
                            return data;
                                 })()     
                        }]
                    });
                });
                
            });


            </script>-->

        </div>
        
        <footer class="Footer">

            <a href="https://www.instagram.com/project.der/"><span class="Social-Icons icon-instagrem"></span></a>
            <a href="https://www.facebook.com/project.der/"><span class="Social-Icons icon-facebook"></span></a>
            <a href=""><span class="Social-Icons icon-twitter"></span></a>
            <a href=""><span class="Social-Icons icon-mail"></span></a>

            &copy; 2019 Project DER. All rights reserved.

        </footer>

</body>

</html>
