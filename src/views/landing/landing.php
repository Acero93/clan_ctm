<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comunidad Gaming</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- AOS CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
  <!-- Estilos personalizados -->
  <style>
    body {
      background-color: #1a1a1a;
      color: #fff;
    }
    .navbar, .footer {
      background-color: #0d0d0d;
    }
    .hero-section {
      background: url('gaming-background.jpg') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
    }
    .hero-section h1 {
      font-size: 4rem;
      font-weight: bold;
    }
    .features-section, .testimonials-section {
      padding: 80px 0;
    }
    .card {
      background-color: #262626;
      color: #fff;
      border: none;
    }
    .btn-primary {
      background-color: #ff4d4d;
      border: none;
    }
    .btn-primary:hover {
      background-color: #ff1a1a;
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="#">Comunidad Gaming</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="#features">Características</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#gallery">Galería</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#testimonials">Testimonios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link btn btn-primary" href="#join">Únete Ahora</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="hero-section">
    <div class="container">
      <h1>Únete a la Mejor Comunidad Gaming</h1>
      <p class="lead">Conéctate con jugadores de todo el mundo, participa en torneos y mejora tus habilidades.</p>
      <a href="#join" class="btn btn-primary btn-lg">Únete Ahora</a>
    </div>
  </section>

  <!-- Features Section -->
  <section id="features" class="features-section">
    <div class="container">
      <h2 class="text-center mb-5">Características</h2>
      <div class="row">
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Torneos Semanales</h5>
              <p class="card-text">Participa en torneos y gana premios increíbles.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Comunidad Activa</h5>
              <p class="card-text">Únete a discusiones y haz nuevos amigos.</p>
            </div>
          </div>
        </div>
        <div class="col-md-4" data-aos="fade-up" data-aos-delay="300">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Guías y Tutoriales</h5>
              <p class="card-text">Aprende de los mejores jugadores.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Gallery Section -->
  <section id="gallery" class="bg-dark py-5">
    <div class="container">
      <h2 class="text-center mb-5">Galería</h2>
      <div class="row">
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
          <img src="gaming1.jpg" class="img-fluid rounded" alt="Gaming 1">
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
          <img src="gaming2.jpg" class="img-fluid rounded" alt="Gaming 2">
        </div>
        <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
          <img src="gaming3.jpg" class="img-fluid rounded" alt="Gaming 3">
        </div>
      </div>
    </div>
  </section>

  <!-- Testimonials Section -->
  <section id="testimonials" class="testimonials-section">
    <div class="container">
      <h2 class="text-center mb-5">Testimonios</h2>
      <div class="row">
        <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
          <div class="card">
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>"La mejor comunidad gaming que he conocido. ¡Los torneos son increíbles!"</p>
                <footer class="blockquote-footer">Juan Pérez</footer>
              </blockquote>
            </div>
          </div>
        </div>
        <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
          <div class="card">
            <div class="card-body">
              <blockquote class="blockquote mb-0">
                <p>"He mejorado mucho gracias a las guías y consejos de la comunidad."</p>
                <footer class="blockquote-footer">Ana Gómez</footer>
              </blockquote>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Call-to-Action Section -->
  <section id="join" class="bg-dark py-5">
    <div class="container">
      <h2 class="text-center mb-5">¿Qué esperas para unirte?</h2>
      <div class="row">
        <!-- Widget de Discord -->
        <div class="col-md-6" data-aos="fade-right" data-aos-delay="100">
          <div class="discord-widget">
            <iframe src="https://discord.com/widget?id=TU_ID_DE_SERVIDOR&theme=dark" width="100%" height="500" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe>
          </div>
        </div>
        <!-- Información del servidor -->
        <div class="col-md-6" data-aos="fade-left" data-aos-delay="200">
          <div class="server-info">
            <h3>Información del Servidor</h3>
            <p>¡Bienvenido a nuestra comunidad gaming! Aquí encontrarás:</p>
            <ul>
              <li>🎮 Torneos semanales con premios.</li>
              <li>💬 Canales de chat para jugadores.</li>
              <li>📚 Guías y tutoriales actualizados.</li>
              <li>🎉 Eventos exclusivos para miembros.</li>
            </ul>
            <p>¡Únete ahora y forma parte de la diversión!</p>
            <a href="https://discord.gg/TU_ENLACE_DE_INVITACION" class="btn btn-primary">Únete a Discord</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer py-4">
    <div class="container text-center">
      <p>&copy; 2023 Comunidad Gaming. Todos los derechos reservados.</p>
      <div class="social-links">
        <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
        <a href="#" class="text-white me-3"><i class="fab fa-discord"></i></a>
        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
      </div>
    </div>
  </footer>

  <!-- Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS JS -->
  <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
  <script>
    // Inicializa AOS
    AOS.init({
      duration: 1000, // Duración de la animación en ms
      once: true, // La animación solo se reproduce una vez
    });
  </script>
</body>
</html>