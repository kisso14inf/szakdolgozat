<!DOCTYPE html>
<html lang="hu">
<?php require_once "oop.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GyakoriKérdések</title>
    
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css'/>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
    
    
</head>
<style>
<?php
    //Ha nem include-olom, akkor nem működik
    include "styles.css";
    ?>    
</style>
<body>
    <?php //itt daraboltuk fel a layoutot
        $statisztika = StatVanMa();
       
        require_once "menusav.php";
        require_once "balsav.php";
        require_once "$view.php"; 
        require_once "jobbsav.php";
        //require_once "lablec.php";
        
        //Ha scriptként teszem be
        //úgy nem működik ez
        require_once "regform.js";
        require_once "belepform.js";
    ?>
    

</body>
</html>