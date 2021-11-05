<html>
	<head>
		<title>TestComponentsWithPHP</title>
	</head>
	<body>
		<?php
		function action(){
			echo "fuck";
		}
		?>
		<label id="testLabel" onclick="document.write('<?php action();?>')">hhhhhhhhhhh</label>
	</body>
</html>