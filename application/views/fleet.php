<div class="row">
	<div class="span10">
    	<table border="1" cellpadding="10">
        <tr>
          <th>ID</th>
          <th>Plane Model</th>
          <th>Manufacturer</th>
        </tr>
      {fleet}
      <tr>
        <td><a href="/fleet/show/{key}">{id}</a></td>
        <td>{model}</td>
        <td>{manufacturer}</td>
      </tr>
      {/fleet}
    </table>
	</div>
</div>
