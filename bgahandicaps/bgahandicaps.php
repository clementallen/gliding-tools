<!DOCTYPE HTML>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="List of BGA handicaps">
    <meta name="author" content="Clement Allen">

    <title>BGA Handicaps</title>

    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/css/gliding.css" rel="stylesheet" type="text/css" />
</head>

<body>


    <div class="container bga-handicap">

            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div id="handicap-search" class="panel panel-default">
                        <h1>BGA Handicaps</h1>
                        <p class="lead">Updated May 2015</p>

                            <div class="filter">

                                <input id="glider-search" class="search" placeholder="Filter" />

                                <button class="sort" data-sort="glider">Sort by glider</button>

                                <button class="sort" data-sort="handicap">Sort by handicap</button>

                                <p style="float: right" class="lead total">Total: <span></span></p>

                            </div>

                            <table class="table table-striped table-condensed">
                                <tbody class="list">

                                <?php

                                $json = file_get_contents('../assets/bgahandicaps.json');
                                $jsonArray = json_decode($json, true);

                                foreach($jsonArray as $item){
                                    echo '<tr><td class="glider">' . $item['glider'] . '</td><td class="handicap">' . $item['handicap'] . '</td></tr>';
                                }

                                ?>

                                </tbody>
                            </table>

                    </div>
                </div>
            </div>

            <div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-12" id="footer">
                <p>Created by <a target="_blank" href="http://clementallen.com">Clement Allen</a> - </p>
            </div>

    </div><!-- /container -->

    <script data-main="../assets/js/bgaHandicaps" src="../assets/js/vendor/require.js"></script>

</body>

</html>
