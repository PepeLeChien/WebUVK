<nav class="navbar navbar-expand navbar-light navbar-bg">
	<a class="sidebar-toggle js-sidebar-toggle">
		<i class="hamburger align-self-center"></i>
	</a>

	<div class="  d-flex justify-content-end align-items-end">
		<ul class="navbar-nav navbar-align">
			<li class="nav-item dropdown">
				<span class="nav-link  d-flex"  >
					 <?php echo htmlspecialchars(explode('@', $email)[0]); ?>
                </span> 
			</li>
		</ul>
	</div>
</nav>
