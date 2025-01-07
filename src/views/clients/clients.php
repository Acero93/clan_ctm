<h1>Listado de Clientes</h1>
<div class="table-dark" id="clientes-tabla"></div>


<?= loadScripts($scripts ?? []) ?>
<script>
    fetchRequest('/clients')
    .then(data => {
        // Verificar si 'data' es un objeto y convertirlo a un array
        const clientsData = Array.isArray(data) ? data : Object.values(data); // Asegurarte de que los datos sean un array
        // Inicializar Tabulator con los datos
        const tablaClientes = new Tabulator("#clientes-tabla", {
            layout: "fitColumns", // Ajustar las columnas al contenedor
            pagination: "local",  // Activar paginación local
            paginationSize: 10,   // Número de filas por página
            placeholder: "No hay datos disponibles",
            columns: [
                { title: "ID", field: "id", width: 50, headerFilter: "input" },
                { title: "Nombre", field: "first_name", headerFilter: "input" },
                { title: "Apellido", field: "last_name", headerFilter: "input" },
                { title: "Teléfono", field: "phone_number", headerFilter: "input" },
                { title: "Dirección", field: "address", headerFilter: "input" },
                { title: "Estado", field: "status", headerFilter: "input"},
                { title: "Creado", field: "created_at", sorter: "datetime", hozAlign: "center", headerFilter: "input" },
                { title: "Actualizado", field: "updated_at", sorter: "datetime", hozAlign: "center", headerFilter: "input" },
                {
                    title: "Acciones",
                    formatter: function(cell, formatterParams, onRendered) {
                        // Botones personalizados
                        return `
                        <button class="btn btn-sm btn-warning editar-btn">Editar</button>
                        <button class="btn btn-sm btn-danger eliminar-btn">Eliminar</button>
                        `;
                    },
                    width: 150,
                    hozAlign: "center",
                    cellClick: function(e, cell) {
                        const rowData = cell.getRow().getData();
                        
                        // Identificar qué botón fue presionado
                        if (e.target.classList.contains("editar-btn")) {
                            window.location.href = "/clientes/ver/" + rowData.id;
                        } 

                        if (e.target.classList.contains("eliminar-btn")) {
                            if (confirm(`¿Estás seguro de eliminar al cliente: ${rowData.first_name} ${rowData.last_name}?`)) {
                                fetchRequest(`/client/delete/${rowData.id}`, 'DELETE')
                                .then(response => {
                                    if (response.success) {
                                        alert("Eliminado correctamente");
                                        cell.getRow().delete();
                                        // window.location.reload();
                                    } else {
                                        alert("Error al eliminar el cliente");
                                    }
                                })
                                .catch(error => {
                                    console.error('Error al eliminar el cliente:', error);
                                });
                            }
                        }

                    },
                },
            ],
            data: clientsData,
        });
    })
    .catch(error => {
        console.error('Error:', error);
    });

</script>