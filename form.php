<?php

if ($_SERVER['REQUEST_METHOD']=='POST') {

    $cURL = curl_init();
    curl_setopt_array($cURL, [
        CURLOPT_URL => $_POST['url'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTPHEADER => ["Connection: keep-alive"],
    ]);
    $cData = curl_exec($cURL);
    curl_close($cURL);
    $title = explode('</title>', $cData)[0];
    $title = explode('<title', $title)[1];
    $title = explode('>', $title)[1];
    $data=[];
    $data['title']=$title;
    $url = explode('/',$_POST['url']);
    $data['icon']='https://'.$url[2].'/favicon.ico';

	$conn = new mysqli("localhost","pu","url","zero");
	$result = $conn->query('SELECT id from vosco where url = "'.$_POST['url'].'"');
	if(!$result->num_rows){
		$result = $conn->query('INSERT INTO `vosco`(`url`, `title`, `icon`) VALUES  ("'.$_POST['url'].'","'.$data['title'].'","'.$data['icon'].'")');
	}
	echo json_encode($data);
    die;
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
  	<title></title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"></script>
</head>
<body>



<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
    <ul class="navbar-nav">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="form.php">Form</a>
      </li>
    </ul>

  </div>
</nav>

<div class="container">

	<form>
		<input type="text" name="url" class="form-control" placeholder="Enter url">
	</form>
	<a class="btn btn-primary">Submit</a>
	<table class="table" style="display: none;">
		<tr>
			<th>Title</th>
			<td class="title"></td>
		</tr>
		<tr>
			<th>Icon</th>
			<td class="icon"></td>
		</tr>
	</table>
</div>

<script type="text/javascript">

	$(document).ready(function() {
	    $(document)[0].oncontextmenu = function() { return false; }
	    $(document).mousedown(function(e) {
	        if( e.button == 2 ) {
	            alert('Sorry, this functionality is disabled!');
	            return false;
	        } else {
	            return true;
	        }
	    });
	});

	$('input').change(function(){
		$.ajax({
			type:"POST",
			data:{"url":$(this).val()},
			success:function(resp){
				resp = JSON.parse(resp);
				$('table').show();
				$('.title').html(resp['title'])
				$('.icon').html('<img src="'+resp['icon']+'">')
				console.log(resp);
			}
		})
	})
</script>

</body>
</html>
