<?php
$url = "https://www.bitstamp.net/api/ticker/";
$fgc = file_get_contents($url);
$json = json_decode($fgc, true);

$price = $json["last"];
$high = $json["high"];
$low = $json["low"];
$date = date("m-d-Y - h:i:sa");
$open = $json["open"];

if($open < $price){
  $indicator = "+";
  $change = $price - $open;
  $percent = $change / $open; 
  $percentCalc = $percent * 100;
  $percentChange = $indicator.number_format($percent, 2);  
  $color = "green";
}
if($open > $price){
  $indicator = "-";
  $change = $open - $price;
  $percent = $change / $open; 
  $percentCalc = $percent * 100;
  $percentChange = $indicator.number_format($percent, 2); 
  $color = "red"; 
}
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Gekko</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<h1 id="logo"><a href="index.html">Gekko</a></h1>
					<nav id="nav">
						<ul>
							<li><a href="index.html">Home</a></li>
							<li>
								<a href="coins.html">Currencies</a>
							</li>
							<li><a href="contact.html">Contact</a></li>
							<li><a href="signup.html" class="button special">Subscribe</a></li>
						</ul>
					</nav>
				</header>

			<!-- Main -->
				<div id="main" class="wrapper style1">
					<div class="container">
						<header class="major">
							<h2>Crypto 	Coins</h2>
						</header>

						<!-- Content -->
							<section id="content">
								<div id="container">
							      <table width="100%">
							        <tr>
							          <td rowspan="3" width="60%" id="lastprice"><?php echo $price; ?></td>
							          <td align="right"><?php echo $percentChange; ?></td>
							        </tr>
							        <tr>
							          <td align="right"><?php echo $high; ?></td>
							        </tr>
							        <tr>
							          <td align="right"><?php echo $low; ?></td>
							        </tr>
							        <tr>
							          <td colspan="2" align="right" id="timedate"><?php echo $date; ?></td>
							        </tr>
							      </table>
							    </div>
							</section>

					</div>
				</div>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<li><a href="#" class="icon alt fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="#" class="icon alt fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="#" class="icon alt fa-linkedin"><span class="label">LinkedIn</span></a></li>
						<li><a href="#" class="icon alt fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="#" class="icon alt fa-github"><span class="label">GitHub</span></a></li>
						<li><a href="#" class="icon alt fa-envelope"><span class="label">Email</span></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled. All rights reserved.</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>