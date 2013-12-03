<?php
    echo '<p>Now is: <?php echo date("l, j F Y, H:i:s"); ?> and the weather is <strong><?php echo $weather; ?></strong></p>';
    echo "<p>Template is: " . date("l, j F Y, H:i:s") . "</p>";
    sleep(2); // wait for 2 seconds, as you can tell the difference then :-)
?>
