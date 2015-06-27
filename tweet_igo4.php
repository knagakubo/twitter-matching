<?php
	ini_set('memory_limit', '1024M');
	session_start();
	$time_start = microtime(true);
	set_time_limit(1200);

	require "twitteroauth/autoload.php";
	use Abraham\TwitterOAuth\TwitterOAuth;
	require_once "common.php";
	include_once "igo-php/lib/Igo.php";

	function count_noun2($array){
		$igo = new Igo("igo-php/ipadic", "UTF-8");
		$noun_count = array();
		foreach ($array as $sentence) {
			$result = $igo->parse($sentence);
			foreach($result as $value){
			    $feature = explode(",", $value->feature);
			    if($feature[0]=="名詞"){
			    	$noun = $value->surface;
			        if(isset($noun_count[$noun])){
			        	$noun_count[$noun]++;
			        }else{
			        	$noun_count[$noun]=1;
			        }
			    }
			}
		}		
		return $noun_count;
	}

	function jaccard($array1, $array2){
		$numerator = 0;
		foreach (array_keys($array1) as $key) {
			if(isset($array2[$key])) $numerator++;
		}
		$denominator = count($array1) + count($array2) - $numerator;
		if($denominator != 0){
			return (float) $numerator / $denominator;
		}else{
			return 0;
		}
	}

	echo '<div class="block" id="progress"><img src="images/matchdotcom_banner.jpg"></div>';
	ob_flush();
	flush();

	$access_token = $_SESSION['access_token'];

	$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

	//ユーザーのツイートを取得
	$tweets = $connection->get('statuses/user_timeline', array('count' => 200));
	$user_id = (int) $tweets[0]->user->id_str;
	$texts = array();
	foreach($tweets as $tweet){
		array_push($texts, $tweet->text);
	}
	$noun_count1 = count_noun2($texts);

	//友達の友達のツイートを取得
	$data = array();
	$follows = $connection->get('friends/list', array('count' => 10));
	$count = 0;
	foreach($follows->users as $follow){
		if($follow->protected == false){
			$follows2 = $connection->get('friends/list', array('user_id' => $follow->id , 'count' => 200));
			foreach ($follows2->users as $follow2){
				$texts2 = array();
				if($follow2->protected == false){
					$id = $follow2->id;
					$tweets = $connection->get('statuses/user_timeline', array('user_id' => $id, 'count' => 200));
					if(is_object($tweets)) break 2;
					if(isset($tweets[0]->user->name)){
						$name = $tweets[0]->user->name;
					}else{
						$name = null;
					}
					foreach($tweets as $tweet){
						array_push($texts2, $tweet->text);
					}
					$noun_count2 = count_noun2($texts2);
					$jaccard = jaccard($noun_count1,$noun_count2);
					$array[] = array('id' => $id, 'name' => $name, 'jaccard' => $jaccard);
					$data += $array;
					$count++;
					if(microtime(true) - $time_start > 300) break 2;
				}
			}
		}
	}


	$follows = $connection->get('friends/ids', array('count' => 1000));
	$ids = $follows->ids;
	array_push($ids, $user_id);

	//ソート
	foreach ($data as $key => $value) {
		$key_jaccard[$key] = $value['jaccard'];
	}
	array_multisort($key_jaccard, SORT_DESC, $data);

	echo "<script>document.getElementById( 'top' ).innerHTML = '<h2>おすすめのユーザー</h2>'</script>";
	echo "<script>document.getElementById( 'progress' ).innerHTML = ''</script>";

	//jaccard係数の高い順に表示
	$count = 0;
	foreach ($data as $datum) {
		if(array_search($datum['id'],$ids) == false){
			$count++;
			$profile = $connection->get('users/show', array('user_id' => $datum['id']));
			$account = $profile->screen_name;
			$description = $profile->description;
			echo "<div class=\"block\"><div class=\"left\"><img src='http://furyu.nazo.cc/twicon/";
			echo $account;
			echo "/bigger'></div><div class=\"right\"><a target=\"_blank\" href=\"https://twitter.com/";
			echo $account;
			echo "\">" . $datum['name'] . "</a><br>";
			echo "<small class=\"id\">@" . $account . "</small><br>";
			echo  $description;
			echo "</div><div class=\"blank\"></div></div>";
		}
		if($count == 10) break;
	}
	$time_end = microtime(true);
	//echo  $time_end - $time_start . "</br></br>";
?>