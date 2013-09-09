<body>
<div id="container">
	<h1><?php echo 'Welcome ' .$this->user_model->get_name(); ?></h1>

	<div id="body">
		<h2> Send job report</h2>
		<form action="<?php echo site_url("report/send") ;?>" method="post" accept-charset="utf-8">
			<select name="state" id="state">
			<?php
			$managers = $this->report_model->getManagers();
			foreach ($managers as $manager):?>
					<?php echo "<option 
									value='" .$manager['state'] ."'>"
									.$manager['state'] ." - "
									.$manager['firstName'] ." " 
									.$manager['lastName'] ."</option>"
									;?>
			<?php endforeach;?>
			</select>
			<input type="submit" value="Send">
			<?php echo isset($message) ? $message : "" ?>
	</div>
	<p class="footer">
		Page rendered in <strong>{elapsed_time}</strong> seconds
		<a align="left" href='<?php echo site_url('home/logout');?>'>Logout</a>
	</p>
</body>
</html>