<!DOCTYPE html>
<html lang="hu">
<?php require_once "oop.php"; ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GyakoriKérdések</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css'/>
    <link rel="stylesheet" href="/stilus/styles.css">
</head>
<body>
    <?php //itt daraboltuk fel a layoutot
        require_once "menusav.php";
    ?>
    <div id="container">
    <?php  
        require_once "balsav.php";
        require_once "$view.php"; 
        require_once "jobbsav.php";
    ?>
    </div>
    
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/additional-methods.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <script src="/script/regform.js"></script>
    <script src="/script/belepform.js"></script>
    <script src="/script/ukcimkek.js"></script>
    <script src="/script/ujkerdesform.js"></script>
    <script src="/script/valaszelkuld.js"></script>
</body>
</html>