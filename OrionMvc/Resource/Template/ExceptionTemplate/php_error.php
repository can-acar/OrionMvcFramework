<div style="border:1px solid #990000;padding:10px 20px;margin:10px;font: 13px verdana;">

<b style="color: #990000"><?php echo $error; ?></b>
<p><?php echo $message; ?></p>


<?php if(!empty($line_info)) {
	print '<p>'. $line_info. '</p>';
}
?>


<?php if(!empty($trace)) { ?>
	<div style="    background: none repeat scroll 0 0 #EBF2FA;
    border: 1px solid #BEDBEB;
    list-style: none inside none;
    padding: 10px;">
	<b>Script History:</b><ul>

	<?php
	foreach($trace as $line) {
		print '<li>'. $line[0];
		//If there are also arguments
		if($line[1]) {
			print '<i>Parameters:</i><ul>';
			foreach($line[1] as $args) {
				print '<li>'. $args. '</li>';
			}
			print '</ul>';
		}
		print '</li>';
	}
	?>

	</ul>
	</div>
<?php } ?>



</div>