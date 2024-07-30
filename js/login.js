function mostrarContrasena(){
    var tipo = document.getElementById("password");
    if(tipo.type == "password"){
        tipo.type = "text";
    }else{
        tipo.type = "password";
    }
}
function Ver_Pass(elem) {

    if ($("#password").attr("type") == 'password') {
        $("#password").attr("type", "text");
    } else {
        $("#password").attr("type", "password");
    }
}

$(function () {

    $('#form-login').validate({
        rules: {
            user: { required: true, minlength: 2, maxlength: 250 },
            password: { required: true, minlength: 2, maxlength: 250 },
            mail: { required: true, minlength: 2, maxlength: 250 }
        },
        messages: {
            user: "El campo usuario es obligatorio y debe ser el correo del usuario",
            password: "El campo password es obligatorio",
            mail: "El campo correo es obligatorio y debe ser formato email"
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});