<nav>
	<div class="brand"><a href="index.php">Part1</a></div>
	<div class="link">
		<ul>
			<?php 
				if (isset($_SESSION['userid'])) {
				$info = $this->M_normal_user->welcome($_SESSION['userid']); 
			?>

			<li><a href="user.php?p=add_user"><?php if ($info['admin'] == 1) echo 'Add user'; ?></a></li>
			
			<li><a href="user.php?p=welcome"><?php echo $info['username']; ?></a></li>

			<li><a href="user.php?p=logout">Log out</a></li>
			<?php } ?>
		</ul>
	</div>
</nav>