<?php 
	require_once 'autoload.php';
	Classes\Navigator::onLoad(true);
	( isset($_SESSION['is_active']) ) ? Classes\Navigator::redirect('home.php') : '' ;
 ?>
 		<form id="login-form" method="post" action="parts/login.php">
			<fieldset>
				<label>
				username
				<input type="text" name="username" required>
			</label>
			<label>
				password
				<input name="password" type="password" required>
			</label>
			</fieldset>
			<button id="submit-login" type="submit">Submit</button>
		</form>
	<?php 
	require_once 'parts/footer.php';