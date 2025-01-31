<?php
session_start();
date_default_timezone_set('Asia/Ho_Chi_Minh');
$create_at = date('Y-m-d H:i:s', $time);
function create_product($name, $image, $price, $sale, $des, $category)
{
    global $create_at;
    $sql = "INSERT INTO `products` (`id`, `name`, `image`, `price`, `sale`, `des`, `view`, `create_at`, `update_at`, `category_id`) VALUES (NULL, '$name', '$image', '$price', '$sale', '$des', '0', '$create_at', '$create_at', '$category')";
    pdo_execute($sql);
}
function get_product_filter($key_word, $select)
{
    $sql = "SELECT * FROM products WHERE products.name LIKE '%$key_word%' ";
    if ($select > 0) {
        $sql .= " AND category_id = '$select'";
    }
    $sql .= " ORDER BY id DESC";
    $list_products = pdo_query($sql);
    return $list_products;
}
function delete_product($id)
{
    $sql = "DELETE FROM products WHERE id='$id'";
    pdo_execute($sql);
}
function get_product_one($id)
{
    $sql = "SELECT * FROM products WHERE id='$id'";
    $item = pdo_query_one($sql);
    return $item;
}
function update_product($name, $image, $price, $sale, $des, $category, $id)
{
    global $create_at;
    $sql = "UPDATE products SET products.name = '$name', update_at='$create_at', products.image='$image',price='$price',sale='$sale',products.des='$des',category_id='$category' WHERE id = '$id' ";
    pdo_execute($sql);
}
function get_product_sale_limit($limit)
{
    $sql = "SELECT * FROM products WHERE sale > 0 ORDER BY sale DESC LIMIT $limit";
    $item = pdo_query($sql);
    return $item;
}
function get_product_limit($limit, $category)
{
    $sql = "SELECT * FROM products WHERE category_id = '$category' ORDER BY price DESC LIMIT $limit";
    $item = pdo_query($sql);
    return $item;
}
function get_product_list_filter($category, $price, $search, $sort, $page)
{
    $sql = "SELECT * FROM products";
    if ($category !== "") {
        $sql .= " WHERE category_id = '$category'";
    } else {
        $sql .= " WHERE 1";
    }
    if ($price !== "") {
        $sql .= " AND price BETWEEN $price";
    }
    $sql .= " AND name LIKE '%$search%'";
    if ($sort !== "") {
        $sql .= " ORDER BY price $sort";
    }
    if ($page !== "") {
        $sql .= " LIMIT $page";
    }
    $item = pdo_query($sql);
    return $item;
}
function get_product_detail($id)
{
    $sql = "SELECT * ,categories.name as category_name,products.name as product_name FROM products JOIN categories ON products.category_id = categories.id WHERE products.id = '$id'";
    $item = pdo_query_one($sql);
    return $item;
}
function count_product()
{
    $sql = "SELECT count(products.name) as count_product , categories.name as category_name FROM products JOIN categories ON products.category_id = categories.id GROUP BY products.category_id";
    $item = pdo_query($sql);
    return $item;
}
function count_view()
{
    $sql = "SELECT SUM(view) as count_view FROM products";
    $item = pdo_query_one($sql);
    return $item;
}
