<?php
	require('config.php');
	$bootstrap = require(TOOLS_PATH.'/bootstrap/api.php');
	header("Content-type:text/html;charset=utf-8");
	function postvar($arg){
		if(isset($_POST[$arg]))
			return $_POST[$arg];
	}
?>
<!doctype html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<?php echo $bootstrap['css']; echo $bootstrap['theme-css']; echo $bootstrap['jquery'];	echo $bootstrap['js']; ?>
		<script type="text/javascript" src="repeat.js"></script>
		<script type="text/javascript">
			<?php
				if(isset($_POST) && !empty($_POST)){
			?>
			var time;//初始时			
			function dotime(){
				setInterval(function(){
					time = time-1;
					document.getElementById('time').innerHTML = '执行倒计时:'+time;
					//console.log(time);
				},1000);			
			}
			
			function cron(){
				//document.getElementById('status').innerHTML = '请求中...';
				//document.getElementById('result').innerHTML = '';
				jQuery("#icon").fadeIn(100);
				jQuery("#result").fadeOut(100);
						
				get("<?php echo postvar('url');?>",function(){
					//console.log(request);
					
					//if(request.readyState == 4 && request.status == 200){
					//time = <?php echo postvar('time');?>/1000 + 1;//初始时			
					if(request.readyState == 4 && request.status==200){
						//document.getElementById('status').innerHTML = '完成!';
						jQuery("#icon").css({'display':'none'});
						
						jQuery("#result").html(request.responseText);	
						//document.getElementById('result').innerHTML = request.responseText;
						jQuery("#result").fadeIn(100);
						
						setTimeout(cron,<?php echo postvar('time');?>);
					}
					
				});
				//time = <?php echo postvar('time');?>/1000 + 1;//初始时			
				//setTimeout(cron,<?php echo postvar('time');?>);
			}

			window.onload = function(){
				cron();
				//dotime();
			}
			<?php
				}
			?>
			
		</script>
		<style type="text/css">
			html{
				width:100%;
				height:100%;
				overflow:hidden;
			}
			.margin{
				margin:10px auto;
			}
			#status{
				width:100%;
				height:60px;

			}
			#icon{
				width:100%;
				height:60px;			
				background:url('waiting.gif') no-repeat top center;
			}
		</style>
		<title>循环执行任务</title>
	</head>
	<div class="container">
		<div class="row">
			<form method="post">
					<div class="input-group margin">
						<span class="input-group-addon">执行url(完整url)</span>
						<input name="url" type="text" class="form-control" placeholder="请输入要执行的url地址" value="<?php echo postvar('url');?>" />
				</div>
				
					<div class="input-group margin">
						<span class="input-group-addon">执行间隔(毫秒)</span>
						<input name="time" type="text" class="form-control" placeholder="请输入执行时间，单位毫秒" value="<?php echo postvar('time'); ?>" />
					</div>
				
					<div class="btn-group margin">
						<input type="submit" class="btn btn-default" value="执行">
					</div>
					
			</form>
		
		<div id="time"></div><!--时间-->
		<div id="status"><div id="icon"></div></div><!--显示状态-->
		<div id="result"></div><!--显示结果-->
		
		</div>
	</div>
</html>