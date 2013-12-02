
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
	white-space: pre-line;
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

<body>
<div class="system_error">


	<h2><i><?php echo $error; ?></i></h2>
	<?php //Site::debug(OrionException::backtrace(1))?>
    <div class="box">
<?php

	if($backtrace = OrionException::backtrace(1))
	{
		$html = '';
		$stac ='';
		foreach($backtrace as $id => $line)
		{
			if($id == 2)
			{
				
				// Print file, line, and source
				$html .= '<code class="source">'. OrionException::source($line['file'], $line['line']).  '</code>';
				$html .= '<b>Source file: </b>'. $line['file']. ' <b>Line:</b> '. $line['line']. '';
				$html .= '<p><b> Stac Trace:</b></p>';
				
			}
			
			
			if($id > 2)
			{
				$stac .=  '<br/><b>'. (isset($line['class']) ? $line['class']. $line['type'] : '');
				$stac .= $line['function']. '()   '.$line['file'].':'.$line['line'].'</b>';
			}
			
			
		}
		//$html .= $stac.'';
		echo $html.$stac;
	}
	elseif(isset($file, $line))
	{
		print '<p><b>'. $file. '</b> ('. $line. ')</p>';
	}
	
	?>
</div>
</div>
</body>

