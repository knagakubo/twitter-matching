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
				background-color:#F5F8FA;
				margin-top: 0;
				margin-bottom: 0;
				margin-left:auto;
                margin-right:auto;  
                text-align:left;  
                width:590px;
                height:600px;
                border-radius: 10px;  
   				-webkit-border-radius: 10px; 
   				-moz-border-radius: 10px;  
			}
		-->
		</style>
	</head>
	<body>
		<div class="main">	
			<h1>ツイッターマッチングアプリ</h1>

			<p>
				あなたのツイートを分析して、マッチングを行います。
			</p>
			<form action = "login" method = "post">
				<input type = "submit" value = "ログイン">
			</form>
			<br>
			<form action="result.php" method="get">
			  <input type="submit" value="診断">
			</form>
		</div>
	</body>
</html>