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

    <title>BGA Handicaps</title>

    <link href="../assets/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/gliding.css" rel="stylesheet" type="text/css" />
</head>

<body>


    <div class="container bga-handicap">

            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
                    <div id="handicap-search" class="panel panel-default">
                        <h1>BGA Handicaps</h1>
                        <p class="lead">Updated May 2015</p>

                            <div class="filter">

                                <input class="search" placeholder="Search" />
                                <button class="sort" data-sort="glider">
                                    Sort by glider
                                </button>

                                <button class="sort" data-sort="handicap">
                                    Sort by handicap
                                </button>

                            </div>

                            <table class="table table-striped table-condensed">
                                <tbody class="list">

                                <?php

                                date_default_timezone_set('UTC');

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
                <p>Created by <a target="_blank" href="http://clementallen.com">Clement Allen</a> - <?php echo date('Y'); ?></p>
            </div>

    </div><!-- /container -->

    <script src="../assets/list.min.js"></script>
    <script src="../assets/bgahandicaps.js"></script>

</body>

</html>