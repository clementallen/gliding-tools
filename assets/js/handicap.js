require(['config'], function() {
    require(['main', 'validators', 'jquery'], function(main, validate, $) {

        function handicapSpeed(handicap, speed) {
            var handicappedSpeed = (speed / handicap) * 100;
            return handicappedSpeed.toFixed(1);
        }

        $('#handicap-form').submit(function(e) {
            e.preventDefault();

            var handicapEl = $('#handicap-number'),
                handicap = handicapEl.val(),
                speedEl = $('#handicap-speed'),
                speed = speedEl.val(),
                resultBox = $('#handicap-result');

            handicapEl.parent().removeClass('has-error');
            speedEl.parent().removeClass('has-error');
            resultBox.hide();

            handicap = parseInt(handicap, 10);
            speed = parseInt(speed, 10);

            var entries = {
                '#handicap-number': handicap,
                '#handicap-speed': speed
            };

            var errors = validate.numberGroup(entries);

            if(errors.length) {
                validate.processErrors(errors);
                return;
            }

            var handicappedSpeed = handicapSpeed(handicap, speed);

            resultBox.html('<p>Handicapped speed: ' + handicappedSpeed + '</p>');
            resultBox.show();

        });

    });
});
