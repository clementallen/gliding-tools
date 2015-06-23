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
    <meta name="description" content="Calculates glide range using glide ratio and current height along with flight duration">
    <meta name="author" content="Clement Allen">

    <title>Glide range calculator</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/gliding.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php

date_default_timezone_set('UTC');

//check if submit button as been clicked
if ($_POST['submit']) {

    //inclues the Glide class
    include 'Glide.php';

    //creates instance of the Glide class
    $Glide = new Glide();

    //collects info from the form
    $height = $_POST['height'];
    $gRatio = $_POST['gRatio'];
    $rateOfSink = $_POST['rateOfSink'];

    //validates entries
    $errHeight = $Glide->validate($height);
    $errGRatio = $Glide->validate($gRatio);

    //if rate of sink has been submitted
    if($rateOfSink){

        //validates rate of sink
        $errRateOfSink = $Glide->validate($rateOfSink);

        //if validation passes on all three
        if(!$errHeight && !$errGRatio && !$errRateOfSink){

            //calculation time!
            $rangeInKm = $Glide->calculateRange($height, $gRatio);
            $heightLoss = $Glide->calculateHeightLoss($height, $rangeInKm);
            $duration = $Glide->calculateDuration($height, $rateOfSink);

            $result = '<div class="alert alert-success">You can fly ' . $rangeInKm . ' Km and would lose ' . $heightLoss . 'ft per Km travelled.<br />'
            . 'Additionally, you would be able to fly for ' . $duration . ' minutes.</div>';
        }

    //if only height and glide ratio have been submitted
    } elseif (!$errHeight && !$errGRatio) {

        //calculation time!
        $rangeInKm = $Glide->calculateRange($height, $gRatio);
        $heightLoss = $Glide->calculateHeightLoss($height, $rangeInKm);

        $result = '<div class="alert alert-success">You can fly ' . $rangeInKm . ' Km and would lose ' . $heightLoss . 'ft per Km travelled.</div>';
    }

}

?>

    <div class="container">

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                    <div class="panel panel-default">
                        <h1>Glide range calculator</h1>
                        <br />

                            <form novalidate class="form-horizontal" role="form" method="post">

                                <div class="form-group">
                                <label for="height" class="col-sm-2 control-label center-block">Height</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="height" name="height" placeholder="Enter height in feet" value="<?php echo !isset($errHeight) ? $height : null ?>">
                                <?php echo "<p class='text-danger'>$errHeight</p>";?>
                                </div>
                                </div>

                                <div class="form-group">
                                <label for="gRatio" class="col-sm-2 control-label">Glide ratio</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="gRatio" name="gRatio" placeholder="Enter glide ratio" value="<?php echo !isset($errGRatio) ? $gRatio : null ?>">
                                <?php echo "<p class='text-danger'>$errGRatio</p>";?>
                                </div>
                                </div>

                                <div class="form-group">
                                <label for="rateOfSink" class="col-sm-2 control-label">Rate of sink</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="rateOfSink" name="rateOfSink" placeholder="Enter rate of sink in feet per minute (optional)" value="<?php echo !isset($errRateOfSink) ? $rateOfSink : null ?>">
                                <?php echo "<p class='text-danger'>$errRateOfSink</p>";?>
                                </div>
                                </div>

                                <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                <input id="submit" name="submit" type="submit" value="Calculate" class="btn btn-primary">
                                </div>
                                </div>

                                <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
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
