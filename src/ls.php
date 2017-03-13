<?php

$PATH_TO_CAT_PHP = "/cat.php";

function perm_to_str($perms) {

    switch ($perms & 0xF000) {
        case 0xC000: // ソケット
            $info = 's';
            break;
        case 0xA000: // シンボリックリンク
            $info = 'l';
            break;
        case 0x8000: // 通常のファイル
            $info = '-';
            break;
        case 0x6000: // ブロックスペシャルファイル
            $info = 'b';
            break;
        case 0x4000: // ディレクトリ
            $info = 'd';
            break;
        case 0x2000: // キャラクタスペシャルファイル
            $info = 'c';
            break;
        case 0x1000: // FIFO パイプ
            $info = 'p';
            break;
        default: // 不明
            $info = 'u';
    }

    // 所有者
    $info .= (($perms & 0x0100) ? 'r' : '-');
    $info .= (($perms & 0x0080) ? 'w' : '-');
    $info .= (($perms & 0x0040) ?
              (($perms & 0x0800) ? 's' : 'x' ) :
              (($perms & 0x0800) ? 'S' : '-'));

    // グループ
    $info .= (($perms & 0x0020) ? 'r' : '-');
    $info .= (($perms & 0x0010) ? 'w' : '-');
    $info .= (($perms & 0x0008) ?
              (($perms & 0x0400) ? 's' : 'x' ) :
              (($perms & 0x0400) ? 'S' : '-'));

    // 全体
    $info .= (($perms & 0x0004) ? 'r' : '-');
    $info .= (($perms & 0x0002) ? 'w' : '-');
    $info .= (($perms & 0x0001) ?
              (($perms & 0x0200) ? 't' : 'x' ) :
              (($perms & 0x0200) ? 'T' : '-'));

    return $info;
}

$path = isset($_GET['path']) ? $_GET['path'] : ".";

echo "<html><pre><code style=\"font-family: Consolas, 'Courier New', Courier, Monaco, monospace;\">\n";
if (file_exists($path)) {
    foreach (new DirectoryIterator($path) as $fileInfo) {
        try {
            $perms = $fileInfo->getPerms();
            $size = $fileInfo->getSize();
            $mtime = $fileInfo->getMTime();
        } catch (Exception $ex){
            $parms = 0;
            $size = 0;
            $mtime = 0;
        }
        $filename = $fileInfo->getFilename();
        if ($fileInfo->isDot()) {
            if ($filename === ".." && $path !== ".") {
                $filename = sprintf('<a href="%s?path=%s">%s</a>', $_SERVER["SCRIPT_NAME"], dirname($path) , $filename);
            }
        } elseif ($fileInfo->isDir()) {
            $filename = sprintf('<a href="%s?path=%s/%s">%s</a>', $_SERVER["SCRIPT_NAME"], $path , $filename, $filename);
        } elseif ($fileInfo->isFile()) {
            $filename = sprintf('<a href="%s?path=%s/%s">%s</a>', $PATH_TO_CAT_PHP, $path , $filename, $filename);
        }
        printf("%s %8d %s %s\n", perm_to_str($perms), $size, date("Y-m-d H:i:s", $mtime), $filename);
    }
}
echo "</code></pre></html>\n";
