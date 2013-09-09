<?php
if (!$this->input->post('jobId') && $this->uri->segment(2) == "edit"){
	$buttonValue = "Update";
}else{
	$buttonValue = "Create";
}
?>

<body>
<div id="container">
	<h1><?php echo 'Welcome ' .$this->user_model->get_name(); ?></h1>

	<div id="body">
		<h2></h2>
		<form action="<?php echo ($this->uri->segment(2) == "edit" ? site_url("job/edit/".$this->uri->segment(3)) : site_url("job/add")); ?>" method="post" accept-charset="utf-8">
			<table border="0">
				<tr>
					<th>Customer</th><td><input type="text" name="customer" id="customer" value="<?php echo set_value('customer',(isset($customer) ? $customer : "")); ?>"></td>
				</tr>
				<tr>
					<th>Start</th><td><input type="text" name="start" id="start" readonly="true" value="<?php echo set_value('start',(isset($start) ? $start : "")); ?>"></td>
				</tr>
				<tr> 
					<th>End</th><td><input type="text" name="end" id="end" readonly="true" value="<?php echo set_value('end',(isset($end) ? $end : "")); ?>"></td>
				</tr>
				<tr>
					<input type="hidden" name="jobId" id="jobId" value="<?php echo set_value('id',(isset($id) ? $id : "")); ?>">
					<td><input type="submit" value="<?php echo $buttonValue ?>"></td>
				</tr>			
			</table>
		</form>
		<?php echo validation_errors(); ?>
		<br>
		<h2>Previous Jobs:</h2>
		<table border='0'>
			<tr>
				<th>Customer</th>
				<th>Start</th>
				<th>End</th>
				<th colspan="2">Action</th>
			</tr>
		<?php
			$jobs = $this->job_model->getJobs();
			foreach ($jobs as $job):?>
				<tr>
					<?php echo "<tr>
									<td>" .$job['Cust'] ."</td>
									<td>" .$job['Start'] ."</td>
									<td>" .$job['End'] ."</td>
									<td><a href='/index.php/job/delete/" .$job['Id'] ."'><img src='/images/delete.jpg' height='20px' width='20px'></a></td>
									<td><a href='/index.php/job/edit/" .$job['Id']  ."'><img src='/images/edit.jpg' height='20px' width='20px'></a></td>
								</tr>";?></tr>
			<?php endforeach;
		?>
		</table>
	</div>

	<p class="footer">
		Page rendered in <strong>{elapsed_time}</strong> seconds
		<a align="left" href='<?php echo site_url('home/logout');?>'>Logout</a>
	</p>
</div>

</body>
</html>