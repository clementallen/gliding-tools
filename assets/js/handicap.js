require(['config'], function() {
    require(['main', 'validators', 'jquery'], function(main, valid, $) {
        $('#handicap-form').submit(function(e) {
            e.preventDefault();

            var handicap = $('#handicap-number'),
                handicapVal = handicap.val(),
                speed = $('#handicap-speed'),
                speedVal = speed.val(),
                resultBox = $('#handicap-result'),
                handicappedSpeed, result;

            function handicapSpeed(handicap, speed) {
                handicappedSpeed = (speed / handicap) * 100;
                return handicappedSpeed.toFixed(1);
            }

            handicap.parent().removeClass('has-error');
            speed.parent().removeClass('has-error');
            resultBox.hide();

            if(valid.number(handicapVal) && valid.number(speedVal)) {
                result = handicapSpeed(handicapVal, speedVal);
                resultBox.html('<p>Handicapped speed: ' + result + '</p>');
                resultBox.show();

            } else {
                handicap.parent().addClass('has-error');
                speed.parent().addClass('has-error');
            }

        });
    });
});
