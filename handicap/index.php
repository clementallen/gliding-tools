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
    <meta name="description" content="Calculates handicapped speed of task">
    <meta name="author" content="Clement Allen">

    <title>Handicapped speed calculator</title>

    <link href="../assets/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/gliding.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php

date_default_timezone_set('UTC');

if ($_POST['submit']) { //check if submit button as been clicked

    //inclues the Handicap class
    include 'Handicap.php';

    //creates instance of the Handicap class
    $Handicap = new Handicap();

    $speed = $_POST['speed']; //gets speed from the form
    $handicap = $_POST['handicap']; //gets handicap from the form

    $errSpeed = $Handicap->validate($speed); //validates speed
    $errHandicap = $Handicap->validate($handicap); //validates handicap

    if (!$errSpeed && !$errHandicap) { // If there are no errors print out result

        $handicapSpeed = $Handicap->calculate($speed, $handicap);

        $result = '<div class="alert alert-success">You flew at a handicapped speed of ' . $handicapSpeed . '</div>';
    }

}
?>

    <div class="container">

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                    <div class="panel panel-default">
                        <h1>Handicapped speed calculator</h1>
                        <br />

                            <form novalidate class="form-horizontal" role="form" method="post">

                                <div class="form-group">
                                <label for="speed" class="col-sm-2 control-label center-block">Speed</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="speed" name="speed" placeholder="Enter flown task speed" value="<?php echo !isset($errSpeed) ? $speed : null ?>">
                                <?php echo "<p class='text-danger'>$errSpeed</p>";?>
                                </div>
                                </div>

                                <div class="form-group">
                                <label for="handicap" class="col-sm-2 control-label">Handicap</label>
                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="handicap" name="handicap" placeholder="Enter handicap" value="<?php echo !isset($errHandicap) ? $handicap : null ?>">
                                <?php echo "<p class='text-danger'>$errHandicap</p>";?>
                                </div>
                                </div>

                                <div class="form-group">
                                <div class="col-sm-10 col-sm-offset-2">
                                <input id="submit" name="submit" type="submit" value="Calculate" class="btn btn-primary">
                                <a href="../bgahandicaps/" target="_blank" style="float: right" class="btn btn-primary">BGA Handicaps</a>
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
