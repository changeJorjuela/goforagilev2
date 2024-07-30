// $(document).ready(function () {
//     $('#preguntasFrecuentesTable').DataTable({
//         columnDefs: [
//             { responsivePriority: 1, targets: 0 },
//             { responsivePriority: 2, targets: -1 }],
//         responsive  : true,
//         lengthChange: false,
//         searching   : true,
//         ordering    : false,
//         info        : false,
//         autoWidth   : false,
//         rowReorder  : false,
//         pageLength  : 10,
//         lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "Todos"]],
//         order: [[ 0, "desc" ]],
//         language: {
//             processing: "Procesando...",
//             search: "Buscar:",
//             lengthMenu: "Mostrar _MENU_ registros.",
//             info: "Mostrando tickets del _START_ al _END_ de un total de _TOTAL_ tickets",
//             infoEmpty: "Mostrando tickets del 0 al 0 de 0 tickets",
//             infoFiltered: "(filtrado de un total de _MAX_ registros)",
//             infoPostFix: "",
//             loadingRecords: "Cargando...",
//             zeroRecords: "No se encontraron preguntas referentes a su búsqueda",
//             emptyTable: "Ningún dato disponible en este listado",
//             row: "Registro",
//             export: "Exportar",
//             paginate: {
//                 first: "Primero",
//                 previous: "Anterior",
//                 next: "Siguiente",
//                 last: "Ultimo"
//             },
//             aria: {
//                 sortAscending: ": Activar para ordenar la columna de manera ascendente",
//                 sortDescending: ": Activar para ordenar la columna de manera descendente"
//             },
//             select: {
//                 row: "registro",
//                 selected: "seleccionado"
//             }
//         }
//       }
//     );
// });

// resultadoRespuesta = document.getElementById('resultadoPregunta');

function searchQuestion() {
    var input, filter, table, tr, td, i, txtValue;
    input = document.getElementById("buscarPregunta");
    filter = input.value.toUpperCase();
    table = document.getElementById("preguntasFrecuentesTable");
    tr = table.getElementsByTagName("tr");
    resultadoRespuesta = document.getElementById('resultadoPregunta');
    j = 0;
    for (i = 0; i < tr.length; i++) {
        // td = tr[i].getElementsByTagName("button")[0];
        td = tr[i].querySelectorAll("label, .box-title")[0];
        if (td) {
            txtValue = td.textContent || td.innerText;
            // console.log(txtValue.toUpperCase().lastIndexOf(filter))
            // console.log(tr.length)
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
                resultadoRespuesta.style.display = "none";
            } else {
                tr[i].style.display = "none";
                j++;
                // console.log(j)
                if((j) == tr.length){
                    resultadoRespuesta.style.display = "block";
                }
            }

        }
    }
}

var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    }
  });
}

// document.addEventListener("keyup", e=>{

//     resultadoRespuesta = document.getElementById('resultadoPregunta');

//     if (e.target.matches("#buscarPregunta")){

//         if (e.key ==="Escape")e.target.value = ""

//         document.querySelectorAll(".preguntaF, button").forEach(pregunta =>{

//             pregunta.textContent.toLowerCase().includes(e.target.value.toLowerCase())
//               ?pregunta.classList.remove("filtro")
//               :pregunta.classList.add("filtro")
//         })

//     }

//     switch (e.key) {
//         case "Backspace":
//             resultadoRespuesta.style.display = 'none';
//             break;
//         case "Delete":
//             resultadoRespuesta.style.display = 'none';
//             break;
//         case "Escape":
//             resultadoRespuesta.style.display = 'none';
//             break;
//     }

// })

(function () {
    $('.box').on('click', function() {
      $('.box-title').toggleClass('animate');
      })
  })();
