$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$(document).ready(function () {
    var page = location.pathname;
    var tipo = 'get';
    $.ajax({
        url: "crearVisita",
        type: "get",
        data: { _method: tipo, pagina: page },
        success: function (data) {
        }
    });
});

function check(e) {
    key = e.keyCode || e.which;

    teclado = String.fromCharCode(key).toLowerCase();

    letras = "abcdefghijklmnñopqrstuvwxyz ";

    especiales = "8-37-38-46-164-46";

    teclado_especial = false;

    for (var i in especiales) {
        if (key == especiales[i]) {
            teclado_especial = true;
            break;
        }
    }

    if (letras.indexOf(teclado) == -1 && !teclado_especial) {
        return false;
    }
}

function numero(event) {
    if (event.charCode >= 48 && event.charCode <= 57) {
        return true;
    }
    return false;

}

function noPuntoComa(event) {

    var e = event || window.event;
    var key = e.keyCode || e.which;

    if (key === 110 || key === 190 || key === 188) {

        e.preventDefault();
    }
}


function myFunction() {
    document.getElementsByClassName("site-navbar")[0].classList.toggle("responsive");
}

jQuery(document).ready(function () {
    jQuery('.content-tabs li a').click(function (e) {
        e.preventDefault();
        jQuery(this).tab('show');
    });
});

function inHijos(o, s) {
    jQuery(o).children().each(function (idx, el) {
        inHijos(el, s);
        jQuery(el).css('font-size', (parseInt(jQuery(el).css('font-size').replace('px', '')) + s) + 'px');
        // jQuery("#logoNavbar").css("width", "9.5%");
        jQuery("#logoNavbar").css("margin-top", "0px");
        jQuery("#logoNavbar").css("width", "23%");
        jQuery("#logoNavbar").prop("src", "images/MARCA-BOGOTA-EMPRESA.png");
        if (window.innerWidth <= 991) {
            jQuery("#logoNavbar").css("margin-top", "-34px");
            jQuery("#logoNavbar").css("width", "70%");
        }
    });
}

function setFSize(val) {
    if (val <= 0) {
        localStorage.removeItem("fontSize");
    } else {
        localStorage.fontSize = val;
    }
    location.reload();
}

function switchContraste() {
    if (localStorage.contraste) {
        localStorage.removeItem("contraste");
    } else {
        localStorage.contraste = true;
    }
    location.reload();
}

if (localStorage.fontSize) {
    inHijos(jQuery("body"), parseInt(localStorage.fontSize));
}

function inHijosContraste(o) {
    jQuery(o).children().each(function (idx, el) {
        inHijosContraste(el);
        jQuery(el).css('font-size', (parseInt(jQuery(el).css('font-size').replace('px', '')) + s) + 'px');
    });
}

