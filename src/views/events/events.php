<?php

// $endpoint_1 = $_ENV['SV1'];
// $endpoint_2 = $_ENV['SV2'];
// $endpoint_3 = $_ENV['SV3'];
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

    // const endpointSelector = document.getElementById('endpointSelector');
    // let servidorEndpoint   = endpointSelector.value;
    // let servidor;
    // let servidorInfo;
    let table;



    // Agregar un evento change al combo
    // endpointSelector.addEventListener('change', function () {
    //     servidorEndpoint = this.value;
    //     ejecutarFuncion(servidorEndpoint); 

    // });


    // Definir la función que se ejecutará al cambiar el valor del combo



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

                            if (e.target.classList.contains("edit-btn")) {
                                abrirFormularioEdicionEvento(rowData.id); // Función para abrir el formulario de edición
                                return;
                            }
                            
                            if (e.target.classList.contains("delete-btn")) {
                                eliminarEvento(rowData.id); // Función para eliminar el evento
                                return;
                            }

                            

                            
                        },
                    },
                ],
                data: eventsArray, // Los datos convertidos en un array
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
                        <input type="text" id="event_type" class="form-control" value="${eventData.event_type}">
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
                        <input type="text" id="status" class="form-control" value="${eventData.status}">
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
                    <input type="text" id="event_type" class="form-control">
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
                const form = document.getElementById('create-event-form');


                const eventDateInput = form.querySelector('#event_date');
                const eventDate = new Date(eventDateInput.value); // Convertir a objeto Date
                const now = new Date(); // Fecha y hora actual

                // Validar que la fecha no sea anterior a la actual
                if (eventDate < now) {
                    Swal.showValidationMessage('La fecha y hora no pueden ser anteriores a la actual.');
                    return false;
                }


                const newEventData = {
                    name: form.querySelector('#name').value,
                    description: form.querySelector('#description').value,
                    event_type: form.querySelector('#event_type').value,
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

    // async function actualizarLista(endpoint) {
    //     try {

    //         const data = await fetchRequest('/get_player_list', { endpoint: endpoint });


    //         if (!data || !data.message || !data.message.result) {
    //             throw new Error("Datos de jugadores no válidos");
    //         }

    //         table.setData(data.message.result);

    //     } catch (error) {


    //         console.error('Error en actualizarLista:', error);
    //     }
    // }


    // function abrirFormularioMensajeMasivo() {
    //     Swal.fire({
    //         title: 'Enviar Mensaje Masivo',
    //         input: 'textarea',
    //         inputLabel: 'Escribe tu mensaje',
    //         inputPlaceholder: 'Escribe aquí el mensaje que deseas enviar a todos los jugadores...',
    //         showCancelButton: true,
    //         confirmButtonText: 'Enviar',
    //         cancelButtonText: 'Cancelar',
    //         showLoaderOnConfirm: true,
    //         preConfirm: async (mensaje) => {
    //             if (!mensaje) {
    //                 Swal.showValidationMessage('Por favor, escribe un mensaje.');
    //                 return false;
    //             }
    //             return await enviarMensajeMasivo(mensaje);
    //         },
    //         allowOutsideClick: () => !Swal.isLoading()
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Mensaje enviado',
    //                 text: 'El mensaje se ha enviado correctamente a todos los jugadores.'
    //             });
    //         }
    //     });
    // }

    // function abrirFormularioMensaje(player_id) {
    //     Swal.fire({
    //         title: 'Enviar Mensaje',
    //         input: 'textarea',
    //         inputLabel: 'Escribe tu mensaje',
    //         inputPlaceholder: 'Escribe aquí el mensaje que deseas enviar...',
    //         showCancelButton: true,
    //         confirmButtonText: 'Enviar',
    //         cancelButtonText: 'Cancelar',
    //         showLoaderOnConfirm: true,
    //         preConfirm: async (mensaje) => {
    //             if (!mensaje) {
    //                 Swal.showValidationMessage('Por favor, escribe un mensaje.');
    //                 return false;
    //             }
    //             return await enviarMensajeJugador(mensaje, player_id);
    //         },
    //         allowOutsideClick: () => !Swal.isLoading()
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Mensaje enviado',
    //                 text: 'El mensaje se ha enviado correctamente al jugador'
    //             });
    //         }
    //     });
    // }

    // function abrirFormularioKickeoMasivo() {
    //     Swal.fire({
    //         title: '¿Estás seguro?',
    //         text: "Esta función permite kickear a todos los jugadores que no sean del clan. -- [v1]",
    //         icon: 'warning',
    //         showCancelButton: true,
    //         confirmButtonText: 'Sí, kickear',
    //         cancelButtonText: 'Cancelar',
    //         showLoaderOnConfirm: true,
    //         preConfirm: async () => {

    //             try {
    //                 // Lógica para realizar el kickeo masivo
    //                 const resultado = await realizarKickeoMasivo();
    //                 return resultado;
    //             } catch (error) {
    //                 Swal.showValidationMessage('Error al realizar el kickeo masivo.');
    //                 return false;
    //             }
    //         },
    //         allowOutsideClick: () => !Swal.isLoading()
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Kickeo masivo realizado',
    //                 text: 'Los jugadores han sido kickeados correctamente.'
    //             });
    //         }
    //     });
    // }

    // function abrirFormularioKickeoPlayer(player_name ) {
    //     Swal.fire({
    //         title: '¿Estás seguro?',
    //         text: "Estás a punto de kickear al jugador: " + player_name,
    //         icon: 'warning',
    //         input: 'text', // Campo de texto
    //         inputPlaceholder: 'Ingresa la razón del kickeo...', // Placeholder del campo de texto
    //         inputValidator: (value) => {
    //             // Validar que el campo no esté vacío
    //             if (!value) {
    //                 return 'Debes ingresar una razón para el kickeo.';
    //             }
    //         },
    //         showCancelButton: true,
    //         confirmButtonText: 'Sí, kickear',
    //         cancelButtonText: 'Cancelar',
    //         showLoaderOnConfirm: true,
    //         preConfirm: async (razon) => { // El valor del campo de texto se pasa como parámetro
    //             try {
    //                 // Lógica para realizar el kickeo
    //                 const resultado = await realizarKickeoPlayer(player_name, razon); // Pasar la razón al kickeo
    //                 return resultado;
    //             } catch (error) {
    //                 Swal.showValidationMessage('Error al realizar el kickeo.');
    //                 return false;
    //             }
    //         },
    //         allowOutsideClick: () => !Swal.isLoading()
    //     }).then((result) => {
    //         if (result.isConfirmed) {
    //             Swal.fire({
    //                 icon: 'success',
    //                 title: 'Jugador expulsado',
    //                 text: 'El jugador ha sido kickeado correctamente.'
    //             });
    //         }
    //     });

    // }


    // async function obtenerServerData(endpoint) {
    //     try {
    //         const response = await fetchRequest("/get_server_data", {
    //             endpoint : endpoint
    //         });

    //         if (response.success) {
    //             servidorInfo = response.message.result;
    //             document.getElementById('total-registros').textContent = ` ${servidorInfo.player_count}`;
    //             document.getElementById('nombre-servidor').textContent = ` ${servidorInfo.name.name}`;
    //             document.getElementById('mapa').textContent = ` ${servidorInfo.current_map.map.pretty_name}`;
    //         } else {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Error',
    //                 text: 'Hubo un error al enviar el mensaje.'
    //             });
    //             return false;
    //         }
    //     } catch (error) {
    //         console.error('Error:', error);
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Error',
    //             text: 'Hubo un error al enviar el mensaje.'
    //         });
    //         return false;
    //     }
    // }
    // Función para enviar el mensaje masivo
    // async function enviarMensajeMasivo(mensaje) {
    //     const endpoint = document.getElementById('endpointSelector').value;

    //     try {
    //         const response = await fetchRequest("/message_masive_players", {
    //             endpoint : endpoint,
    //             message: mensaje
    //         });

    //         if (response.success) {
    //             return true;
    //         } else {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Error',
    //                 text: 'Hubo un error al enviar el mensaje.'
    //             });
    //             return false;
    //         }
    //     } catch (error) {
    //         console.error('Error:', error);
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Error',
    //             text: 'Hubo un error al enviar el mensaje.'
    //         });
    //         return false;
    //     }
    // }

    // async function enviarMensajeJugador(mensaje, player_id) {
    //     const endpoint = document.getElementById('endpointSelector').value;

    //     try {
    //         const response = await fetchRequest("/message_player", {
    //             endpoint : endpoint,
    //             message  : mensaje,
    //             player_id: player_id
    //         });

    //         if (response.success) {
    //             return true;
    //         } else {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Error',
    //                 text: 'Hubo un error al enviar el mensaje.'
    //             });
    //             return false;
    //         }
    //     } catch (error) {
    //         console.error('Error:', error);
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Error',
    //             text: 'Hubo un error al enviar el mensaje.'
    //         });
    //         return false;
    //     }
    // }


    // async function realizarKickeoPlayer(player_name ,mensaje = ""){
    //     try {
    //         const response = await fetchRequest("/kick_player", {
    //             endpoint    : servidorEndpoint,
    //             message     : mensaje,
    //             player_name : player_name
    //         });

    //         if (response.success) {
    //             return true;
    //         } else {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Error',
    //                 text: response.message
    //             });
    //             return false;
    //         }
    //     } catch (error) {
    //         console.error('Error:', error);
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Error',
    //             text: 'Hubo un error al enviar el mensaje.'
    //         });
    //         return false;
    //     }
    // }

    // async function realizarKickeoMasivo(mensaje = "") {
    //     // const endpoint = document.getElementById('endpointSelector').value;

    //     try {
    //         const response = await fetchRequest("/kick_player_no_clan", {
    //             endpoint : servidorEndpoint,
    //             message  : mensaje
    //         });

    //         if (response.success) {
    //             return true;
    //         } else {
    //             Swal.fire({
    //                 icon: 'error',
    //                 title: 'Error',
    //                 text: response.message
    //             });
    //             return false;
    //         }
    //     } catch (error) {
    //         console.error('Error:', error);
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Error',
    //             text: 'Hubo un error al enviar el mensaje.'
    //         });
    //         return false;
    //     }
    // }
    
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
        // setInterval(obtenerInfoSV, 10000);

    });


    function obtenerInfoSV() {
        actualizarLista(servidorEndpoint);
        obtenerServerData(servidorEndpoint);
    }



</script>