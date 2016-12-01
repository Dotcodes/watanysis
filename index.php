<?php
$target_dir = "txt/";
if(isset($_POST["submit"])) {
if ($_FILES['file']['type'] == 'text/plain'){
		$name= rand(158757363,4574463569683).rand(573948544,56888768766).".txt";
		session_start();
		$_SESSION['name']= $name;
		move_uploaded_file($_FILES['file']['tmp_name'], 'txt/' . $name);
		$db= new PDO ('sqlite:watansys.db');
$sql = "select * from `count`";
$result = $db->query($sql);
	foreach($result as $row){
	 $data = $row['data'] +1;
	$sql = "UPDATE `count` SET `data`='$data' WHERE `id`='1'";
			$db->exec($sql);
	}


		header("Location:analysis.php");
}
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>WatAnsys WhatsApp Group Messages Analyiser</title>

		<meta property="og:type" content="website" /> 
		<meta property="og:site_name" content="WatAnsys" />
		<meta property="og:title" content="WatAnsys WhatsApp Group message Analyiser" />
		<meta property="og:description" content="WatAnsys helps to analysis your whatsapp group chat." /> 
		<meta property="og:image" content="http://watansys.pixub.com/step3.jpeg" />
		<meta property="og:url" content="http://watansys.pixub.com/step3.jpeg" />

		<meta name="twitter:card" content="summary_large_image">
		<meta name="twitter:site" content="@naveenda007">
		<meta name="twitter:title" content="WatAnsys WhatsApp Group message Analyiser">
		<meta name="twitter:description" content="WatAnsys helps to analysis your whatsapp group chat.">
		<meta name="twitter:image" content="http://watansys.pixub.com/step3.jpeg">
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
	<link href="https://fonts.googleapis.com/css?family=Russo+One" rel="stylesheet">    
	

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<style>
body{
	overflow-x:hidden;
background-image: url("whats-bg.jpg");
	}	

.parallax { 
    background-image: url("bg.jpg");
    
    height: 350px; 
    background-attachment: fixed;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
h1{
	font-family: 'Russo One', sans-serif;
	z-index:12;
	color:#eee;
	position:absolute;
	top:150px;
	margin-left:18%;
	vertical-align:middle;
	}
.parallax::before{
  background: linear-gradient(141deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);
    background: -webkit-linear-gradient(141deg, #0fb8ad 0%, #1fc8db 51%, #2cb5e8 75%);

  filter: alpha(opacity=50); 
  opacity: 0.5;
  content: '';
  display: block;
  height: 350px;
  position: absolute;
  width: 100%;
  z-index:1;
}
	
	.border{
	background:#fff;
	padding: 1em 0;
	margin-right:4;
	border-top: 10px solid #E4E4E4;
	border-bottom:2px solid #A4A4A4;
	text-align:center;
	border-right:2px solid #E4E4E4;
	}
	
	h3.border{
	color:#626262;
	font-size:2em;
	font-weight:bolder;
	letter-spacing:-3px;
	}
	.border h3 span{
	
	color:#626262;
	font-weight:600;
	}

	.line{
	width:20%;
	display:block;
	min-height:112px;
	margin-left:12px;
	float:left;
	border-right:1px solid #E4E4E4;
	}

@media only screen and (max-width : 768px){   
input{
margin-top:3em;
}
.upload-btn{
margin-top:3em;
	float:none;
}h1{
top:16px;
margin-left:32px;
}
}
.line {

    align-items: center;
    display: flex;
}
.line > i {
font-size:225%;
    width: 100%;
    text-align: center;
    vertical-align: middle;
}
.upload{
	background:white;
	padding: 1em ;
	margin-right:4;
	border-top: 10px solid #E4E4E4;
	border-bottom:2px solid #A4A4A4;
	text-align:center;
	border-right:2px solid #E4E4E4;
}
.well{
margin:3em 2.5em;
	padding:2em;
	background:#F6F5F5;
	border-top:1px solid #EFEFEF;
	border-right:1px solid #EFEFEF;
	border-bottom:1px solid #EFEFEF;
	border-left:5px solid #00bfa5;text-shadow:none;
}
.well h3{
	color:#5B5B5B;
	font-size: 14px;
	margin: 0;
	text-transform: uppercase;
	font-weight: 600;
	float:left;
}
.upload-btn{
	float:right;
	margin-top:-5em;
}
.btn{
background:#00bfa5;
color:#fff;
}
.btn:hover{
color:#fff;
}
#count::first-letter{
background:red;
color:red;
}
#count:nth-letter(3){
color:red;
letter-spacing:3px;
}
</style>
	
  </head>
  <body>
<div class="parallax">
<h1><strong>WatAnsys</strong> - A simple analysis tool for analysis your whatsapp group</h1>
</div>

<div class="container" > 
<p>&nbsp;</p>
<div class="upload">
<div class="well">
<h3>Upload your whatsapp's group chat history txt file </h3><br><br>
				<form method="post" enctype="multipart/form-data">
				<input type="file" name="file" required>
				
			<button type="submit" class="btn pull-right " name="submit">Upload</button></form>
			<br><br>
			</div>
			
				
</div>
	
<div class="row" style="     background: #fff; border-top: 10px solid #E5E5E5; padding:12px; font-style: normal;margin: 1em 0;border-bottom: 3px solid #AAAAAA;">
<h2 style="font-family: 'Russo One', sans-serif; text-align:center;">How to Get chat history.txt file</h2>
<p>&nbsp;</p>
<div class="col-md-4"><h3>Step 1</h3><hr>
<img src="step1.jpeg" style="width:235px; border:1px solid black;"><br><br>
<p>Open a chat and click on the <b>menu button</b> at the top right. Then select More, choose <b>Email</b> chat and click <b>WITHOUT MEDIA</b>.</p>
</div>
<div class="col-md-4"><h3>Step 2</h3><hr>
<img src="step2.jpeg" style="width:235px; border:1px solid black;"><br></br>
<p>Send the email to <b>your mail</b> then goto send itmes <b>download</b> the chat-history.txt file</p>

</div>
<div class="col-md-4"><h3>Step 3</h3><hr>
<img src="step3.jpeg" class="img img-responsive" style="width:435px; height:225px; border:1px solid black;"><br><br><br>
Ater getting the chat-history.txt file upload that file in this site. All are done you get a power full analysis report of about yor group.
</div>
</div>

<div style="background:#fff; padding:12px;"><h2 style="font-family: 'Russo One', sans-serif; text-align:center;">What data WatAnsys is provided?<h2></div>

<div class="row">
<p>&nbsp;</p>
<div class="col-md-3 border"><span class="line"><i class="fa fa-calendar"></i></span><h3>TIME<span>SPAN</span></h3><p>How long the chat is did.(From data  to To date ).</p></div>
<div class="col-md-3 border"><span class="line"><i class="fa fa-chain-broken"></i></span><h3>GROUP <span>LEFT</span></h3><p>How many group members are left in this time span</p></div>
<div class="col-md-3 border"><span class="line"><i class="fa fa-history"></i></span><h3>TIME<span> LINE<span></h3><p>Date and how many messages are send in a graph form.</p></div>
<div class="col-md-3 border" style="border-left:none;"><span class="line"><i class="fa fa-users"></i></span><h3>GROUP <span>INVITIES</span></h3><p>How many members joint via group invited link<br></p></div>
</div><div class="row">
<div class="col-md-3 border"><span class="line"><i class="fa fa-bar-chart"></i></span><h3>TOP <span>DAYS</span></h3><p>The most active Days (according to the number of messages) </p></div>
<div class="col-md-3 border"><span class="line"><i class="fa fa-signal"></i></span><h3><small>MOST USED</small> <span>WORD.</span></h3><p>The most used words in this group (English only) </p></div>
<div class="col-md-3 border"><span class="line"><i class="fa fa-file"></i></span><h3>GROUP <span>FILES.</span></h3><p>How many files are sended in this group. </p></div>
<div class="col-md-3 border"><span class="line"><i class="fa fa-list-alt"></i></span><h3>TOTAL <span>NUMBERS.</span></h3><p>Days you are chatting, message count, word count</p></div>
</div>

<br><br>
<div style="background:#fff; padding:12px;"><h2 style="font-family: 'Russo One', sans-serif; text-align:center;">WatAnsys has analysis Done<h2>
<center><span id="count">5465364</span>
</center>
</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script> 
<script src="jquery.counterup.min.js"></script> 

<script>
$(document).ready(function () {
	/*
	$.ajax({
		type: "POST",
		url: "count.php",
		success: function(data){
			$("#count").html(data);
		}
		});
		});
		*/
</script>
<script>
    jQuery(document).ready(function( $ ) {
        $('#count').counterUp({
            delay: 10,
            time: 1000
        });
    });
</script>

<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
</body>
</html>