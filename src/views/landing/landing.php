<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <!-- Incluye los estilos de Fancybox -->
    <link href="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.css" rel="stylesheet">


    
    <link rel="shortcut icon" href="public/assets/icons/hll-favicon.ico">
    <title>Clan [CTM]</title>


    <style>


        body.no-scroll {
            overflow: hidden; 
        }

        /* IMG logo */

        .img-logo {
            opacity: 4%;
            height: 100vh;
            width: 60vw;
            border-radius: 50%;
            top: -31vh;
            left: -26vw;
            position: absolute;
            animation: moveAndFade 10s ease-in-out infinite;
            overflow: hidden;
        }


        .img-container {
            position: relative;
            width: 100px; 
            height: 100px; 
            
        }

   


        @keyframes moveAndFade {
            0% {
                transform: translateX(0) translateY(0); 
                opacity: 0%; 
            }
            10%{
                opacity: 2%; 
            }
            20%{
                opacity: 4%; 
            }
            60% {
                transform: translateX(200px) translateY(200px); 
                opacity: 0%; 
            }
            100% {
                transform: translateX(0) translateY(0); 
                opacity: 0%; 
            }
        }

        .video-background {
            position: fixed;
            right: 0;
            bottom: 0;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            z-index: -1;
        }

        .content {
            position: relative;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .lead {
            font-size: 1.25rem;
            font-weight: 300;
        }

        .discord-btn:hover {
            background-color: #5b73c7;
        }

        .discord-btn {
            background-color: #7289DA;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
            transition: background-color 0.3s ease;
        }


        /* widget */

        .dynamic-content {
            height: 85vh;
            position: relative;
            width: 25vw;
            overflow: hidden;
            
        }

        .contenido {
            position: relative;
            top: 0;
            left: 100%;
            width: 100%;
            transition: left 1s ease;
        }

        .contenido.show {
            left: 0;
        }

        .contenido.hide {
            left: -100%;
        }

        #contenido-1 {
            z-index: 2;
            top: 30vh;
        }

        #contenido-2 {
            z-index: 3;
            top: -22vh;
        }


   
        .contenido.show {
            left: 0;
        }

      
        .contenido.hide {
            left: -100%;
        }

        .row-container {
            position: relative;
        }


        .lead {
            background-color: rgba(0, 0, 0, 0.5); 
            border-radius: 15px; 
            padding: 10px; 
            color: white; 
            text-align: justify; 
            display: inline-block; 
        }

        /* Efecto hover de zoom para el párrafo */
        .zoom-hover {
            display: inline-block; 
            transition: transform 0.3s ease, color 0.3s ease; 
        }

        .zoom-hover:hover {
            transform: scale(1.1); 
            color: #ff6347; 
        }

        /* Estilo base del texto */
        .intro-text {
            opacity: 0; 
            transform: translateY(-50px); 
            animation: slideInFromTop 3s ease-out forwards; 
        }

        /* Animación de entrada desde arriba */
        @keyframes slideInFromTop {
            0% {
                opacity: 0;
                transform: translateY(-50px); 
            }
            50% {
                opacity: 50%;
                transform: translateY(0); 
            }
            80% {
                opacity: 80%;
            }
            100% {
                opacity: 1;
                transform: translateY(0); /* En posición normal */
            }
        }


        p {
            background: #01060629;
        }

        h1 {
            position: relative;
            top: -7vh;
            text-align: center;
            font-size: 48px;
            font-family: Arial, sans-serif;
        }


        .slide-in-bounce {
            opacity: 0; 
            transform: translateY(50px); 
            animation: slideInFromBottomBounce 1.5s ease-out forwards; 
        }

      
        .slide-in-bounce.animated {
            animation: heartBeat 2s ease-in-out infinite;
        }


  
        @keyframes slideInFromBottomBounce {
            0% {
                opacity: 0;
                transform: translateY(50px); /* Fuera de la vista hacia abajo */
            }
            60% {
                opacity: 60%;
                transform: translateY(-10px); /* Rebota hacia arriba */
            }
            80% {
                opacity: 80%;
                transform: translateY(5px); /* Rebota ligeramente hacia abajo */
            }
            100% {
                opacity: 1;
                transform: translateY(0); /* Posición final */
            }
        }


        .heart-beat {
            animation: heartBeat 2s ease-in-out infinite; 
        }
                

        @keyframes heartBeat {
            0%,
            100% {
                transform: scale(1); 
            }
            50% {
                transform: scale(1.1); 
            }
        }

        .letter {
            display: inline-block;
            opacity: 0;
            animation: fadeInMoveZoom 4.5s forwards infinite; 
            transform: translateY(20px) scale(0.8); 
        }

        @keyframes fadeInMoveZoom {
            0% {
                opacity: 0;
                transform: translateY(20px) scale(0.8); 
            }
            50% {
                opacity: 1;
                transform: translateY(0) scale(1.2); 
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1); 
            }
        }

        /* Retrasos para que cada letra aparezca en secuencia */
        h1 .letter:nth-child(1) { animation-delay: 0.1s; }
        h1 .letter:nth-child(2) { animation-delay: 0.2s; }
        h1 .letter:nth-child(3) { animation-delay: 0.3s; }
        h1 .letter:nth-child(4) { animation-delay: 0.4s; }
        h1 .letter:nth-child(5) { animation-delay: 0.5s; }
        h1 .letter:nth-child(6) { animation-delay: 0.6s; }
        h1 .letter:nth-child(7) { animation-delay: 0.7s; }
        h1 .letter:nth-child(8) { animation-delay: 0.8s; }
        h1 .letter:nth-child(9) { animation-delay: 0.9s; }
        h1 .letter:nth-child(10) { animation-delay: 1s; }
        h1 .letter:nth-child(11) { animation-delay: 1.1s; }
        h1 .letter:nth-child(12) { animation-delay: 1.2s; }
        h1 .letter:nth-child(13) { animation-delay: 1.3s; }


