<?php
require_once "Connection.php";
require_once "functions.php";

$categories      = get_cat();
$categories_tree = getTree($categories);
$categories_menu = render_categories_tree($categories_tree);


// echo "<pre>";
// print_r($categories_tree);
// echo "</pre>";

// Хлебные крошки
if (isset($_GET['category'])) {
    $category_id = (int) $_GET['category'];

    $breadcrumbs_array = generateBreadcrumbs($categories, $category_id);
    
    if ($breadcrumbs_array) {
        $breadcrumbs = "<a href='index.php'>Главная</a>  /  ";
        foreach ($breadcrumbs_array as $id => $title) {
            $breadcrumbs .= "<a href='?category={$id}'>{$title}</a> / ";
        }
        $breadcrumbs = rtrim($breadcrumbs, " / ");
        $breadcrumbs = preg_replace("/(.+)?<a.+>(.+)<\/a>$/", "$1$2", $breadcrumbs);
        $active_link = end($breadcrumbs_array);
    } else {
        $breadcrumbs = "<a id='allproducts_link' href='index.php'>Главная </a> / Все товары ";
        $active_link = "Все товары";

    }

    $ids = cats_id($categories, $category_id);
   $ids = !$ids ? $category_id : rtrim($ids, ",");
   
   $con = new Connection();
   
   if ($category_id == 0 ) {
     $arr = $con->queryObj("SELECT * FROM `honeyproducts`");
   } else {
       if ($ids) {
   
           $arr = $con->queryObj("SELECT * FROM `honeyproducts`  WHERE  `category_id` IN($ids) ORDER BY `category`");
       } else { $arr = $con->queryObj("SELECT * FROM `honeyproducts` WHERE `category_id` = '0'");}
   
   } 

} else {
   $breadcrumbs = "<a href='index.php'>Главная </a> / Корзина";
  
   
  
  }
// id дочерних категорий  и вывод товаров