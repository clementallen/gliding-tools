var options = {
    valueNames: [ 'glider', 'handicap' ],
    page: [306]
};

var gliderList = new List('handicap-search', options);

$("p.total span").append($("tbody.list tr").length);