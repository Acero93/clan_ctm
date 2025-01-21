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
</div>
<div class="table-dark" id="clientes-tabla"></div>



<?= loadScripts($scripts ?? []) ?>
<script>

    const endpointSelector = document.getElementById('endpointSelector').value;

    alert(endpointSelector);
    // fetchRequest('/clients')
    // .then(data => {
        
    //     console.log(data);

    //     // // Verificar si 'data' es un objeto y convertirlo a un array
    //     // const clientsData = Array.isArray(data) ? data : Object.values(data); // Asegurarte de que los datos sean un array
    //     // // Inicializar Tabulator con los datos
    //     // const tablaClientes = new Tabulator("#clientes-tabla", {
    //     //     layout: "fitColumns", // Ajustar las columnas al contenedor
    //     //     pagination: "local",  // Activar paginación local
    //     //     paginationSize: 10,   // Número de filas por página
    //     //     placeholder: "No hay datos disponibles",
    //     //     columns: [
    //     //         { title: "ID", field: "id", width: 50, headerFilter: "input" },
    //     //         { title: "Nombre", field: "first_name", headerFilter: "input" },
    //     //         { title: "Apellido", field: "last_name", headerFilter: "input" },
    //     //         { title: "Teléfono", field: "phone_number", headerFilter: "input" },
    //     //         { title: "Dirección", field: "address", headerFilter: "input" },
    //     //         { title: "Estado", field: "status", headerFilter: "input"},
    //     //         { title: "Creado", field: "created_at", sorter: "datetime", hozAlign: "center", headerFilter: "input" },
    //     //         { title: "Actualizado", field: "updated_at", sorter: "datetime", hozAlign: "center", headerFilter: "input" },
    //     //         {
    //     //             title: "Acciones",
    //     //             formatter: function(cell, formatterParams, onRendered) {
    //     //                 // Botones personalizados
    //     //                 return `
    //     //                 <button class="btn btn-sm btn-warning editar-btn">Editar</button>
    //     //                 <button class="btn btn-sm btn-danger eliminar-btn">Eliminar</button>
    //     //                 `;
    //     //             },
    //     //             width: 150,
    //     //             hozAlign: "center",
    //     //             cellClick: function(e, cell) {
    //     //                 const rowData = cell.getRow().getData();
                        
    //     //                 // Identificar qué botón fue presionado
    //     //                 if (e.target.classList.contains("editar-btn")) {
    //     //                     window.location.href = "/clientes/ver/" + rowData.id;
    //     //                 } 

    //     //                 if (e.target.classList.contains("eliminar-btn")) {
    //     //                     if (confirm(`¿Estás seguro de eliminar al cliente: ${rowData.first_name} ${rowData.last_name}?`)) {
    //     //                         fetchRequest(`/client/delete/${rowData.id}`, 'DELETE')
    //     //                         .then(response => {
    //     //                             if (response.success) {
    //     //                                 alert("Eliminado correctamente");
    //     //                                 cell.getRow().delete();
    //     //                                 // window.location.reload();
    //     //                             } else {
    //     //                                 alert("Error al eliminar el cliente");
    //     //                             }
    //     //                         })
    //     //                         .catch(error => {
    //     //                             console.error('Error al eliminar el cliente:', error);
    //     //                         });
    //     //                     }
    //     //                 }

    //     //             },
    //     //         },
    //     //     ],
    //     //     data: clientsData,
    //     // });
    // })
    // .catch(error => {
    //     console.error('Error:', error);
    // });





    // Suponiendo que fetchRequest sea algo así:
    async function fetchRequest(url, options = {}) {
        try {
            const response = await fetch(url, options);
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return await response.json();
        } catch (error) {
            console.error('Error in fetchRequest:', error);
            throw error;
        }
    }

    // Uso del token para hacer la solicitud
    const token = "TU_TOKEN_AQUÍ"; // Reemplaza con tu token válido
    // const endpoint = "http://154.53.62.97:8011/api/get_player_profile";

    const options = {
        method: "GET", // Cambia a "POST" si es necesario
        headers: {
            "Authorization": `Bearer cf9e6585-ce60-4d13-b6cf-b72665159e4d`,
            "Content-Type": "application/json",
        },
    };

    // fetchRequest(endpointSelector+"/api/get_api_documentation", options)
    // .then(data => {
    //     console.log(data);
    // })
    // .catch(error => {
    //     console.error("Error al obtener el perfil del jugador:", error);
    // });


    fetch('https://server1.rconctm.xyz/api/get_api_documentation', {
        method: 'GET',
        mode: 'no-cors',
    }).then(response => {
        console.log(response); // No podrás ver el contenido de la respuesta
    });
        

</script>