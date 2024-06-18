<?php
error_reporting(E_ERROR);
require_once 'imgdata.php';
$karnc = new imgdata();

/**
 * 检查 GET 请求中是否存在指定查询参数
 * @param $query
 * @return bool
 */
function has_query($query)
{
    return isset($_GET[$query]);
}

// 读取 url.csv 文件中的图片链接
if (file_exists(__DIR__ . '/../url.csv')) { // Adjusted to locate url.csv in parent directory
    $imgs_array = file(__DIR__ . '/../url.csv', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
} else {
    $imgs_array = array('https://http.cat/503'); // Default if url.csv not found
}

// 随机选择图片链接
$len = count($imgs_array);
$id = array_rand($imgs_array);
$img = $imgs_array[$id];

/**
 * 域名白名单校验函数
 * @param $domain_list
 * @return true/false
 */
function checkReferer($domain_list = array(
    'marxchou.com',
    'mch.icu'
)) {
    $status = false;
    $refer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : ''; //前一URL
    if ($refer) {
        $referhost = parse_url($refer);
        /**来源地址主域名**/
        $host = strtolower($referhost['host']);
        $host_parts = explode('.', $host);
        $domain_parts = array_slice($host_parts, -2); // 获取主域名
        $domain = implode('.', $domain_parts);
        if ($host == $_SERVER['HTTP_HOST'] || in_array($domain, $domain_list)) {
            $status = true;
        }
    }
    return $status;
}

// 随机选择图片链接并获取其内容
$imgData = file_get_contents($img);
if ($imgData === false) {
    $img = 'https://http.cat/404'; // Use a default image if the selected one is not accessible
    $imgData = file_get_contents($img);
}

// 处理图片输出
$karnc->imgdata = $imgData;
$karnc->imgform = 'image/jpeg'; // Assuming all images are JPEG, adjust accordingly
$refer = $_SERVER['HTTP_REFERER']; //前一URL

//存在前一URL
if ($refer) {
    if (!checkReferer()) {
        $karnc->getdir('nico.gif'); // Path to default image
        $karnc->img2data();
        $karnc->data2img();
        die;
    } else {
        $karnc->data2img();
        die;
    }
} else {
    //直接访问API地址
    $imgWeb = file_get_contents(__DIR__ . '/../imgweb.html'); // Adjusted to locate imgweb.html in parent directory
    echo $imgWeb;
    die;
}
?>

