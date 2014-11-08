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
		jQuery(document).ready(function($){
			var input = $("#url-input").html();
			$("#add").click(function(){
				$(".extra").append('<div class="input-group margin">'+input+'</div>');
			})
		})
		
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
				
			//清除结果
			function clear(){
				jQuery("#result").html('');
				setTimeout(clear,60000);
			}
			
			/**
			 任务执行
			*/
			var cron = function(url){
			
				jQuery("#icon").fadeIn(100);
				//jQuery("#result").fadeOut(100);
				get(url,function(){
					if(request.readyState == 4 && request.status==200){
					
						jQuery("#icon").css({'display':'none'});
						jQuery("#result").append(request.responseText);	
						
						/*setTimeout(function(){
							cron(urls);
						},<?php echo postvar('time');?>);*/
							
					}
					
				});
			}



			window.onload = function(){
				var url = new Array();
				<?php
					$urls = array_filter(postvar('url'));
					foreach($urls as $key=>$url){
					
						$out = $key*1000;
						echo 'setTimeout(function(){
						setInterval(
							function(){
								cron("'.$url.'")
							},'.postvar('time').')
							},'.$out.');';
							
					}
				
				?>

				//dotime();
				clear();
			}
			
			
			<?php
				}//end isset post
			?>
			
		</script>
		<style type="text/css">
			html{
				width:100%;
				height:100%;
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
		<?php $urls = postvar('url');?>
			<form method="post">
			
					<div class="input-group margin" id="url-input">
						<span class="input-group-addon">执行url(完整url)</span>
						<input name="url[]" type="text" class="form-control" placeholder="请输入要执行的url地址" value="<?php echo $urls[0]; ?>" />
					</div>
					<div class="extra">
						<?php
							for($i=1,$j=count($urls);$i<$j;$i++){
						?>
						<div class="input-group margin" id="url-input">
							<span class="input-group-addon">执行url(完整url)</span>
							<input name="url[]" type="text" class="form-control" placeholder="请输入要执行的url地址" value="<?php echo $urls[$i]; ?>" />
						</div>						
						<?php }?>
					</div>
					<div class="btn-group">
						<a class="btn" id="add">添加</a>
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