<?php
echo "<html>\n";
$classes = get_declared_classes();
foreach ($classes as $cl) {
    echo "<h1>$cl</h1>";
    echo "<pre>\n";
    var_dump(get_class_methods($cl));
    echo "</pre>\n";
}
echo "</html>\n";
