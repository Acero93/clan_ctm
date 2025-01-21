<?php

Flight::set('flight.views.path', dirname(__DIR__) . '/views');



// Rutas de ejemplo


Flight::route('GET /', function() {

    Flight::render('landing/landing.php', ['title' => 'Inicio', 'js' => 'clients.js']);
    // Flight::render('layout/sidebar', );
});


// Flight::route('GET /base', function() {

//     Flight::render('base.php', ['title' => 'Inicio', 'js' => 'clients.js']);
   
// });

Flight::route('GET /base', function() {

    $membersView = "ingame_list/ingame_players.php";
    $footerView = "";
    Flight::render('base.php', [
        'title' => 'Miembros', 
        'content' =>$membersView , 
        'footer' => $footerView,
        'styles' => [
            '/assets/css/members.css',
            'https://cdnjs.cloudflare.com/ajax/libs/tabulator/6.3.0/css/tabulator_bootstrap5.min.css',
            'https://unpkg.com/tabulator-tables@6.3.0/dist/css/tabulator.min.css',
        ],
        'scripts' => [
            'https://unpkg.com/tabulator-tables@6.3.0/dist/js/tabulator.min.js', // Librería necesaria para esta vista
            '/assets/js/members.js',
        ]
    ]);

});


// Miembros


Flight::route('GET /miembros/ver', function() {

    $clientsView = "../src/views/clients/clients.php";
    $footerView = "";
    Flight::render('base.php', [
        'title' => 'Miembros', 
        'content' =>$clientsView , 
        'footer' => $footerView,
        'styles' => [
            '/assets/css/clients.css',
            'https://cdnjs.cloudflare.com/ajax/libs/tabulator/6.3.0/css/tabulator_bootstrap5.min.css',
            'https://unpkg.com/tabulator-tables@6.3.0/dist/css/tabulator.min.css',
        ],
        'scripts' => [
            'https://unpkg.com/tabulator-tables@6.3.0/dist/js/tabulator.min.js', // Librería necesaria para esta vista
            '/assets/js/clients.js',
        ]
    ]);

});


Flight::route('GET /miembros/ver/@id', function($id) {

    $clientsView = "../src/views/clients/clientDetail.php";
    $footerView = "";
    Flight::render('base.php', [
        'title' => 'Cliente Detallado', 
        'content' =>$clientsView , 
        'footer' => $footerView,
        'styles' => [
            '/assets/css/clients.css',
        ],
        'scripts' => [
            '/assets/js/clients.js',
        ],
        'client_id' => $id,
    ]);

});

Flight::route('GET /miembros/agregar', function() {

    $clientsAdd = "../src/views/clients/clientAdd.php";
    $footerView = "";
    Flight::render('base.php', [
        'title' => 'Agregar Cliente', 
        'content' =>$clientsAdd , 
        'footer' => $footerView,
        'styles' => ['/assets/css/clients.css'],
        'scripts' => ['/assets/js/clients.js']
    ]);
});







Flight::route('GET /about', function() {
    Flight::render('about.php', ['title' => 'Sobre Nosotros']);
});


// Rutas fijas

Flight::route('GET /login', function() {
    Flight::render('login.php', ['title' => 'Login del amor']);
});




// CTM Web vistas

Flight::route('GET /CTM', function() {
    // Flight::render('main/index.php', ['title' => 'CTM Web']);
    $content = "main.php";


    Flight::render('main/index.php', [
        'title' => 'Inicio', 
        'active' => 'CTM',
        'content' =>$content,
        'styles' => "/assets/css/main/styles.css",
    ]);
});


Flight::route('GET /miembrosCTM', function() {

    $content = "members.php";


    Flight::render('main/index.php', [
        'title' => 'Miembros CTM', 
        'active' => 'CTM',
        'content' =>$content,
        'styles' => ["/assets/css/main/styles.css"],
        'scripts' => ["/assets/js/main/members.js"]
    ]);
}); 