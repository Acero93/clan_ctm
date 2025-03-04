<?php


use Controllers\JsonSchemaController;

    $schema = [
        "type" => "object",
        "properties" => [
            "name" => [
                "type" => "string",
                "title" => "Nombre",
                "minLength" => 3,
                "class" => "form-control"
            ],
            "age" => [
                "type" => "integer",
                "title" => "Edad",
                "minimum" => 0,
                "class" => "form-control"
            ],
            "email" => [
                "type" => "string",
                "title" => "Correo electrónico",
                "format" => "email",
                "class" => "form-control"
            ],
            "subscribe" => [
                "type" => "boolean",
                "title" => "Suscribirse al boletín",
                "class" => "form-check-input"
            ]
        ],
        "required" => ["name", "email"]
    ];

    $jsonSchemaController = new JsonSchemaController();
    // echo $jsonSchemaController->generateForm($schema);

    // echo "holas";

?>


<div id="table"></div>

<?= loadScripts($scripts ?? []) ?>

<script>

    let table;
    // 1. Obtener los datos desde el backend
    fetch('/players') // Ruta al script PHP que devuelve los datos
        .then(response => response.json())
        .then(data => {
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
</script>