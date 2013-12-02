<html>
 <head>
	<title><?php echo $message; ?></title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<style type="text/css" >
h1 {
	font-family: "Verdana";
	font-weight: normal;
	font-size: 18pt;
	color: red;
}
h2 {
	font-family: "Verdana";
	font-weight: normal;
	font-size: 14pt;
	color: maroon;
}
body {
	font-family: "Verdana";
	font-weight: normal;
	font-size: .7em;
	color: black;
}
.system_error {
	background: #fff;
}
code.source {
	white-space: pre;
	background: #FFC;
	display: block;
	margin: 1em 0;
	font-size: 15px;

}
code.source em { color: red; font }
.system_error .box {
	margin: 1em 0;
}

</style>
</head>
<body>
<div class="system_error">

	<h1 >Server Error in  Application
	<hr width="100%" size="1" color="silver">
	 <b style="color: #990000">Database Error</b>
	</h1>

	<b><?php echo'[' .$code .']:'. $message; ?></b>

</div>
</div>
</body>
</html>
