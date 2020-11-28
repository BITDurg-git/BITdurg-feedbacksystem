<?php
	include 'common.php';
?>
<div class="container">
	<h3 class="text-center">New Faculty Registration</h3>
	<br>

	<?php
	if(!isset($res->data)){ echo "<p class='w3-center'>No Data Found</p>";}
	else{
		$i=1;
	?>
	
	<div class="row">
		<div class="col-md-1"></div>
		<table class="col-md-10 w3-table scroll w3-white">
			<thead class="w3-theme-l2">
				<tr>
					<th>Sr No.</th>
					<th>Full Name</th>
					<th>UserId</th>
					<th>E-mail</th>
					<th>Action</th>
				</tr>
			</thead>

		<?php
		foreach ($res->data as $key => $user){
		?>

			<tr class="w3-border-bottom">
				<td><?=$i++;?></td>
				<td><?=$user['name']?></td>
				<td><?=$user['uid']?></td>
				<td><?=$user['email']?></td>
				<td class="text-primary">
					<a href="<?php echo $res->action?>/admin/faculty_registration/:id=<?=$user['uid']?>">
						Approve
					</a>
				</td>
			</tr>

		<?php }?>
			
		</table>
		<div class="col-md-1"></div>
	</div>

	<?php }?>
</div>