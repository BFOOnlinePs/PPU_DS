<?php
set_time_limit(300); // Increase script execution time

// Run Composer update
$output = [];
exec('composer update 2>&1', $output);

// Display output
echo "<pre>";
echo implode("\n", $output);
echo "</pre>";
?>
