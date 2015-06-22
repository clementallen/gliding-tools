<!--
The MIT License (MIT)
Copyright (c) 2015 Clement Allen
Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:
The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

<!-- fork this project on GitHub! http://github.com/clementallen/gliding-tools/ -->

<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Calculates max launch height for silver distance using airfield heights and the 1% rule">
    <meta name="author" content="Clement Allen">

    <title>Silver launch height calculator</title>

    <link href="../assets/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/gliding.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php

date_default_timezone_set('UTC');

if ($_POST['submit']) { //check if submit button as been clicked

    include 'Silver.php';

    $Silver = new Silver();

    $distance = $_POST['distance']; //gets height from the form
    $originHeight = $_POST['originHeight']; //gets origin height from the form
    $destinationHeight = $_POST['destinationHeight']; //gets destination height from the form

    $errDistance = $Silver->validate($distance); //validates distance

    if ($distance && $originHeight && $destinationHeight) { //if airfield heights have been submitted
        $errOriginHeight = $Silver->validate($originHeight); //validates origin height
        $errDestinationHeight = $Silver->validate($destinationHeight); //validates destination height

        if (!$errDistance && !$errOriginHeight && !$errDestinationHeight) { //if validation passes print out the result
            $launchHeightFeet = $Silver->launchHeight($distance);
            $maxLaunchHeight = $Silver->airfieldHeight($launchHeightFeet, $originHeight, $destinationHeight);

            $result = '<div class="alert alert-success">Maximum launch height is ' . $maxLaunchHeight . 'ft.<br />And without altitude calculations it is ' . $launchHeightFeet . 'ft.</div>';
        }

    } elseif ((!$$originHeight || !$destinationHeight) && !$errDistance) { // If there are no errors print out result
        $launchHeightFeet = $Silver->launchHeight($distance);
        $maxLaunchHeight = $Silver->airfieldHeight($launchHeightFeet, $originHeight, $destinationHeight);

        $result = '<div class="alert alert-success">Maximum launch height is ' . $maxLaunchHeight . 'ft.</div>';
    }

}
?>

    <div class="container">

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                    <div class="panel panel-default">

                        <h1>Silver launch height calculator</h1>
                        <br />

                            <form novalidate class="form-horizontal" role="form" method="post">

                                <div class="form-group">
                                <label for="distance" class="col-sm-3 control-label center-block">Flight distance</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="distance" name="distance" placeholder="Enter flight distance in km" value="<?php if(!isset($errDistance)){echo$distance;} ?>">
                                <?php echo "<p class='text-danger'>$errDistance</p>";?>
                                </div>
                                </div>

                                <div class="form-group">
                                <label for="originHeight" class="col-sm-3 control-label">Origin altitude</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="originHeight" name="originHeight" placeholder="Enter origin altitude in feet (optional)" value="<?php if(!isset($errOriginHeight)){echo$originHeight;} ?>">
                                <?php echo "<p class='text-danger'>$errOriginHeight</p>";?>
                                </div>
                                </div>

                                <div class="form-group">
                                <label for="destinationHeight" class="col-sm-3 control-label">Destination altitude</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" id="destinationHeight" name="destinationHeight" placeholder="Enter destination altitude in feet (optional)" value="<?php if(!isset($errDestinationHeight)){echo$destinationHeight;} ?>">
                                <?php echo "<p class='text-danger'>$errDestinationHeight</p>";?>
                                </div>
                                </div>

                                <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                <input id="submit" name="submit" type="submit" value="Calculate" class="btn btn-primary">
                                </div>
                                </div>

                                <div class="form-group">
                                <div class="col-sm-9 col-sm-offset-3">
                                <?php echo $result; ?>
                                </div>
                                </div>

                            </form>

                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-12" id="footer">
                <p>Created by <a target="_blank" href="http://clementallen.com">Clement Allen</a> - <?php echo date('Y'); ?></p>
            </div>

    </div><!-- /container -->

</body>

</html>
