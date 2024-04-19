console.log('access.js loaded');
console.log(config.API_ENDPOINT + '/auth/login');

$(document).ready(function() {

    $('#registerForm').submit(function(event) {
        // Evitar el envío predeterminado del formulario
        event.preventDefault();

        // Obtener los datos del formulario
        var formData = {
            email: $('#email').val(),
            password: $('#password').val(),
        };

        // Realizar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: config.API_ENDPOINT + '/auth/login',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function(data) {
                console.log(data);
                // Manejar la respuesta de la API según sea necesario
                //alert(data.message);
                window.location.href = './home';
            },
            error: function(xhr, status, error) {
                // Manejar errores de la solicitud
                console.error('Error to log in ' + xhr.responseText);
                //alert('Error al registrar usuario');
                $('#error').show();  
                $('#password').val('').css({'border-color': 'red', 'border-width': '2px'});
                $('#email').css({'border-color': 'red', 'border-width': '2px'});
            }
        });
    });
});
