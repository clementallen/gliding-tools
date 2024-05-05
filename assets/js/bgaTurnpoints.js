var gliderList;
var options = {
    valueNames: ['name', 'trigraph'],
    page: []
};

function displayResultsAmount(amount) {
    $('p.total span').text(amount);
}

$.ajax({
    type: 'GET',
    url: '../assets/bgaturnpoints-2024.json',
    success: function(data) {
        for (let i = 0; i < data.length; i++) {
            const item = data[i];
            $('tbody.list').append('<tr><td class="name">' + item.name + '</td><td class="trigraph">' + item.trigraph + '</td></tr>');
        }
        options.page[0] = data.length;
        gliderList = new List('turnpoint-search', options);
        gliderList.on('updated', function() {
            displayResultsAmount(gliderList.visibleItems.length);
        });
        displayResultsAmount(gliderList.visibleItems.length);
    }
});
