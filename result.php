<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
		<title>PHPテスト</title>
		<style type="text/css">
		<!--
			body { 
				background-image: url(images/20100510162446.png);
  				background-attachment: fixed;
			}
			div.main{
				margin-top: 0;
				margin-bottom: 0;
				margin-left:auto;
                margin-right:auto; 
                text-align:left;  
                width:590px;
			}
			div.top{
				background-color:#FFFFFF;
				border-top:1px solid #E1E8ED;
				border-bottom:1px solid #E1E8ED;
				margin-top: -1px
				border-radius: 10px;    
				-webkit-border-top-left-radius: 10px;  
    			-webkit-border-top-right-radius: 10px;   
    			-moz-border-radius-topleft: 10px;  
    			-moz-border-radius-topright: 10px;    
			}
			div.block{
				background-color:#FFFFFF;
				border-top:1px solid #E1E8ED;
				border-bottom:1px solid #E1E8ED;
				margin-top: -1px;
				
			}
			div.bottom{
				background-color:#FFFFFF;
				border-top:1px solid #E1E8ED;
				border-bottom:1px solid #E1E8ED;
				margin-top: -1px
				border-radius: 10px;    
				-webkit-border-bottom-left-radius: 10px;  
    			-webkit-border-bottom-right-radius: 10px;   
    			-moz-border-radius-bottomleft: 10px;  
    			-moz-border-radius-bottomright: 10px;    
			}
			div.left{
				float: left;
				width:100px;
			}
			div.right{
				float: right;
				width:490px;
			}
			div.blank{
				clear: both;
			}
			a{
				color: #292F33;
				font-weight:bold;
				text-decoration:none;
			}
			.id{
				color: #B8A2A6;
			}
		-->
		</style>
	</head>
	<body>
		<div class="main"> 
			<div class="top" id="top">
				<h2>処理中・・・</h2>
			</div>
			<?php 
			require_once("tweet_igo4.php");
			?>
			<div class="bottom">
				<br>
			</div>
		</div>
	</body>
</html>