<?php

 
// az utvonal lekérdezése
$uri = $_SERVER["REQUEST_URI"] ?? '/'; //lehet hogy egy nem létező változóra hivatkozunk// '/'- a home-ot jelenti
$cleaned = explode("?", $uri) [0];


list($view, $data) = dispatch($cleaned, 'notFoundController');
extract($data);

//--------------------------------------------------
