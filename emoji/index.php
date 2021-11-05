<html>
	<head>
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
		<title>选择emoji</title>
		
		<style>
             .header {
             	 height:100%;
             	 padding: 150px;
                 text-align: center;
                 background: #1abc9c;
                 color: white;
             }

            .header h1 {
                 font-size: 40px;
                 
             }
             .header select{
                 border: none;
                 outline: none;
                 width: 40%;
                 height: 40px;
                 line-height: 40px;
                 appearance: none;
                 -webkit-appearance: none;
                 -moz-appearance: none;
                 padding-left: 20px;
                 text-align: center;
                 text-align-last: center;
             }
  
  
             @media screen and (max-width: 700px) {
                 .row {   
                     flex-direction: column;
                 }
             }
 
             
.row {  
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap; 
    flex-wrap: wrap;
}
             
             
.submit_btn { 
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
.submit_btn:hover { 
	background: #bbc0c1;
	transition: background-position 1s;

		</style>
		<?php
			$con = mysqli_connect("idoknow.top","smro","qwertyui");
            if (!$con)
            {
                echo '无法连接到数据库.<br />';
            }
			
            // some code
            mysqli_select_db($con,"stumap");
            $result=mysqli_query($con,"SELECT s.id id,s.class,s.name name FROM students s
            ORDER BY s.class");
            $json="{\"students\":[";
            while($row=mysqli_fetch_array($result,MYSQLI_BOTH))
            {
            	//echo $row['id'] . "\t" . $row['name'] . "\t" . $row['scname'] . "\t" . $row['area'];
            	$json.="{\"id\":\"".$row['id']."\",\"cl\":\"".$row['class']."\",\"na\":\"".$row['name']."\"},";
            }
            $json.="{\"id\":\"-1\",\"sc\":\"\",\"cl\":\"-1\",\"na\":\"\",\"lo\":\"0.0\",\"la\":\"0.0\"}]}";
            echo "<script>var json=\"".str_replace("\"","\\\"",$json)."\"</script>";
            mysqli_close($con);
            
            echo "<script>var emojis=\"".str_replace("\n","\\n",file_get_contents("emojiList.txt"))."\"</script>"
		?>
						    	<div style="display:none">
    		<script type="text/javascript">document.write(unescape("%3Cspan id='cnzz_stat_icon_1280163383'%3E%3C/span%3E%3Cscript src='https://v1.cnzz.com/z_stat.php%3Fid%3D1280163383%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
    		</div>

	</head>
	<body>

		<div class="header">
		
		<form id="input_form" action="setEmoji.php" method="post">
			
						<h1>
				选择一个你喜欢的Emoji😊
			</h1>
			
			
			<select type="text" id="input_emoji" name="emojiInput">
				
			</select>
			
			<br/>
			
			<h1>
				你的名字。
			</h1>
			
			<select type="text" id="select_name" name="nameInput">
			
				
			</select>
			
			<br/>
			<br/>
			<br/>
			<br/>
			<br/>
		
			
			<input type="submit" class="submit_btn" onclick="onSubmitEmojiSetting()">
			
			<script>
				var selectContent="<option value='0'>请选择姓名</option>";
            	var dd=JSON.parse(json)
				console.log("filling out select.")
				var currentClass=0;
				for(i=0;i<dd.students.length-1;i++){
					if(currentClass==0||dd.students[i].cl!=currentClass){
						if(currentClass!=0){//不是首个班级
							selectContent+="</optgroup>"
						}
						selectContent+="<optgroup label=\"----"+dd.students[i].cl+"----\">"
						currentClass=dd.students[i].cl
					}
					selectContent+="<option value=\""+dd.students[i].id+"\">"+dd.students[i].na+"</option>"
				}
				selectContent+="</optgroup>"
				document.getElementById("select_name").innerHTML=selectContent
				
				console.log("filling out emojilist.")
				var emjLines=emojis.split("\n")
				var emjSelectContent="<option value=\"0\">0 我想要随机的！</option>";
				for(i=0;i<emjLines.length;i++){
					emjSelectContent+="<option value=\""+emjLines[i].split(" ")[0]+"\">"+emjLines[i]+"</option>"
				}
				document.getElementById("input_emoji").innerHTML=emjSelectContent
				
				function onSubmitEmojiSetting(){
					_czc.push(["_trackEvent","设置","Emoji","-"+document.getElementById("select_name").value,"-"+document.getElementById("input_emoji").value])
				}
			</script>
		</form>
		</div>
	</body>
</html>