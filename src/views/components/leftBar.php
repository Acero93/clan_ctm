<?php

    $menu =  [
        [
            'name' => 'Inicio',
            'path' => '/base',
            'children' => [] // Sin submenús
        ],
        [
            'name' => 'Miembros',
            'path' => '/miembros',
            'children' => [
                ['name' => 'Ver Miembros', 'path' => '/Miembros/ver'],
                ['name' => 'Agregar Cliente', 'path' => '/Miembros/agregar'],
            ]
        ],
        [
            'name' => 'Configuración',
            'path' => '/configuracion',
            'children' => [
                ['name' => 'Preferencias', 'path' => '/configuracion/preferencias'],
                ['name' => 'Seguridad', 'path' => '/configuracion/seguridad'],
            ]
        ]
    ];
?>

<nav id="sidebar" class="bg-dark text-white p-3" style="width: 250px;">
    <h5 class="text-center">Menú</h5>
    <ul class="nav flex-column">
        <?php foreach ($menu as $item): ?>
            <li class="nav-item">
                <a class="nav-link text-white d-flex justify-content-between align-items-center" 
                   href="<?= htmlspecialchars($item['path'], ENT_QUOTES, 'UTF-8') ?>"
                   <?php if (!empty($item['children'])): ?> 
                   data-bs-toggle="collapse" 
                   data-bs-target="#submenu-<?= md5($item['name']) ?>" 
                   role="button" 
                   aria-expanded="false" 
                   aria-controls="submenu-<?= md5($item['name']) ?>"
                   <?php endif; ?>>
                   <?= htmlspecialchars($item['name'], ENT_QUOTES, 'UTF-8') ?>
                   <?php if (!empty($item['children'])): ?>
                       <span>
                           <i class="bi bi-chevron-down rotate-icon"></i>
                       </span>
                   <?php endif; ?>
                </a>
                <?php if (!empty($item['children'])): ?>
                    <div class="collapse" id="submenu-<?= md5($item['name']) ?>">
                        <ul class="nav flex-column ms-3">
                            <?php foreach ($item['children'] as $child): ?>
                                <li class="nav-item">
                                    <a class="nav-link text-white" 
                                       href="<?= htmlspecialchars($child['path'], ENT_QUOTES, 'UTF-8') ?>">
                                       <?= htmlspecialchars($child['name'], ENT_QUOTES, 'UTF-8') ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</nav>

