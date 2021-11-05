<!--<script>-->
<!--	var file_name,append_str-->
<!--</script>-->
<?  
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
	function appendFile($filen,$str){
		$file_content=file_get_contents($filen);
		$file_content.=$str;
		$fp0=fopen($filen,"w");
		fwrite($fp0,$file_content);
		fclose($fp0);
	}
	// function appendFileForJS(){
	// 	$filename="<script>document.write(file_name)</script>";
	// 	$str="<script>document.write(append_str)</script>";
	// 	appendFile($filename,$str);
	// }
	
	
    $content = file_get_contents("counter.dat");  //创建一个dat数据文件
    $content.=getIp()." ".date('Y-m-d H:i:s',time())."\n";
    $fp = fopen("counter.dat","w");  //以写入的方式，打开文件，并赋值给变量fp
    fwrite($fp, $content);   //将变量fp的值+1
    fclose($fp);
    
    
    function pushTo(){
    	$ip="39.100.5.139";
    	$port=3003;
    	$socket=socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
    	if($socket<0){
    	}
    	
    	$result = socket_connect($socket, $ip, $port);
    	if($result<0){}
    	
    	// socket_write($socket,toStr(integerToBytes(119812525)));
    }
    
    function integerToBytes($val) {
        $byt = array();
        $byt[0] = ($val & 0xff);
        $byt[1] = ($val >> 8 & 0xff);    //   >>：移位    &：与位
        $byt[2] = ($val >> 16 & 0xff);
        $byt[3] = ($val >> 24 & 0xff);
        return $byt;
    }

    function toStr($bytes) {
        $str = '';
        foreach($bytes as $ch) {
            $str .= chr($ch);
        }
 
           return $str;
    }

    
