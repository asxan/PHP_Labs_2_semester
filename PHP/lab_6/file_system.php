<?php
require('header.php');
// Get all files from current directory or use path from GET
function get_dir_files() {
    $dir_path = __DIR__;
    $skip_back = true;
    if (!empty($_GET['path']) && file_exists($_GET['path']) && strpos($_GET['path'], __DIR__) !== false && strpos($_GET['path'], '/..') === false) {
        if ($_GET['path'] != __DIR__) {
            $dir_path = $_GET['path'];
            $skip_back = false;
        }
    }
    $dir_files = scandir($dir_path);
    $files = [];
    foreach ($dir_files as $file) {
        if ($file == '.' || ($skip_back && $file == '..')) continue;
        $path = $dir_path . '/' . $file;
        $info = get_info($path, $file);
        $files[] = [
            'name' => $info['name'],
            'path' => $info['path'],
            'type' => $info['type'],
            'size' => $info['size'],
            'date' => $info['date'],
        ];
    }
    sort_files($files);
    return $files;
}

// Generate file info
function get_info($path, $filename) {
    $type = 'directory';
    $size = '-';
    $name = $filename;
    $dir_path = '';
    if (is_dir($path)) {
        $dir_path = '<a href="?path='. realpath($path) .'">'. $filename .'</a>';
    } else {
        $type = 'file';
        $size = filesize($path);
    }
    return [
        'name' => $name,
        'path' => $dir_path,
        'type' => $type,
        'size' => $size,
        'date' => filemtime($path),
    ];
}

// Get correct file size name
function file_size_convert($bytes)
{
    $bytes = floatval($bytes);
    $arBytes = array(
        0 => array(
            "UNIT" => "TB",
            "VALUE" => pow(1024, 4)
        ),
        1 => array(
            "UNIT" => "GB",
            "VALUE" => pow(1024, 3)
        ),
        2 => array(
            "UNIT" => "MB",
            "VALUE" => pow(1024, 2)
        ),
        3 => array(
            "UNIT" => "KB",
            "VALUE" => 1024
        ),
        4 => array(
            "UNIT" => "B",
            "VALUE" => 1
        ),
    );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

// Sorting function
function sort_files(&$files) {
    if (empty($_GET['sort'])) return;
    $sort_type = !empty($_GET['sort_type']) ? $_GET['sort_type'] : 'asc';
    foreach ($_GET['sort'] as $sort) {
        usort($files, function ($a, $b) use ($sort, $sort_type) {
            if ($sort == 'name') {
                if ($sort_type == 'desc') {
                    return - strcasecmp($a[$sort], $b[$sort]);
                }
                return strcasecmp($a[$sort], $b[$sort]);
            }
            if ($a[$sort] == $b[$sort]) {
                return 0;
            }
            if ($sort_type == 'desc') {
                return ($a[$sort] > $b[$sort]) ? -1 : 1;
            }
            return ($a[$sort] < $b[$sort]) ? -1 : 1;
        });
    }
}

// Created HTML for files result
function print_files() {
    $files = get_dir_files();
    if (empty($files)) {
        echo 'There are no files in this directory';
        return;
    }
    $html = '<table class="file-system-table">
      <tr>
        <th>Имя</th>
        <th>Тип</th>
        <th>Размер</th>
        <th>Дата создания</th>
      </tr>';
    foreach ($files as $file) {
        $html .= '<tr>
        <td>'. ($file["path"] ?: $file["name"]) .'</td>
        <td>'. $file["type"] .'</td>
        <td>'. file_size_convert($file["size"]) .'</td>
        <td>'. date('d-m-Y H:s:i', $file["date"]) .'</td>
      </tr>';
    }
    $html .= '</table>';
    return $html;
}
// Created GET query for sorting
function buildSortQuery($type) {
    $data = $_GET;
    if (!empty($data['sort']) && in_array($type, $data['sort'])) {
        unset($data['sort'][array_search($type, $data['sort'])]);
    } else {
        $data['sort'][] =  $type;
    }
    return http_build_query($data);
}
// Created GET query for sorting type
function buildSortTypeQuery($type) {
    $data = $_GET;
    if (!empty($data['sort_type'])) {
        unset($data['sort_type']);
    }
    $data['sort_type'] =  $type;
    return http_build_query($data);
}
?>
<div class="sorting">
    <a href="?<?= buildSortQuery('date'); ?>" <?= (isset($_GET['sort']) && in_array('date', $_GET['sort'])) ? 'style="color:green;"' : ''; ?>>дата создания</a>
    <a href="?<?= buildSortQuery('name'); ?>" <?= (isset($_GET['sort']) && in_array('name', $_GET['sort'])) ? 'style="color:green;"' : ''; ?>>имя</a>
    <a href="?<?= buildSortQuery('size'); ?>" <?= (isset($_GET['sort']) && in_array('size', $_GET['sort'])) ? 'style="color:green;"' : ''; ?>>размер</a>

    <a href="?<?= buildSortTypeQuery('asc'); ?>" <?= (!isset($_GET['sort_type']) || $_GET['sort_type'] == 'asc') ? 'style="color:green;"' : ''; ?>>ASC</a>
    <a href="?<?= buildSortTypeQuery('desc'); ?>" <?= (isset($_GET['sort_type']) && $_GET['sort_type'] =='desc') ? 'style="color:green;"' : ''; ?>>DESC</a>
</div>
<div class="file-table">
    <?= print_files(); ?>
</div>
<? require('footer.php'); ?>