$(document).ready(function() {

    //registro de usuarios ajax
    $('#formulario-registro-usuario').on('submit', function(event) {
        event.preventDefault();

        var formData = new FormData(this);
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            cache: false,
            processData: false,
            contentType: false,
            dataType: 'json',
            beforeSend: function() {
                $('#signup').text('Registrando...');
            },
            success: function(response) {
                if (!response.success) {
                    swal({
                        title: "Error", 
                        text: response.message, 
                        type: "error"
                    });
                    $('#signup').text('Registrarse');
                } else {
                    swal({
                        title: "Mensaje", 
                        text: response.message, 
                        type: "success"
                    }).then(function() {
                        window.location.href = "index.php";   
                    });
                }
            }
        })
    });

    //login de usuarios ajax
    $('#formulario-login').on('submit', function(event) {
        event.preventDefault();

        var email = $('#email').val();
        var password = $('#password').val();

        if (email == 'undefined' || email == null || email == '') {
            swal({
                title: "Error", 
                text: "Debes ingresar tu email", 
                type: "error"
            });
        } else if (password == 'undefined' || password == null || password == '') {
            swal({
                title: "Error", 
                text: "Debes ingresar tu contraseña", 
                type: "error"
            });
        } else {
   
            var response = grecaptcha.getResponse();
            if (response.length == 0) {
                document.getElementById('g-recaptcha-error').innerHTML = '<span class="alert alert-danger my-3">Debes completar el captcha.</span>';
                return false;
            } else {

                var formData = new FormData(this);
                $.ajax({
                    url: $(this).attr('action'),
                    type: $(this).attr('method'),
                    data: formData,
                    cache: false,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function() {
                        $('#login').text('Ingresando...');
                    },
                    success: function(response) {
                        if (!response.success) {
                            swal({
                                title: "Error", 
                                text: response.message, 
                                type: "error"
                            });
                            $('#login').text('Ingresar');
                        }else if (!response.isAdmin) {
                            //no es admin 
                            window.location.href = "./home/index.php"; 
                        }else{
                            //si es admin
                            window.location.href = "./home/admin/admin.php";
                        }
                    }
                });
            }
        }
    });


});


function closeCaptcha() {
    //captcha completado con éxito
    $('#g-recaptcha-error').empty();  
}