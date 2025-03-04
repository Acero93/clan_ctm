
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Listado de jugadores</h1>
</div>

<a type="button" class="btn btn-primary my-3" id="openFormButton" >
    Nuevo jugador
</a>

<div>
     Total de jugadores:<span id="total-registros">0</span>
</div>


<div id="table"></div>




<?= loadScripts($scripts ?? []) ?>

<script>
    let table;

    document.addEventListener('DOMContentLoaded', function () {

        inicializarTabla();
        setInterval(actualizarTabla, 10000);

    });



    function inicializarTabla(){

        Swal.fire({
            title: 'Cargando...',
            text: 'Por favor, espera mientras se cargan los datos.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading(); // Muestra el spinner de carga
            }
        });

        
        // 1. Obtener los datos desde el backend
        fetch('/players') // Ruta al script PHP que devuelve los datos
        .then(response => response.json())
        .then(data => {
            Swal.close();
            // 2. Crear la tabla con Tabulator
            table = new Tabulator("#table", {
                data: Object.values(data), // Datos validados
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 15,
                columns: [
                    // { title: "ID", field: "id", sorter: "number" },
                    { title: "Nombre en el juego", field: "in_game_name", sorter: "string" },
                    // { title: "Usuario de Discord", field: "discord_username", sorter: "string" },
                    // { title: "ID de Discord", field: "discord_id", sorter: "string" },
                    // { title: "ID del juego", field: "game_id", sorter: "string" },
                    // { title: "Fecha de ingreso", field: "join_date", sorter: "date" },
                    // { title: "Plataforma", field: "platform", sorter: "string" },
                    { title: "Dependencia", field: "dependency", sorter: "string" },
                    { title: "Estado", field: "status", sorter: "number" },
                    { title: "Rango", field: "rank", sorter: "string" },
                    // { title: "Estilo de juego", field: "play_style", sorter: "string" },
                    // { title: "Compromiso", field: "commitment", sorter: "string" },
                    { title: "Especialización", field: "specialization", sorter: "string" },
                    { title: "División", field: "division", sorter: "string" },
                    { title: "Capitán", field: "captain", sorter: "number" },
                    { title: "Número de contacto", field: "contact_number", sorter: "string" },
                    // { title: "País", field: "country", sorter: "string" },
                    // { title: "PIN", field: "pin", sorter: "string" },
                    // { title: "Nivel", field: "level", sorter: "string" },
                    // { title: "Notas", field: "notes", sorter: "string" },
                    { title: "Creado en", field: "created_at", sorter: "date" },
                    // { title: "Actualizado en", field: "update_at", sorter: "date" }
                    {
                        title: "Acciones",
                        formatter: function(cell, formatterParams, onRendered) {
                            // Botones personalizados
                            return `
                            <button class="btn btn-sm btn-warning edit-btn">
                                <i class="bi bi-pencil"></i> 
                            </button>
                            <button class="btn btn-sm btn-danger delete-btn">
                                <i class="bi bi-trash"></i> 
                            </button>
                            `;
                        },
                        width: 150,
                        hozAlign: "center",
                        cellClick: function(e, cell) {
                            const rowData = cell.getRow().getData();

                            if (e.target.classList.contains("edit-btn") || e.target.classList.contains("bi-pencil") ) {
                                abrirFormularioEdicionEvento(rowData.id); // Función para abrir el formulario de edición
                            
                            }
                            
                            if (e.target.classList.contains("delete-btn") || e.target.classList.contains("bi-trash") ) {
                                eliminarEvento(rowData.id); // Función para eliminar el evento
                             
                            }
 
                        }
                    }
                ]
            });


            table.on("rowClick", function(e, row){
                const rowData = row.getData(); // Obtener los datos de la fila
                // alert("Row " + row.getIndex() + " Clicked!!!!")
                console.log(rowData);
            });

        })
        .catch(error => console.error("Error al cargar los datos:", error));

    }

    function actualizarTabla() {
        fetchRequest('/players', {}, 'GET')
        .then(data => {
            // Convertir el objeto en un array
            const playersArray = Object.values(data);

            // Establecer los datos en Tabulator
            table.setData(playersArray);
        })
        .catch(error => {
            console.error('Error al cargar los datos:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudieron cargar los datos. Por favor, inténtalo de nuevo.',
            });
        });
    }


    function eliminar(id) {
        
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¡No podrás revertir esto!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, eliminar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
           
                fetchRequest(`/players/delete/${id}`, {}, 'DELETE')
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado',
                        text: 'El evento ha sido eliminado correctamente.',
                    });
                    
                    actualizarTabla();
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'No se pudo eliminar el evento. Por favor, inténtalo de nuevo.',
                    });
                });
            }
        });
    }


    document.getElementById('openFormButton').addEventListener('click', function () {
        Swal.fire({
            title: 'Formulario de Jugador',
            html: `
                <form id="playerForm" class="needs-validation" novalidate>
                    <!-- Nombre en el juego -->
                    <div class="mb-3">
                        <label for="in_game_name" class="form-label">Nombre en el juego</label>
                        <input type="text" class="form-control" id="in_game_name" name="in_game_name" maxlength="75" required>
                        <div class="invalid-feedback">Por favor, ingresa tu nombre en el juego.</div>
                    </div>

                    <!-- Nombre de usuario en Discord -->
                    <div class="mb-3">
                        <label for="discord_username" class="form-label">Nombre de usuario en Discord</label>
                        <input type="text" class="form-control" id="discord_username" name="discord_username" maxlength="75" required>
                        <div class="invalid-feedback">Por favor, ingresa tu nombre de usuario en Discord.</div>
                    </div>

                    <!-- ID de Discord -->
                    <div class="mb-3">
                        <label for="discord_id" class="form-label">ID de Discord</label>
                        <input type="text" class="form-control" id="discord_id" name="discord_id" maxlength="75" required>
                        <div class="invalid-feedback">Por favor, ingresa tu ID de Discord.</div>
                    </div>

                    <!-- ID del juego -->
                    <div class="mb-3">
                        <label for="game_id" class="form-label">ID del juego</label>
                        <input type="text" class="form-control" id="game_id" name="game_id" maxlength="75" required>
                        <div class="invalid-feedback">Por favor, ingresa tu ID del juego.</div>
                    </div>

                    <!-- Fecha de ingreso -->
                    <div class="mb-3">
                        <label for="join_date" class="form-label">Fecha de ingreso</label>
                        <input type="date" class="form-control" id="join_date" name="join_date" required>
                        <div class="invalid-feedback">Por favor, ingresa la fecha de ingreso.</div>
                    </div>

                    <!-- Plataforma -->
                    <div class="mb-3">
                        <label for="platform" class="form-label">Plataforma</label>
                        <select class="form-select" id="platform" name="platform" required>
                            <option value="">Selecciona una plataforma</option>
                            <option value="Steam">Steam</option>
                            <option value="Epic">Epic</option>
                            <option value="Otra">Otra</option>
                        </select>
                        <div class="invalid-feedback">Por favor, selecciona una plataforma.</div>
                    </div>

                    <!-- Dependencia -->
                    <div class="mb-3">
                        <label for="dependency" class="form-label">Dependencia</label>
                        <select class="form-select" id="dependency" name="dependency" required>
                            <option value="">Selecciona una dependencia</option>
                            <option value="Clan">Clan</option>
                            <option value="Aliado">Aliado</option>
                            <option value="Invitado">Invitado</option>
                        </select>
                        <div class="invalid-feedback">Por favor, selecciona una dependencia.</div>
                    </div>

                    <!-- Estado -->
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                        <div class="invalid-feedback">Por favor, selecciona un estado.</div>
                    </div>

                    <!-- Rango -->
                    <div class="mb-3">
                        <label for="rank" class="form-label">Rango</label>
                        <input type="text" class="form-control" id="rank" name="rank" maxlength="75" required>
                        <div class="invalid-feedback">Por favor, ingresa tu rango.</div>
                    </div>

                    <!-- Estilo de juego -->
                    <div class="mb-3">
                        <label for="play_style" class="form-label">Estilo de juego</label>
                        <select class="form-select" id="play_style" name="play_style" required>
                            <option value="">Selecciona un estilo de juego</option>
                            <option value="Competitivo">Competitivo</option>
                            <option value="Casual">Casual</option>
                        </select>
                        <div class="invalid-feedback">Por favor, selecciona un estilo de juego.</div>
                    </div>

                    <!-- Compromiso -->
                    <div class="mb-3">
                        <label for="commitment" class="form-label">Compromiso</label>
                        <select class="form-select" id="commitment" name="commitment" required>
                            <option value="">Selecciona un nivel de compromiso</option>
                            <option value="Alto">Alto</option>
                            <option value="Medio">Medio</option>
                            <option value="Bajo">Bajo</option>
                        </select>
                        <div class="invalid-feedback">Por favor, selecciona un nivel de compromiso.</div>
                    </div>

                    <!-- Especialización -->
                    <div class="mb-3">
                        <label for="specialization" class="form-label">Especialización</label>
                        <input type="text" class="form-control" id="specialization" name="specialization" placeholder="Ingresa especializaciones separadas por comas (ej: Infantería, Blindados)" maxlength="300" required>
                        <div class="invalid-feedback">Por favor, ingresa tus especializaciones.</div>
                    </div>

                    <!-- División -->
                    <div class="mb-3">
                        <label for="division" class="form-label">División</label>
                        <select class="form-select" id="division" name="division" required>
                            <option value="">Selecciona una división</option>
                            <option value="Frontal">Frontal</option>
                            <option value="Flanqueo">Flanqueo</option>
                            <option value="Defensa">Defensa</option>
                            <option value="N/A">N/A</option>
                        </select>
                        <div class="invalid-feedback">Por favor, selecciona una división.</div>
                    </div>

                    <!-- Capitán -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="captain" name="captain">
                            <label class="form-check-label" for="captain">Capitán</label>
                        </div>
                    </div>

                    <!-- Número de contacto -->
                    <div class="mb-3">
                        <label for="contact_number" class="form-label">Número de contacto</label>
                        <input type="text" class="form-control" id="contact_number" name="contact_number" maxlength="20" required>
                        <div class="invalid-feedback">Por favor, ingresa tu número de contacto.</div>
                    </div>

                    <!-- País -->
                    <div class="mb-3">
                        <label for="country" class="form-label">País</label>
                        <input type="text" class="form-control" id="country" name="country" maxlength="75" required>
                        <div class="invalid-feedback">Por favor, ingresa tu país.</div>
                    </div>

                    <!-- PIN -->
                    <div class="mb-3">
                        <label for="pin" class="form-label">PIN</label>
                        <input type="text" class="form-control" id="pin" name="pin" maxlength="4" required>
                        <div class="invalid-feedback">Por favor, ingresa tu PIN.</div>
                    </div>

                    <!-- Nivel -->
                    <div class="mb-3">
                        <label for="level" class="form-label">Nivel</label>
                        <input type="text" class="form-control" id="level" name="level" maxlength="75" required>
                        <div class="invalid-feedback">Por favor, ingresa tu nivel.</div>
                    </div>

                    <!-- Notas -->
                    <div class="mb-3">
                        <label for="notes" class="form-label">Notas</label>
                        <textarea class="form-control" id="notes" name="notes" maxlength="300" rows="3"></textarea>
                        <div class="invalid-feedback">Por favor, ingresa tus notas.</div>
                    </div>
                </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            cancelButtonText: 'Cancelar',
            focusConfirm: false,
            preConfirm: async () => {
                    const form = document.getElementById('playerForm');
                    if (form.checkValidity()) {
                        // Obtener los datos del formulario
                        const formData = new FormData(form);
                        const data = Object.fromEntries(formData.entries());

                        // Enviar los datos al endpoint /player/save
                        try {
                            const response = await fetchRequest('/player/save', data, 'POST');
                            return response; // Devuelve la respuesta del servidor
                        } catch (error) {
                            Swal.showValidationMessage(`Error al enviar el formulario: ${error.message}`);
                            return false; // Evita que se cierre SweetAlert2
                        }
                    } else {
                        // Mostrar mensajes de validación
                        form.classList.add('was-validated');
                        Swal.showValidationMessage('Por favor, completa todos los campos requeridos.');
                        return false; // Evita que se cierre SweetAlert2
                    }
                }
        }).then((result) => {
            if (result.isConfirmed) {
                // Aquí puedes manejar los datos del formulario
                console.log('Datos del formulario:', result.value);
                Swal.fire('¡Éxito!', 'El formulario se envió correctamente.', 'success');
            }
        });
    });



    
    async function fetchRequest(url, bodyData = {}, method = 'POST') {
        try {
            const options = {
                method,
                headers: {
                    'Content-Type': 'application/json', // Indicamos que el contenido es JSON
                },
            };

            // Solo agregar el cuerpo si el método no es GET o HEAD
            if (method !== 'GET' && method !== 'HEAD') {
                options.body = JSON.stringify(bodyData); // Convertimos los datos a JSON
            }

            const response = await fetch(url, options);

            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.status}`);
            }

            return await response.json(); // Parseamos y devolvemos la respuesta
        } catch (error) {
            throw new Error(`Error en fetchRequest: ${error.message}`);
        }
    }


</script>