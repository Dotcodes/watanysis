<?php
session_start();
if(!$_SESSION['name']){
	header("location:index.php");
}else{
	$file_name = $_SESSION['name'];
}
?>
<?php
$file = fopen("txt/$file_name","r");
$raw_file = '';
while(! feof($file))
  {
  $raw_file .= fgets($file);
  }

fclose($file);

function clean($string) {
   $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
   $string = preg_replace('/[^A-Za-z\-]/', '', $string); // Removes special chars.
   $string = preg_replace('/pm/', '', $string); // Removes am.
   return preg_replace('/am/', '', $string); // Removes pm.

   
}

$raw_file =  addslashes(htmlspecialchars($raw_file));

$raw_text= strtolower(trim($raw_file));

$new_text = clean($raw_text) ;

$raw_array = explode("-",$new_text);

$filter_array = array_filter($raw_array);

$array_count = array_count_values($filter_array);

arsort($array_count);

$top_ten_words = array_slice($array_count, 0, 10, true);


$date = '';

$total_words = strlen( str_replace('-', '', $new_text) ); 

$re = '/(\d\d\/\d\d\/\d\d\,\s\d:\d\d\s[A-z]{2})/';
preg_match_all($re, $raw_file, $matches);
$matches[0];

$staring_time = date('d-M-Y h:i A', strtotime($matches[0][0] ));

$end_time =  date('d-M-Y h:i A', strtotime(end($matches[0])));

$group_link = substr_count($raw_file,'joined using this group');

$group_left = substr_count($raw_file,'left');

$media = substr_count($raw_file,'&lt;Media omitted&gt;');

$Location = substr_count($raw_file,'location:');



$total_msg = count($matches[0]);

$total_text_msg = $total_msg-($media + $Location) ;

$count= 0;
foreach($matches[0] as $match){
$i = $count++;
$php_time_array[$i] = date('d-M-y', strtotime($match));
}


$counts = array_count_values($php_time_array);

$json = json_encode($counts);
function graph_json($json){
$json = preg_replace('/\"(.*?)\":(.*?),/',"['$1',$2],",$json);
$json = preg_replace('/\"(.*?)\":(.*?)}/',"['$1',$2]",$json);
return $json = preg_replace('/{/',"",$json);
}
$json = graph_json( $json) ;
$total_number_of_days = count($counts);

arsort($counts);
reset($counts);
$Top_most_days = date('d-M-Y', strtotime(key($counts)));




?> 
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>WatAnsys WhatsApp Group Messages Analyiser</title>
    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
<link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
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
.buy{
	margin:3em 2.5em;
	padding:2em;
	background:#F6F5F5;
	border-top:1px solid #EFEFEF;
	border-right:1px solid #EFEFEF;
	border-bottom:1px solid #EFEFEF;
	border-left:5px solid #00bfa5;
	border-radius:5px;
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	-o-border-radius:5px;
	-ms-border-radius:5px;
	}
.buy-now a.hvr-bounce-to-left{
	padding: 15px 35px;
	color: #fff;
	background:  #00bfa5;
	display: block;
	font-size: 14px;
	font-weight: 600;
	border-radius:5px;
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	-o-border-radius:5px;
	-ms-border-radius:5px;
	}
.buy-now a.hvr-bounce-to-left:hover{
	text-decoration:none;
	color:#00bfa5;
	}
	
	/*-- banner-bottom --*/
.banner-bottom{
	margin:1em 0 0;
	}
.banner-bottom-grids{
	border-right:2px solid #CECECE;
	float:left;
	width:25%;
	margin-top: .5em;
	}
.banner-bottom-grid{
	background:#fff;
	padding: 1em 0;
	border-top: 10px solid #E4E4E4;
	border-bottom:2px solid #A4A4A4;
	}
.um-fig{
	float:left;
	width: 20%;
	}
.um-fig span{
	
	display: block;
	height: 73px;
	}
.t-fig{
	float:left;
	width: 20%;
	}
.t-fig span{
	
	display: block;
	height: 73px;
	}
.toy-fig{
	float:left;
	width: 20%;
	}
.toy-fig span{
	
	display: block;
	height: 73px;
	}
.tie-fig{
	float:left;
	width: 20%;
	}
.tie-fig span{
	
	display: block;
	height: 73px;
	}
.arr-fig{
	float:left;
	width: 20%;
	}
.arr-fig span{
	
	display: block;
	height: 73px;
	}
.graph-fig{
	float:left;
	width: 20%;
	}
.graph-fig span{
	display: block;
	height: 73px;
	}
.box-fig{
	float:left;
	width: 20%;
	}
.box-fig span{
	display: block;
	height: 73px;
	}
.rod-fig{
	float:left;
	width: 20%;
	}
.rod-fig span{
	
	display: block;
	height: 73px;
	}
