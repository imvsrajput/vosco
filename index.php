<?php 	
	$conn = new mysqli("localhost","pu","url","zero");
    $result = $conn->query('SELECT * FROM vosco');

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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
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
	<table class="table">
		<thead>
			<tr>
				<th>Url</th>
				<th>title</th>
				<th>icon</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php if ($result->num_rows): ?>
				<?php while ($row=$result->fetch_assoc()): ?>
					<tr>
						<th><?=$row['url']?></th>
						<th><?=$row['title']?></th>
						<th><img src="<?=$row['icon']?>"> </th>
						<th><a href="del.php?id=<?=$row['id']?>">Delete</a></th>
					</tr>
						
				<?php endwhile ?>	
			<?php endif ?>
		</tbody>
	</table>
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

	$(document).ready( function () {
    $('.table').DataTable();
} );
</script>
</div>
</body>
</html>
