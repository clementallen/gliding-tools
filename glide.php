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

<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Calculates glide range using glide ratio and current height">
    <meta name="author" content="Clement Allen">

  <title>Glide range calculator</title>
  
  <link href="bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="glide.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  
</head>

<body>

<?php

if ($_POST['submit']) { //check if submit button as been clicked
  
	$height = $_POST['height'];
	$gRatio = $_POST['gRatio'];
	$kmConversion = 0.0003048; //conversion maths from feet to kilometres
	
	// Check if height has been entered and is valid
	if (!is_numeric($height)) {
		$errHeight = 'Please enter a number!'; //error message 
	}
	if ($height > 60000 || $height <= 0){ //keeps height within a sensible limit
		$errHeight = 'Come on, make it sensible!';
	}
	if (!$_POST['height']) {
		$errHeight = 'Please enter a height'; //error message
	}

	// Check if glide ratio has been entered and is valid
	if (!is_numeric($gRatio)) {
		$errGRatio = 'Please enter a number!'; //error message
	}
	if ($gRatio > 100 || $gRatio <= 0){ //keeps glide ratio within a sensible limit
		$errGRatio = 'Come on, make it sensible!';
	}
	if (!$_POST['gRatio']) {
		$errGRatio = 'Please enter a glide ratio'; //error message
	}

	// If there are no errors, start the calculations
	if (!$errHeight && !$errGRatio) {
	
		//calculate range into feet using height and glide ratio
		$rangeInFeet = $height * $gRatio;

		//convert feet into kilometres
		$rangeInKm = $rangeInFeet * $kmConversion;
		$rangeInKm = substr($rangeInKm,0,strpos($rangeInKm,".") + 3); //result to 2 decimal places

		//calculate feet lost per km
		$feetLostPerKm = $height / $rangeInKm;
		$feetLostPerKm = round($feetLostPerKm);

		//success printout
		$result = '<div class="alert alert-success">You can fly ' . $rangeInKm . ' Km and would lose ' . $feetLostPerKm . 'ft per Km travelled.</div>';
	}

}

?>

  <div class="container">

      <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
          <div class="panel panel-default center-text">
            <h1>Glide range calculator</h1>
			<br />

			<form novalidate class="form-horizontal" role="form" method="post">

				<div class="form-group">
				<label for="height" class="col-sm-2 control-label center-block">Height</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="height" name="height" placeholder="Enter height in feet" value="<?php if(!isset($errHeight)){echo$height;} ?>">
                <?php echo "<p class='text-danger'>$errHeight</p>";?>
                </div>
                </div>
						
                <div class="form-group">
                <label for="gRatio" class="col-sm-2 control-label">Glide ratio</label>
                <div class="col-sm-10">
                <input type="text" class="form-control" id="gRatio" name="gRatio" placeholder="Enter glide ratio" value="<?php if(!isset($errGRatio)){echo$gRatio;} ?>">
				
				<?php echo "<p class='text-danger'>$errGRatio</p>";?>
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
        <p>Created by <a target="_blank" href="http://clementallen.com">Clement Allen</a> - <?php echo date("Y")?>.</p>
    </div>
	
  </div><!-- /container -->

</body>

</html>
