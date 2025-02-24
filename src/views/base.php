<?php 
  
    include (dirname(__DIR__)) . "/utils/helpers.php"; 


?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php include "components/baseHead.php"; ?>

    
    <style>
        /* Efecto de transición para la altura y opacidad */
        .collapse {
            transition: height 0.3s ease, opacity 0.3s ease-in-out;
        }
        .collapse.show {
            opacity: 1; /* Submenú visible */
        }
        .collapse:not(.show) {
            opacity: 0; /* Submenú oculto */
            height: 0 !important; /* Altura del submenú colapsado */
            overflow: hidden; /* Ocultar contenido */
        }

        /* Animación de rotación del ícono */
        .rotate-icon {
            transition: transform 0.3s ease; /* Efecto de rotación suave */
        }
        .rotate-icon.rotate {
            transform: rotate(180deg); /* Rotar 180 grados */
        }
    </style>
    <base href="<?= getBaseUrl() ?>">

</head>
<body>
    <header>
        <!-- Cabecera común aquí -->

    </header>

    <!-- <div class="container">
        

        <h1> testeando </h1>
    </div> -->



    <div class="d-flex">
        <!-- Sidebar -->

        <?php
            !isset($ForeignView) ? include "components/leftBar.php" : null;
        ?>


        <?php //include "components/leftBar.php"; ?>


        <!-- Main Content -->
        <div id="main-content" class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <!-- <button class="btn btn-primary" id="toggleSidebar">☰</button> -->
                    <span class="navbar-brand ms-3">Uranium-235</span>
                </div>
            </nav>
            <div class="container mt-4">
                <!-- <h1>Bienvenido</h1>
                <p>Este es un ejemplo de una barra lateral con Bootstrap 5 que se puede ocultar.</p> -->
            
            
                <?php 
                    isset($content)? include $content : null;
                ?>
            </div>
        </div>
    </div>

    <footer>
        <!-- Pie de página común aquí -->
    </footer>





    <!-- Bootstrap 5 JS -->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleLinks = document.querySelectorAll('[data-bs-toggle="collapse"]');

            toggleLinks.forEach(link => {
                const icon = link.querySelector('.rotate-icon');
                
                link.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-bs-target');
                    const target = document.querySelector(targetId);

                    if (target.classList.contains('show')) {
                        icon.classList.remove('rotate'); // Quitar rotación si ya está desplegado
                    } else {
                        icon.classList.add('rotate'); // Aplicar rotación
                    }
                });
            });
        });
    </script>





<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
