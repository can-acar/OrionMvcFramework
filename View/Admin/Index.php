<!DOCTYPE html>
<html>
	<head>
		<title>
		Welcome	Admin !
		</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		
		<link href="../Theme/css/bootstrap.min.css" rel="stylesheet" media="screen">
		<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
		<link href="../Theme/css/theme.css" rel="stylesheet" media="screen">
		<!--[if IE 7]>
		  <link rel="stylesheet" href="../Theme/css/font-awesome-ie7.min.css">
		<![endif]-->
		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="../assets/js/html5shiv.js"></script>
		<script src="../assets/js/respond.min.js"></script>
		
		<![endif]-->
		<!--[if lt IE 9]>
		<script src="https://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" type="text/css" href="http://static.gavick.com/templates/gk_homepage/css/ie8.css" />
		<![endif]-->
		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="//code.jquery.com/jquery.js">
		</script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="../Theme/js/bootstrap.min.js">
		</script>
	</head>
	<body>
		<div class="body-section clearfix">
			<div class="container">
				<div class="header-section">
					<div class="navbar navbar-inverse">
						<div class="container">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
									<span class="icon-bar">
									</span>
									<span class="icon-bar">
									</span>
									<span class="icon-bar">
									</span>
								</button>
								<a class="navbar-brand" href="/">
									Orion PHP MVC Framework
								</a>
							</div>
							<div class="navbar-collapse collapse">
								<ul class="nav navbar-nav">
									<li>
										<a href="#about">
											About
										</a>
									</li>
									<li>
										<a href="#contact">
											Download
										</a>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown">
											Documentation
											<b class="caret">
											</b>
										</a>
										<ul class="dropdown-menu">
											<li>
												<a href="#">
													Action
												</a>
											</li>
											<li>
												<a href="#">
													Another action
												</a>
											</li>
											<li>
												<a href="#">
													Something else here
												</a>
											</li>
											<li class="divider">
											</li>
											<li class="dropdown-header">
												Nav header
											</li>
											<li>
												<a href="#">
													Separated link
												</a>
											</li>
											<li>
												<a href="#">
													One more separated link
												</a>
											</li>
										</ul>
									</li>
								</ul>
							</div><!--/.nav-collapse -->
						</div>
					</div>
				</div>
					<div class="wrap clearfix">
						<div class="page-wrapper  clearfix">
							<div class="">
								<div class="top-container clearfix">
									<div class="inner clearfix">
								        <h1>{{@AdminTitle }}</h1>
								        <p>Welcome Admin</p>
								        <p><a class="btn btn-primary btn-lg">Learn more »</a></p>
							        </div>
									<div class="row-fluid clearfix">
										<div class="col-lg-4">
											<div class="panel panel-default">
											  <div class="panel-head">
													<h3>Panel Head</h3>
												</div>
												  <div class="panel-body">
													<table class="table table-striped">
																<thead>
																	<tr>
																	  <th>Browser</th>
																	  <th>Visits</th>
																	</tr>
																</thead>
																<tbody>
																  <tr>
																	<td>Firefox</td>
																	<td><strong>5798</strong></td>
																  </tr>
																  <tr>
																	<td>Chrome</td>
																	<td><strong>4855</strong></td>
																  </tr>
																  <tr>
																	<td>Internet Explorer</td>
																	<td><strong>2877</strong></td>
																  </tr>
																  <tr>
																	<td>Safari</td>
																	<td><strong>2705</strong></td>
																  </tr>
																  <tr>
																	<td>Opera</td>
																	<td><strong>1985</strong></td>
																  </tr>
																  <tr>
																	<td>Android Browser</td>
																	<td><strong>1581</strong></td>
																  </tr>
																  <tr>
																	<td>RockMelt</td>
																	<td><strong>1284</strong></td>
																  </tr>
																</tbody>
														</table>
												  </div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="panel panel-default">
											  <div class="panel-body">
												Basic panel
											  </div>
											</div>
										</div>
										<div class="col-lg-4">
											<div class="panel panel-default">
											  <div class="panel-body">
												Basic panel
											  </div>
											<div class="panel-footer">
												Panel Footer
											</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<div class="hightlight">
								<?php        echo $Message        ?>
							</div>
						</div>
					</div>	
			</div>
			<div class="footer-section clearfix">
				<div class="container">
					<p class="text-muted credit">Senior Software Developer<a href="#"></a>   Can Acar</a>.</p>
				</div>
			</div>
		</div>
	</body>
</html>