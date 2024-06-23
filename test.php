<?php
// 示例环境变量
$_ENV['BASE_URL'] = 'https://example.net';

// 从环境变量获取 Base URL
$base_url = rtrim('https://' . $_ENV['BASE_URL'], '/'); // 确保没有多余的斜线

$csv_path = __DIR__ . '/url.csv';
if (file_exists($csv_path)) {
    $imgs_array = file($csv_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $imgs_array = array_map(function ($line) use ($base_url) {
        return $base_url . '/' . ltrim($line, '/');
    }, $imgs_array);
} else {
    $imgs_array = array('https://http.cat/503'); // 如果找不到url.csv，默认值
}

// 拼接URL并打印结果
foreach ($imgs_array as $url) {
    echo $url . "\n";
}
?>

