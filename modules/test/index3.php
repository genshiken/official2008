<?php

$free = shell_exec("df -h | grep home");

echo "<br />$free";

?>
