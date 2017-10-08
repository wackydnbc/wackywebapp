<div class="panel panel-default">
	<div class="panel-heading">Flights</div>
	<div class="panel-body">
		<table class="table table-striped table-hover">
      <tr class="info">
        <th>Plane ID</th>
        <th>Departure Airport</th>
        <th>Arrival Airport</th>
        <th>Departure Time</th>
        <th>Arrival Time</th>
      </tr>
      {flights}
      <tr>
        <td>{plane_id}</td>
        <td>{departure_airport}</td>
        <td>{arrival_airport}</td>
        <td>{departure_time}</td>
        <td>{arrival_time}</td>
      </tr>
      {/flights}
    </table>
	</div>
</div>