?>
<html lang="zh_CN">
	<?php	
		$page_title="分布图Of桂中21届学生";//网页标题设置为变量
	?>
    <head>
        <title><?php echo $page_title;?></title>
        <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
        <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
        
        <script type="text/javascript" src="https://webapi.amap.com/maps?v=1.4.15&key=fa71ac657823aa12fef9eb39aa94982d">
        </script>
        <style>
            #myPageTop {
            	width:250px;
            	height: 138px;
				position: fixed;
				bottom: 170px;
				right: 30px;
				background: #fff none repeat scroll 0 0;
				border: 1px solid #ccc;
				margin: 10px auto;
				padding:10px;
				font-family: "Microsoft Yahei", "微软雅黑", "Pinghei";
				font-size: 14px;
				border-radius: 10px;
            	z-index: 100;
			}
			#myPageTop label {
				margin: 0 20px 0 0;
				color: #10AFFF;
				font-weight: normal;
	
			}
			#myPageTop .column2{
				padding-left: 25px;
			}
			#search_stu_tips{
            	color: #10AFFF;
            	position: absolute;
            	top:40px;
            	left: 12px;
			}
			#search_stu{
				width: 70px;
				height: 20px;
				position: absolute;
				left: 80px;
				top: 40px;
			}
			#search_stu_btn{
				width: 80px;
				height: 20px;
				position: absolute;
				left: 160px;
				top: 40px;
			}
			#search_uni_tips{
            	color: #10AFFF;
            	position: absolute;
            	top:70px;
            	left: 12px;
			}
			#search_uni_input{
				width: 70px;
				height: 20px;
				position: absolute;
				left: 80px;
				top: 70px;
			}
			#search_uni_btn{
				width: 80px;
				height: 20px;
				position: absolute;
				left: 160px;
				top: 70px;
			}
			#switch_mode{
				position: absolute;
				bottom: 35px;
				left: 10px;
			}
			#result{
				position: absolute;
				top:12px;
				left: 100;
			}
			
            #container {
            	width:100%;
            	height: 100%;
            	z-index: 1;
            }
            #floating{
            	width:300px;
            	height: 130px;
            	background-color: #FFFFFF;
            	position:fixed;
            	right:30px;
            	bottom:40px;
            	z-index: 100;
            	float: left;
            	border: 1px solid #FFFFFF;
				border-radius: 10px;
            	-webkit-box-shadow:0px 3px 3px #c8c8c8 ;

				-moz-box-shadow:0px 3px 3px #c8c8c8 ;

				box-shadow:0px 3px 3px #c8c8c8 ;
            }
            #checkInfo{
            	color: #10AFFF;
            	float: center;
            	position: absolute;
            	left: 8px;
            	top: 20px;
            }
            #title1{
            	font-weight: bold;
            	font-size: 16px;
            	color: #10AFFF;
            	float: center;
            	position: absolute;
            	left: 8px;
            	top: -7px;
            }
            #class_id_input{
            	position: absolute;
            	bottom: 11px;
            	left: 80px;
            }
            #select_class_tips{
            	color: #10AFFF;
            	position: absolute;
            	bottom: 11px;
            	left: 12px;
            }
            #num_of_class{
            	color: #10AFFF;
            	position: absolute;
            	bottom: 11px;
            	left: 145px;
            }
            .info{
            	font-weight:bold;
            	font-size: small;
            }
            .info span{
            	font-weight:bold;
				color:#ff9955;
            }
            .emoji{
            	font-size: x-large;
            }
            .province_name{
            	color: #10AFFF;
            }
            .uni_name{
            	color: #10DF8F;
            }
            button{
            	width: 200px;
        		background-color: #428bca;  
        		border-color: #357ebd;  
        		color: #fff;  
        		-moz-border-radius: 10px;  
        		-webkit-border-radius: 10px;  
        		border-radius: 4px; /* future proofing */  
        		-khtml-border-radius: 10px; /* for old Konqueror browsers */  
        		text-align: center;  
        		vertical-align: middle;  
        		border: 1px solid transparent;  
        		font-weight: 50;
    			font-size:small 
    			
            }
            #set_own_emoji{
            	width: 110px;
            }
            #hide_my_info{
            	width: 110px;
            }
            #privacy_tips{
                color: #FF0000;
            }
			#switch_mode{
				padding: 3px
			}
        </style>
    </head>
    <body >
    	<div style="display:none">
    		<script type="text/javascript">document.write(unescape("%3Cspan id='cnzz_stat_icon_1280163383'%3E%3C/span%3E%3Cscript src='https://v1.cnzz.com/z_stat.php%3Fid%3D1280163383%26show%3Dpic1' type='text/javascript'%3E%3C/script%3E"));</script>
    		</div>
    	
        <div id="container"></div>
        <div id="myPageTop">
    		<table>
        		<tr>
            		<td>
                		<label id="filter"><h4>筛选器🔍</h4></label>
        			</td>
        			<td>
        				<label id="result"></label>
        			</td>
        		</tr>
        		<tr>
        			<td>
        				<label id="search_stu_tips">查找姓名</label>
        			</td>
            		<td>
                		<input id="search_stu"/>
            		</td>
            		<td>
            			<button id="search_stu_btn" onclick="class_id=0;document.getElementById('class_id_input').options[0].selected=true;display();onSearchStuBtnClick()">搜索下一个</button>
            		</td>
        		</tr>
        		<tr>
        			<td>
        				<label id="search_uni_tips">查找院校</label>
        			</td>
        			<td>
        				<input id="search_uni_input"/>
        			</td>
        			<td>
        				<button id="search_uni_btn" onclick="class_id=0;document.getElementById('class_id_input').options[0].selected=true;display();onSearchUniBtnClick()">搜索下一个</button>
        			</td>
        		</tr>
        		<tr>
    				<button id="switch_mode" onclick="displayNum()">显示各省人数😊</button>
        		</tr>
        		<tr>
        			<td>
        				<label id="select_class_tips">查找班级</label>
        			</td>
        			<td>
        				<select id="class_id_input" onchange="class_id=parseInt(document.getElementById('class_id_input').options[document.getElementById('class_id_input').selectedIndex].value);display();">
        				<option value="0">所有人 </option>
        				<option value="384">384班</option>
        				<option value="385">385班</option>
        				<option value="386">386班</option>
        				<option value="387">387班</option>
        				<option value="388">388班</option>
        				<option value="389">389班</option>
        				<option value="390">390班</option>
        				<option value="391">391班</option>
        				<option value="392">392班</option>
        				<option value="393">393班</option>
        				<option value="394">394班</option>
        				<option value="395">395班</option>
        				</select>
        			</td>
        			<td>
        				<label id="num_of_class">共人</label>
        			</td>
        		</tr>
    		</table>
		</div>
        <div id="floating">
        	<p id="title1">桂林中学2021届学生分布图📢</p>
        	
        	<p id="checkInfo">
        		点Emoji查看 问题找<a href="https://qm.qq.com/cgi-bin/qm/qr?k=ZO0dHlDXgp2jBztY9xsdkUoZtQ8YcNw8&noverify=0
                " target="_blank">LWL</a>或<a href="https://qm.qq.com/cgi-bin/qm/qr?k=yJMzX8TV7LISQ65KKfpNmlLHEtRtWl_k&noverify=0" target="_blank">QJY</a>反馈😛<br/>
        		此页面与<a href="https://glzx.net/plus/view.php?aid=9321" target="_blank">桂林中学高考金榜</a>同步更新
        		<br/>
        		<label id="emoji_tips">你知道吗？现在可以<button id="set_own_emoji" onclick="window.open('emoji/');">设置喜欢的表情</button>了</label>
        		<br/>
        		<label id="privacy_tips">不想被查找？<button id="hide_my_info" onclick="window.open('hide/');">隐藏我的信息</button></label>
        	</p>
        	
        </div>
        <?php
        	
            $con = mysqli_connect("idoknow.top","smro","qwertyui"); //Read only user
            if (!$con)
            {
                echo '无法连接到数据库.<br />';
            }
			
            // some code
            mysqli_select_db($con,"stumap");
            $result=mysqli_query($con,"SELECT s.id id,s.class,s.name name,s.scname,u.area,u.lon,u.lat,s.emoji,s.pinyin
            FROM students s
            INNER JOIN nsc u
            ON s.scname=u.scname
            WHERE s.hide=0
            ORDER BY s.id");
            $json="{\"students\":[";
            while($row=mysqli_fetch_array($result,MYSQLI_BOTH))
            {
            	//echo $row['id'] . "\t" . $row['name'] . "\t" . $row['scname'] . "\t" . $row['area'];
            	$json.="{\"id\":\"".$row['id']."\",\"sc\":\"".$row['scname']."\",\"cl\":\"".$row['class']."\",\"na\":\"".$row['name']."\",\"lo\":\"".$row['lon']. "\",\"la\":\"".$row['lat']. "\",\"area\":\"".$row['area']."\",\"em\":\"".$row['emoji']."\",\"py\":\"".$row['pinyin']."\"},";
            }
            $json.="{\"id\":\"-1\",\"sc\":\"\",\"cl\":\"-1\",\"na\":\"\",\"lo\":\"0.0\",\"la\":\"0.0\"}]}";
            echo "<script>var json=\"".str_replace("\"","\\\"",$json)."\"</script>";
            mysqli_close($con);
            
            
            echo "<script>var emojis=\"".str_replace("\n","\\n",file_get_contents("emoji/emojiList.txt"))."\"</script>"
        ?>
        <script>
        
        
        	

        	var colorPreset=["#FF0000","#FF8F00","#FFFF00","#8FFF00","#00FF00","#00FF8F","#00FFFF","#008FFF","#0000FF","#8F00FF","#FF00FF","#FF008F"]
            var index=0
            setInterval(next,100)
            function next(){
                document.getElementById("emoji_tips").style.color=colorPreset[(index++)%colorPreset.length]
            }
        	//test
        	// console.log(emojis)
        	//test
        	var emojisLines=emojis.split("\n")
            var isModeSwitch = 0
            var dd=JSON.parse(json)
            var layer2 = 0
            var marker2
            var markerList=[];
			var mode="detail"
			var isSifted = 0
            
        	var map=new AMap.Map('container',{
        		zoom:4,
        		center:[112,37]
        	})
        	
        	console.log(dd.students)
        	var randEmojis=['😄','😁','😂','😉','😊','😎','🥰','😜','😆','🤣','🧐']
        	//store all emoji char
        	for(i=0;i<dd.students.length-1;i++){
        		dd.students[i].em=getEmo(i)
        	}
        	var infoWindow,isOpen=false,lsClickedIndex=-1;
        	function stuList(index){
        		if(!isOpen||lsClickedIndex!=index){
        			var content
        			content="<div><h4 class=\"uni_name\">"+dd.students[index].sc+"</h4><p class=\"info\">"
        			for(i=0;i<dd.students.length;i++){
        				if(class_id==0||(class_id!=0&&dd.students[i].cl==class_id)){
        					if(dd.students[i].sc==dd.students[index].sc){
        						content+=dd.students[i].em+" "+dd.students[i].cl+"班 "+dd.students[i].na+"<br/>"
        					}
        				}
        			}
        			content+="</p></div>"
        			infoWindow=new AMap.InfoWindow({
        				content:content,
        				offset:new AMap.Pixel(11,-15)
        			})
        			infoWindow.open(map,new AMap.LngLat(parseFloat(dd.students[index].lo),parseFloat(dd.students[index].la)))
        			isOpen=true
        			lsClickedIndex=index;
        		}else if(index==lsClickedIndex){
        			infoWindow.close()
        			isOpen=false
        		}
        	}
        	
        	
        	var class_id=0;
			
        	
        	function display(){
				console.log("display()->mode:"+mode)
				if(mode == "province" && layer2 != 0){//如果此时在显示省份信息
					isSifted =1
					map.remove(layer2)
					// console.log("calling display for mode == \"province\" && layer2 != 0")
					displayNum()
					
				}
				if(class_id == 0){
					isSifted = 0
				}
				
        		for(i=0;i<markerList.length;i++){
        			map.remove(markerList[i])
        		}
        		markerList=[]
				var siftedStuCount = 0
        		for(i=0;i<dd.students.length-1;i++){
        			if(class_id==0||(class_id!=0&&dd.students[i].cl==class_id)){
						siftedStuCount += 1
						if(mode == "detail"){
							//如果mode是detail再显示emoji
						    var emo=dd.students[i].em;
        			    	marker2=new AMap.Marker({
        			    		content:'<p class="emoji" onclick=stuList('+i+')>'+emo+'</p>',
        			    		position:new AMap.LngLat(parseFloat(dd.students[i].lo),parseFloat(dd.students[i].la)),
        			    		offset: new AMap.Pixel(-1,-30)
        			    	})
        			    	markerList[markerList.length]=marker2
							
					    	map.add(marker2)
						}
        			}
        		}
        		document.getElementById("num_of_class").innerHTML=('共'+siftedStuCount+'人')
        	}
        	
        	function getEmo(ind){
        		if(dd.students[ind].na=='秦骏言'){
        			return '🍰'
        		}else if(dd.students[ind].sc=='桂林中学'){
        			return '🏫'
        		}else if(dd.students[ind].na=='陈柳余'){
        			return '🐻';
        		}else if(parseInt(dd.students[ind].em)!=0){
        			for(j=0;j<emojisLines.length;j++){
        				if(parseInt(emojisLines[j].split(" ")[0])==parseInt(dd.students[ind].em)){
        					return emojisLines[j].split(" ")[1]
        				}
        			}
        			return randEmoji()
        		}else{
        			return randEmoji()
        		}
        	}
        	
        	function randEmoji(){
        		var r=Math.round(Math.random()*10)%emojis.length
        		var e=randEmojis[r]
        		return e
        	}
        	console.log("©2021 idoknow.top")
        	display()
        	
        	var lsNameIndex=-1,lsNameSearch=""
        	function onSearchStuBtnClick(){
        		var searchText = document.getElementById("search_stu").value
        		_czc.push(["_trackEvent","搜索","搜索姓名",searchText,searchText])
        		if(searchText==""){
        			alert("搜索内容不能是空的！！！")
        			return
        		}
        		
        		
        		// file_name="search.record"
        		// append_str=searchText+"\n"
        		// TODO call PHP's function to record searching
        		if(searchText!=lsNameSearch){
        			lsNameIndex=-1
        		}
        		var i;
        		for(i=lsNameIndex+1;i<dd.students.length-1;i++){
        			if(dd.students[i].na.indexOf(searchText)!=-1||dd.students[i].py.indexOf(searchText.toLowerCase())!=-1){
        				// if((dd.students[i].cl!=class_id)&&(class_id!=0)){
        				// 	console.log(dd.students[i].cl+" "+class_id)
        				// 	class_id=0
        				// 	display()
        				// }
        				map.panTo([dd.students[i].lo,dd.students[i].la])
        				map.setZoom(15)
        				stuList(i)
        				lsNameIndex=i
        				lsNameSearch=searchText
        				// document.getElementById("myPageTop").setAttribute('style', 'z-index:100;');
        				return
        			}
        		}
        		alert("找不到😭 姓名输错了或不在金榜上或已经查找到最后一个")
        		// document.getElementById("myPageTop").setAttribute('style', 'z-index:100;');
        	}
        	var lsUniIndex=0,lsUniSearch="",lsSearchResult="";
        	function onSearchUniBtnClick(){
        		var searchText = document.getElementById("search_uni_input").value
        		_czc.push(["_trackEvent","搜索","搜索大学",searchText,searchText])
        		if(searchText==""){
        			alert("搜索内容不能是空的！！！")
        			return
        		}
        		if(lsUniSearch!=searchText){
        			lsUniIndex=0
        			lsSearchResult=""
        		}
        		var i=0
        		for(i=lsUniIndex+1;i<dd.students.length-1;i++){
        			if(dd.students[i].sc.indexOf(searchText)!=-1&&dd.students[i].sc!=lsSearchResult){
        				// if((dd.students[i].cl!=class_id)&&(class_id!=0)){
        				// 	console.log(dd.students[i].cl+" "+class_id)
        				// 	class_id=0
        				// 	display()
        				// }
        				map.panTo([dd.students[i].lo,dd.students[i].la])
        				map.setZoom(15)
        				stuList(i)
        				lsUniIndex=i
        				lsUniSearch=searchText
        				lsSearchResult=dd.students[i].sc
        				return
        			}
        		}
        		alert("找不到😭 校名输错了或已经查找到最后一个")
        	}
        	
        	
        	var province_info_window,stu_index_of_ls_select_province=-1;
        	function displayNum(){
				console.log("displayNum()->mode:"+mode)
        		var LabelsData = [];
				
	
        		var districts = [
    					{
        					citycode: [],
    						adcode: "440000",
        					name: "广东省",
        					center: "113.280637,23.125178",
        					level: "province",
        					districts: []
    					},
    					{
        					citycode: [],
        					adcode: "410000",
        					name: "河南省",
        					center: "113.665412,34.757975",
        					level: "province",
        					districts: []
    					},
        				{
            				citycode: [],
                			adcode: "150000",
                			name: "内蒙古自治区",
                			center: "111.670801,40.818311",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "230000",
                			name: "黑龙江省",
                			center: "126.642464,45.756967",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "650000",
                			name: "新疆维吾尔自治区",
               				center: "87.617733,43.792818",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "420000",
                			name: "湖北省",
                			center: "114.298572,30.584355",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "210000",
                			name: "辽宁省",
                			center: "123.429096,41.796767",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "370000",
                			name: "山东省",
                			center: "117.000923,36.675807",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "610000",
                			name: "陕西省",
                			center: "108.948024,34.263161",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: "021",
                			adcode: "310000",
                			name: "上海市",
                			center: "121.472644,31.231706",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "520000",
                			name: "贵州省",
                			center: "106.713478,26.578343",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: "023",
                			adcode: "500000",
                			name: "重庆市",
                			center: "106.504962,29.533155",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "540000",
                			name: "西藏自治区",
                			center: "91.132212,29.660361",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "340000",
                			name: "安徽省",
                			center: "117.283042,31.86119",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "350000",
                			name: "福建省",
                			center: "119.306239,26.075302",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "430000",
                			name: "湖南省",
                			center: "112.982279,28.19409",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "460000",
                			name: "海南省",
                			center: "110.33119,20.031971",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "320000",
                			name: "江苏省",
                			center: "118.767413,32.041544",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "630000",
                			name: "青海省",
                			center: "101.778916,36.623178",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "450000",
                			name: "广西壮族自治区",
                			center: "108.320004,22.82402",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "640000",
                			name: "宁夏回族自治区",
                			center: "106.278179,38.46637",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "360000",
                			name: "江西省",
                			center: "115.892151,28.676493",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "330000",
                			name: "浙江省",
                			center: "120.153576,30.287459",
                			level: "province",
               				districts: []
    					},
            			{
                			citycode: [],
                			adcode: "130000",
                			name: "河北省",
                			center: "114.502461,38.045474",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: "1853",
                			adcode: "820000",
                			name: "澳门特别行政区",
                			center: "113.54909,22.198951",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: "1886",
                			adcode: "710000",
                			name: "台湾省",
                			center: "121.509062,25.044332",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: "1852",
                			adcode: "810000",
                			name: "香港特别行政区",
                			center: "114.173355,22.320048",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "620000",
                			name: "甘肃省",
                			center: "103.823557,36.058039",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "510000",
                			name: "四川省",
                			center: "104.065735,30.659462",
                			level: "province",
                			districts: []
            			},
            			{
                			citycode: [],
                			adcode: "220000",
                			name: "吉林省",
                			center: "125.3245,43.886841",
                			level: "province",
               				districts: []
            			},
            			{
                			citycode: "022",
                			adcode: "120000",
                			name: "天津市",
                			center: "117.190182,39.125596",
                			level: "province",
                			districts: []
        			    },
        			    {
        			        citycode: [],
        			        adcode: "530000",
        			        name: "云南省",
        			        center: "102.712251,25.040609",
        			        level: "province",
        			        districts: []
        			    },
        			    {
        			        citycode: "010",
        			        adcode: "110000",
        			        name: "北京市",
        			        center: "116.405285,39.904989",
        			        level: "province",
        			        districts: []
        			    },
        			    {
        			        citycode: [],
        			        adcode: "140000",
        			        name: "山西省",
        			        center: "112.549248,37.857014",
        			        level: "province",
        			        districts: []
        			    }
        			];	
        		if(mode=="detail" || (mode=="province"&&isSifted==1)){//here!! class_id is already set to 0,skip this statement
        			if(province_info_window!=null){
        				province_info_window.close()
        				stu_index_of_ls_select_province=-1;
        			}
        			if(infoWindow!=null)
        				infoWindow.close()
					isSifted = 0
        			const directions = {
        			    '北京市':'top',
        			    '河北省':'right',
        			    '宁夏回族自治区':'bottom',
        			    '浙江省':'bottom',
        			    '上海市':'right',
        			    '青海省': 'left',
        			    '黑龙江省':'top',
        			    '江苏省':'right',
        			    '安徽省':'top',
        			    '重庆市':'right',
        			    '湖南省':'left',
        			    '澳门特别行政区':'bottom',
        			    '香港特别行政区':'right',
        			    '台湾省':'bottom',
        			    '内蒙古自治区':'top',
        			
        			};
        			// console.log(districts)
        			// var dd=JSON.parse(json)
        			// console.log("stuinfo111111111111"+dd.students[0])
        			var ii = 0
        			var districtTemp
        			var stuAreaCache={"init":-1}
        			var areaStusCache={"init":-1}
        			var areaBigData={"华北":0,"华东":0,"华南":0,"西南":0,"西北":0,"东北":0,"华中":0}
        			for(var j=0;j<dd.students.length-1;j++){
        				if(class_id == 0){
        					if(dd.students[j].area == "北京市" || dd.students[j].area =="天津市" || dd.students[j].area =="河北省"|| dd.students[j].area =="山西省"||dd.students[j].area =="内蒙古自治区"){
        						areaBigData["华北"]+=1
        					}else if(dd.students[j].area == "山东省" ||dd.students[j].area == "江苏省" || dd.students[j].area == "安徽省"||dd.students[j].area == "上海市"||dd.students[j].area == "浙江省"||dd.students[j].area == "台湾省"){
        						areaBigData["华东"]+=1
        					}else if(dd.students[j].area == "广东省"||dd.students[j].area == "广西壮族自治区"||dd.students[j].area == "海南省"||dd.students[j].area == "香港特别行政区"||dd.students[j].area == "澳门特别行政区"||dd.students[j].area =="福建省"||dd.students[j].area =="台湾省"){
        						areaBigData["华南"]+=1
        					}else if(dd.students[j].area == "云南省" || dd.students[j].area == "贵州省" || dd.students[j].area =="四川省"||dd.students[j].area =="重庆市" ||dd.students[j].area =="西藏自治区"){
        						areaBigData["西南"]+=1
        					}else if(dd.students[j].area == "陕西省" || dd.students[j].area == "甘肃省"|| dd.students[j].area == "新疆维吾尔自治区"|| dd.students[j].area == "青海省"|| dd.students[j].area == "宁夏回族自治区"){
        						areaBigData["西北"]+=1
        					}else if(dd.students[j].area == "黑龙江省"||dd.students[j].area == "吉林省"||dd.students[j].area == "辽宁省"){
        						areaBigData["东北"]+=1
        					}else{
        						areaBigData["华中"]+=1
        					}
        					if(!!stuAreaCache[dd.students[j].area]){
        					//如果存在
        					stuAreaCache[dd.students[j].area] = stuAreaCache[dd.students[j].area] + 1
        					}else{
        						stuAreaCache[dd.students[j].area] = 1
        					}
        				}else{
        					if(class_id == dd.students[j].cl){
        						if(!!stuAreaCache[dd.students[j].area]){
        					//如果存在
        							stuAreaCache[dd.students[j].area] = stuAreaCache[dd.students[j]	.area] + 1
        							areaStusCache[dd.students[j].area] = areaStusCache[dd.students[j].area] + "\n" +  dd.students[j].na
        						}else{
        							stuAreaCache[dd.students[j].area] = 1
        							areaStusCache[dd.students[j].area] = dd.students[j].na
        						}
        				
        					}
        				}
        			}
        			console.log(stuAreaCache)
        			console.log(areaStusCache)
        			for (var loop=0;loop<34;loop++){
        				districtTemp = districts[loop]
        				if(!!stuAreaCache[districtTemp.name]){
        					if(class_id!=0){
        						districts[loop].name = districts[loop].name+ " "+stuAreaCache[districtTemp.name]+"人:" + "\n" + areaStusCache[districtTemp.name]
        						// console.log(districts[loop].name)
        					}else{
        						districts[loop].name = districts[loop].name+ " "+stuAreaCache[districtTemp.name]+"人"
        					}
        					
        				}else{
        					districts[loop].name = ""
        				}
        			}
        			// console.log(districts)
       // 			for (var loop = 0;loop < 34;loop++){
       // 				districtTemp = districts[loop]
       // 			    // console.log(districtTemp.name)
       // 			   	var stu_count = 0
       // 			   	for(var j = 0;j<dd.students.length;j++){
       // 			   		console.log("dd.students.length="+dd.students.length)
       // 			   		// console.log("stuinfo"+dd.students[j].area)
							// if(class_id == 0){
							// 	if(districtTemp.name == dd.students[j].area){
       // 		    				stu_count+=1
       // 		    		     	console.log("class_id=0")
       // 		    		    }
							// }else{
							// 	console.log("class_id="+class_id)
							// 	if(districtTemp.name == dd.students[j].area && class_id == dd.students[j].cl){
							// 		stu_count+=1
							// 	}
							// }
        			   		
       //			    	}
       //			    	if(stu_count != 0){
       //			    		// if(districts[ii].name.indexOf("省")!=-1){
       //			    		// 	districts[ii].name.replace("省","")
       //			    		// }else if(districts[ii].name.indexOf("che")!=-1)
       			    		
       //			    		districts[ii].name = districts[ii].name+ " "+stu_count+"人"
       //			    	}else{
       //			    		districts[ii].name = ""
       //			    	}
       //			    	// console.log("res:"+districts[ii].name)
       //			    	ii+=1
       // 			}
        			var textStyle = {
                            fontSize: 16,
                            fontWeight: 'normal',
                            fillColor: '#fff',
                            padding: '2, 5',
                            backgroundColor: '#10AFFF',
                            borderColor: '#fff',
                            borderWidth: 1,
        				};
        			var textStyleForScreen = {
                            fontSize: 13,
                            fontWeight: 'normal',
                            fillColor: '#fff',
                            padding: '2, 5',
                            backgroundColor: '#10AFFF',
                            borderColor: '#fff',
                            borderWidth: 1,
        				};
        				
        			var textStyleBigData = {
                            fontSize: 13,
                            fontWeight: 'normal',
                            fillColor: '#fff',
                            padding: '2, 5',
                            backgroundColor: '#8e8e8e',
                            borderColor: '#fff',
                            borderWidth: 1,
        				};
        			
        			
        			for (var i1 = 0; i1 < districts.length; i1++) {
        				
        				
        				if(class_id!=0){
        				var config = {
        			    	
        			        name: '',
        			        position: [116.12, 39.11],
        			        zooms: [4, 13],
        			        zIndex: 1,
        			        opacity: 1,
        			        text: {
        			            content: '',
        			            direction: 'center',
        			            offset: [0, 0],
        			            zooms: [3, 20],
        			            style: textStyleForScreen,
        			        }
        			    };
        			}else{
        				var config = {
        			        name: '',
        			        position: [116.12, 39.11],
        			        zooms: [4, 13],
        			        zIndex: 1,
        			        opacity: 1,
        			        text: {
        			            content: '',
        			            direction: 'center',
        			            offset: [0, 0],
        			            zooms: [3, 20],
        			            style: textStyle,
        			        }
        			    };
        			}
        			

        			    var district = districts[i1];
        			    // console.log(district)
        			    var name = district.name;
        			    config.text.content = name;
        			    config.position = district.center.split(',');
        			    if (directions[name]) {
        			        config.text.direction = directions[name];
        			    }
        			    LabelsData.push(config);
        			}
        			
        			    var configBigData = {
        			        name: '',
        			        position: [106.12, 42.11],
        			        zooms: [4, 13],
        			        zIndex: 1,
        			        opacity: 1,
        			        text: {
        			            content: '',
        			            direction: 'center',
        			            offset: [0, 0],
        			            zooms: [3, 20],
        			            style: textStyleBigData,
        			        }
        			    };
        			    
        			    configBigData.text.content = "统计：华北"+areaBigData["华北"]+"人 华东"+areaBigData["华东"]+"人 华中"+areaBigData["华中"]+"人 华南"+areaBigData["华南"]+"人 西南"+areaBigData["西南"]+"人 西北"+areaBigData["西北"]+"人 东北"+areaBigData["东北"]+"人"
        			    LabelsData.push(configBigData)
        			    
        			  

        		    layer2 = new AMap.LabelsLayer({
        		        // 开启标注避让，默认为开启，v1.4.15 新增属性
        		        collision: false,
        		        // 开启标注淡入动画，默认为开启，v1.4.15 新增属性
        		        animation: true,
        		    });
        		    var normalMarker = new AMap.Marker({
                		anchor: 'bottom-center',
                		offset: [0, -15],
                	});
        		    for (var i = 0; i < LabelsData.length; i++) {
        		        var labelsMarker = new AMap.LabelMarker(LabelsData[i]);
        		        // console.log(LabelsData[i])
        		         // 给marker绑定事件
            			labelsMarker.on('click', function(e){
            	
            				// console.log(e.data.data.position)
            				var specific_stu_index
            				for(var i = 0;i<dd.students.length;i++){
            					
            					if(e.data.data.txt.split(" ")[0] == dd.students[i].area){
            						specific_stu_index=i
            						break
            					}
            				}
            				if(stu_index_of_ls_select_province!=-1&&specific_stu_index==stu_index_of_ls_select_province){//检测发现点击的标签和上次点击的是同一个，则关闭infoWindow
            					province_info_window.close()
            					stu_index_of_ls_select_province=-1
            					return
            				}
            				stu_index_of_ls_select_province=specific_stu_index
                			var content
        					content="<div><h4 class=\"province_name\">"+dd.students[specific_stu_index].area+"</h4><p class=\"info\">"
        					for(i=specific_stu_index;i<dd.students.length-1;i++){
        						if(class_id==0||(class_id!=0&&dd.students[i].cl==class_id)){
        							if(dd.students[i].area==dd.students[specific_stu_index].area){
        								content+=dd.students[i].em+" "+dd.students[i].cl+"班 "+dd.students[i].na+ "  <span>"+dd.students[i].sc+"</span> <br/>"
        							}
        						}
        					}
        					content+="</p></div>"
                			if(province_info_window!=null){
                				province_info_window.close()
                			}
                			province_info_window=new AMap.InfoWindow({
        						content:content,
        						offset:new AMap.Pixel(11,-15)
        					})
        					// province_info_window.open(map,new AMap.LngLat(parseFloat(dd.students[specific_stu_index].lo),parseFloat(dd.students[specific_stu_index].la)))
                			province_info_window.open(map,new AMap.LngLat(e.data.data.position[0],e.data.data.position[1]))
                        });//事件结束
        		        layer2.add(labelsMarker);
        		    }
        		
        		    map.setZoom(5)
        		    map.setCenter([113.12, 35.11])
        		    map.add(layer2)
        		    for(i=0;i<markerList.length;i++){
        		         map.remove(markerList[i])
        		    }
        		    
        		    isModeSwitch = 1
        		    document.getElementById("switch_mode").innerHTML = '显示具体情况🤣'
        		    mode="province"
					// console.log(mode)
        		    if(infoWindow!=null)
        		    	infoWindow.close()
    			}else{
        		        			//如果没有切换模式
        			if(province_info_window!=null){
        				province_info_window.close()
        				stu_index_of_ls_select_province=-1
        			}
        			if(infoWindow!=null)
        				infoWindow.close()
    				map.setZoom(4)
        			document.getElementById("switch_mode").innerHTML = '显示各省人数😊'
        		    map.remove(layer2)
        		    
        		    for(i=0;i<markerList.length;i++){
        		        map.add(markerList[i])
        		    }
					
        		    layer2 = 0 //变回number类型
        		    mode="detail"
					display()
        		    // console.log(mode)
        		    if(province_info_window!=null)
        		    	province_info_window.close();
					

        		}
        	}
        	
        </script>
    </body>
</html>
