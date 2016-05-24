define([], function() {

    var exports = {};

    exports.number = function(unit) {
        return !isNaN(parseInt(unit), 10);
    };

    return exports;

});
