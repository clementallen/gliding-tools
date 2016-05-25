require(['config'], function() {
    require(['main', 'validators', 'jquery', 'aircraftWeights'], function(main, validate, $, aircraft) {

        function updatePlaceholder(id, value) {
            $(id).attr('placeholder', value);
        }

        function calculateWeightMargin(pilotWeight, gliderWeight) {
            if(pilotWeight > gliderWeight) {
                return pilotWeight - gliderWeight;
            } else {
                return gliderWeight - pilotWeight;
            }
        }

        $.each(aircraft, function(index, value) {
            $('#weight-select-glider').append('<option value="' + index + '">' + index + '</option>');
        });

        $('#weight-select-glider').on('change', function() {
            var selected = $(this).val();
            if(selected == 'other' || selected == 'Select glider') {
                $('#weight-glider').parent().removeClass('hidden');
                $('#weight-individual').parent().removeClass('hidden');
                $('#weight-glider').val('');
                $('#weight-individual').val('');

            } else {
                $('#weight-glider').parent().addClass('hidden');
                $('#weight-individual').parent().addClass('hidden');
                $('#weight-glider').val(aircraft[selected].minWeight);
                $('#weight-individual').val(aircraft[selected].leadWeight);
            }
        });

        $('#weight-unit').on('click', function() {
            var unit = $(this).text(),
                newUnit;

            if(unit == 'Imperial') {
                newUnit = 'Metric';
                updatePlaceholder('#weight-pilot', 'kgs');
                updatePlaceholder('#weight-glider', 'kgs');
                updatePlaceholder('#weight-individual', 'kgs');

            } else {
                newUnit = 'Imperial';
                updatePlaceholder('#weight-pilot', 'lbs');
                updatePlaceholder('#weight-glider', 'lbs');
                updatePlaceholder('#weight-individual', 'lbs');
            }

            $(this).text(newUnit);
        });

        $('#weight-form').submit(function(e) {
            e.preventDefault();

            var isImperial = $('#weight-unit').text() == 'Imperial',
                unit = isImperial ? 'lbs' : 'kgs',
                pilotWeight = $('#weight-pilot').val(),
                gliderWeight = $('#weight-glider').val(),
                eachWeight = $('#weight-individual').val(),
                resultBox = $('#weight-result'),
                errors, weightMargin, requiredWeights;

            $('#weight-pilot').parent().removeClass('has-error');
            $('#weight-glider').parent().removeClass('has-error');
            $('#weight-individual').parent().removeClass('has-error');
            resultBox.hide();

            pilotWeight = parseInt(pilotWeight, 10);
            gliderWeight = parseInt(gliderWeight, 10);

            var entries = {
                '#weight-pilot': pilotWeight,
                '#weight-glider': gliderWeight
            };

            if(eachWeight) {
                entries['#weight-individual'] = eachWeight;
            }

            errors = validate.numberGroup(entries);

            if(errors.length) {
                validate.processErrors(errors);
                return;
            }

            weightMargin = calculateWeightMargin(pilotWeight, gliderWeight);

            if(pilotWeight > gliderWeight) {
                resultBox.html('<p>No need for weights, you are ' + weightMargin + unit + ' over the minimum limit</p>');
                resultBox.show();
                return;
            }

            resultBox.html('<p>You are ' + weightMargin + unit + ' under the minimum limit</p>');

            if(eachWeight) {
                requiredWeights = weightMargin / eachWeight;
                resultBox.append('<p>You would need ' + Math.ceil(requiredWeights) + ' weights to be over the minimum limit</p>');
            }
            
            resultBox.show();

        });

    });
});
