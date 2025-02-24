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

    $view = "events/events.php";
    $footerView = "";
    Flight::render('base.php', [
        'title' => 'Eventos', 
        'content' =>$view , 
        'footer' => $footerView,
        'styles' => [
            'https://cdnjs.cloudflare.com/ajax/libs/tabulator/6.3.0/css/tabulator_bootstrap5.min.css',
            'https://unpkg.com/tabulator-tables@6.3.0/dist/css/tabulator.min.css',
        ],
        'scripts' => [
            'https://unpkg.com/tabulator-tables@6.3.0/dist/js/tabulator.min.js', // Librería necesaria para esta vista
         
        ]
    ]);

    // Flight::render('base.php', [
    //     'title' => 'Miembros', 
    //     'content' =>$eventsView , 
    //     'footer' => $footerView,
    //     'styles' => [
    //         'public/assets/css/members.css',
    //         'https://cdnjs.cloudflare.com/ajax/libs/tabulator/6.3.0/css/tabulator_bootstrap5.min.css',
    //         'https://unpkg.com/tabulator-tables@6.3.0/dist/css/tabulator.min.css',
    //     ],
    //     'scripts' => [
    //         'https://unpkg.com/tabulator-tables@6.3.0/dist/js/tabulator.min.js', // Librería necesaria para esta vista
         
    //     ]
    // ]);

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




//  Web vistas

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


Flight::route('GET /herramientas/mapa_tactico', function() {

    $content = "mapa/mapa_tactico.php";


    Flight::render('base.php', [
        'title' => 'Mapa Táctico', 
        'active' => 'CTM',
        'content' =>$content,
        'styles' => ["../public/assets/css/main/styles.css"],
        'scripts' => ["assets/js/mapa_tactico.js"]
    ]);
}); 




// EVENTOS

Flight::route('GET /eventos/ver', function() {
    
    $view = "events/events.php";
    $footerView = "";
    Flight::render('base.php', [
        'title' => 'Eventos', 
        'content' =>$view , 
        'footer' => $footerView,
        'styles' => [
            'https://cdnjs.cloudflare.com/ajax/libs/tabulator/6.3.0/css/tabulator_bootstrap5.min.css',
            'https://unpkg.com/tabulator-tables@6.3.0/dist/css/tabulator.min.css',
        ],
        'scripts' => [
            'https://unpkg.com/tabulator-tables@6.3.0/dist/js/tabulator.min.js', // Librería necesaria para esta vista
         
        ]
    ]);

});

Flight::route('GET /eventos/asistencia', function() {
    
    $view       = "events/events_attendance.php";
    $footerView = "";
    Flight::render('base.php', [
        'title' => 'Eventos', 
        'ForeignView' => true,
        'content' =>$view , 
        'footer' => $footerView,
        'styles' => [
            'https://cdnjs.cloudflare.com/ajax/libs/tabulator/6.3.0/css/tabulator_bootstrap5.min.css',
            'https://unpkg.com/tabulator-tables@6.3.0/dist/css/tabulator.min.css',
        ],
        'scripts' => [
            'https://unpkg.com/tabulator-tables@6.3.0/dist/js/tabulator.min.js', // Librería necesaria para esta vista
         
        ]
    ]);

});