console.log('access.js loaded');
console.log(config.API_ENDPOINT + '/auth/login');

$(document).ready(function () {

    $('#registerForm').submit(function (event) {
        // Evitar el envío predeterminado del formulario
        event.preventDefault();

        // Obtener los datos del formulario
        var formData = {
            name: $('#name').val(),
            email: $('#email').val(),
            email_confirmation: $('#email_confirmation').val(),
            'g-recaptcha-response': $('#g-recaptcha-response').val(),
        };

        // Realizar la solicitud AJAX
        $.ajax({
            type: 'POST',
            url: config.API_ENDPOINT + '/auth/register',
            data: formData,
            dataType: 'json',
            encode: true,
            success: function (data) {
                console.log(data);
                // Manejar la respuesta de la API según sea necesario
                //alert(data.message);
                /* window.location.href = './home'; */
                $('#instructions').hide();
                $('#form-card-register').hide();

                $('#success-container').html(`
                    <div id="instructions" class="text-center">
                        <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                            ¡Genial! ahora accede a tu correo y accede al enlace de confirmación
                        </h1>
                        <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
                            <ol>
                                <li>Registra tu empresa</li>
                                <li><strong>Recibe un correo de confirmación</strong></li>
                                <li>Introduce tu contraseña</li>
                                <li>¡Listo! Ya puedes empezar a usar TimeSync</li>
                            </ol>
                        </p>
                    </div>
                `).show();
            },
            error: function (xhr, status, error) {
                // Manejar errores de la solicitud
                console.error('Error to log in ' + xhr.responseText);
                //alert('Error al registrar usuario');
                $('#error').show();
                $('#password').val('').css({ 'border-color': 'red', 'border-width': '2px' });
                $('#email').css({ 'border-color': 'red', 'border-width': '2px' });
            }
        });
    });

    $('#prueba').click(function () {
        console.log('click');

        if ($('#instructions').is(':visible')) {
            $('#instructions').hide();
            $('#form-card-register').hide();

            $('#success-container').html(`
                <div id="instructions" class="text-center">
                    <h1 class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                        ¡Genial! ahora accede a tu correo y accede al enlace de confirmación
                    </h1>
                    <p class="mb-6 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 xl:px-48 dark:text-gray-400">
                        <ol>
                            <li>Registra tu empresa</li>
                            <li><strong>Recibe un correo de confirmación</strong></li>
                            <li>Introduce tu contraseña</li>
                            <li>¡Listo! Ya puedes empezar a usar TimeSync</li>
                        </ol>
                    </p>
                </div>
            `).show();
        } else {
            $('#instructions').show();
            $('#form-card-register').show();
            $('#success-container').hide();


        }

    });

});
