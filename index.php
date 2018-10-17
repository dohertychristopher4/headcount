<!doctype html>
<head>
    <title>Head Count</title>
    <link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="./css/styles.css">
    <!--<link rel="stylesheet" href="/xampp/htdocs/lsapp/public/css/app.css">-->
    <!--Check if mobile-->
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
                <div class="col-xs-10">
                    <h1>Head Count</h1>      
                    <h4>Welcome to Head Count!</h4>
                    <h5>Here you'll find footfall data and graphs from local businesses.</h5>
                </div>
                <div class="col-xs-2">
                    <img id="imgLogo" width="100%" src='./images/logo.png'/>
                </div>
            </div><!-- jumbotron -->     
        </div>
        <div class="row" style="margin-right: -5px;">
            <div class="green-bg col-xs-12">
                <div class="card text-white">
                    <div class="card-header" style="text-align:center">
                        <h4>
                            Change Location:
                        </h4>
                    </div>
                    <div class="card-body" style="text-align:center">
                        <p>
                            <?php include 'getVenueNames.php';?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="green-bg col-xs-12"  id="countPod">
                <div class="card text-white">
                    <div class="card-header">
                        <h2 class="card-title"  style="text-align:center">
                            <p id="myVenue"></p>
                        </h2>
                    </div>
                    <div class="card-body">
                        <h3 id="todaysCount" style="text-align:center"></h3>
                        <p class="card-text" style="text-align:center"></p>
                    </div>
                </div>
            </div>

        </div>
          
        <div class="footer" align="center" id="pageViews">
            <img src="./images/viewCount.png"/ height="15" width="15">
        </div>
    </div>

    <script src="currentCount.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>