window.config = {
    /* API_ENDPOINT: 'http://localhost:8080/dws/TimeSync/public/api' */
    API_ENDPOINT: '/dws/TimeSync/public/api',
    APP_ENDPOINT: '/dws/TimeSync/public',
    ajaxRequest: function(type, url) {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: type,
                url: this.APP_ENDPOINT + '/' + url,
                success: function (data) {
                    resolve(data);
                },
                error: function (xhr, status, error) {
                    reject('Error ' + xhr.responseText);
                }
            });
        });
    },
    toast: function(message, acceptanceMessage) {
        var toastHTML = `
        <div class="toast fixed top-12 w-96 right-0 m-6 p-4 rounded bg-neutral-700 text-white z-50">
            <div>${message}</div>
            <button id="confirmButton" class="mt-2 bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded">${acceptanceMessage}</button>
            <button id="cancelButton" class="mt-2 bg-red-700 hover:bg-red-900 text-white font-bold py-2 px-4 rounded">Cancelar</button>
        </div>`;
    
        // Añade el toast al body
        $('body').append(toastHTML);
    
        // Oculta el toast después de 5 segundos
        setTimeout(function() {
            $('.toast').remove();
        }, 5000);
    }

};

