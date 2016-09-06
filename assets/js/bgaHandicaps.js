require(['config'], function() {
    require(['main', 'list', 'jquery'], function(main, List, $) {

        var options = {
            valueNames: ['glider', 'handicap'],
            page: [306]
        };

        $.ajax({
            type: 'GET',
            url: '../assets/bgahandicaps.json',
            success: function(data) {
                $.each(data, function(index, item) {
                    $('tbody.list').append('<tr><td class="glider">' + item.glider + '</td><td class="handicap">' + item.handicap + '</td></tr>');
                });

                var gliderList = new List('handicap-search', options);
                displayResultsAmount();
            }
        });

        function displayResultsAmount() {
            $('p.total span').text($('tbody.list tr').length);
        }

        document.getElementById('glider-search').onkeyup = function() {
            displayResultsAmount();
        };

    });
});
