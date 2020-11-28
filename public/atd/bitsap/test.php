<?php

?>

<!DOCTYPE html>
<html>
<head>
	<title>Testing</title>
</head>
<body>
	<script type="text/javascript">
		function fun()
		{
			var x = document.getElementById("t1").value;
			document.getElementById("q").innerHTML = JSON.parse(JSON.stringify(x));

		}
	</script>
	<p>
		<textarea id="t1" placeholder="I/P here"></textarea>
	</p>

	<p>
		<textarea id="t2" placeholder="O/P here"></textarea>
	</p>

	<p>
		<button onclick="fun()">Check</button>
	</p>

	<pre>
		<div id="q"></div>
	</pre>

</body>
</html>