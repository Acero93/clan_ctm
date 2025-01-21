<?php
// Simula datos de una base de datos (esto normalmente sería una consulta real)
$players = [
    ['username' => 'PlayerOne', 'image' => 'path_to_image1.jpg'],
    ['username' => 'GamerGirl', 'image' => 'path_to_image2.jpg'],
    ['username' => 'ProSniper', 'image' => 'path_to_image3.jpg'],
    ['username' => 'ShadowNinja', 'image' => 'path_to_image4.jpg'],
    ['username' => 'SpeedRacer', 'image' => 'path_to_image5.jpg'],
    ['username' => 'KnightKing', 'image' => 'path_to_image6.jpg'],
    // Agrega más jugadores según sea necesario
];
?>

<section class="players-section">
    <p class="text-uppercase text-danger">Personal [ · C T M · ]</p>
    <h2><?php  echo date("Y"); ?></h2>
    <div class="d-flex flex-wrap justify-content-center">
        <?php foreach ($players as $player): ?>
            <div class="player-avatar" data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo $player['username']; ?>">
                <img src="<?php echo $player['image']; ?>" alt="<?php echo $player['username']; ?>">
            </div>
        <?php endforeach; ?>
    </div>
    <!-- <a href="#" class="view-more-btn">View All Community Players</a> -->
</section>
