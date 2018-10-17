<!doctype html>
    <head>
        <title>Daily Totals - Head Count Live</title>
        <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="./css/styles.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="utf-8">
        <script src="jquery-3.3.1.min.js"></script>
    </head>
    <body>
        <!-- NAVBAR -->
        <?php include 'header.php';?>
        
        <!-- END NAVBAR -->
        <div class="container">
            <div class="row">
                <div class="jumbotron">
                <div class="col-xs-10" style="display: table;">
                    <h1>Daily Totals</h1>      
                    <h5>Here you'll find the busy and quieter times of your selected business.</h5>
                </div>
                <div class="col-xs-2">
                    <img id="imgLogo" width="100%" src='./images/logo.png'/>
                </div>
                </div><!-- jumbotron -->     
            </div>
            
            <div class="row" style="padding-bottom:30px;">
                <div class="col-sm-12">
                    <div class="card-body" style="text-align: center;">
                        <h4 class="mb-3"></h4>
                        <span><b>Select Premises: &nbsp;</b></span>	
                        <?php include 'getVenueNames.php';?>
                        <div id="chart-container">
                            <canvas id="mycanvas"></canvas>
                            <img id="imgNoData" width="100%" src='./images/noData.png'/>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footer" align="center" id="pageViews">
                <img src="./images/viewCount.png"/ height="15" width="15" />
                <!--Current Count JS handles this-->
            </div>
        </div>

    </body>
    <script src="Chart.js"></script>
    <script src="dailyTotals.js"></script>
    <script src="currentCount.js"></script>
    <script src="js/bootstrap.min.js"></script>
</html>
