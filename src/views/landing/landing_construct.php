<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Uranium - HLL - Chile</title>
    <!-- Favicon -->
    <link rel="icon" type="image/png" href="https://i.imgur.com/JRi5mVt.png">
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
            transition: opacity 20s ease-in-out; 
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

    </style>
</head>
<body>
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


    <audio id="miAudio">
        <source src="public/assets/audios/uranium_1_noche_oscura.mp3" type="audio/mpeg">
        Tu navegador no soporta el elemento de audio.
    </audio>

    <!-- Bootstrap 5 JS (opcional, si necesitas funcionalidades de BS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>


        var imgContainer = document.querySelector('.img-container');
        imgContainer.classList.add('fade-in');

        window.addEventListener('DOMContentLoaded', () => {


            const audio = document.getElementById('miAudio');
            audio.play().catch(error => {
                console.error("El navegador bloqueó la reproducción automática: ", error);
            });

        });





    </script>

</body>
</html>