.um-text{
	float:left;
	padding-left:1em;
	border-left:1px solid #EFEFEF;
	width: 80%;
	font-family: 'Titillium Web', sans-serif;
	font-style:normal;
	}
.um-text h3{
	color:#626262;
	font-size:2em;
	font-weight:300;
	letter-spacing:-3px;
	}
.um-text h3 span{
	color:#626262;
	font-weight:600;
	}
.um-text p{
	font-size:14px;
	margin:0.5em 0 0;
	color:#6C6C6C;
	}
.banner-bottom-grid:nth-child(2) {
	margin-top: .5em;
	}
.banner-bottom-grids:nth-child(4) {
	border-right: none;
	}
/*-- //banner-bottom --*/
/*-- work --*/
.work{
	background:#fff;
	border-top:10px solid #E5E5E5;
	font-family: 'Titillium Web', sans-serif;
	font-style:normal;
	margin: 1em 0;
	border-bottom:3px solid #AAAAAA;
	}
.buy{
	margin:3em 2.5em;
	padding:2em;
	background:#F6F5F5;
	border-top:1px solid #EFEFEF;
	border-right:1px solid #EFEFEF;
	border-bottom:1px solid #EFEFEF;
	border-left:5px solid #00bfa5;
	border-radius:5px;
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	-o-border-radius:5px;
	-ms-border-radius:5px;
	}
.buy-text{
	float:left;
	margin: 1em 0;
	}
.buy-text h3{
	color:#5B5B5B;
	font-size: 14px;
	margin: 0;
	text-transform: uppercase;
	font-weight: 600;
	}
.buy-text p{
	color:#8D8D8D;
	font-size:13px;
	margin:.5em 0 0;
	}
.buy-now{
	float:right;
	}
.buy-now a.hvr-bounce-to-left{
	padding: 15px 35px;
	color: #fff;
	background: url no-repeat 6px 17px #00bfa5;
	display: block;
	font-size: 14px;
	font-weight: 600;
	border-radius:5px;
	-webkit-border-radius:5px;
	-moz-border-radius:5px;
	-o-border-radius:5px;
	-ms-border-radius:5px;
	}
.buy-now a.hvr-bounce-to-left:hover{
	text-decoration:none;
	color:#313140;
	}
hr.one{
	 padding: 0; border: none; border-top: 1px solid #333; color: #333; text-align: center;
}
hr.one:before { content:"\f063"; display: inline-block; font-family: FontAwesome; position: relative; float:left; top: -0.4em; font-size: 1.5em; padding: -0em; background: white; }
hr.one:after { content: "\f063"; display: inline-block; font-family: FontAwesome; position: relative; float:right; top: -0.4em; font-size: 1.5em; padding: -0em; background: white; }
</style>
	
  </head>
  <body>
<div class="parallax">
<h1><strong>WatAnsys</strong> - A simple analysis tool for analysis your whatsapp group</h1>
</div>
<div class="container">
<p>&nbsp;</p>
<div style="background:#fff; padding:12px;"><h2 style="font-family: 'Russo One', sans-serif; text-align:center;">Timeline Span</h2><hr>
<center style="font-size:125%; text-align:center;"> From <b><?php echo $staring_time ; ?></b>  To <b><?php echo $end_time ; ?></b></center>
<div style="width:55%; margin: 2px auto;" ><hr class="one">

<p>&nbsp;</p>
</div>
<span class="pull-left" style="margin-left:13em !important; margin-top:-2em;"><b><?php echo $staring_time ; ?></b></span>
<span class="pull-right" style="margin-right:13em !important; margin-top:-2em;"><b><?php echo $end_time ; ?></b></span>
</div>

<p>&nbsp;</p>
<div style="background:#fff; padding:12px;"><h2 style="font-family: 'Russo One', sans-serif; text-align:center;">Timeline About Your Whatsapp Group</h2>
<div id="container" style="min-width: 300px; height: 400px; margin: 0 auto"></div>
</div>

<p>&nbsp;</p>
<div style="background:#fff; padding:12px;"><h2 style="font-family: 'Russo One', sans-serif; text-align:center;">Top Days</h2><hr>
<center style="font-size:125%; text-align:center;"> The top active day is <b><?php echo $Top_most_days ; ?></b></center>
<p>&nbsp;</p><center>
<?php
$tags = explode('-',$Top_most_days);

foreach($tags as $key) {    
    echo '<span style="background:#00bfa5;padding:3px 6px; font-family: \'Russo One\', sans-serif; font-size:175%; margin-right:3px;">'.$key.'</span>';    
}
?>


<p>&nbsp;</p>
</center>

</div>

