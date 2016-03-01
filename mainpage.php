<?php
    include 'vendor/autoload.php';
    use Parse\ParseClient;
    use Parse\ParseUser;
    use Parse\ParseException;
    date_default_timezone_set('America/New_York');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
        ParseClient::initialize('W78hSNsME23VkGSZOD0JXn2XoM5Nf6GO41BgMqxE', 'H3EgW9gCr6wyP8MfL3Eobz1mWJMwydyp6N2prcVF', 'mRppu4ciMuqhNsTXHoeh329Za4ShOOc1F1NN0skD');   
    }
    $currentUser = ParseUser::getCurrentUser();
	if($currentUser && isset($_SESSION['timestamp']) && time() - $_SESSION['timestamp'] >= 300){
        include('logout.php');
        die();
	} 
	else{
		$_SESSION['timestamp'] = time();
    }
    if($currentUser) {
    }
    else{
        header('Location: /');
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Portfolio | StockOverflow</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="overall-wrapper">
	    <div class="header">
            <a href="/mainpage.php"><img src="img/so-logo.png" id="logo"></a>
	   		<div id="user-section" class="clearfix">
                <?php
                	echo '<p id="balance">' . $currentUser->get('username') . '</p>';
                	echo '<p id="balance">$' . $currentUser->get('balance') . '</p>';
                ?>
                <a href="logout.php" id="logout">Logout</a>
                <a href="" id="manual">User Manual</a>
	   		</div>
	    </div>

	    <div class="content clearfix">
	    	<div class="left-float-wrapper">
	    	<div id="center-area">
	    		<div id="search-section" class="widget-box">
	    			<input id="search-box" type="text" placeholder="Search stocks..." oninput="requestStockNames(this);">
	    		</div>

	    		<div id="graph-section" class="widget-box">
	    			<canvas id="canvas" height="200px" width="200px"></canvas>
	    			<div class="button-wrapper">
	    				<button id="1d" class="button graph-button" onclick="updateTimeRange('1d')">1 day</button>
	    				<button id="5d" class="button graph-button">5 days</button>
	    				<button id="1d" class="button graph-button">1 month</button>
	    				<button id="3m" class="button graph-button">3 months</button>
	    				<button id="6m" class="button graph-button">6 months</button>
	    				<button id="1y" class="button graph-button">1 year</button>
	    				<button id="all" class="button graph-button">All</button>
	    			</div>
	    		</div>

	    		<div id="information-section" class="widget-box">
	    			<p>Stock information section
	    				
	    			</p>
	    		</div>

	    	</div>

	    	<div id="left-area">
                <div id="CSV-section" class="widget-box">
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <input type="file" name="fileToUpload" id="fileToUpload" class="button-fileUpload">
                            <label for="fileToUpload">
                                <span>Upload CSV File</span>
                            </label>
                        <input type="submit" name="submit"  alt="Import CSV" value="Import CSV File" class="button">
                    </form>
				</div>
	    		<div id="portfolio-section" class="widget-box">
	    			<table>
		    			<tr>
		    				<th align="left">Ticker</th>
		    				<th align="left">Name</th>
		    				<th align="left">Price</th>
		    			</tr>
		    			<tr>
		    				<td>FB</td>
		    				<td>Facebook</td>
		    				<td>$price</td>
		    			</tr>
		    			<tr>
		    				<td>GOOG</td>
		    				<td>Google</td>
		    				<td>$price</td>
		    			</tr>
	    			</table>

	    			
	    		</div>

	    		<div id="buy-sell-section" class="widget-box">
					 <form action="" method="post">
						<input id="tickerInput" class="buySell-field" type="text" placeholder="Stock Ticker" pattern="[A-Za-z]{1,5}" maxlength="5" required autofocus><br>
						<input id="qty" class="buySell-field" type="number" min="1" placeholder="Quantity" required><br>
                        <div class="button-wrapper">
							<input type="submit" class="button-buySell" name="buy"  alt="Buy" value="Buy">
							<input type="submit" class="button-buySell" name="sell" alt="Sell" value="Sell">
						</div>
					</form>
	    		</div>

	    	</div>
	    </div> <!--left float wrapper end -->
	    	<div id="right-area">
	    		<div id="time-date" class="widget-box">
	    			<p>Time</p>
	    		</div>

	    		<div id="graph-key" class="widget-box">
	    			<p>Key</p>
	    		</div>

	    		<div id="watchlist" class="widget-box">
	    			<p>Watchlist</p>
	    		</div>
	    	</div>

	    </div>

	    <footer>
	    <p><small>This is the work of college students.</small></p>
	    <br>
        <p><small>For more information, <a href="mailto:halfond@usc.edu" class="contact" target="_top">email</a> or <a href="tel:12137401239" class="contact">call</a> Professor Halfond.</small></p>
	    </footer>
    </div>



	<!-- Load javascript here -->
	<script src="js/Chart.js/Chart.min.js"></script>
	<script src="js/stock-graph.js"></script>
	<script src="js/stock-graph.js"></script>
	<script src="js/search-stocks-handler.js"></script>

</body>
</html>
