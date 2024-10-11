$(document).ready(function () {
    $('#areas').DataTable({
        columnDefs: [
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: -1 }],
        responsive: true,
        pageLength: 50,
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros.",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            row: "Registro",
            export: "Exportar",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Ultimo"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            },
            select: {
                row: "registro",
                selected: "seleccionado"
            }
        },
        dom: 'Bfrtip',
        buttons: [{
            extend: 'collection',
            text: 'Exportar',
            buttons: [
                'copy',
                'excel',
                'csv',
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body)
                            .css('font-size', '10pt');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]
        }

        ]
    });


    $('#cargos').DataTable({
        columnDefs: [
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: -1 }],
        responsive: true,
        pageLength: 50,
        language: {
            processing: "Procesando...",
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros.",
            info: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            infoEmpty: "Mostrando registros del 0 al 0 de 0 registros",
            infoFiltered: "(filtrado de un total de _MAX_ registros)",
            infoPostFix: "",
            loadingRecords: "Cargando...",
            zeroRecords: "No se encontraron resultados",
            emptyTable: "Ningún dato disponible en esta tabla",
            row: "Registro",
            export: "Exportar",
            paginate: {
                first: "Primero",
                previous: "Anterior",
                next: "Siguiente",
                last: "Ultimo"
            },
            aria: {
                sortAscending: ": Activar para ordenar la columna de manera ascendente",
                sortDescending: ": Activar para ordenar la columna de manera descendente"
            },
            select: {
                row: "registro",
                selected: "seleccionado"
            }
        },
        dom: 'Bfrtip',
        buttons: [{
            extend: 'collection',
            text: 'Exportar',
            buttons: [
                'copy',
                'excel',
                'csv',
                {
                    extend: 'pdfHtml5',
                    text: 'PDF',
                    orientation: 'landscape',
                    pageSize: 'LEGAL'
                },
                {
                    extend: 'print',
                    customize: function (win) {
                        $(win.document.body)
                            .css('font-size', '10pt');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]
        }

        ]
    });
});

function obtener_datos_area(id) {
    var Nombre = $("#nombre_area" + id).val();
    var Padre = $("#padre" + id).val();
    var Jerarquia = $("#jerarquia" + id).val();
    var Estado = $("#estado_activo" + id).val();

    $("#idArea_upd").val(id);
    $("#mod_nombre_area").val(Nombre);
    $("#mod_padre").val(Padre);
    $("#mod_jerarquia").val(Jerarquia);
    $("#mod_estado").val(Estado);
}

function obtener_datos_cargo(id) {
    var Nombre = $("#nombre_cargo" + id).val();
    var Area = $("#id_area" + id).val();
    var NivelJerarquico = $("#nivel_jerarquico" + id).val();
    var Estado = $("#estado_activo" + id).val();

    $("#idCargo_upd").val(id);
    $("#idCargo_delete").val(id);
    $("#mod_nombre_cargo").val(Nombre);
    $("#mod_area").val(Area);
    $("#mod_nivel_jerarquico").val(NivelJerarquico);
    $("#mod_estado").val(Estado);
}

