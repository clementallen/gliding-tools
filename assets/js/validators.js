const validate = {
    number(n) {
        return !isNaN(+n) && isFinite(n) && n >= 0;
    },
    numberGroup(numbers) {
        var errors = [];
        var self = this;

        Object.keys(numbers).forEach(function(key, index) {
            if(!self.number(numbers[key])) {
                errors.push(key);
            }
        });

        return errors;
    },
    processErrors(errors) {
        var results = [];

        for (var i = 0; i < errors.length; i++) {
            results.push($(errors[i]).parent().addClass('has-error'));
        }

        return results;
    }
};
