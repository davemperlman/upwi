<?php 
	if ($_SESSION) {
		$me = Classes\SQL::get("SELECT * FROM Employees WHERE id = :id", array('id' => $_SESSION['id']), 1);
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title></title>
		<script src="_js/jQuery.js"></script>
		<link rel="stylesheet" href="_css/main.css">
	</head>
	<body>
		<header>
			<a href="" class="logo">
				<h1>United Piping & Welding</h1>
			</a>
			<?php if ($_SESSION): ?>
				<nav>
				<ul>
					<li>Profile</li>
					<li>
						<a href="parts/logout.php?logout=1">Logout</a>
					</li>
					<!-- Offers an Admin option for employees created as admin -->
					<?php echo ( isset($me['admin']) ) ? "<li><a href='admin'>Admin</a></li>" : ''; ?>
				</ul>
			</nav>
			<?php endif ?>
		</header>
