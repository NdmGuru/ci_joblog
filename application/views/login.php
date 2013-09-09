<body>

<div id="container">
	<h1>Please enter your Tech ID</h1>

	<div id="body">
	<? echo form_open('login/process'); ?>
	<input type="tel" name="techId" id="techId">
	<? echo form_submit('login', 'Login'); ?> 
	<? echo $errors; ?>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>
