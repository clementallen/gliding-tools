<?php

class Glide {

    public function validate($input) {

        //if the input has not been entered
        if (!$input) {
            $error = 'Please enter a value';

        //if the input is not a number
        } elseif (!is_numeric($input)) {
            $error = 'Please enter a number';

        //keeps input within a sensible limit
        } elseif ($input > 40000 || $input <= 0) {
            $error = 'Come on, make it sensible!';

        //if validation has passed don't define the variable
        } else {
            $error = null;
        }

        return $error;
    }

    //calculates everything!
    public function calculateRange($height, $gRatio) {

        //conversion maths from feet to kilometres
        $kmConversion = 0.0003048;

        //calculate range into feet
        $rangeInFeet = $height * $gRatio;

        //convert feet into kilometres and rounds to two decimal places
        $rangeInKm = round($rangeInFeet * $kmConversion, 2);

        return $rangeInKm;
    }

    //calculate feet lost per km
    public function calculateHeightLoss($height, $rangeInKm){

        $feetLostPerKm = round($height / $rangeInKm);

        return $feetLostPerKm;
    }

    //calculates flight duration
    public function calculateDuration($height, $rateOfSink){

        $durationMinutes = round($height / $rateOfSink);

        return $durationMinutes;
    }

}