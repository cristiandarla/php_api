<nav class="navbar navbar-expand-lg navbar-light bg-light pl-5 sticky-top">
	<div class="navbar-header">
		<a class="navbar-brand" href="/">Company Name</a>
   	</div>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navb" aria-controls="navb" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
    <div class="collapse navbar-collapse" id="navb">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item"><a class="nav-link" href="../register.php">Register</a></li>
			<?php
                session_start();
				if(isset($_SESSION['loggedin'])){
					echo '<li class="nav-item"><a class="nav-link" href="../controllers/logout.php">Logout</a></li>';
					echo '<li class="nav-item"><a class="nav-link" href="../user.php">User Page</a></li>';
				}else{
					echo '<li class="nav-item"><a class="nav-link" href="../login.php">Login</a></li>';
				}
			?>
		</ul>
	</div>
</nav>