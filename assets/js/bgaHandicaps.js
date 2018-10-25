var gliderList;
var options = {
    valueNames: ['glider', 'handicap'],
    page: []
};

function displayResultsAmount(amount) {
    $('p.total span').text(amount);
}

$.ajax({
    type: 'GET',
    url: '../assets/bgahandicaps-2020.json',
    success: function(data) {
        data = JSON.parse(data);
        for (let i = 0; i < data.length; i++) {
            const item = data[i];
            $('tbody.list').append('<tr><td class="glider">' + item.glider + '</td><td class="handicap">' + item.handicap + '</td></tr>');
        }
        options.page[0] = data.length;
        gliderList = new List('handicap-search', options);
        gliderList.on('updated', function() {
            displayResultsAmount(gliderList.visibleItems.length);
        });
        displayResultsAmount(gliderList.visibleItems.length);
    }
});
