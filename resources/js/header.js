$(document).ready(function () {
    console.log('header.js loaded');
    
    //Change workday status
    $('#workdayButton').click(function (event) {
        event.preventDefault();
        console.log('workdayButton clicked');
        var hasClass = $('#workdayButton').hasClass('bg-gray-700');


        if(hasClass){
            config.toast('Confirmar iniciar jornada laboral', 'Iniciar');
        } else {
            config.toast('Finalizar jornada laboral', 'Finalizar');
        }

        // Cuando se hace clic en el botón de confirmación, ejecuta la función
        $('body').on('click', '#confirmButton', function() {
            console.log('confirmButton clicked');

            config.ajaxRequest('GET', 'workday').then(data => {
            
                if (hasClass) {
                    $('#workdayButton').removeClass('bg-gray-700'); // quita la clase 'clase-antigua'
                    $('#workdayButton').addClass('bg-green-700'); // agrega la clase 'clase-nueva'
                    $('#workdayButton').text('Finalizar jornada'); // cambia el texto del botón

                } else {
                    $('#workdayButton').removeClass('bg-green-700');
                    $('#workdayButton').addClass('bg-gray-700'); 
                    $('#workdayButton').text('Iniciar jornada'); // cambia el texto del botón

                }        }).catch(error => {
                console.error(error);
                
            });

            // Oculta el toast
            $('.toast').remove();

        });
        $('body').on('click', '#cancelButton', function() {
            $('.toast').remove();
        });

    });

});

