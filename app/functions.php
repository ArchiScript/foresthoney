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


function render_categories_tree($categories)
{
    $list ='';
    foreach ($categories as $category) {

        $list .= "<li>
       <a href='products.php?category={$category['id']}&pageid=" . md5(time()) . "'>{$category['category_name']}</a>";

    if (!empty($category['children'])) {
        $list .= "<ul>" . render_categories_tree($category['children']) . "</ul>";
    }

    $list .= "</li>";

   

    }
    return $list;
}


// Хлебные крошки

function generateBreadcrumbs($categories, $id)
{
    if (empty($id) || empty($categories[$id])) {
        return false;
    }

    $breadcrumbs = [];
    while (!empty($categories[$id])) {
        $category = $categories[$id];
        $breadcrumbs[$category['id']] = $category['category_name'];
        $id = $category['parent_id'];
    }

    return array_reverse($breadcrumbs, true);
}
// Получение ID дочерних категорий
function cats_id($array, $id)
{
    if (!$id) {
        return false;
    }

    foreach ($array as $item) {
        $data="";
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
        return false;
    }

        $con = new Connection();
        $prodarr=$con->queryObj("SELECT * FROM `honeyproducts`  WHERE `id` = $id");
        return $prodarr[0];
    
    
}