<p>&nbsp;</p>
<div style="background:#fff; padding:12px;"><h2 style="font-family: 'Russo One', sans-serif; text-align:center;">Group Files and Location</h2><hr>
<div class="row">
<div class="col-md-12 col-md-push-2">
<div class="row"><div class="col-md-2"><b>Text  Messages : </b></div><div class="col-md-4">  <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round(($total_text_msg / $total_msg)*100,0) ; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round(($total_text_msg / $total_msg)*100,0) ; ?>%;"><?php echo round(($total_text_msg / $total_msg)*100,0) ; ?>%</div></div></div></div>
<div class="row"><div class="col-md-2"><b>Media Messages : </b></div><div class="col-md-4">  <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round(($media / $total_msg)*100,0) ; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round(($media / $total_msg)*100,0) ; ?>%;"><?php echo round(($media / $total_msg)*100,0) ; ?>%</div></div></div></div>
<div class="row"><div class="col-md-2"><b>Location : </b></div><div class="col-md-4">  <div class="progress"><div class="progress-bar" role="progressbar" aria-valuenow="<?php echo round(($Location / $total_msg)*100,0) ; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round(($Location / $total_msg)*100,0) ; ?>%;"><?php echo round(($Location / $total_msg)*100,0) ; ?>%</div></div></div></div>
</div>
</div>
</div>

<p>&nbsp;</p>
<div style="background:#fff; padding:12px;"><h2 style="font-family: 'Russo One', sans-serif; text-align:center;">Group Left</h2><hr>
<center style="font-size:125%; text-align:center;"> The Total number of Group left is <b><?php echo $group_left ; ?></b></center>
<p>&nbsp;</p>
</div>

<p>&nbsp;</p>
<div style="background:#fff; padding:12px;"><h2 style="font-family: 'Russo One', sans-serif; text-align:center;">Group Join via Group's Invite link</h2><hr>
<center style="font-size:125%; text-align:center;"> The Total number of Group left is <b><?php echo $group_link ; ?></b></center>
<p>&nbsp;</p>
</div>

<p>&nbsp;</p>
<div style="background:#fff; padding:12px;"><h2 style="font-family: 'Russo One', sans-serif; text-align:center;">Most Used Words</h2><hr>
<div class="row">
<div class="col-md-9 col-md-push-2">

    <table class="table table-bordered">
      <thead bgcolor="steelblue" style="color:#fff;">
	  <tr><th align="center">Rank</th><th>Word</th><th>Count</th></tr>
	  </thead>
<?php 
$i = 1;
    foreach ($top_ten_words as $key => $value) 
    {
        echo'<tr>'; 
		echo '<td align="center">'.$i++.'</td>';
        echo'<td><b>'. $key .'</b></td>';
        echo'<td><b>'. $value .'</b></td>';
        echo'<tr>';
    }
?>
      </tbody>
    </table>
  

</div></div>
</div>

<p>&nbsp;</p>
<div style="background:#fff; padding:12px;"><h2 style="font-family: 'Russo One', sans-serif; text-align:center;">Grand Summary</h2><hr>
<div class="row">
<div class="col-md-6 col-md-push-3">

    <table class="table table-bordered">
      <tbody>
        <tr>          
          <th>Total Number of mesages</th>
          <td><?php echo $total_msg ; ?></td>
        </tr>
        <tr>          
          <th>Total Number of Days</th>
          <td><?php echo $total_number_of_days ; ?></td>
        </tr>
        <tr>          
          <th>Total Number of Members left</th>
          <td><?php echo $group_left ; ?></td>
        </tr>
		<tr>          
          <th>Total Number of joints via group Link</th>
          <td><?php echo $group_link ; ?></td>
        </tr>
		<tr>          
          <th>Total Number of Text Messages</th>
          <td><?php echo $total_text_msg ; ?></td>
        </tr>
		<tr>          
          <th>Total Number of Media</th>
          <td><?php echo $media ; ?></td>
        </tr>
		<tr>          
          <th>Total Number of Locations</th>
          <td><?php echo $Location ; ?></td>
        </tr>
		
		<tr>          
          <th>Total Number of Words</th>
          <td><?php echo $total_words ; ?></td>
        </tr>
		<tr>          
          <th>Top most day</th>
          <td><?php echo $Top_most_days ; ?></td>
        </tr>
      </tbody>
    </table>
  

</div></div>
</div>



</div>
<p>&nbsp;</p><p>&nbsp;</p><p>&nbsp;</p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script>
$(function () {
    Highcharts.chart('container', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        
        xAxis: {
            type: 'category',
            labels: {
                rotation: -45,
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Number of Messages'
            }
        },
        legend: {
            enabled: false
        },
        tooltip: {
            pointFormat: 'Total number of messages is <b>{point.y:f}</b>'
        },
        series: [{
            name: 'Days',
            data: [
             <?php echo $json ;?>

            ]
        }]
    });
});
</script>
</body>
</html>














