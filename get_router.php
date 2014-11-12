<!DOCTYPE HTML>
<!--
	TXT by HTML5 UP
	html5up.net | @n33co
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
	<head>
		<title>SNMP MANAGER</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
			<link rel="stylesheet" href="css/style-desktop.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body>

		<!-- Header -->
			<header id="header">
				<div class="logo container">
					<div>
						<h1><a href="admin_page5.php" id="logo">SNMP</a></h1>
						<p>MANAGER</p>
					</div>
				</div>
			</header>

		<!-- Nav -->
			<nav id="nav" class="skel-layers-fixed">
				<ul>
					<li><a href="admin_page5.php">Home</a></li>
					<li  class="current">
						<a href="get_router.php">GET Router</a>
						<!--<ul>
							<li><a href="#">Lorem ipsum dolor</a></li>
							<li><a href="#">Magna phasellus</a></li>
							<li>
								<a href="">Phasellus consequat</a>
								<ul>
									<li><a href="#">Lorem ipsum dolor</a></li>
									<li><a href="#">Phasellus consequat</a></li>
									<li><a href="#">Magna phasellus</a></li>
									<li><a href="#">Etiam dolore nisl</a></li>
								</ul>
							</li>
							<li><a href="#">Veroeros feugiat</a></li>
						</ul>-->
					</li>
					<li><a href="manage_user.php">Manager USER</a></li>
					<li><a href="topology.php">Your Topology</a></li>
                    <li><a href="log_page.php">Log File</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</nav>
		
		<!-- Main -->
			<div id="main-wrapper">
				<div id="main" class="container">
					<div class="row">
						<div class="12u">
							<div class="content">
							
								<!-- Content -->
						
									<article class="box page-content">

										<header>
											<h2>Get information</h2>
											<p>You can get information your router from this page</p>
											
										</header>
										<center>
										<section>
										
											<form id="form1" name="form1" method="post" action="">
                                <select name="catalog" id="catalog"onChange="location.href = 'get_router_show.php?Router_IP=' + this.value;" style="width:200px">
                                    <option value="">- Choose -</option>
                                    <?php
                                    $host = "localhost";
                                    $user = "root";
                                    $password = "password";
                                    $dbname = "logon";
                                    $connection = mysql_connect($host, $user, $password) or die("àª×èÍÁµèÍ°Ò¹¢éÍÁÙÅäÁèä´é");
                                    mysql_select_db($dbname) or die("äÁèÊÒÁÒÃ¶àÅ×Í¡°Ò¹¢éÍÁÙÅä´é");
                                    $sql = "select * from router order by Router_ID ASC";
                                    $dbquery = mysql_db_query($dbname, $sql);
                                    var_dump($dbquery);
                                    while ($result = mysql_fetch_array($dbquery)) {
                                        if ($Router_ID == $result[Router_Name]) { 
                                            ?>
                                            <option value="<?php echo $result["Router_IP"]; ?>" selected="selected"><?php echo $result["Router_Name"]; ?></option>
                                            <?php
                                            }else{?>
                                            <option value="<?php echo $result["Router_IP"]; ?>"><?php echo $result["Router_Name"]; ?></option>

                                    <?php
                                    } }
                                    ?>

										</section>
									</center>
									</article>

							</div>
						</div>
					</div>
					<div class="row 200%">
						<div class="12u">

							
												
										
											</div>
										</div>
										
										</div>
									</div>
								</section>

						</div>
					</div>
				</div>
			</div>

		<!-- Footer -->
			<footer id="footer" class="container">
				<div class="row 200%">
					<div class="12u">

						
					</div>
				</div>
				<div class="row 200%">
					<div class="12u">

						
					
					</div>
				</div>

				<!-- Copyright -->
					<div id="copyright">
						<ul class="menu">
							<li>&copy; Untitled. All rights reserved</li><li>Design: <a href="http://html5up.net">HTML5 UP</a></li>
						</ul>
					</div>

			</footer>

	</body>
</html>