<?php
require "Cex/Cex.php";

echo "<html><head>
<title>Cex Price Grabber</title>
<link rel=\"stylesheet\" href=\"https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css\" integrity=\"sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb\" crossorigin=\"anonymous\">
<style>body{padding:10px;}</style>
</head>
<div class=\"container\">";

	$Cex = new Cex();
	$Cex->showForm();
	
	if(isset($_REQUEST['url']) && !empty($_REQUEST['url'])) {
		$results = $Cex->getPrice($_REQUEST['url']);
		
		echo "<div class=\"alert alert-info\">
			<pre>".print_r($results, true)."</pre>
		</div>";
	}
	
echo "</div>
</body></html>";
?>