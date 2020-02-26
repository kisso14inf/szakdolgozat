<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GyakoriKérdések</title>
    
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css'/>
    
    
</head>
<style>
<?php  
    include "styles.css";
    ?>    
</style>
<body>
    <?php //itt daraboltuk fel a layoutot
        
        require_once "menusav.php";
        require_once "balsav.php";
        require_once "$view.php"; 
        require_once "jobbsav.php";
       // require_once "lablec.php";
    ?>
</body>
</html>