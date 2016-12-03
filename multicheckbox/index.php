<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MultiCheckbox demo</title>
	<style type="text/css">
		.buttons {
			display: block;
		}
		.buttons input {
			margin: 10px 5px;
			padding: 5px;
			border-radius: 4px;
			border: 1px #888 solid;
		}
	</style>
	<link rel="stylesheet" href="jquery.multicheckbox.css" type="text/css" />
	<script src="jquery.js" type="text/javascript"></script>
	<script src="jquery.multicheckbox.js" type="text/javascript"></script>
</head>


<body>
<?php

if (count($_POST) > 0) {
	echo '<pre>POST DATA: '.print_r($_POST, 1).'</pre>';
}

function selected($value) {
	if (isset($_POST['selector']) && in_array($value, $_POST['selector'])) {
		echo ' selected="selected"';
	}
}

?>
<br />

<form action="index.php" method="post">
<select name="selector[]" multiple="multiple" style="width: 300px; height: 200px;">
	<option value="1"<?php selected(1); ?>>some cool value 1</option>
	<option value="2"<?php selected(2); ?>>some cool value 2</option>
	<option value="3"<?php selected(3); ?>>some cool value 3</option>
	<option value="4"<?php selected(4); ?>>some cool value 4</option>
	<option value="5"<?php selected(5); ?>>some cool value 5</option>
	<option value="6"<?php selected(6); ?>>some cool value 6</option>
	<option value="7"<?php selected(7); ?>>some cool value 7</option>
</select>

<span class="buttons">
<input type="button" onclick="$('select').multiCheckbox();" value="apply plugin" />
<input type="submit" value="submit form" />
</span>

<i>click <b>&quot;apply plugin&quot;</b> to install plugin at the &lt;select&gt;</i><br />
<i>submit form to see, what really comes to server</i>

</form>
</body>

</html>