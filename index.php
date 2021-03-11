<?php  

require_once 'vendor/autoload.php';

//My TMDB API key
define('API_KEY', '4d99948a1ac7d10033d3d485c1a1bb61');
//Global variable used to have the language of the infos called by the api to be in french
define('LANGUAGE','fr');
//Base url for he api database for images, text, etc.
define('API_URL','https://api.themoviedb.org/3/');

// Making a call function for guzzle

$client = new GuzzleHttp\Client([
    // Base URI is used with relative requests
    'base_uri' => 'API_URL',
    // You can set any number of default request options.
    'timeout'  => 2.0,
]);



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>