"use strict";

(function($) {

    // Displays year in footer
    $('#footer p').append(new Date().getFullYear());

    function isValid(unit) {
        return !isNaN(parseInt(unit), 10);
    }

    $('#glide-form').submit(function(e) {
        e.preventDefault();

        var $height = $('#glide-height'),
            $heightVal = $height.val(),
            $glideRatio = $('#glide-ratio'),
            $glideRatioVal = $glideRatio.val(),
            $rateOfSink = $('#glide-rate-of-sink'),
            $rateOfSinkVal = $rateOfSink.val(),
            $resultBox = $('#glide-result'),
            kmConversion, rangeInFeet, flightDuration, rangeInKm, heightLoss, result;

        function range(height, glideRatio) {
            kmConversion = 0.0003048;
            rangeInFeet = height * glideRatio;

            return (rangeInFeet * kmConversion).toFixed(2);
        }

        function lostHeight(height) {
            return Math.round(height / range($heightVal, $glideRatioVal));
        }

        function duration(height, rateOfSink) {
            return Math.round(height / rateOfSink);
        }

        $height.parent().removeClass('has-error');
        $glideRatio.parent().removeClass('has-error');
        $rateOfSink.parent().removeClass('has-error');
        $resultBox.hide();

        if(isValid($heightVal) && isValid($glideRatioVal)) {

            if($rateOfSinkVal) {

                if(isValid($rateOfSinkVal)) {
                    // calculate everything
                    flightDuration = duration($heightVal, $rateOfSinkVal);
                    rangeInKm = range($heightVal, $glideRatioVal);
                    heightLoss = lostHeight($heightVal);
                    $resultBox.html('<p>Maximum flight distance: ' + rangeInKm + 'km</p>');
                    $resultBox.append('<p>Loss of height per Km travelled: ' + heightLoss + 'ft</p>');
                    $resultBox.append('<p>Flight duration: ' + flightDuration + ' minutes</p>');
                    $resultBox.show();

                } else {
                    $rateOfSink.parent().addClass('has-error');
                }

            } else {
                // calculate only range and height lost per km travelled
                rangeInKm = range($heightVal, $glideRatioVal);
                heightLoss = lostHeight($heightVal);
                $resultBox.html('<p>Maximum flight distance: ' + rangeInKm + 'km</p>');
                $resultBox.append('<p>Loss of height per Km travelled: ' + heightLoss + 'ft</p>');
                $resultBox.show();
            }

        } else {
            $height.parent().addClass('has-error');
            $glideRatio.parent().addClass('has-error');
        }

    });


    $('#silver-form').submit(function(e) {
        e.preventDefault();

        var $distance = $('#silver-distance'),
            $distanceVal = $distance.val(),
            $origin = $('#silver-origin'),
            $originVal = $origin.val(),
            $destination = $('#silver-destination'),
            $destinationVal = $destination.val(),
            $resultBox = $('#silver-result'),
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

        $distance.parent().removeClass('has-error');
        $origin.parent().removeClass('has-error');
        $destination.parent().removeClass('has-error');
        $resultBox.hide();

        if(isValid($distanceVal)) {

            if($originVal || $destinationVal) {

                if(isValid($originVal) && isValid($destinationVal)) {
                    // calculate everything
                    result = includeAirfieldHeight($distanceVal, $originVal, $destinationVal);
                    distanceOnlyResult = findLaunchHeight($distanceVal);
                    $resultBox.html('<p>Maximum launch height: ' + result + 'ft</p>');
                    $resultBox.append('<p>Without altitude calculations: ' + distanceOnlyResult + 'ft</p>');
                    $resultBox.show();

                } else {
                    $origin.parent().addClass('has-error');
                    $destination.parent().addClass('has-error');
                }

            } else {
                // calculate only distance
                result = findLaunchHeight($distanceVal);
                $resultBox.html('Maximum launch height is ' + result + 'ft.');
                $resultBox.show();
            }

        } else {
            $distance.parent().addClass('has-error');
        }

    });

    $('#handicap-form').submit(function(e) {
        e.preventDefault();

        var $handicap = $('#handicap-number'),
            $handicapVal = $handicap.val(),
            $speed = $('#handicap-speed'),
            $speedVal = $speed.val(),
            $resultBox = $('#handicap-result'),
            handicappedSpeed, result;

        function handicapSpeed(handicap, speed) {
            handicappedSpeed = (speed / handicap) * 100;
            return handicappedSpeed.toFixed(1);
        }

        $handicap.parent().removeClass('has-error');
        $speed.parent().removeClass('has-error');
        $resultBox.hide();

        if(isValid($handicapVal) && isValid($speedVal)) {
            result = handicapSpeed($handicapVal, $speedVal);
            $resultBox.html('<p>Handicapped speed: ' + result + '</p>');
            $resultBox.show();

        } else {
            $handicap.parent().addClass('has-error');
            $speed.parent().addClass('has-error');
        }

    });

})(jQuery);