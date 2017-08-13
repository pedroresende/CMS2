/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$('#cache_clear').click(
    function () {
        fetch('/api/cache/',
        {
            method: "POST",
        }
        )
        .then(
            function (response) {
                return response.text()
            }
        ).then(
            function (body) {
            }
        )
        $('#cache_status').html('Cache Cleared');
    }
);