/*social */

        .social-buttons {
            position: relative;
            top: -28vh;
            left: 8vw;
        }

        .social-buttons a {
            font-size : 5vw;
        }

        .social-buttons {
            display: flex; 
            justify-content: space-between; 
            width: 25vw; 
        }

        .social-buttons a {
            text-decoration: none; 
            transition: all 0.3s ease; 
        }

        .social-buttons a:hover {
            color: #ff5722; 
            transform: scale(1.2); 
        }

/* proxi */


        .prox {
            position: absolute;
            bottom: 15vh;
            left: 28vw;
            text-align: center;
            font-size: 2.1vw;
            font-family: Arial, sans-serif;
            background-color: #007bff;
            color: #fff;
            padding: 15px 30px;
            border-radius: 5px;
            text-decoration: none;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }



        .prox:hover {
            background-color: #0056b3; 
            transform: scale(1.05); 
        }

        .prox:active {
            background-color: #003d80;
            transform: scale(0.95); 
        }

        .widget-ds{
            width: 350px;
            height: 500px;
        }


        .modal-body img {
            width: 100%; 
            height: auto; 
            max-width: 500px; 
            margin: 0 auto; 
        }


        .fade-in-image {
            opacity: 0; 
            animation: fadeIn 2s forwards; 
            width: 100%; 
            height: 100%; 
            object-fit: contain; 
        }

        /* Definir la animación fadeIn */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }



        .join {
            border-radius: 15px;
            background-color: #00000059;
            position: relative;
            top: 17vh;
            font-size: 2rem;
        }



        .server-info h2 {
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 20px;
        }

        .server-info p {
            margin: 8px 0;
        }

        .server-info .label {
            font-weight: bold;
        }

        .server-info .row {
            display: flex;
            justify-content: space-between;
        }

        .server-info .row .value {
            font-weight: normal;
        }

        .server-info-2 {
            position: relative;
            top: -60vh;
        }


        .custom-label {
            display: block;      /* Asegura que el span ocupe todo el ancho de su contenedor */
            text-align: left;    /* Alinea el texto a la izquierda */
            font-weight: bold;   /* Si deseas que el texto sea negrita */
        }

        .custom-value {
            display: block;
            text-align: center;
            font-weight: bold;
            font-size: 1.2em; /* Aumentar el tamaño de fuente */
            color: #007BFF; /* Color azul para resaltar el valor */
            padding: 6px 12px; /* Espaciado interno */
            border-radius: 8px; /* Bordes redondeados */
            box-shadow: 0px 2px 6px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            transition: all 0.3s ease; /* Transición suave para hover */
        }

        /* Efecto hover */
        .custom-value:hover {
            background-color: #e2f3ff; /* Fondo más claro cuando se pasa el ratón */
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.15); /* Sombra más fuerte */
            transform: translateY(-2px); /* Efecto de desplazamiento */
        }


        

        @media screen and (max-width: 468px) {
            .content {
                position: absolute;
                
            }

            .container {
                margin-top : 75vh;
            }

            .prox {
                position: absolute;
                bottom: 6vh;
                left: 29vw;
                text-align: center;
                font-size: 4vw;
                font-family: Arial, sans-serif;
                background-color: #007bff;
                color: #fff;
                padding: 15px 30px;
                border-radius: 5px;
                text-decoration: none;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
                transition: all 0.3s ease;
            }

            .social-buttons {
                position: relative;
                top: -81vh;
                left: 19vw;
                width: 51vw;

                
            }

            .social-buttons a {
                font-size: 11vw;
            }

            .dynamic-content {
                width: 100%;
                height: 87vh;
            }


            .custom-label {
                display: block;      /* Asegura que el span ocupe todo el ancho de su contenedor */
                text-align: center;    /* Alinea el texto a la izquierda */
                font-weight: bold;   /* Si deseas que el texto sea negrita */
            }

            .server-info-2 {
                left: 12vw;   
            }
        }

    </style>

