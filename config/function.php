<?php
require_once __DIR__ . '/config.php';



function getAllCategories()
{
    global $pdo;
    $stmt = $pdo->query("SELECT * FROM categories ORDER BY sort_order ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getCategory($id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM categories WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// function getAllCategoryNames()
// {
//     global $pdo;
//     $stmt = $pdo->query("SELECT name FROM categories ORDER BY sort_order ASC");
//     return $stmt->fetchAll(PDO::FETCH_COLUMN);
// }
function getAllCategoryNames()
{
    global $pdo;
    $stmt = $pdo->query("SELECT id, name FROM categories ORDER BY sort_order ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductsByCategory($category_id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM products WHERE category_id = ?");
    $stmt->execute([$category_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getAllProducts()
{
    global $pdo;

    $stmt = $pdo->query("
        SELECT 
            products.*, 
            categories.name AS category_name
        FROM products
        LEFT JOIN categories ON products.category_id = categories.id
        ORDER BY products.sort_order ASC
    ");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// function getProduct($id)
// {
//     global $pdo;
//     $stmt = $pdo->prepare("SELECT * FROM products WHERE id = ?");
//     $stmt->execute([$id]);
//     return $stmt->fetch(PDO::FETCH_ASSOC);
// }
function getProduct($id)
{
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT products.*, categories.name AS category_name 
        FROM products 
        LEFT JOIN categories ON products.category_id = categories.id 
        WHERE products.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


function getAllUsers()
{
    $pdo = getDBConnection(); // Safe & proper connection
    $stmt = $pdo->query("SELECT * FROM users ORDER BY sort_order ASC");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function getUser($id)
{
    $pdo = getDBConnection(); // Safe & proper connection
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
