<?php
	require_once '../autoload.php';
	session_start();
	$date = $_GET['date'];
	$jobs = Classes\SQL::get("SELECT * FROM WorkOrders INNER JOIN Jobs ON Jobs.id = job_id WHERE date = :date AND complete = :complete", array('date' => $date, 'complete' => 0));
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
	$('.workorder').on('click', function(){
		$(this).toggleClass('drop');
		$(this).next('.expandable').slideToggle(500);
	})
	// Slides in and populates form for completing job
	$('.finish-workorder').on('click', function(){
		var WOid = '<?php echo $job['id']; ?>';
		$.post( 'parts/complete-workorder-form.php', {id: WOid}, function(data){
			$('.offscreen-window').append(data);
		})
		$('.offscreen-window').addClass('slide-in');
	});
</script>

