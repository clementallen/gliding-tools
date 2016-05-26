require(['config'], function() {
    require(['main', 'validators', 'jquery'], function(main, validate, $) {

        function maxLaunchHeight(distance) {
            kmToFeet = 3.281;
            distancePercentKm = distance / 100;
            launchHeight = distancePercentKm * kmToFeet;
            return Math.round(launchHeight * 1000);
        }

        function includeAirfieldHeight(launchHeight, origin, destination) {
            var airfieldHeight = destination - origin;
            return launchHeight - airfieldHeight;
        }

        $('#silver-form').submit(function(e) {
            e.preventDefault();

            var distanceEl = $('#silver-distance'),
                distance = distanceEl.val(),
                originEl = $('#silver-origin'),
                origin = originEl.val(),
                destinationEl = $('#silver-destination'),
                destination = destinationEl.val(),
                resultBox = $('#silver-result');

            distanceEl.parent().removeClass('has-error');
            originEl.parent().removeClass('has-error');
            destinationEl.parent().removeClass('has-error');
            resultBox.hide();

            distance = parseInt(distance, 10);

            var entries = {
                '#silver-distance': distance
            };

            if(origin) {
                origin = parseInt(origin, 10);
                entries['#silver-origin'] = origin;
            }

            if(destination) {
                destination = parseInt(destination, 10);
                entries['#silver-destination'] = destination;
            }

            var errors = validate.numberGroup(entries);

            if(errors.length) {
                validate.processErrors(errors);
                return;
            }

            launchHeight = maxLaunchHeight(distance);

            resultBox.html('<p>Maximum launch height is ' + launchHeight + 'ft</p>');

            if(!origin && !destination) {
                resultBox.show();
                return;
            }

            var launchHeightWithAirfields = includeAirfieldHeight(launchHeight, origin, destination);

            resultBox.append('<p>Maximum launch height including airfield heights: ' + launchHeightWithAirfields + 'ft</p>');
            resultBox.show();

        });
    });
});
