
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

<h1 >Server Error in  Application
<hr width="100%" size="1" color="silver">
</h1>
<h2><i><?php echo $exception->getMessage(); ?></i></h2>
<div class="box">


<?php
	$x = FALSE;
	if($backtrace = $exception->getTrace())
	{
		$html = '';
		$stac ='';
		foreach($backtrace as $id => $line)
		{
			if(!isset($line['file'],$line['line']))continue;
			$x = TRUE;
			if($id==0)
			{
				
				// Print file, line, and source
				$html .= '<code class="source">'. OrionException::source($line['file'], $line['line']).  '</code>';
				$html .= '<b>Source file: </b>'. $line['file']. ' <b>Line:</b> '. $line['line']. '';
				$html .= '<p><b> Stac Trace:</b></p>';
				$html .='';
			}
			foreach($line['args'] as $k => $v)
			{
				$stac .=  '<b>* '. (isset($line['class']) ? $line['class']. $line['type'] : '');
				$stac .= $line['function']. '()   '.$line['file'].':'.$line['line'].'</b><br/>';
				//Site::debug($k,$v);
			}
		}
		echo $html.$stac.'';
	}
	if(!$x)
	{
		//Site::debug($exception);
		print '<p><b>'.$exception->getFile().'</b> ('.$exception->getLine().')</p>';
	}
?>
</div>
</div>
</body>

