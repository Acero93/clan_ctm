<?php

?>

<div class="container mt-5">
    <h1 class="mb-4">Ingresar Mapa Táctico</h1>
    <form id="strategyForm" enctype="multipart/form-data">
        <!-- Campo: Nombre -->
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="name" name="name" required minlength="3" maxlength="100">
            <div class="invalid-feedback">El nombre debe tener entre 3 y 100 caracteres.</div>
        </div>

        <!-- Campo: ID del Evento -->
        <div class="mb-3">
            <label for="id_event" class="form-label">ID del Evento</label>
            <input type="number" class="form-control" id="id_event" name="id_event" required min="1">
            <div class="invalid-feedback">El ID del evento debe ser un número válido.</div>
        </div>
        <!-- password -->

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" maxlength="10" required>
            <div class="invalid-feedback">Por favor, ingresa una contraseña.</div>
        </div>

        <!-- Campo: URL -->
        <div class="mb-3">
            <label for="url" class="form-label">URL</label>
            <input type="url" class="form-control" id="url" name="url" required>
            <div class="invalid-feedback">Por favor, ingresa una URL válida.</div>
        </div>

        <!-- Campo: Imágenes (Máximo 5 archivos) -->
        <div class="mb-3">
            <label for="maps_img" class="form-label">Imágenes (Máximo 5 archivos)</label>
            <input type="file" class="form-control" id="maps_img" name="maps_img[]" multiple accept="image/*" max="5">
            <div class="invalid-feedback">Solo se permiten hasta 5 archivos de imagen.</div>
        </div>

        <!-- Botón de envío -->
        <button type="submit" class="btn btn-primary">Guardar</button>
    </form>
</div>


<?= loadScripts($scripts ?? []) ?>


