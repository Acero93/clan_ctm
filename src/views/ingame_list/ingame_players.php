<?php

$endpoint_1 = $_ENV['SV1'];
$endpoint_2 = $_ENV['SV2'];
$endpoint_3 = $_ENV['SV3'];
?>


<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Listado de servidores</h1>





    <div class="form-group">
        <label for="endpointSelector" class="form-label">Selecciona servidor</label>
        <select id="endpointSelector" class="form-select">
            <option value="<?= $endpoint_1 ?>">SV #3</option>
            <option value="<?= $endpoint_2 ?>">SV #2</option>
            <option value="<?= $endpoint_3 ?>">SV #1</option>
        </select>
    </div>


    <button type="button" class="btn btn-primary mt-3" onclick="abrirFormularioKickeoMasivo()">
        Limpiar por evento
    </button>

    <button type="button" class="btn btn-primary mt-3" onclick="abrirFormularioMensajeMasivo()">
        Mensaje Masivo
    </button>


</div>

<div>
     Total de registros:<span id="total-registros"> 0</span>
</div>
<div>
    Nombre del servidor:<span id="nombre-servidor"> </span>
</div>
<div>
    Mapa actual:<span id="mapa"> </span>
</div>

<div class="table-dark" id="players-tabla"></div>



<?= loadScripts($scripts ?? []) ?>
<script>

    const endpointSelector = document.getElementById('endpointSelector');
    let servidorEndpoint   = endpointSelector.value;
    let servidor;
    let servidorInfo;
    let table;



    // Agregar un evento change al combo
    endpointSelector.addEventListener('change', function () {
        servidorEndpoint = this.value;
        ejecutarFuncion(servidorEndpoint); 

    });


    // Definir la función que se ejecutará al cambiar el valor del combo
    async function ejecutarFuncion(endpoint) {

        Swal.fire({
            title: 'Cargando...',
            text: 'Por favor, espera mientras se cargan los datos.',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading(); // Muestra el spinner de carga
            }
        });

        obtenerServerData(endpoint);

        fetchRequest('/get_player_list', { endpoint: endpoint })
        .then(data => {

            servidor = data.message.result;
                table = new Tabulator("#players-tabla", {
                layout: "fitColumns",
                pagination: "local",  
                paginationSize: 15,   
                columns: [
                    {   title: "Nombre", field: "name", headerFilter: "input" },
                    {   title: "ID del Jugador", field: "player_id", headerFilter: "input" },
                    {   title: "VIP", field: "is_vip", formatter: "tickCross" },
                    {
                        title: "Acciones",
                        formatter: function(cell, formatterParams, onRendered) {
                            // Botones personalizados
                            return `
                            <button class="btn btn-sm btn-warning kick-btn">Kick</button>
                            
                            <button class="btn btn-sm btn-danger msg-btn">Msg</button>
                            `;
                        },
                        width: 150,
                        hozAlign: "center",
                        cellClick: function(e, cell) {
                            const rowData = cell.getRow().getData();
                            
                            // Identificar qué botón fue presionado
                            if (e.target.classList.contains("kick-btn")) {
                                abrirFormularioKickeoPlayer(rowData.nombre);
                            } 

                            if (e.target.classList.contains("ban-btn")) {
                                
                            }

                            if (e.target.classList.contains("msg-btn")) {
                                abrirFormularioMensaje(rowData.player_id);
                            }

                        },
                    },
                ],
                data: data.message.result,


            });

            Swal.close();
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }


    async function actualizarLista(endpoint) {
        try {

            const data = await fetchRequest('/get_player_list', { endpoint: endpoint });


            if (!data || !data.message || !data.message.result) {
                throw new Error("Datos de jugadores no válidos");
            }

            table.setData(data.message.result);

        } catch (error) {


            console.error('Error en actualizarLista:', error);
        }
    }


    function abrirFormularioMensajeMasivo() {
        Swal.fire({
            title: 'Enviar Mensaje Masivo',
            input: 'textarea',
            inputLabel: 'Escribe tu mensaje',
            inputPlaceholder: 'Escribe aquí el mensaje que deseas enviar a todos los jugadores...',
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: async (mensaje) => {
                if (!mensaje) {
                    Swal.showValidationMessage('Por favor, escribe un mensaje.');
                    return false;
                }
                return await enviarMensajeMasivo(mensaje);
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Mensaje enviado',
                    text: 'El mensaje se ha enviado correctamente a todos los jugadores.'
                });
            }
        });
    }

    function abrirFormularioMensaje(player_id) {
        Swal.fire({
            title: 'Enviar Mensaje',
            input: 'textarea',
            inputLabel: 'Escribe tu mensaje',
            inputPlaceholder: 'Escribe aquí el mensaje que deseas enviar...',
            showCancelButton: true,
            confirmButtonText: 'Enviar',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: async (mensaje) => {
                if (!mensaje) {
                    Swal.showValidationMessage('Por favor, escribe un mensaje.');
                    return false;
                }
                return await enviarMensajeJugador(mensaje, player_id);
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Mensaje enviado',
                    text: 'El mensaje se ha enviado correctamente al jugador'
                });
            }
        });
    }

    function abrirFormularioKickeoMasivo() {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Esta función permite kickear a todos los jugadores que no sean del clan. -- [v1]",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Sí, kickear',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: async () => {

                try {
                    // Lógica para realizar el kickeo masivo
                    const resultado = await realizarKickeoMasivo();
                    return resultado;
                } catch (error) {
                    Swal.showValidationMessage('Error al realizar el kickeo masivo.');
                    return false;
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Kickeo masivo realizado',
                    text: 'Los jugadores han sido kickeados correctamente.'
                });
            }
        });
    }

    function abrirFormularioKickeoPlayer(player_name ) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Estás a punto de kickear al jugador: " + player_name,
            icon: 'warning',
            input: 'text', // Campo de texto
            inputPlaceholder: 'Ingresa la razón del kickeo...', // Placeholder del campo de texto
            inputValidator: (value) => {
                // Validar que el campo no esté vacío
                if (!value) {
                    return 'Debes ingresar una razón para el kickeo.';
                }
            },
            showCancelButton: true,
            confirmButtonText: 'Sí, kickear',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            preConfirm: async (razon) => { // El valor del campo de texto se pasa como parámetro
                try {
                    // Lógica para realizar el kickeo
                    const resultado = await realizarKickeoPlayer(player_name, razon); // Pasar la razón al kickeo
                    return resultado;
                } catch (error) {
                    Swal.showValidationMessage('Error al realizar el kickeo.');
                    return false;
                }
            },
            allowOutsideClick: () => !Swal.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    icon: 'success',
                    title: 'Jugador expulsado',
                    text: 'El jugador ha sido kickeado correctamente.'
                });
            }
        });

    }


    async function obtenerServerData(endpoint) {
        try {
            const response = await fetchRequest("/get_server_data", {
                endpoint : endpoint
            });

            if (response.success) {
                servidorInfo = response.message.result;
                document.getElementById('total-registros').textContent = ` ${servidorInfo.player_count}`;
                document.getElementById('nombre-servidor').textContent = ` ${servidorInfo.name.name}`;
                document.getElementById('mapa').textContent = ` ${servidorInfo.current_map.map.pretty_name}`;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al enviar el mensaje.'
                });
                return false;
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al enviar el mensaje.'
            });
            return false;
        }
    }
    // Función para enviar el mensaje masivo
    async function enviarMensajeMasivo(mensaje) {
        const endpoint = document.getElementById('endpointSelector').value;

        try {
            const response = await fetchRequest("/message_masive_players", {
                endpoint : endpoint,
                message: mensaje
            });

            if (response.success) {
                return true;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al enviar el mensaje.'
                });
                return false;
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al enviar el mensaje.'
            });
            return false;
        }
    }

    async function enviarMensajeJugador(mensaje, player_id) {
        const endpoint = document.getElementById('endpointSelector').value;

        try {
            const response = await fetchRequest("/message_player", {
                endpoint : endpoint,
                message  : mensaje,
                player_id: player_id
            });

            if (response.success) {
                return true;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Hubo un error al enviar el mensaje.'
                });
                return false;
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al enviar el mensaje.'
            });
            return false;
        }
    }


    async function realizarKickeoPlayer(player_name ,mensaje = ""){
        try {
            const response = await fetchRequest("/kick_player", {
                endpoint    : servidorEndpoint,
                message     : mensaje,
                player_name : player_name
            });

            if (response.success) {
                return true;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
                return false;
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al enviar el mensaje.'
            });
            return false;
        }
    }

    async function realizarKickeoMasivo(mensaje = "") {
        // const endpoint = document.getElementById('endpointSelector').value;

        try {
            const response = await fetchRequest("/kick_player_no_clan", {
                endpoint : servidorEndpoint,
                message  : mensaje
            });

            if (response.success) {
                return true;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message
                });
                return false;
            }
        } catch (error) {
            console.error('Error:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al enviar el mensaje.'
            });
            return false;
        }
    }
    
    async function fetchRequest(url, bodyData = {}, method = 'POST') {
        try {
            const response = await fetch(url, {
                method, 
                headers: {
                    'Content-Type': 'application/json', // Indicamos que el contenido es JSON
                },
                body: JSON.stringify(bodyData), // Convertimos los datos a JSON
            });

            if (!response.ok) {
                throw new Error(`Error en la solicitud: ${response.status}`);
            }

            return await response.json(); // Parseamos y devolvemos la respuesta
        } catch (error) {
            throw new Error(`Error en fetchRequest: ${error.message}`);
        }
    }


    document.addEventListener('DOMContentLoaded', function () {

        ejecutarFuncion(servidorEndpoint);
        setInterval(obtenerInfoSV, 10000);

    });


    function obtenerInfoSV() {
        actualizarLista(servidorEndpoint);
        obtenerServerData(servidorEndpoint);
    }



</script>