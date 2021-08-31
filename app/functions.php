<?php
require_once "Connection.php";


// Распечатать массив
function debug($array)
{
    echo "<pre>" . print_r($array, true) . "</pre>";
}

function getTree($data)
{
    $tree = [];

    foreach ($data as $id => &$node) {
        if (!$node['parent_id']) {
            $tree[$id] = &$node;
        } else {
            $data[$node['parent_id']]['children'][$id] = &$node;
        }
    }
    return $tree;

}

// Получение массива категорий

function get_cat()
{
    $con = new Connection();
    $arr = $con->queryArray("SELECT * FROM `categories`");
    return $arr;
}

function categories_to_string($data)
{
    foreach ($data as $item) {
        $str = $str . categories_to_template($item);

    }
    return $str;
}

// Шаблон вывода категорий

function categories_to_template($category)
{
    ob_start();
    include 'category_template.php';
    return ob_get_clean();
};

// Хлебные крошки
function breadcrumbs($array, $id)
{
    if (!$id) {
        return false;
    }

    $count             = count($array);
    $breadcrumbs_array = array();
    for ($i = 0; $i <= $count; $i++) {
        if ($array[$id]) {
            $breadcrumbs_array[$array[$id]['id']] = $array[$id]['category_name'];
            $id                                   = $array[$id]['parent_id'];

        } else {
            break;
        }

    }
    return array_reverse($breadcrumbs_array, true);
}

// Получение ID дочерних категорий
function cats_id($array, $id)
{
    if (!$id) {
        return false;
    }

    foreach ($array as $item) {
        if ($item['parent_id'] == $id) {

            $data .= ($item['id']) . ",";
            $data .= cats_id($array, $item['id']);
        }
    }
    return $data;
}

// Найти товар по ID

function get_product($id){
    if(!$id){
        return false;}

        $con = new Connection();
        $prodarr=$con->queryObj("SELECT * FROM `honeyproducts`  WHERE `id` = $id");
        return $prodarr;
    
    
}