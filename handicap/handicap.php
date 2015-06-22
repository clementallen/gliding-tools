<?php

class Handicap {

    //validates inputs
    public function validate($input){

        //if the input has not been entered
        if (!$input) {
            $error = 'Please enter a value';

        //if the input is not a number
        } elseif (!is_numeric($input)){
            $error = 'Please enter a number';

        //if validation has passed don't define the variable
        } else {
            $error = null;
        }

        return $error;
    }

    //calculates handicapped speed
    public function calculate($speed, $handicap) {

        //the calculation
        $handicapSpeed = ($speed / $handicap) * 100;

        //rounds handicapped speed to one decimal place
        $handicapSpeed = round($handicapSpeed, 1);

        return $handicapSpeed;
    }

}