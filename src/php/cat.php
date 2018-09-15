<?php

$path = isset($_GET['path']) ? $_GET['path'] : ".";

echo "<html><pre><code style=\"font-family: Consolas, 'Courier New', Courier, Monaco, monospace;\">\n";
if (is_file($path)) {
    echo htmlspecialchars(file_get_contents($path));
}
echo "</code></pre></html>\n";
