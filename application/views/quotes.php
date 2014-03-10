<?php
date_default_timezone_set('UTC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Quotes</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
	<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="/assets/css/style.css">
</head>
<body>
<div id="container">
	<?php
	if ($this->session->flashdata('success')) 
	{
		echo "<h2>".$this->session->flashdata('success')."</h2>";
	}
	?>
	<div class="main">
		<?= "Welcome ".$this->session->userdata('name')."!"?>
		</br>
		<a href="/quotes/logout">Log Out</a>
	</div>
	<div id="quotable">
		<h3>Quotable Quotes</h3>
		<?php
		// echo "<pre>";
		// var_dump($quotes);
		foreach ($quotes as $quote) 
		{
		?>
		<div class="quote">
			<p><?=$quote['author']?>: <?=$quote['message']?></p>
			Posted by: <?=$quote['postedby']?>
			<form action="/quotes/add" method="post">
				<input type="hidden" value="<?=$quote['user_id']?>" name="userid">
				<input type="hidden" value="<?=$quote['id']?>" name="quoteid">
				<input type="hidden" value="<?=$quote['author']?>" name="author">
				<input type="hidden" value="<?=$quote['message']?>" name="message">
				<input type="hidden" value="<?=$quote['postedby']?>" name="postedby">
				<input type="submit" value="add to my list" class="btn">
			</form>
		</div>
		<?php
		}
		?>
	</div>
	<div id="favorites">
		<h3>Your Favorites</h3>
		<?php
		// echo "<pre>";
		// var_dump($quotes);
		foreach ($favorites as $favorite) 
		{
		?>
		<div class="favorite">
			<p><?=$favorite['author']?>: <?=$favorite['message']?></p>
			Posted by: <?=$favorite['postedby']?>
			<form action="/quotes/remove" method="post">
				<input type="hidden" value="<?=$favorite['user_id']?>" name="userid">
				<input type="hidden" value="<?=$favorite['id']?>" name="quoteid">
				<input type="submit" value="remove from my list" class="btn">
			</form>
		</div>
		<?php
		}
		?>
	</div>
	<div id="newquote">
		<h4>Contribute a Quote</h4>
		<form action="/quotes/create" method="post">
			<input type="hidden" name="userid" value="<?=$this->session->userdata('userid')?>">
			<input type="hidden" name="postedby" value="<?=$this->session->userdata('name')?>">
			<label for="Author">Quoted By: </label>
			<input type="text" name="author" id="author"></br>
			<label for="Message">Message: </label>
			<textarea name="message" id="message" cols="30" rows="3"></textarea></br>
			<input type="submit" value="Submit" class="btn">
		</form>
	</div>
</div><!--end of container div-->
</body>
</html>