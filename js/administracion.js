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

    $('#auditoria').DataTable({
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

    $('#colaboradores').DataTable({
        destroy: true,
        ajax: {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "colaboradoresEmpresa",
            type: "get",
            dataSrc: function (json) {
                // console.log("Respuesta API:", json);
                return Object.values(json.data) || [];  // Convierte el objeto en un array
            }
        },
        columns: [
            { data: "documento" },
            { data: "foto_tabla", defaultContent: "Sin foto" },
            { data: "nombre" },
            { data: "correo" },
            { data: "nombre_cargo", defaultContent: "No asignado" },
            { data: "nombre_vp", defaultContent: "No asignado" },
            { data: "nombre_area", defaultContent: "No asignado" },
            { data: "nombre_rol", defaultContent: "Sin rol" },
            {
                data: "estado",
                render: function (data, type, row) {
                    return `<span class="${row.label}"><b>${data}</b></span>`;
                }
            },
            {
                data: "verificar",
                render: function (data, type, row) {
                    return `<span class="${row.label_verificar}"><b>${data}</b></span>`;
                }
            },
            {
                data: "id",
                render: function (data) {
                    return `<a href="detalleColaborador?colaborador=${data}" class="btn btn-warning" id="tableEditButton" title="Editar">
                                <i class="icon-pencil2"></i>
                            </a>`;
                }
            }
        ],
        columnDefs: [
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: -1 }],
        responsive: true,
        order: [
            [2, 'asc']
        ],
        pageLength: 100,
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

    $('#liderColaborador').DataTable({
        columnDefs: [
            { responsivePriority: 1, targets: 1 },
            { responsivePriority: 2, targets: -1 }],
        responsive: true,
        order: [
            [2, 'asc']
        ],
        pageLength: 10,
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
        }
    });
});

function obtener_datos_area(id) {
    var Nombre = $("#nombre_area" + id).val();
    var Padre = $("#padre" + id).val();
    var Jerarquia = $("#jerarquia" + id).val();
    var Estado = $("#estado_activo" + id).val();

    $("#idArea_upd").val(id);
    $("#idArea_delete").val(id);
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

$('#foto').change(function () {
    var clone = $(this).clone();
    clone.attr('id', 'foto1');
    clone.attr('name', 'foto1');
    $('#field2_area').html(clone);
});

$('#mod_foto_upd').change(function () {
    var clone = $(this).clone();
    clone.attr('id', 'foto2');
    clone.attr('name', 'foto2');
    $('#field2_area1').html(clone);
});

function select_vicepresidencia() {
    var tipo = 'get';
    $("#unidad_corporativa option:selected").each(function () {
        var empresa = $("#id_empresa").val();
        var area = $("#id_area").val();
        id = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "listarAreas",
            type: "get",
            data: {
                _method: tipo,
                id: id,
                id_empresa: empresa,
                area: area
            },
            success: function (data) {

                $('#area').html('<option value="">Seleccione un área</option>');

                data.sort(function (a, b) {
                    return a.nombre.localeCompare(b.nombre);
                });

                $.each(data, function (key, value) {
                    $('#area').append('<option value="' + value.id + '">' + value.nombre + '</option>');
                });
            }
        });
    });

}

function select_area() {
    var tipo = 'get';
    $("#area option:selected").each(function () {
        var empresa = $("#id_empresa").val();
        var area = $("#id_area").val();
        var vp = $("#unidad_corporativa").val();
        id = $(this).val();

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: "listarUnidadOrganizativa",
            type: "get",
            data: {
                _method: tipo,
                id: id,
                id_empresa: empresa,
                vp: vp
            },
            success: function (data) {

                $('#unidad_organizativa').html('<option value="">Seleccione un unidad organizativa</option>');

                data.sort(function (a, b) {
                    return a.unidad_organizativa.localeCompare(b.unidad_organizativa);
                });

                $.each(data, function (key, value) {
                    $('#unidad_organizativa').append('<option value="' + value.id + '">' + value.unidad_organizativa + '</option>');
                });
            }
        });
    });
}
function togglePassword() {
    var passwordField = document.getElementById("password");
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}

function EliminarColaborador(id, id_user) {
    showSuccessMessage(
        'Eliminar Colaborador',
        'Está a punto de eliminar un colaborador. ESTA ACCIÓN ES IRREVERSIBLE. se perderán los datos. ¿Está seguro?',
        function () {
            var tipo = 'post';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "eliminarColaborador",
                type: "post",
                data: {
                    _method: tipo,
                    id: id,
                    id_user: id_user
                },
                success: function (data) {
                    if (data == 'true') {
                        toastr.success("Colaborador eliminado con exito");
                        window.location = "colaboradores";
                    } else {
                        toastr.error("Hubo un error al eliminar el colaborador.");
                    }
                }
            });
        }
    );

}

function EliminarLider(id, id_user, id_colaborador) {
    showSuccessMessage(
        'Eliminar Lider',
        'Está a punto de eliminar un lider asignado al colaborador. ESTA ACCIÓN ES IRREVERSIBLE. se perderán los datos. ¿Está seguro?',
        function () {
            var tipo = 'post';
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "eliminarLider",
                type: "post",
                data: {
                    _method: tipo,
                    id: id,
                    id_user: id_user,
                    id_colaborador: id_colaborador
                },
                success: function (data) {
                    if (data == 'true') {
                        toastr.success("Colaborador eliminado con exito");
                        window.location = "detalleColaborador?colaborador=" + id_colaborador + "&lider_tab_panel=" + id_colaborador;
                    } else {
                        toastr.error("Hubo un error al eliminar el lider.");
                    }
                }
            });
        }
    );

}
function showSuccessMessage(header, message, callbackFunction) {
    document.getElementById('headAlerta').innerHTML = header;
    document.getElementById('exitoAlerta').innerHTML = message;

    $('#mensajeAlerta').modal('show');

    document.getElementById('aceptarAlerta').onclick = function () {
        if (typeof callbackFunction === 'function') {
            callbackFunction();
        }

        $('#mensajeAlerta').modal('hide');
    };

    if (!document.getElementById('cerrarAlerta')) {
        var closeButton = document.createElement('button');
        closeButton.classList.add('btn', 'btn-primary', 'btn-rounded');
        closeButton.innerHTML = 'Cerrar';
        closeButton.id = 'cerrarAlerta';

        closeButton.addEventListener('click', function () {
            $('#mensajeAlerta').modal('hide');
        });

        document.getElementById('modalFooter').appendChild(closeButton);
    }
}