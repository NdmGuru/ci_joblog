<?php
if (!$this->input->post('jobId') && $this->uri->segment(2) == "edit"){
	$buttonValue = "Update";
}else{
	$buttonValue = "Create";
}
?>

<body>
<div id="container">
	<h1>Audit Trail</h1>

	<div id="body">
		<h2></h2>
		<form action="<?php echo site_url("audit/view"); ?>" method="post" accept-charset="utf-8">
			<table border="0">
				<tr>
					<th>Technitian</th><td><?php echo form_dropdown('techId', $this->user_model->techDropdown()) ;?></td><td><input type="submit" value="View"></td>
				</tr>			
			</table>
		</form>
		<br>
		<h2>Trail for: <?php echo $this->input->post("techId") ? $this->user_model->getTechName($this->input->post("techId")): "Please Select Technitian" ; ?></h2>
		<table border='0'>
			<tr>
				<th>JobID</th>
				<th>Customer</th>
				<th>Start</th>
				<th>End</th>
				<th>Action</th>
				<th>Changed At</th>
			</tr>
		<?php
		if($this->input->post('techId')){
			$audits = $this->audit_model->getAudit($this->input->post("techId"));
			foreach ($audits as $audit):?>
				<tr>
					<?php echo "<tr>
									<td>" .$audit['jobId'] ."</td>
									<td>" .$audit['customer'] ."</td>
									<td>" .$audit['start'] ."</td>
									<td>" .$audit['end'] ."</td>
									<td>" .$audit['action'] ."</td>
									<td>" .$audit['datestamp'] ."</td>
								</tr>";?></tr>
			<?php endforeach;
		}
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