<?php
/*
 * For displaying an array of airports
 */
?>

<div class="panel-body">
    <?php foreach ($_ci_data['_ci_vars'] as $num => $airport) { ?>
        <p><?php echo $airport['id'] ?> - <?php echo $airport['airport'] ?> </p>
    <?php } ?>
</div>