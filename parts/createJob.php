<?php

?>

<a class="close" href="#">Back</a>
<form class="form" method="post" action="parts/add.php">
	<label>
		Customer First:
		<input name="customerFirst" type="text">
	</label>
	<label>
		Customer Last:
		<input name="customerLast" type="text">
	</label>
	<label>
		Address:
		<input name="customerAddress" type="text">
	</label>
	<label>
		Phone:
		<input name="customerPhone" type="text">
	</label>
	<label>
		Email:
		<input name="customerEmail" type="email">
	</label>
	<label>
		Description:
		<textarea name="description"></textarea>
	</label>
	<button type="submit" name="newJob" value="1">Create</button>
</form>




<script>
	$('.close').on('click', function(e){
        e.preventDefault();
        $('.offscreen-window').removeClass('slide-in');
        $('.offscreen-window').empty();
    });
</script>