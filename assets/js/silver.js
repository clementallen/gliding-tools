require(['config'], function() {
    require(['main', 'validators', 'jquery'], function(main, valid, $) {
        $('#silver-form').submit(function(e) {
            e.preventDefault();

            var distance = $('#silver-distance'),
                distanceVal = distance.val(),
                origin = $('#silver-origin'),
                originVal = origin.val(),
                destination = $('#silver-destination'),
                destinationVal = destination.val(),
                resultBox = $('#silver-result'),
                kmToFeet, distancePercentKm, launchHeight, launchHeightFeet, airfieldHeight, distanceOnlyResult, result;

            function findLaunchHeight(distance) {
                kmToFeet = 3.281;
                distancePercentKm = distance / 100;
                launchHeight = distancePercentKm * kmToFeet;
                return Math.round(launchHeight * 1000);
            }

            function includeAirfieldHeight(distance, origin, destination) {
                launchHeightFeet = findLaunchHeight(distance);
                airfieldHeight = destination - origin;
                return launchHeightFeet - airfieldHeight;
            }

            distance.parent().removeClass('has-error');
            origin.parent().removeClass('has-error');
            destination.parent().removeClass('has-error');
            resultBox.hide();

            if(valid.number(distanceVal)) {

                if(originVal || destinationVal) {

                    if(valid.number(originVal) && valid.number(destinationVal)) {
                        // calculate everything
                        result = includeAirfieldHeight(distanceVal, originVal, destinationVal);
                        distanceOnlyResult = findLaunchHeight(distanceVal);
                        resultBox.html('<p>Maximum launch height: ' + result + 'ft</p>');
                        resultBox.append('<p>Without altitude calculations: ' + distanceOnlyResult + 'ft</p>');
                        resultBox.show();

                    } else {
                        origin.parent().addClass('has-error');
                        destination.parent().addClass('has-error');
                    }

                } else {
                    // calculate only distance
                    result = findLaunchHeight(distanceVal);
                    resultBox.html('Maximum launch height is ' + result + 'ft.');
                    resultBox.show();
                }

            } else {
                distance.parent().addClass('has-error');
            }

        });
    });
});
