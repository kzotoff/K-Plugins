<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MultiCheckbox demo</title>
	<script src="../jquery.js" type="text/javascript"></script>
	<script src="jquery.multicheckbox.js" type="text/javascript"></script>
	<link rel="stylesheet" href="jquery.multicheckbox.css" type="text/css" />
	<link rel="stylesheet" href="../css.css" />
</head>

<body>
<?php

if (count($_POST) > 0) {
	echo '<pre>INCOMING POST DATA: '.print_r($_POST, 1).'</pre><br />';
}

function selected($value) {
	if (isset($_POST['selector']) && in_array($value, $_POST['selector'])) {
		echo ' selected="selected"';
	}
}

?>

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
	<span class="buttons" style="display: block;">
		<input class="button" type="button" onclick="$('select').multiCheckbox();" value="apply plugin" />
		<input class="button" type="submit" value="submit form" />
	</span>
</form>

<p>click <b>&quot;apply plugin&quot;</b> to install plugin</p>
<p>submit form to see what will be posted</p>
<p>code: <code>$('[name=&quot;selector[]&quot;]').multiCheckbox();</code></p>
<p><a href="..">back to list</a></p>
</body>

</html>