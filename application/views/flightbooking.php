

<div class="row">
	<div class="col-md-6">
		<div class="panel panel-success">
			<div class="panel-heading">Select a Departure and Destination</div>
			<div class="panel-body">
			<!-- drop down here -->
				<select id="departure_select" style="color:black">
					<option value="">Select a departure airport</option>
					<?php foreach ($airports as $num => $airport) { ?>
						<option value="<?php echo $airport['id'] ?>"><?php echo $airport['airport'] ?></option>
					<?php } ?>
				</select>
				<select id="destination_select" style="color:black">
					<option value="">Select a destination airport</option>
					<?php foreach ($airports as $num => $airport) { ?>
						<option value="<?php echo $airport['id'] ?>"><?php echo $airport['airport'] ?></option>
					<?php } ?>
				</select>
				<button class="btn btn-success" id="submit_depart_dest">Submit</button>

			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="panel panel-warning">
			<div class="panel-heading">Choose from a list of applicable bookings</div>
			<div class="panel-body">
				<!-- list is dependant upon section -->
				<table class="table table-striped table-hover">
					<tr class="info">
						<th>First Leg</th>
						<th>Second Leg</th>
						<th>Third Leg</th>
						
					</tr>
					<?php if(isset($bookings)): ?>
						<?php foreach ($bookings as $num => $booking) { ?>
							<tr>
								<?php foreach ($booking as $num => $flight) { ?>
									<td>
										<p>Plane Id: <?php echo $flight->plane_id ?></p>
										<p>Departure: <?php echo $flight->departure_airport ?></p>
										<p>Arrival: <?php echo $flight->arrival_airport ?></p>
										<p>Depart Time: <?php echo $flight->departure_time ?></p>
										<p>Arrive Time: <?php echo $flight->arrival_time ?></p>
									</td>
								<?php } ?>
							</tr>
						<?php } ?>
					<?php endif ?>
    			</table>
			</div>
		</div>
	</div>
</div>
