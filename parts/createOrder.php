<?php
require_once '../autoload.php';
	$employees = Classes\SQL::get('SELECT * FROM Employees', array());
	$jobs = Classes\SQL::get("SELECT * FROM Jobs WHERE complete = :complete", array('complete' => 0));
?>
<a class="close" href="#">Back</a>
<form id="workOrderForm" action="">
	<label >
		Employee:
		<select name="" id="employee">
			<?php foreach ($employees as $employee): ?>
				<option value="<?php echo $employee['id'] ?>">
					<?php echo $employee['name']; ?>
				</option>
			<?php endforeach ?>
		</select>
	</label>
	<label>
		Job:
		<select name="" id="job">
			<?php foreach ($jobs as $job): ?>
				<option value="<?php echo $job['id']; ?>">
					<?php echo $job['customerAddress']; ?>
				</option>
			<?php endforeach ?>
		</select>
	</label>
	<label>
		Date:
		<input id="date" type="date">
	</label>
	<label>
		Time:
		<input id="time" type="time">
	</label>
	<button type="submit">Create</button>
</form>




<script>
	$('.close').on('click', function(e){
        e.preventDefault();
        $('.offscreen-window').removeClass('slide-in');
        $('.offscreen-window').empty();
    });
</script>