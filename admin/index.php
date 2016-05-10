<?php require_once 'common/header.php'?>
<?php require_once 'common/sidebar.php'?>
	<!-- start: Content -->
	<div id="content" class="span10">
			<ul class="breadcrumb">
				<li>
					<i class="icon-home"></i>
					<a href="index.html">Home</a> 
					<i class="icon-angle-right"></i>
				</li>
				<li><a href="#">Dashboard</a></li>
			</ul>

			<?php
			$users = getAllUsers($connection);
			?>

		<div class="box-content">
			<table class="table table-striped table-bordered bootstrap-datatable datatable">
				<thead>
				<tr>
					<th>Username</th>
					<th>Email</th>
					<th>Description</th>
				</tr>
				</thead>
				<tbody>

					<?php foreach($users as $user) { ?>
					<tr>
						<td>
							<?php echo $user['username']; ?>
						</td>
						<td>
							<?php echo $user['email']; ?>
						</td>
						<td>
							<?php echo $user['description']; ?>
						</td>
					</tr>
					<?php } ?>

				</tbody>
			</table>
		</div>

	</div><!--/.fluid-container-->

<?php require_once 'common/footer.php'?>