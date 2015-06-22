<?php

class Silver {

    public function validate($input) { //validates inputs

        if (!$input) { //if the input has not been entered
            $error = 'Please enter a value';
        }
        elseif (!is_numeric($input)){ //if the input is not a number
            $error = 'Please enter a number';
        }
        else {
            $error = null; //if validation has passed don't define the variable
        }

        return $error;
    }

    public function launchHeight($distance) { //calculates just max launch height

        $kmToFeet = 3.281; //conversion maths from km to feet
        $distancePercentKm = $distance / 100; //calculates 1% of the distance
        $launchHeight = $distancePercentKm * $kmToFeet; //convert kilometres to feet
        $launchHeightFeet = $launchHeight * 1000; //removes decimal point
        $launchHeightFeet = round($launchHeightFeet); //rounds up/down to make a full number

        return $launchHeightFeet;
    }

    public function airfieldHeight($launchHeightFeet, $originHeight, $destinationHeight) { //calculates max launch height using origin and destination altitudes

        $airfieldHeight = $destinationHeight - $originHeight; //total difference between airfields
        $maxLaunchHeight = $launchHeightFeet + $airfieldHeight; //calculates final launch height taking into account airfield heights

        return $maxLaunchHeight;
    }
}
