<?php
	require_once '../autoload.php';
	session_start();
	$date = $_GET['date'];
	$jobs = Classes\SQL::get("SELECT * FROM WorkOrders INNER JOIN Jobs ON Jobs.id = job_id WHERE date = '$date' AND complete = 0");
?>

<?php foreach ($jobs as $job): ?>
	<table class="workorder">
		<tr>
			<td>
				<?php echo "$job[customerFirst]" . ' ' . "$job[customerLast]"; ?>
			</td>
			<td>
				<?php echo $job['time']; ?>
			</td>
			<td>
				<?php echo $job['customerAddress']; ?>
			</td>
		</tr>
	</table>
	<section class="expandable">
		<ul>
			<li>
				<?php echo $job['description']; ?>
			</li>
			<li>
				<?php echo $job['time']; ?>
			</li>
		</ul>
		<?php if ($_SESSION['id'] == $job['id']): ?>
			<button class="finish-workorder">SUBMIT ME</button>
		<?php endif ?>
	</section>
<?php endforeach ?>

<script>
	// Slides in and populates form for completing job
	$('.finish-workorder').on('click', function(){
		$.post( 'parts/complete-workorder-form.php', function(data){
			$('.offscreen-window').append(data);
		})
		$('.offscreen-window').addClass('slide-in');
	});
</script>

