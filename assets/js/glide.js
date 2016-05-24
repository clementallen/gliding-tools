require(['config'], function() {
    require(['main', 'validators', 'jquery'], function(main, valid, $) {
        $('#glide-form').submit(function(e) {
            e.preventDefault();

            var height = $('#glide-height'),
                heightVal = height.val(),
                glideRatio = $('#glide-ratio'),
                glideRatioVal = glideRatio.val(),
                rateOfSink = $('#glide-rate-of-sink'),
                rateOfSinkVal = rateOfSink.val(),
                resultBox = $('#glide-result'),
                kmConversion, rangeInFeet, flightDuration, rangeInKm, heightLoss, result;

            function range(height, glideRatio) {
                kmConversion = 0.0003048;
                rangeInFeet = height * glideRatio;

                return (rangeInFeet * kmConversion).toFixed(2);
            }

            function lostHeight(height) {
                return Math.round(height / range(heightVal, glideRatioVal));
            }

            function duration(height, rateOfSink) {
                return Math.round(height / rateOfSink);
            }

            height.parent().removeClass('has-error');
            glideRatio.parent().removeClass('has-error');
            rateOfSink.parent().removeClass('has-error');
            resultBox.hide();

            if(valid.number(heightVal) && valid.number(glideRatioVal)) {

                if(rateOfSinkVal) {

                    if(valid.number(rateOfSinkVal)) {
                        // calculate everything
                        flightDuration = duration(heightVal, rateOfSinkVal);
                        rangeInKm = range(heightVal, glideRatioVal);
                        heightLoss = lostHeight(heightVal);
                        resultBox.html('<p>Maximum flight distance: ' + rangeInKm + 'km</p>');
                        resultBox.append('<p>Loss of height per Km travelled: ' + heightLoss + 'ft</p>');
                        resultBox.append('<p>Flight duration: ' + flightDuration + ' minutes</p>');
                        resultBox.show();

                    } else {
                        rateOfSink.parent().addClass('has-error');
                    }

                } else {
                    // calculate only range and height lost per km travelled
                    rangeInKm = range(heightVal, glideRatioVal);
                    heightLoss = lostHeight(heightVal);
                    resultBox.html('<p>Maximum flight distance: ' + rangeInKm + 'km</p>');
                    resultBox.append('<p>Loss of height per Km travelled: ' + heightLoss + 'ft</p>');
                    resultBox.show();
                }

            } else {
                height.parent().addClass('has-error');
                glideRatio.parent().addClass('has-error');
            }

        });
    });
});
