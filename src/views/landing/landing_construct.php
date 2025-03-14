<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uranium - HLL - Chile</title>
    <base href="<?php echo $_ENV['HOST_WEB'] ?>">
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://i.imgur.com/3jRip24.png">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Font: Bebas Neue (estilo militar) -->
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">



    <style>
        body {
            background-color: #000;
            color: #2b3e42;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            font-family: 'Bebas Neue', sans-serif;
        }
        .construction-text {
            font-size: 3.5rem;
            font-weight: bold;
            text-align: center;
            margin-top: 20px;
            animation: glow 1.5s infinite alternate;
            letter-spacing: 3px;
        }
        @keyframes glow {
            from {
                text-shadow: 0 0 10px #fff, 0 0 20px #fff, 0 0 30px #040403, 0 0 40px #ffeb3b, 0 0 50px #ffeb3b, 0 0 60px #ffeb3b, 0 0 70px #ffeb3b;
            }
            to {
                text-shadow: 0 0 20px #fff, 0 0 30px #ffeb3b, 0 0 40px #716d47, 0 0 50px #ffeb3b, 0 0 60px #dc3545, 0 0 70px #a09219, 0 0 80px #b6af6e;
            }
            
        }
        .img-container {
            animation: float 3s ease-in-out infinite;
            margin-top: -15vh;
            opacity: 0; 
            transition: opacity 15s ease-in-out; 
        }

    
        .img-container.fade-in {
            opacity: 1; 
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        .nuclear-theme {
            text-transform: uppercase;
        }
        .subtext {
            font-size: 1.8rem;
            margin-top: 10px;
            color: #ffeb3b;
            letter-spacing: 2px;
            display: inline-block;
        }
        .subtext span {
            display: inline-block;
            animation: zoom 0.5s ease-in-out infinite alternate;
            animation-delay: calc(0.1s * var(--i));
        }
        @keyframes zoom {
            0% {
                transform: scale(1);
            }
            100% {
                transform: scale(1.2);
            }
        }
        .highlight {
            color: #ffeb3b;
            font-weight: bold;
        }


        /* iconos */
        .social-icons {
            text-align: center;
        }
        .social-icon {
            text-decoration: none;
            display: inline-block; /* Asegura que el hover funcione correctamente */
        }
        .social-icon i {
            font-size: 4rem; /* Tamaño inicial */
            color: #ffcc00;
            transition: all 0.3s ease; /* Transición suave para todos los efectos */
            animation: glow-icon 1.5s infinite alternate, heartbeat 1.5s infinite; /* Efecto de brillo y heartbeat */
        }
        @keyframes glow-icon {
            from {
                text-shadow: 0 0 5px rgba(255, 235, 59, 0.5), 0 0 10px rgba(255, 235, 59, 0.5), 0 0 20px rgba(255, 235, 59, 0.5);
            }
            to {
                text-shadow: 0 0 10px rgba(255, 235, 59, 0.5), 0 0 20px rgba(255, 235, 59, 0.5), 0 0 30px rgba(255, 235, 59, 0.5);
            }
        }
        @keyframes heartbeat {
            0%, 100% {
                transform: scale(1); /* Tamaño normal */
            }
            50% {
                transform: scale(1.2); /* Aumenta ligeramente el tamaño */
            }
        }
        .social-icon:hover i {
            color: #ffeb3b; /* Color más brillante al hacer hover */
            font-size: 10rem; /* Tamaño más grande en hover */
            text-shadow: 0 0 20px rgba(255, 235, 59, 0.8), 0 0 40px rgba(255, 235, 59, 0.8), 0 0 60px rgba(255, 235, 59, 0.8); /* Brillo más intenso */
            animation: none; /* Detiene el efecto heartbeat en el hover */
        }

        .img-fluid{
            margin-top: 10%;
            width: 34%;
            margin-bottom: 5%;
        }

        .icon_ {
            color: #2b3f41 !important; 
            transition: all 0.3s ease;
        }


        /* Estilos para las explosiones */
        /* Estilos para las explosiones */
        .explosion {
            position: absolute;
            width: 200px; /* Tamaño más grande */
            height: 200px;
            background: radial-gradient(
                circle,
                rgba(255, 200, 50, 0.3) 0%, /* Amarillo translúcido */
                rgba(255, 150, 0, 0.2) 50%, /* Naranja translúcido */
                rgba(255, 100, 0, 0.1) 100% /* Rojo translúcido */
            );
            border-radius: 50%; /* Forma circular */
            opacity: 0; /* Inicialmente invisible */
            animation: explosion 3s ease-out infinite; /* Animación más lenta */
            transform: scale(0); /* Comienza pequeño */
        }

        /* Animación de explosión */
        @keyframes explosion {
            0% {
                opacity: 0.3; /* Opacidad inicial */
                transform: scale(0);
            }
            50% {
                opacity: 0.2; /* Opacidad media */
                transform: scale(1.5); /* Crecimiento máximo */
            }
            100% {
                opacity: 0; /* Desvanecimiento total */
                transform: scale(2); /* Tamaño final */
            }
        }



        /* Contenedor del GIF de humo */
        .humo-container {
            position: fixed;
            bottom: 0; /* Coloca el GIF en la parte inferior */
            left: 0;
            width: 100%; /* Ocupa todo el ancho de la pantalla */
            z-index: 0; /* Asegura que el humo esté detrás del contenido */
            overflow: hidden; /* Evita desbordamientos */
        }

        /* Contenedor del video de fondo */
        .video-container {
            position: fixed; /* Fija el video en la pantalla */
            top: 0;
            left: 0;
            width: 100%; /* Ocupa todo el ancho */
            height: 100%; /* Ocupa todo el alto */
            z-index: -2; /* Coloca el video detrás del contenido */
            overflow: hidden; /* Evita desbordamientos */
        }

        /* Estilos para el video de fondo */
        .video-fondo {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Ajusta el video para cubrir todo el contenedor */
            opacity: 0.5; /* Transparencia del 50% */
        }


    </style>
</head>
<body>


    <div id="efecto-explosiones"></div>
    

    <div class="container text-center">
        <div class="img-container">
            <img src="https://i.imgur.com/3jRip24.png" alt="Uranium - Sitio en Construcción" class="img-fluid">
        </div>
        <div class="construction-text nuclear-theme">
            URANIUM: !EL FRENTE ESTÁ ACTIVO!
        </div>
        <div class="subtext">
            <!-- Cada letra envuelta en un span con un delay calculado -->
            <span style="--i: 0">P</span>
            <span style="--i: 1">r</span>
            <span style="--i: 2">e</span>
            <span style="--i: 3">p</span>
            <span style="--i: 4">á</span>
            <span style="--i: 5">r</span>
            <span style="--i: 6">a</span>
            <span style="--i: 7">t</span>
            <span style="--i: 8">e</span>
            <span style="--i: 9"> </span>
            <span style="--i: 10">p</span>
            <span style="--i: 11">a</span>
            <span style="--i: 12">r</span>
            <span style="--i: 13">a</span>
            <span style="--i: 14"> </span>
            <span style="--i: 15">e</span>
            <span style="--i: 16">l</span>
            <span style="--i: 17"> </span>
            <span style="--i: 18">c</span>
            <span style="--i: 19">o</span>
            <span style="--i: 20">m</span>
            <span style="--i: 21">b</span>
            <span style="--i: 22">a</span>
            <span style="--i: 23">t</span>
            <span style="--i: 24">e</span>
            <span style="--i: 25"> </span>
            <span style="--i: 26">m</span>
            <span style="--i: 27">á</span>
            <span style="--i: 28">s</span>
            <span style="--i: 29"> </span>
            <span style="--i: 30">i</span>
            <span style="--i: 31">n</span>
            <span style="--i: 32">t</span>
            <span style="--i: 33">e</span>
            <span style="--i: 34">n</span>
            <span style="--i: 35">s</span>
            <span style="--i: 36">o</span>
        </div>

        <div class="social-icons mt-4">
            <a href="https://www.facebook.com/groups/1115060145604499" target="_blank" class="social-icon me-3">
                <i class="bi bi-facebook icon_" ></i>
            </a>
            <a href="https://discord.uraniumhll.cl/" target="_blank" class="social-icon">
                <i class="bi bi-discord icon_" ></i>
            </a>
        </div>

    </div>


    <div class="video-container">
        <video autoplay loop muted class="video-fondo">
            <source src="https://i.imgur.com/hcGhnJT.mp4" type="video/mp4">
            Tu navegador no soporta videos.
        </video>
    </div>

    <div id="youtube-player"></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>


        var imgContainer = document.querySelector('.img-container');
        imgContainer.classList.add('fade-in');

        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        var player;

        function onYouTubeIframeAPIReady() {
            player = new YT.Player('youtube-player', {
                height: '0',
                width: '0',  
                videoId: 'Pb9cOAnw6Y4', 
                playerVars: {
                    autoplay: 1,       
                    controls: 0,       
                    modestbranding: 1, 
                    rel: 0,            
                    enablejsapi: 1,     
                    start: 9   
                },
                events: {
                    'onReady': onPlayerReady
                }
            });
        }

        // Función que se ejecuta cuando el reproductor está listo
        function onPlayerReady(event) {
            event.target.playVideo(); // Reproducir el video
        }


        // Función para crear una explosión
        function crearExplosion() {
            const explosion = document.createElement('div');
            explosion.classList.add('explosion');

            // Posición aleatoria en la pantalla
            const x = Math.random() * window.innerWidth;
            const y = Math.random() * window.innerHeight;
            explosion.style.left = `${x}px`;
            explosion.style.top = `${y}px`;

            // Tamaño aleatorio (entre 150px y 300px)
            const tamaño = Math.random() * 900 + 900;
            explosion.style.width = `${tamaño}px`;
            explosion.style.height = `${tamaño}px`;

            // Duración aleatoria de la animación (entre 2 y 4 segundos)
            const duracion = Math.random() * 4 + 2;
            explosion.style.animationDuration = `${duracion}s`;

            // Añadir la explosión al contenedor
            document.getElementById('efecto-explosiones').appendChild(explosion);

            // Eliminar la explosión después de que termine la animación
            setTimeout(() => {
                explosion.remove();
            }, duracion * 1000);
        }

        // Crear explosiones de forma continua
        function iniciarExplosiones() {
            setInterval(crearExplosion, 3500); // Crear una explosión cada segundo
        }

        // Iniciar el efecto cuando la página cargue
        window.onload = iniciarExplosiones;



    </script>

</body>
</html>