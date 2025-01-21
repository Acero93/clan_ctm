<?php
$active = $active ?? ''; 

$menu_items = [
    'CTM' => '/CTM',
    'Miembros'  => '/miembrosCTM',
    'Eventos'   => '/eventos',
    'WikiCTM'   => 'https://wiki.clanctm.cl',
    'Medallas'  => '/medallas',
    'Eventos'   => '/Eventos',
    'Browse'    => 'browse.html',
    'Details'   => 'details.html',
    'Streams'   => 'streams.html',
    'Profile'   => 'profile.html',
];

?>

<div class="container">
    <div class="row">
        <div class="col-12">
            <nav class="main-nav">
                <!-- ***** Logo Start ***** -->
                <a href="index.html" class="logo">
                    <img src="public/assets/images/main/logo.png" alt="">
                </a>
                <!-- ***** Logo End ***** -->
                <!-- ***** Search Start ***** -->
                <!-- <div class="search-input">
                    <form id="search" action="#">
                        <input type="text" placeholder="Type Something" id="searchText" name="searchKeyword" onkeypress="handle" />
                        <i class="fa fa-search"></i>
                    </form>
                </div> -->
                <!-- ***** Search End ***** -->
                <!-- ***** Menu Start ***** -->
                <ul class="nav">
                    <?php foreach ($menu_items as $name => $url): ?>
                        <li>
                            <a href="<?= htmlspecialchars($url) ?>" class="<?= $active === $name ? 'active' : '' ?>">
                                <?= htmlspecialchars($name) ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <a class="menu-trigger">
                    <span>Menu</span>
                </a>
                <!-- ***** Menu End ***** -->
            </nav>
        </div>
    </div>
</div>
