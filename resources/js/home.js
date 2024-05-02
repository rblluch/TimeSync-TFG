$(document).ready(function () {
    
    /* getTasks().then(data => {
        console.log(data);

    }).catch(error => {
        console.error(error);
    }); */

});

function getTasks() {
    return new Promise((resolve, reject) => {
        $.ajax({
            type: 'GET',
            url: config.API_ENDPOINT + '/tasks',
            success: function (data) {
                resolve(data);
            },
            error: function (xhr, status, error) {
                reject('Error to get tasks ' + xhr.responseText);
            }
        });
    });
}
