<div class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a href="index.php" class="navbar-brand">
                <span>
                    <img src="favicon.ico" height="25" width="25" />
                </span> 
                Head Count
            </a>

            <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        
        
        <div class="collapse navbar-collapse navHeaderCollapse">
            <ul class="nav navbar-nav navbar-right">
                <!-- (basename($_SERVER['PHP_SELF']) returns trailing basename component -->
                <!-- Updates active link -->
                <?php 
                    if ((basename($_SERVER['PHP_SELF']) == 'index.php') || basename($_SERVER['PHP_SELF']) == '')
                        print("<li class='active'><a href='index.php'>Current Count</a></li>");
                    else 
                        print("<li><a href='index.php'>Current Count</a></li>");

                    if (basename($_SERVER['PHP_SELF']) == 'dailySpread.php') 
                        print("<li class='active'><a href='dailySpread.php'>Daily Spread</a></li>");
                    else
                        print("<li><a href='dailySpread.php'>Daily Spread</a></li>");

                    if (basename($_SERVER['PHP_SELF']) == 'dailyTotals.php')
                        print("<li class='active'><a href='dailyTotals.php'>Daily Spread</a></li>");
                    else
                        print("<li><a href='dailyTotals.php'>Daily Totals</a></li>");
                ?>
            </ul>
        </div>
    </div>
</div>