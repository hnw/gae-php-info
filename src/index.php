<?php
$path = @parse_url($_SERVER['REQUEST_URI'])['path'];
if ($path === '/') {
    $path = '/index.php';
}
$path = sprintf('%s/php%s', __DIR__, $path);
if (in_array($path, get_included_files())) {
    // 無限ループ防止
    http_response_code(500);
    exit(0);
}
if ((include $path) === FALSE) {
    http_response_code(404);
    exit(0);
}
