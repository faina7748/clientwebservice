<h3>Film Detail</h3>
<form method="POST" action="">
  Film ID: 
  <input type="text" name="id">  
  <a href="javascript:;" onclick="parentNode.submit();"><img src="img/search.ico" height="20" width="20"></a>
</form> 

<hr>

<?php
//client web service
if(isset($_POST['id'])){
	require "vendor/autoload.php";
	$client = new GuzzleHttp\Client(['verify' => false]);
	$url = 'http://localhost/webservice/sakila/film_detail.php';
	$id = $_POST['id'];
	//$token = '';
	$param = [
		'query' => ['id' => $id, 'token'=> '123sdfsdfhjknvllllwqwe']
	];
	$result = $client->request('GET', $url, $param);
	//var_dump($response->getBody()->getContents());
	$film = json_decode($result->getBody()->getContents());

	echo "<h3><img src='img/film.jpg' width='50' height='50'>My Favourite Film Info</h3>";
	echo '<table border=1 cellpadding=0 cellspacing=0>';
	echo '<tr bgcolor="#ff99dd"><td>No</td><td>Title</title><td>Description</td><td>Language</td><td>Show</td>';	

	if(isset($film->err)){
		echo '<tr><td colspan="5">'.$film->err.'</td></tr>';
	}else{		
		echo '<tr>';
		echo '<td align="center">1.</td>';
		echo '<td>'.$film->title.'</td>';
		echo '<td>'.$film->description.'</td>';
		echo '<td align="center">'.$film->name.'</td>';
		echo '<td align="center"><a href="img/smile.jpg" target=_blank><img src="img/movie.png" height="20" width="20"></a></td>';		
	}

	echo '</tr>';		
	echo '</table>';
}
