<?php

//connect to database
$conn = mysqli_connect('localhost', 'jseeuws', 'test1234', 'ninja_sandwich');

//check connection
if(!$conn){
   echo 'connection error: ' . mysqli_connect_error();
}

//write query fro all sandwiches
$sql = 'SELECT  title, ingredients, id FROM sandwiches ORDER BY created_at';

//make query & get result
$result = mysqli_query($conn, $sql);

//fetch the resulting rows as an array
$sandwiches = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free result from memory
mysqli_free_result($result);

//close connection
mysqli_close($conn);

//(explode(',', $sandwiches[0]['ingredients']);

?>

<!doctype html>
<html>


<?php include('templates/header.php'); ?>

<h4 class="center grey-text">sandwiches!</h4>

<div class="container">
<div class="row">

<?php foreach($sandwiches as $sandwich): ?>

<div class="col s6 md3">

<div class="card z-depth-0">

<div class="card-content center">

<h6><?php echo htmlspecialchars($sandwich['title']); ?></h6>

<ul>
<?php foreach(explode(',', $sandwich['ingredients']) as $ing): ?>
<li><?php echo htmlspecialchars($ing); ?></li>
<?php endforeach; ?>
</ul>

</div>

<div class="card-action right-align">

<a class="brand-text" href="#">more info</a>

</div>

</div>

</div>

<?php endforeach; ?>

<?php if(count($sandwiches) >= 3): ?>
 <p>there are 3 or more sandwiches</p>
<?php else: ?>
 <p>there are less than 3 pizzas</p>
<?php endif; ?>

</div>
</div>

<?php include('templates/footer.php'); ?>


</body>
</html>