<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        <style>
        	
        	.set_callback{
        		text-align: center;
        		color: #fff;
        		padding: 80px;
        		
        	}
        	
        	body{
                 background: #A50000;
        	}
        	
        	.btn {
        		
	width: 270px; 
	height: 40px; 
	border-width: 0px; 
	border-radius: 3px; 
	background: #c3cccb; 
	cursor: pointer;
	outline: none; 
	font-family: Microsoft YaHei; 
	color: #000;
	font-size: 17px;
}
.btn:hover { 
	background: #bbc0c1;
	transition: background-position 1s;
        </style>
	</head>
	<body>
	<?php if ($_POST["nameInput"]==0): ?>
		<h1 class = 'set_callback'>请选择姓名</h1>
	<?php else: {
		
		
	function getIp()
	{
    	if ($_SERVER["HTTP_CLIENT_IP"] && strcasecmp($_SERVER["HTTP_CLIENT_IP"], "unknown")) {
        	$ip = $_SERVER["HTTP_CLIENT_IP"];
    	} else {
        	if ($_SERVER["HTTP_X_FORWARDED_FOR"] && strcasecmp($_SERVER["HTTP_X_FORWARDED_FOR"], "unknown")) {
            $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
        	} else {
            	if ($_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], "unknown")) {
                $ip = $_SERVER["REMOTE_ADDR"];
            	} else {
                	if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],
                        "unknown")
                		) {
                    	$ip = $_SERVER['REMOTE_ADDR'];
                	} else {
                    	$ip = "unknown";
                	}
            	}
        	}
    	}
    	return ($ip);
	}
		
		if($_POST["nameInput"]==243){
			echo "<h1 class = 'set_callback'>非法操作</h1>";
			echo "<div style=\"text-align:center\" href=\"index.php\"><button onclick=\"window.location.href='index.php'\" class='btn'>返回</button></div>";
			
        	$filen="hideName.temp";
			$file_content=file_get_contents($filen);
			$file_content.=getIp()." 尝试设置qjy失败;";
			$fp0=fopen($filen,"w");
			fwrite($fp0,$file_content);
			fclose($fp0);
			return;
		}
        $con = mysqli_connect("idoknow.top","<mask>","<mask>");
        if (!$con)
        {
            echo '无法连接到数据库.<br />';
        }
        
        
        // some code
        mysqli_select_db($con,"stumap");
        //查找name
        $name="noname";
        $result=mysqli_query($con,"SELECT name FROM students WHERE id=".$_POST["nameInput"]);
        while($row=mysqli_fetch_array($result,MYSQLI_BOTH)){
        	$name=$row['name'];
        }
        $sql="UPDATE students SET hide=1 WHERE id=".$_POST["nameInput"];
        if(mysqli_query($con,$sql)){
        	echo "<h1 class = 'set_callback'>".$name."的信息已隐藏</h1>";
        	
        $filen="hideName.temp";
		$file_content=file_get_contents($filen);
		$file_content.=getIp()." ".$name.";";
		$fp0=fopen($filen,"w");
		fwrite($fp0,$file_content);
		fclose($fp0);
        }else{
        	echo "<h1 class = 'set_callback'>失败</h1>";
        }
        mysqli_close($con);
	}?>
	<?php endif; ?>
		<div style="text-align:center" href="../index.php"><button onclick="window.location.href='../index.php'" class='btn'>返回</button></div>
	</body>
</html>