if (localStorage.contraste) {
    var styles = "css/contraste.css";
    var newSS = document.createElement('link');
    newSS.rel = 'stylesheet';
    newSS.href = styles;
    document.getElementsByTagName("head")[0].appendChild(newSS);
    jQuery(".escudo").css("background", "url(/web/sites/all/themes/sdmtheme/images/escudo_col_contraste.png)");
    jQuery(".logo-navbar-img").prop("src", "images/logo_header_blanco.png");
    jQuery("#logoNavbar").prop("src", "images/logo_header_blanco.png");
    jQuery("#MarcaEmpresa").prop("src", "images/MARCA-BOGOTA-EMPRESA-BLACK.png");
    jQuery("#logoNavbar2").prop("src", "images/LOGO_GYP_black.png");
    jQuery("#logoNosotros").prop("src", "images/LOGO_GYP_V2.png");
    jQuery("#logoNosotros").css("width", "32%");
    jQuery(".header-twitter").css("background", "url(/web/sites/all/themes/sdmtheme/images/30_twitter_contraste.png)");
    jQuery(".header-facebook").css("background", "url(/web/sites/all/themes/sdmtheme/images/30_facebook_contraste.png)");
    jQuery(".header-youtube").css("background", "url(/web/sites/all/themes/sdmtheme/images/30_youtube_contraste.png)");
    jQuery(".header-instagram").css("background", "url(/web/sites/all/themes/sdmtheme/images/30_instagram_contraste.png)");
    jQuery(".btn-noticia").css("background", "url(/web/sites/all/themes/sdmtheme/images/leer_mas_contraste.png)");
    jQuery(".picpla-automovil").removeClass("picpla-automovil").addClass("picpla-automovil-contraste");
    jQuery(".picpla-taxi").removeClass("picpla-taxi").addClass("picpla-taxi-contraste");
    jQuery(".picpla-colectivo").removeClass("picpla-colectivo").addClass("picpla-colectivo-contraste");
    jQuery(".picpla-ambiental").removeClass("picpla-ambiental").addClass("picpla-ambiental-contraste");
    jQuery(".contact-section").css("color", "#ff0 !important");
    jQuery("#services-section").css("background", "black !important");
    jQuery(".nav-link").css("color", "#ff0 !important");
    jQuery(".ftco-footer .overlay").css("background", "black");
    jQuery(".ftco-navbar-light").css("background-color", "black");
    jQuery("#notificaciones tbody tr").css("background-color", "black");
    jQuery("#notificaciones tbody td").css("background-color", "black");
    jQuery("#emailNotificacion").css("color", "#ff0 !important");
    jQuery(".dataTables_wrapper .dataTables_length,.dataTables_wrapper .dataTables_filter,.dataTables_wrapper .dataTables_info,.dataTables_wrapper .dataTables_processing,.dataTables_wrapper .dataTables_paginate").css("color", "#ff0 !important");
    jQuery(".ftco-cover-1.overlay").removeClass("ftco-cover-1 overlay").addClass("ftco-cover-1-contraste");
    console.log("Se activo contraste!!!");
}

$('#form-trabajo').submit(function () {
    var fileInputP = document.getElementById('hojaVida');
    var Procedimientos = fileInputP.value;
    if (Procedimientos) {
        var fileSize = $('#hojaVida')[0].files[0].size;
        var sizekiloBytes = parseInt(fileSize / 1024);
        if (sizekiloBytes > $('#hojaVida').attr('size')) {
            alert('El tamaño supera el limite permitido de 2mb');
            return false;
        }
    }
});

$(function () {
    $.validator.setDefaults({
        submitHandler: function () {
            alert("Form successful submitted!");
        }
    });

    // $('#form-contacto').validate({
    //     errorElement: 'span',
    //     errorPlacement: function (error, element) {
    //         error.addClass('invalid-feedback');
    //         element.closest('.form-group').append(error);
    //     },
    //     highlight: function (element, errorClass, validClass) {
    //         $(element).addClass('is-invalid');
    //     },
    //     unhighlight: function (element, errorClass, validClass) {
    //         $(element).removeClass('is-invalid');
    //     }
    // });
});

$('.carousel').carousel({
    interval: 5000
})

$(document).ready(function(){
    var url = $("#videoHome").attr('src');

    $("#videoModal").on('hide.bs.modal', function(){
        $("#videoHome").attr('src', '');
    });

    $("#videoModal").on('show.bs.modal', function(){
        $("#videoHome").attr('src', url);
    });
});


$(document).ready(function(){
    var video_url = $("#videoHomeLink").attr('href');
    $("#videoHomeLink").click(function(){
        window.open(video_url,'newwindow','width=660,height=415');
        return false;
    });
});

function avisar()
{
    var page = '/documentos/Comunicado_prensa_septiembre_28_2023.pdf';
    var tipo = 'get';
    $.ajax({
        url: "crearVisita",
        type: "get",
        data: { _method: tipo, pagina: page },
        success: function (data) {
        }
    });
}