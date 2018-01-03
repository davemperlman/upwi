<?php  
	require_once 'autoload.php';
	Classes\Navigator::onLoad();
?>
<link rel="stylesheet" href="_css/calendar.css"> <!-- TEMPORARY -->
<section id="calendar">
	<?php
		$cal = new Classes\Calendar();
		echo $cal->show(); // Needs CSS in header
	?>
	<section id="todays-jobs">
	Todays
	</section>
</section>

<section class="offscreen-window">
	
</section>

<!-- Calendar and Job Scripts -->
<script>
	// Highlights selected day on Calendar and populates Jobs window with selected day's work orders.
	$('.dates li').on('click', function(){
		$('.dates li').removeClass('active');
		$(this).addClass('active');
		$.get( 'parts/retrieveJobs.php', { date: $(this).attr('data-day') }, function(data){
			$('#todays-jobs').empty();
			$('#todays-jobs').append(data);
		});
	})


</script>

<?php 
	Classes\Navigator::get_footer();
?>