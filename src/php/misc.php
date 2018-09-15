<?php
echo "<html><pre>\n";

echo "getmypid()=";
var_dump(getmypid());

echo "getmygid()=";
var_dump(getmygid());

echo "getmyuid()=";
var_dump(getmyuid());

echo "get_current_user()=";
var_dump(get_current_user());

echo "getrusage()=";
var_dump(getrusage());

echo "php_sapi_name()=";
var_dump(php_sapi_name());

echo "</pre></html>\n";
