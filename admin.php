<?php  
	require_once 'autoload.php';
	Classes\Navigator::onLoad();
	$is_admin = Classes\SQL::get("SELECT admin FROM Employees WHERE id = :id", array('id' => $_SESSION['id']));
	if (!$is_admin) {
		Classes\Navigator::redirect();
	}
	$jobs = Classes\SQL::get('SELECT * FROM Jobs WHERE complete = :complete', array('complete' => 0));
	?>
	<ul id="adminNav">
		<li data-link="parts/createJob.php">Create Job</li>
		<li data-link="parts/createOrder.php">Create Work Order</li>
		<li data-link="parts/search.php">Search Customers</li>
	</ul>
	<section id="activeJobs">
		<?php foreach ($jobs as $job): ?>
			<?php 
				$orders = Classes\SQL::get('SELECT * FROM WorkOrders INNER JOIN Employees ON employee_id = Employees.id WHERE job_id = :id', array('id' => $job['id']));
			 ?>
			<table>
				<tr>
					<td>
						<?php echo $job['customerFirst'] . ' ' . $job['customerLast']; ?>
					</td>
					<td>
						<?php echo $job['customerAddress']; ?>
					</td>
					<td>
						<?php echo $job['customerPhone']; ?>
					</td>
					<td>
						<?php echo $job['customerEmail']; ?>
					</td>
					<td>
						<?php echo $job['description']; ?>
					</td>
				</tr>
			</table>
			<table class="orders" style="display: none;">
				<?php foreach ($orders as $order): ?>
					<tr>
						<td>
							<?php echo $order['name']; ?>
						</td>
						<td>
							<?php echo $order['date']; ?>
						</td>
						<td>
							<?php echo $order['time']; ?>
						</td>
							<?php if (!$order['hoursWorked'] || !$order['description']): ?>
								<?php break; ?>
							<?php endif ?>
						<td>
							<?php echo $order['hoursWorked']; ?>
						</td>
						<td>
							<?php echo $order['description']; ?>
						</td>
						<td>
							<?php echo $order['inventoryUsed']; ?>
						</td>
						<td>
							<button>Complete</button>
						</td>
						<td>
							<button>Delete</button>
						</td>
					</tr>
					<tr>
						<?php foreach (explode(',', $order['photoLink']) as $link): ?>
							<td>
								<img src="<?php echo $link; ?>" alt="">
							</td>
						<?php endforeach ?>
					</tr>
				<?php endforeach ?>
			</table>
		<?php endforeach ?>
	</section>
	<section id="action" class="offscreen-window">
		
		
	</section>


	<script>
		$('#adminNav li').on('click', function() {
			var html = $(this).attr('data-link');
			$.get( html , function(data){
				$('#action').empty().append(data);
			});
			$('.offscreen-window').addClass('slide-in');
		});

	</script>