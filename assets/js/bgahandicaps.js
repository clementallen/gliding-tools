var options = {
    valueNames: [ 'glider', 'handicap' ],
    page: [306]
};
var gliderList = new List('handicap-search', options);


$('p.total span').text($('tbody.list tr').length);

document.getElementById('glider-search').onkeyup = function() {
    $('p.total span').text($('tbody.list tr').length);
};