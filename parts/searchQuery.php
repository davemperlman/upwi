<?php
	require_once '../autoload.php';
	$name = "%{$_POST['search']}%";
	$results = Classes\SQL::get("SELECT * FROM Jobs WHERE customerFirst LIKE :name OR customerLast LIKE :name OR customerPhone LIKE :name OR customerEmail LIKE :name OR customerAddress LIKE :name LIMIT 5", array('name' => $name));
?>
<ul>
	<?php foreach ($results as $key => $value): ?>
		<?php $orders = Classes\SQL::get('SELECT * FROM WorkOrders INNER JOIN Employees ON Employees.id = employee_id WHERE job_id = :id', array('id' => $value['id'])); ?>
		<table>
			<tr>
				<td class="searchResult" data-id='<?php echo $value['id']; ?>'><?php echo $value['customerFirst'] . ' ' . $value['customerLast']; ?></td>
				<td class="searchResult" data-id='<?php echo $value['id']; ?>'><?php echo $value['customerAddress']?></td>
				<td class="searchResult" data-id='<?php echo $value['id']; ?>'><?php echo $value['customerEmail']?></td>
				<td class="searchResult" data-id='<?php echo $value['id']; ?>'><?php echo $value['customerPhone']?></td>
			</tr>
		</table>
		<table class="orders">
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
</ul>

<script>
	$('.searchResult').on('click', function(){
		console.log(this.value);
	})
</script>