</head>
<body>

    <video autoplay="" muted="" loop="" class="video-background">
        <source src="https://i.imgur.com/SwDTaEy.mp4" type="video/mp4">
    </video>

    <!-- contenido -->

    <div class="content weon">


        <div class="img-container">
            <img src="/public/assets/images/logo.png" class="img-logo" alt="Logo HLL" width="100" height="100">
        </div>

        <div class="container">
            <div class="row align-items-center row-container">
                <div class="col-md-8">
                    <h1>
                        <span class="letter">C</span>
                        <span class="letter">l</span>
                        <span class="letter">a</span>
                        <span class="letter">n</span>
                        <span class="letter"> </span>
                        <span class="letter">[</span>
                        <span class="letter">·</span>
                        <span class="letter">C</span>
                        <span class="letter">T</span>
                        <span class="letter">M</span>
                        <span class="letter">·</span>
                        <span class="letter">]</span>
                        <span class="letter"> </span>
                        <span class="letter">🇨🇱</span>
                        <span class="letter">🎮</span>
                    </h1>

                    <div class="intro-text">
                        <p class="lead zoom-hover" align="justify">
                            Únete al clan Chileno más apasionado de Hell Let Loose, contamos con nuestro propio servidor dedicado, donde combinamos estrategia, diversión y camaradería. 
                            Estamos dando pasos firmes hacia el mundo competitivo, sin perder de vista lo que más importa: disfrutar juntos cada batalla y forjar amistades en el camino.                    
                        </p>
                    </div>

                    <!-- <p class="lead zoom-hover" align="justify">
                        En Hell Let Loose busca nuestro servidor como: <span class="badge text-bg-warning">HLL Sur America #04 | CLAN [·CTM·] CHILE". ⚔️ </span>
                    </p> -->

                    <p class="lead zoom-hover slide-in-bounce" align="justify">
                        En Hell Let Loose busca nuestro servidor como: <span class="badge text-bg-warning">HLL Sur America #04 | CLAN [·CTM·] CHILE". ⚔️ </span>
                    </p>
                </div>
                <div class="col-md-4 text-center">
                    <div id="dynamic-content" class="dynamic-content">
                        <div id="contenido-1" class="contenido  ">
                            <iframe src="https://discord.com/widget?id=1248436063211360307&theme=dark" class="widget-ds"  allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>

                        </div>
                        <div id="contenido-2" class="contenido  ">
                            <div id="serverInfo" class="server-info">
                                <h2>Live info sv [·CTM·] HLL #1</h2>

                                <div class="row mb-1 mt-3">
                                    <div class="col-md-12">
                                        <span id="serverName">EN MANTENIMIENTO</span>
                                    </div>
                                </div>


                                <div class="row mb-1 mt-3">
                                    <div class="col-md-6">
                                        <span class="custom-label">Mapa actual:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="currentMap"></span>
                                    </div>
                                </div>



                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <span class="custom-label">Siguiente mapa:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="nextMap"></span>
                                    </div>
                                </div>


                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <span class="custom-label">Cantidad de jugadores:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="playerCount"></span>
                                    </div>
                                </div>


                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <span class="custom-label">Aliados:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="alliedCount"></span>
                                    </div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <span class="custom-label">Eje:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="axisCount"></span>
                                    </div>
                                </div>



                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <span class="custom-label">Ganando:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="winningTeam"></span>
                                    </div>
                                </div>
                            </div>

                        </div> 
                        <div id="contenido-3" class="contenido">
                            <div id="serverInfo" class="server-info-2">
                                <h2>Live info sv [·CTM·] HLL #2</h2>

                                <div class="row mb-1 mt-3">
                                    <div class="col-md-12">
                                        <span id="serverName2">EN MANTENIMIENTO</span>
                                    </div>
                                </div>


                                <div class="row mb-1 mt-3">
                                    <div class="col-md-6">
                                        <span class="custom-label">Mapa actual:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="currentMap2"></span>
                                    </div>
                                </div>



                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <span class="custom-label">Siguiente mapa:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="nextMap2"></span>
                                    </div>
                                </div>


                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <span class="custom-label">Cantidad de jugadores:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="playerCount2"></span>
                                    </div>
                                </div>


                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <span class="custom-label">Aliados:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="alliedCount2"></span>
                                    </div>
                                </div>

                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <span class="custom-label">Eje:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="axisCount2"></span>
                                    </div>
                                </div>



                                <div class="row mb-1">
                                    <div class="col-md-6">
                                        <span class="custom-label">Ganando:</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span class="custom-value" id="winningTeam2"></span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="social-buttons">
                <a href="https://www.youtube.com/@CTMHLL" title="YouTube"><i class="fab fa-youtube"></i></a>
                <a href="https://www.instagram.com/ctmhll" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://www.tiktok.com/@ctm.hll" title="TikTok"><i class="fab fa-tiktok"></i></a>
                <a href="http://discord.clanctm" title="Discord"><i class="fab fa-discord"></i></a>
            </div>
        
            <a href="https://i.imgur.com/JurmmPD.png" class="prox prox-m" data-fancybox="roadmap" data-caption="">
                Próximamente
            </a>

            

        </div>
    </div>
 




    <!-- Audio -->

    <audio id="miAudio" src="/public/assets/audios/intro.m4a"></audio>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const audio = document.getElementById('miAudio');
            audio.play().catch(error => {
                console.error("El navegador bloqueó la reproducción automática: ", error);
            });
        });

        document.addEventListener("DOMContentLoaded", function () {


            Fancybox.bind("[data-fancybox='roadmap']", {
                Toolbar: {
                    display: ["zoom", "close"],
                },
                Image: {
                    fit: "contain", 
                    zoom: true,      
                    defaultHeight: "100%",
                    defaultWidth: "100%",
                },
                animationEffect: "fade", 
            });


            const element = document.querySelector(".slide-in-bounce");

            setTimeout(() => {
                element.style.opacity = "1";
                element.classList.add("heart-beat");
            }, 2000); // 2000ms = 2 segundos
        });






        // document.addEventListener("DOMContentLoaded", function () {
        //     let currentIndex = 0;
        //     const contenidos = document.querySelectorAll('.contenido');

        //     contenidos[currentIndex].classList.add('show');

        //     function slide() {
        //         const currentContent = contenidos[currentIndex];
        //         currentContent.classList.remove('show');
        //         currentContent.classList.add('hide');

        //         currentIndex = (currentIndex + 1) % contenidos.length;

        //         const nextContent = contenidos[currentIndex];
        //         nextContent.classList.remove('hide');
        //         nextContent.classList.add('show');
        //     }

        //     setInterval(slide, 8000);  
        // });


        document.addEventListener("DOMContentLoaded", function () {
            let currentIndex = 0;
            const contenidos = document.querySelectorAll('.contenido');

            // Inicializar mostrando solo el primer contenido
            contenidos[currentIndex].classList.add('show');

            function slide() {
                // El contenido actual se esconde
                const currentContent = contenidos[currentIndex];
                currentContent.classList.remove('show');
                currentContent.classList.add('hide');

                // Actualizar el índice para mostrar el siguiente contenido
                currentIndex = (currentIndex + 1) % contenidos.length;

                // El siguiente contenido se muestra
                const nextContent = contenidos[currentIndex];
                nextContent.classList.remove('hide');
                nextContent.classList.add('show');
            }

            // Cambiar el contenido cada 8 segundos
            setInterval(slide, 8000);
        });


        // async function fetchAPI(id_sv) {
        //     try {
        //         const response = await fetch(`/get_hll_sv_status/${id_sv}`);
        //         if (!response.ok) {
        //             throw new Error(`HTTP error! Status: ${response.status}`);
        //         }
        //         const data = await response.json();                
        //         return data.message;
        //     } catch (error) {
        //         console.error("Error al consumir la API:", error);
        //     }
        // }
        

        async function fetchAPI(id_sv) {
            try {
                const response = await fetch('/get_hll_sv_status', {
                    method: 'POST', // Método POST
                    headers: {
                        'Content-Type': 'application/json', // Indica que el cuerpo es JSON
                    },
                    body: JSON.stringify({ id_sv: id_sv }), // Convertir los datos a JSON
                });
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                const data = await response.json();
                return data.message;
            } catch (error) {
                console.error("Error al consumir la API:", error);
            }
        }
        document.addEventListener("DOMContentLoaded", async function () {
            const data = await fetchAPI(1);
            const data_2 = await fetchAPI(2); 


            document.getElementById('serverName').textContent   = data.result.name.name;
            document.getElementById('currentMap').textContent   = data.result.current_map.map.map.name;
            document.getElementById('nextMap').textContent      = data.result.next_map.map.map.name;
            document.getElementById('playerCount').textContent  = `${data.result.player_count} / ${data.result.max_player_count}`;
            document.getElementById('alliedCount').textContent  = data.result.player_count_by_team.allied;
            document.getElementById('axisCount').textContent    = data.result.player_count_by_team.axis;

            let winningTeam = "Iniciando Partida"; // Valor por defecto en caso de no haber datos de puntajes.

            if (data.result.score.allied !== undefined && data.result.score.axis !== undefined) {
                // Verificar si los puntajes están definidos
                if (data.result.score.allied > data.result.score.axis) {
                    winningTeam = 'Aliados';
                } else if (data.result.score.axis > data.result.score.allied) {
                    winningTeam = 'Eje';
                }else if (data.result.score.allied === data.result.score.axis) {
                    winningTeam = 'Empatados';
                }
            }

            document.getElementById('winningTeam').textContent = winningTeam;

            document.getElementById('serverName2').textContent   = data_2.result.name.name;
            document.getElementById('currentMap2').textContent   = data_2.result.current_map.map.map.name;
            document.getElementById('nextMap2').textContent      = data_2.result.next_map.map.map.name;
            document.getElementById('playerCount2').textContent  = `${data_2.result.player_count} / ${data_2.result.max_player_count}`;
            document.getElementById('alliedCount2').textContent  = data_2.result.player_count_by_team.allied;
            document.getElementById('axisCount2').textContent    = data_2.result.player_count_by_team.axis;

            let winningTeam2 = "Iniciando Partida"; // Valor por defecto en caso de no haber datos de puntajes.

            if (data_2.result.score.allied !== undefined && data_2.result.score.axis !== undefined) {
                // Verificar si los puntajes están definidos
                if (data_2.result.score.allied > data_2.result.score.axis) {
                    winningTeam2 = 'Aliados';
                } else if (data_2.result.score.axis > data_2.result.score.allied) {
                    winningTeam2 = 'Eje';
                }else if (data_2.result.score.allied === data_2.result.score.axis) {
                    winningTeam2 = 'Empatados';
                }
            }

            document.getElementById('winningTeam2').textContent = winningTeam2;


            setInterval(fetchAPI, 15000); 
        });

    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0/dist/fancybox.umd.js"></script>
</body>
</html>
