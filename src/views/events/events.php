<?php

?>


<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Listado de eventos</h1>
</div>

<button type="button" class="btn btn-primary my-3" onclick="abrirFormularioCrearEvento()">
    Nuevo evento
</button>

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
                    { title: "Descripción", field: "description", headerFilter: "input" },
                    { title: "Tipo de Evento", field: "event_type", headerFilter: "input" },
                    { title: "Fecha", field: "event_date", headerFilter: "input" },
                    { title: "IP del Servidor", field: "server_ip", headerFilter: "input" },
                    { title: "Asistencia Esperada", field: "expected_attendance", headerFilter: "input" },
                    { title: "Asistencia Real", field: "actual_attendance", headerFilter: "input" },
                    { title: "Estado", field: "status", headerFilter: "input" },
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

    function eliminarEvento(eventId) {
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
                // Llamada a la API para eliminar el evento
                fetchRequest(`/events/delete/${eventId}`, {}, 'DELETE')
                .then(response => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Eliminado',
                        text: 'El evento ha sido eliminado correctamente.',
                    });
                    // Recargar la tabla después de eliminar
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

    function abrirFormularioEdicionEvento(eventId) {
        // Obtener los datos del evento por su ID
        fetchRequest(`/events/${eventId}`, {}, 'GET')
        .then(data => {
            const eventData = data; // Acceder al evento específico

            // Abrir el formulario de edición
            Swal.fire({
                title: 'Editar Evento',
                html: `
                <form id="edit-event-form">
                    <div class="form-group">
                        <label for="name">Nombre</label>
                        <input type="text" id="name" class="form-control" value="${eventData.name}" required>
                    </div>
                    <div class="form-group">
                        <label for="description">Descripción</label>
                        <textarea id="description" class="form-control">${eventData.description}</textarea>
                    </div>



                    <div class="form-group">
                        <label for="event_type">Tipo de Evento</label>
                        <select id="event_type" class="form-control">
                            <option value="0" ${eventData.event_type === 'Entrenamiento interno' ? 'selected' : ''}>Entrenamiento interno</option>
                            <option value="1" ${eventData.event_type === 'Entrenamiento externo' ? 'selected' : ''}>Entrenamiento externo</option>
                            <option value="2" ${eventData.event_type === 'Evento: CvC' ? 'selected' : ''}>Evento: CvC</option>
                            <option value="3" ${eventData.event_type === 'Evento: Senado' ? 'selected' : ''}>Evento: Senado</option>
                            <option value="4" ${eventData.event_type === 'Evento: Competitivo' ? 'selected' : ''}>Evento: Competitivo</option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="event_date">Fecha</label>
                        <input type="datetime-local" id="event_date" class="form-control" value="${eventData.event_date}">
                    </div>
                    <div class="form-group">
                        <label for="server_ip">IP del Servidor</label>
                        <input type="text" id="server_ip" class="form-control" value="${eventData.server_ip}">
                    </div>
                    <div class="form-group">
                        <label for="expected_attendance">Asistencia Esperada</label>
                        <input type="number" id="expected_attendance" class="form-control" value="${eventData.expected_attendance}">
                    </div>
                    <div class="form-group">
                        <label for="actual_attendance">Asistencia Real</label>
                        <input type="number" id="actual_attendance" class="form-control" value="${eventData.actual_attendance}">
                    </div>

                    <div class="form-group">
                        <label for="status">Estado</label>
                        <select id="status" class="form-control">
                            <option value="Programado" ${eventData.status === 'Programado' ? 'selected' : ''}>Programado</option>
                            <option value="Terminado" ${eventData.status === 'Terminado' ? 'selected' : ''}>Terminado</option>
                            <option value="Cancelado" ${eventData.status === 'Cancelado' ? 'selected' : ''}>Cancelado</option>
                        </select>
                    </div>

                    
                </form>
                `,
                showCancelButton: true,
                confirmButtonText: 'Guardar',
                cancelButtonText: 'Cancelar',
                preConfirm: () => {
                    const form = document.getElementById('edit-event-form');
                    const updatedData = {
                        id: eventId, // Incluir el ID en el cuerpo de la solicitud
                        name: form.querySelector('#name').value,
                        description: form.querySelector('#description').value,
                        event_type: form.querySelector('#event_type').value,
                        event_date: form.querySelector('#event_date').value,
                        server_ip: form.querySelector('#server_ip').value,
                        expected_attendance: parseInt(form.querySelector('#expected_attendance').value),
                        actual_attendance: parseInt(form.querySelector('#actual_attendance').value),
                        status: form.querySelector('#status').value,
                    };

                    // Validar campos obligatorios
                    if (!updatedData.name || !updatedData.event_date) {
                        Swal.showValidationMessage('Los campos "Nombre" y "Fecha" son obligatorios.');
                        return false;
                    }

                    // Llamada a la API para guardar o actualizar el evento
                    return fetchRequest('/events/save', updatedData, 'POST')
                    .then(response => {
                        if (!response.success) {
                            throw new Error(response.message); // Lanza un error si no es exitoso
                        }
                        return response; // Devuelve la respuesta completa
                    });
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Acceder a la respuesta desde result.value
                    console.log(result.value); // {success: true, status: "success", message: "Guardado correctamente", id: 3}

                    if (result.value && result.value.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Actualizado',
                            text: 'El evento ha sido actualizado correctamente.',
                        });
                        // Recargar la tabla después de editar
                        actualizarTabla();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'No se pudo actualizar el evento. Por favor, inténtalo de nuevo.',
                        });
                    }
                }
            }).catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: error.message || 'Ocurrió un error al actualizar el evento.',
                });
            });
        })
        .catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'No se pudieron cargar los datos del evento. Por favor, inténtalo de nuevo.',
            });
        });
    }

    // Función para abrir el formulario de creación
    function abrirFormularioCrearEvento() {

        const now = new Date();
        const minDate = now.toISOString().slice(0, 16); // Formato compatible con datetime-local

        Swal.fire({
            title: 'Crear Nuevo Evento',
            html: `
            <form id="create-event-form">
                <div class="form-group">
                    <label for="name">Nombre</label>
                    <input type="text" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description">Descripción</label>
                    <textarea id="description" class="form-control"></textarea>
                </div>

                
                <div class="form-group">
                    <label for="event_type">Tipo de Evento</label>
                    <select id="event_type" class="form-control">
                        <option value="0">Entrenamiento interno</option>
                        <option value="1">Entrenamiento externo</option>
                        <option value="2">Evento: CvC</option>
                        <option value="3">Evento: Senado</option>
                        <option value="2">Evento: Competitivo</option>
                    </select>
                </div>


                <div class="form-group">
                    <label for="event_date">Fecha</label>
                    <input type="datetime-local" id="event_date" class="form-control" min="${minDate}" required>
                </div>
                <div class="form-group">
                    <label for="server_ip">IP del Servidor</label>
                    <input type="text" id="server_ip" class="form-control">
                </div>
                <div class="form-group">
                    <label for="expected_attendance">Asistencia Esperada</label>
                    <input type="number" id="expected_attendance" class="form-control">
                </div>
            </form>
            `,
            showCancelButton: true,
            confirmButtonText: 'Crear',
            cancelButtonText: 'Cancelar',
            preConfirm: () => {
                const form          = document.getElementById('create-event-form');
                const event_type    = document.getElementById('event_type').value;
                const eventDateInput = form.querySelector('#event_date');
                const eventDate      = new Date(eventDateInput.value); // Convertir a objeto Date
                const now            = new Date(); // Fecha y hora actual

                // Validar que la fecha no sea anterior a la actual
                if (eventDate < now) {
                    Swal.showValidationMessage('La fecha y hora no pueden ser anteriores a la actual.');
                    return false;
                }


                const newEventData = {
                    name: form.querySelector('#name').value,
                    description: form.querySelector('#description').value,
                    event_type: event_type,
                    event_date: form.querySelector('#event_date').value,
                    server_ip: form.querySelector('#server_ip').value,
                    expected_attendance: parseInt(form.querySelector('#expected_attendance').value),
                };

                // Validar campos obligatorios
                if (!newEventData.name || !newEventData.event_date) {
                    Swal.showValidationMessage('Los campos "Nombre" y "Fecha" son obligatorios.');
                    return false;
                }

                // Llamada a la API para crear el evento
                return fetchRequest('/events/save', newEventData, 'POST')
                .then(response => {
                    if (!response.success) {
                        throw new Error(response.message);
                    }
                    return response;
                });
            }
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(result.value); // Respuesta de la API
                if (result.value && result.value.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Creado',
                        text: 'El evento ha sido creado correctamente.',
                    });
                    // Recargar la tabla después de crear
                    actualizarTabla();
                }
            }
        }).catch(error => {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: error.message || 'Ocurrió un error al crear el evento.',
            });
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