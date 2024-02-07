<?php require APPROOT . '/views/inc/header.php'; ?>
<?php
// Counter for order number.
$num_counter = 1;
?>

<h1 class="res-header">Restaurant Orders</h1>

<div class="dash-table-container">
	<div class="dash-table">
		<table>
			<tr>
				<th>Customer Name</th>
				<th>Order Status</th>
				<th>Submitted Datetime</th>
				<th>Driver Name</th>
			</tr>
			<tr>
				<td>Murtada</td>
				<td>
					<select class="order-status" name="order-status">
						<option value="not-accepted">Not accepted</option>
						<option value="preparing">preparing</option>
						<option value="prepared">prepared</option>
					</select>
				</td>
				<td>2024-01-21 14:20:28</td>
				<td>Ali</td>
			</tr>
		</table>
	</div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>