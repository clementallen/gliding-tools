<?php

class Glide {

    public function validate($input) {

        if (!$input) { //if the input has not been entered
            $error = 'Please enter a value';

        } elseif (!is_numeric($input)) { //if the input is not a number
            $error = 'Please enter a number';

        } elseif ($input > 40000 || $input <= 0) { //keeps input within a sensible limit
            $error = 'Come on, make it sensible!';

        } else {
            $error = null; //if validation has passed don't define the variable
        }

        return $error;
    }

    public function calculateRange($height, $gRatio) { //calculates everything!

        $kmConversion = 0.0003048; //conversion maths from feet to kilometres
        $rangeInFeet = $height * $gRatio; //calculate range into feet
        $rangeInKm = round(($rangeInFeet * $kmConversion), 2); //convert feet into kilometres and rounds to two decimal places

        return $rangeInKm;
    }

    public function calculateHeightLoss($height, $rangeInKm){ //calculate feet lost per km

        $feetLostPerKm = round($height / $rangeInKm);

        return $feetLostPerKm;
    }

    public function calculateDuration($height, $rateOfSink){ //calculates flight duration

        $durationMinutes = round($height / $rateOfSink);

        return $durationMinutes;
    }

}