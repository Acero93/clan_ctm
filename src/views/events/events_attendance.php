<?php

// $endpoint_1 = $_ENV['SV1'];
// $endpoint_2 = $_ENV['SV2'];
// $endpoint_3 = $_ENV['SV3'];
?>


<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Listado de eventos</h1>
</div>


<div>
     Total de eventos:<span id="total-registros"> 0</span>
</div>


<div class="table-dark" id="tabla"></div>



<?= loadScripts($scripts ?? []) ?>
<script>

    let table;

    async function getEvents(){

        Swal.fire({
            title: 'Cargando...',
            text: 'Por favor, espera mientras se cargan los datos.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading(); // Muestra el spinner de carga
            }
        });

        // Llamada a la API para obtener los eventos

        fetchRequest('/events', {}, 'GET')
        .then(data => {
            // Cierra el modal de carga
            Swal.close();

            // Convertir el objeto de datos en un array
            const eventsArray = Object.values(data);
            const eventos = eventsArray.length;

            document.getElementById('total-registros').textContent = ` ${eventos}`;

            // Inicializa la tabla Tabulator
            table = new Tabulator("#tabla", {
                layout: "fitColumns",
                pagination: "local",
                paginationSize: 15,
                rowClick: function(e, row) {
                    const rowData = row.getData(); // Obtiene los datos de la fila
                    alert(`Hiciste clic en la fila con ID: ${rowData.id}`); // Muestra un alert con el ID de la fila
                },
                columns: [
                    { title: "Nombre", field: "name", headerFilter: "input" },
                    { title: "Descripción", field: "description", headerFilter: "input", visible: false },
                    { title: "Tipo de Evento", field: "event_type", headerFilter: "input", visible: false },
                    { title: "Fecha", field: "event_date", headerFilter: "input" },
                    { title: "IP del Servidor", field: "server_ip", headerFilter: "input", visible: false },
                    { title: "Asistencia Esperada", field: "expected_attendance", headerFilter: "input" },
                    { title: "Asistencia Real", field: "actual_attendance", headerFilter: "input" },
                    { title: "Estado", field: "status", headerFilter: "input" },
                    {
                        title: "Acciones",
                        formatter: function(cell, formatterParams, onRendered) {
                            const rowData = cell.getRow().getData();

                            // Si el evento está "terminado", no mostrar el botón de confirmar asistencia
                            if (rowData.status === "Terminado") {
                                return `
                                <button class="btn btn-sm btn-success confirm-btn ">
                                    <i class="bi bi-check-circle"></i>
                                </button>
                                `;
                            }

                            if (rowData.status === "Cancelado") {
                                return `
                                <button class="btn btn-sm btn-danger confirm-btn ">
                                    <i class="bi bi-x-circle"></i>
                                </button>
                                `;
                            }


                            return `
                            <button class="btn btn-sm btn-warning confirm-btn">
                                <i class="bi bi-hourglass-split"></i>
                            </button>
                            `;
                        },
                        width: 250,
                        hozAlign: "center",
                        cellClick: function(e, cell) {
                            const rowData = cell.getRow().getData();

                            if (e.target.classList.contains("btn-success") || e.target.classList.contains("bi-check-circle")) {
                                abrirFormulario(rowData);
                            }

                            if (e.target.classList.contains("btn-danger") || e.target.classList.contains("bi-x-circle")) {
                                abrirFormulario(rowData); 
                            }


                            if (e.target.classList.contains("btn-warning") || e.target.classList.contains("bi-hourglass-split")) {
                                abrirFormularioConfirmarAsistencia(rowData); 
                            }
                        },
                    },
                ],
                data: eventsArray,
                rowFormatter: function(row) {
                    const data = row.getData(); // Obtiene los datos de la fila

                    // Asigna colores según el estado
                    switch (data.status) {
                        case "Programado":
                            row.getElement().style.backgroundColor = "#fff68e"; 
                            break;
                        case "Terminado":
                            row.getElement().style.backgroundColor = "#67c36f"; 
                            break;
                        case "Cancelado":
                            row.getElement().style.backgroundColor = "#e17575"; 
                            break;
                        default:
                            row.getElement().style.backgroundColor = ""; // Sin color
                    }
                }
            });
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudieron cargar los datos. Por favor, inténtalo de nuevo.',
            });
        });


    }


    function abrirFormularioConfirmarAsistencia(evento) {

        


        Swal.fire({
            title: `Confirmar Asistencia: ${evento.name}`,
            html: `
            <p><strong>Descripción:</strong> ${evento.description}</p>
            <p><strong>Fecha:</strong> ${evento.event_date}</p>
            <p><strong>Asistencias Confirmadas:</strong> ${evento.actual_attendance}</p>
            <p><strong>Nombre del Servidor:</strong> ${evento.server_ip}</p>
            <br>
            <div class="form-group">
                <label for="participacion">¿Participarás en el evento?</label>
                <select id="participacion" class="form-control">
                    <option value="1">Quiero participar</option>
                    <option value="0">No podré participar</option>
                </select>
            </div>
            <br>
            <textarea id="motivo" placeholder="Motivo (opcional, máximo 200 caracteres)" maxlength="200" style="width: 100%; height: 100px; margin-top: 10px;"></textarea>
            <br>
            <p><strong>NOTA:</strong> Puedes ingresar tu ID de Steam|Epic O tú nombre de usuario ingame, no son necesarios ambos. (este último campo debe ser exactamente igual al que dejaste en tu registro)</p>

            <div class="form-group my-1">
                <label for="player_id">ID jugador (STEAM O EPIC)</label>
                <input type="text" id="player_id" class="form-control"  >
            </div>

            <div class="form-group my-1">
                <label for="">Miembro</label>
                <input type="text" id="name" class="form-control"  >
            </div>
            
            <div class="form-group my-1">
                <label for="pin">PIN de seguridad</label>
                <input type="number" id="pin" class="form-control" maxlength="4" value="" >
            </div>

            `,
            showCancelButton: true,
            confirmButtonText: 'Enviar respuesta',
            cancelButtonText: 'Cancelar',
            focusConfirm: false,
            preConfirm: () => {
                
                const motivo        = document.getElementById('motivo').value;
                const participacion = document.getElementById('participacion').value;

                // Aquí puedes enviar la confirmación de asistencia al servidor
                return fetchRequest('/events/confirm', {
                    id              : evento.id,
                    confirmado      : participacion,
                    motivo          : motivo,
                    game_id         : document.getElementById('player_id').value,
                    in_game_name    : document.getElementById('name').value,
                    pin             : document.getElementById('pin').value
                }, 'POST')
                .then(response => {


                    if (!response.success) {
                        throw new Error(response.message);
                    }
                    
                    let texto = "Tu respuesta ha sido registrada correctamente";

                    if(response.message.password){
                        texto += ". La contraseña para la partida es: " + response.message.password;
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'Respuesta enviada',
                        text: texto,
                    });


                })
                .catch(error => {
                    Swal.showValidationMessage(`Error: ${error.message}`);
                });
            }

        })
    }
    
    function abrirFormulario(evento) {
        Swal.fire({
            title: `Evento realizado: ${evento.name}`,
            html: `
            <p><strong>Descripción:</strong> ${evento.description}</p>
            <p><strong>Fecha:</strong> ${evento.event_date}</p>
            <p><strong>Asistencias Confirmadas:</strong> ${evento.actual_attendance}</p>
            <p><strong>Asistencias Esperadas:</strong> ${evento.expected_attendance}</p>
            <p><strong>IP del Servidor:</strong> ${evento.server_ip}</p>
            `,
            showCancelButton: false,
            focusConfirm: false

        });
    }

    function actualizarTabla() {
        fetchRequest('/events', {}, 'GET')
        .then(data => {
            // Convertir el objeto en un array
            const eventsArray = Object.values(data);

            // Establecer los datos en Tabulator
            table.setData(eventsArray);
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

    document.addEventListener('DOMContentLoaded', function () {

        getEvents();
        setInterval(actualizarTabla, 10000);

    });




</script>