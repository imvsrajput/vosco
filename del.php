<?php 


$conn = new mysqli("localhost","pu","url","zero");

$conn->query('delete from vosco where id='.$_GET['id']);
header('Location: index.php')

 ?>
