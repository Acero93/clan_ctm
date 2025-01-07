<?php

use Utils\Scraper;

// Flight::route('GET /scrape/titles', function () {


//     $url = Flight::request()->query->url; // Obtener el parámetro "url" de la query string

//     if (!$url) {
//         Flight::json(['error' => 'URL is required'], 400);
//         return;
//     }

//     $scraper = new Scraper();
//     $titles = $scraper->scrapeTitles($url);

//     Flight::json(['titles' => $titles]);
// });

// Flight::route('GET /scrape/links', function () {
//     $url = Flight::request()->query->url;

//     if (!$url) {
//         Flight::json(['error' => 'URL is required'], 400);
//         return;
//     }

//     $scraper = new Scraper();
//     $links = $scraper->scrapeLinks($url);

//     Flight::json(['links' => $links]);
// });

Flight::route('GET /scrape/test', function () {
    Flight::json(['error' => 'entrando'], 400);
});


Flight::route('GET /scrape/product-title', function () {
    // Obtener la URL desde la query string
    $url = Flight::request()->query->url;

    if (!$url) {
        Flight::json(['error' => 'URL is required'], 400);
        return;
    }

    // Crear una instancia del Scraper
    $scraper = new Scraper();
    
    // Extraer el título del producto
    $title = $scraper->scrapeProductTitle($url);

    if ($title) {
        Flight::json(['title' => $title]);
    } else {
        Flight::json(['error' => 'Could not extract product title'], 400);
    }
});