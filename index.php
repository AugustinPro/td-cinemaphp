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
    'base_uri' => API_URL
]);

//https://docs.guzzlephp.org/en/stable/quickstart.html#using-responses

// Voir une meilleure construction avec $client->request('GET', $url = API_URL, $options = Array() );
// $options = [
//     'api_key' => API_KEY,
//     'language' => LANGUAGE,
//     'id' => 550
// ];
// Exemple de requête de film by ID (id = 550)
// $request = API_URL.'movie/550?api_key='.API_KEY.'&language='.LANGUAGE;

// Exemple de requête globale
$request = API_URL.'movie/popular?api_key='.API_KEY.'&sort_by=popularity.desc&language='.LANGUAGE;

// Appel à l'API TMDB via Guzzle
$response = $client->get($request);
// $client->request('GET', API_URL, $option );

// Entête de la réponse
// echo $response->getHeader('content-type')[0];

// Corps de réponse
$body_response = $response->getBody();

// Le corsp de réponse est converti en string
$body_response = $body_response->getContents();

// Le json est converti en un objet PHP
// Pour accéder à une propriété de l'objet PHP, on écrit : $objet->propriete
$body_response = json_decode($body_response);

// echo '<pre>';

// Réponse obtenue

// print_r($body_response->results[0]);

// echo '</pre>';

// https://www.themoviedb.org/talk/53c11d4ec3a3684cf4006400?language=fr-FR
// echo '<img src="https://image.tmdb.org/t/p/original/'. $body->backdrop_path.' " >';

?>
<!-- <?php /*foreach ($body_response->results as $index => $film) {
   echo $film->title.'<br>';
}*/
?> -->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AlloCiné 2.0</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

</head>
<body>
    <header>
        <nav class="navbar navbar-dark bg-dark pb-2">
            <div class="container-fluid">
                <h1 class="navbar-text">AlloCiné 2.0</h1>
            </div>
        </nav>
    </header>
    <main class="bg-dark">
        <div class="container">
            <div class="row">
                <?php foreach ($body_response->results as $index => $film) : ?>
                <div class="col">
                    <div class="card mt-4" style="width: 18rem;">
                        <img src="https://image.tmdb.org/t/p/original/<?= $film->poster_path; ?>" class="card-img-top" alt="<?= $film->title ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $film->title; ?></h5>
                            <p class="card-text"><?php 
                                $overview = $film->overview;
                                if (strlen($overview) > 200)
                                    {
                                        $overview = substr($overview, 0, 200);
                                        $overview = explode(' ', $overview);
                                        array_pop($overview); // remove last word from array
                                        $overview = implode(' ', $overview);
                                        $overview = $overview . ' ...';
                                    }
                                echo $overview ?></p>
                        </div>
                    </div>
                </div>
                <?php endforeach ?>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>
</html>