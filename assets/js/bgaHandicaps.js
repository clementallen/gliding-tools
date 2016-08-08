require(['config'], function() {
    require(['main', 'list', 'jquery'], function(main, List, $) {

        var options = {
            valueNames: ['glider', 'handicap'],
            page: [306]
        };

        function displayResultsAmount() {
            $('p.total span').text($('tbody.list tr').length);
        }

        var gliderList = new List('handicap-search', options);

        displayResultsAmount();

        document.getElementById('glider-search').onkeyup = function() {
            displayResultsAmount();
        };

    });
});
