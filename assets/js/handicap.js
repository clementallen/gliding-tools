require(['config'], function() {
    require(['main', 'validators', 'jquery'], function(main, validate, $) {
        var handicapData;

        function handicapSpeed(handicap, speed) {
            var handicappedSpeed = (speed / handicap) * 100;
            return handicappedSpeed.toFixed(1);
        }

        $.get('../assets/bgahandicaps-2019.json', function(data) {
            handicapData = data;
            $.each(data, function(index, value) {
                $('#handicap-select-glider').append('<option data-index="' + index + '" value="' + value.Handicap + '">' + value.GliderType + '</option>');
            });
        });

        $('#handicap-select-glider').on('change', function() {
            var selectedValue = $(this).val();
            var selectedIndex = $(this).find(':selected').attr('data-index');
            if (selectedValue == 'other' || selectedValue == 'Select glider') {
                $('#handicap-number').parent().removeClass('hidden');
                $('#handicap-number').val('');
            } else {
                $('#handicap-number').parent().addClass('hidden');
                $('#handicap-number').val(handicapData[selectedIndex].handicap);
            }
        });


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

            if (errors.length) {
                validate.processErrors(errors);
                return;
            }

            var handicappedSpeed = handicapSpeed(handicap, speed);

            resultBox.html('<p>Handicapped speed: ' + handicappedSpeed + '</p>');
            resultBox.show();
        });
    });
});
