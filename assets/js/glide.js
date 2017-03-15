require(['config'], function() {
    require(['main', 'validators', 'jquery'], function(main, validate, $) {
        function range(height, glideRatio) {
            var kmConversion = 0.0003048;
            var rangeInFeet = height * glideRatio;

            return (rangeInFeet * kmConversion).toFixed(2);
        }

        function lostHeight(height, glideRatio) {
            return Math.round(height / range(height, glideRatio));
        }

        function duration(height, rateOfSink) {
            return Math.round(height / rateOfSink);
        }

        $('#glide-form').submit(function(e) {
            e.preventDefault();

            var heightEl = $('#glide-height'),
                height = heightEl.val(),
                glideRatioEl = $('#glide-ratio'),
                glideRatio = glideRatioEl.val(),
                rateOfSinkEl = $('#glide-rate-of-sink'),
                rateOfSink = rateOfSinkEl.val(),
                resultBox = $('#glide-result'),
                errors, flightDuration, rangeInKm, heightLoss;

            heightEl.parent().removeClass('has-error');
            glideRatioEl.parent().removeClass('has-error');
            rateOfSinkEl.parent().removeClass('has-error');
            resultBox.hide();

            height = parseInt(height, 10);
            glideRatio = parseInt(glideRatio, 10);

            var entries =  {
                '#glide-height': height,
                '#glide-ratio': glideRatio
            };

            if (rateOfSink) {
                rateOfSink = parseInt(rateOfSink, 10);
                entries['#glide-rate-of-sink'] = rateOfSink;
            }

            errors = validate.numberGroup(entries);

            if (errors.length) {
                validate.processErrors(errors);
                return;
            }

            rangeInKm = range(height, glideRatio);
            heightLoss = lostHeight(height, glideRatio);

            resultBox.html('<p>Maximum flight distance: ' + rangeInKm + 'km</p');
            resultBox.append('<p>Loss of height per Km travelled: ' + heightLoss + 'ft</p>');

            if (rateOfSink) {
                flightDuration = duration(height, rateOfSink);
                resultBox.append('<p>Flight duration: ' + flightDuration + ' minutes</p>');
            }

            resultBox.show();
        });
    });
});
