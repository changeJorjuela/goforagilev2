function myFunction() {
    document.getElementsByClassName("topnav")[0].classList.toggle("responsive");
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
    jQuery(".ban-header-logo").prop("src", "/web/sites/all/themes/sdmtheme/images/logo_bmt_contraste.png");
    jQuery(".header-twitter").css("background", "url(/web/sites/all/themes/sdmtheme/images/30_twitter_contraste.png)");
    jQuery(".header-facebook").css("background", "url(/web/sites/all/themes/sdmtheme/images/30_facebook_contraste.png)");
    jQuery(".header-youtube").css("background", "url(/web/sites/all/themes/sdmtheme/images/30_youtube_contraste.png)");
    jQuery(".header-instagram").css("background", "url(/web/sites/all/themes/sdmtheme/images/30_instagram_contraste.png)");
    jQuery(".btn-noticia").css("background", "url(/web/sites/all/themes/sdmtheme/images/leer_mas_contraste.png)");
    jQuery(".picpla-automovil").removeClass("picpla-automovil").addClass("picpla-automovil-contraste");
    jQuery(".picpla-taxi").removeClass("picpla-taxi").addClass("picpla-taxi-contraste");
    jQuery(".picpla-colectivo").removeClass("picpla-colectivo").addClass("picpla-colectivo-contraste");
    jQuery(".picpla-ambiental").removeClass("picpla-ambiental").addClass("picpla-ambiental-contraste");
    jQuery(".contact-section").css("color","#ff0 !important");
    jQuery("#services-section").css("background","black !important");
    jQuery(".nav-link").css("color","#ff0 !important");
    jQuery(".ftco-footer .overlay").css("background","black");
    jQuery(".ftco-navbar-light").css("background-color","black");
    console.log("Se activo contraste!!!");
}