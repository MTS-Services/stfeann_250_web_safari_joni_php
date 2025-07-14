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

    // $stmt = $pdo->query("
    //     SELECT 
    //         products.*, 
    //         categories.name AS category_name
    //     FROM products
    //     LEFT JOIN categories ON products.category_id = categories.id
    //     ORDER BY products.sort_order ASC
    // ");
    $stmt = $pdo->query(" 
    SELECT 
        products.*, 
        categories.name AS category_name,
        product_images.image AS product_image
    FROM products
    LEFT JOIN categories ON products.category_id = categories.id
    LEFT JOIN product_images ON product_images.product_id = products.id
    ORDER BY products.updated_at DESC
");


    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getProductImages($product_id)
{
    global $pdo;
    $stmt = $pdo->prepare("SELECT * FROM product_images WHERE product_id = ?");
    $stmt->execute([$product_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function getFeaturedProducts()
{
    global $pdo;

    $stmt = $pdo->query("
        SELECT 
            products.*, 
            categories.name AS category_name
        FROM products
        LEFT JOIN categories ON products.category_id = categories.id
        WHERE products.is_featured = 1
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
        SELECT 
        products.*, 
        categories.name AS category_name,
        product_images.image AS product_image
        FROM products
        LEFT JOIN categories ON products.category_id = categories.id
        LEFT JOIN product_images ON product_images.product_id = products.id
        WHERE products.id = ?
    ");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function getSearchProducts(string $searchValue): array
{
    global $pdo;


    $searchValue = sanitizeInput($searchValue);
    if (empty($searchValue)) {
        return []; // Return empty array if search value is empty
    }
    // Wrap term in wildcards without extra spaces
    $like = "%{$searchValue}%";

    $sql = "
        SELECT products.*, categories.name AS category_name
        FROM products
        LEFT JOIN categories ON products.category_id = categories.id
        WHERE products.name        LIKE :like
           OR products.description LIKE :like
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->execute(['like' => $like]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
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
function getCategoryProducts($category_id)
{
    global $pdo;
    $stmt = $pdo->prepare("
        SELECT products.*, categories.name AS category_name
        FROM products
        LEFT JOIN categories ON products.category_id = categories.id
        WHERE products.category_id = ?
    ");
    $stmt->execute([$category_id]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}



/**
 * Fetch a page of products with their category name.
 *
 * @param int  $perPage  How many products per page (default 10)
 * @return array         The queried rows as associative arrays
 */
function getPaginatedProducts(int $perPage = 10): array
{
    global $pdo;

    // Current page from the query‑string, fallback to 1
    $currentPage = isset($_GET['paginate']) && is_numeric($_GET['paginate'])
        ? (int) $_GET['paginate']
        : 1;

    // Calculate the first row for this page (OFFSET)
    $offset = ($currentPage - 1) * $perPage;

    $sql = "
        SELECT  products.*,
                categories.name AS category_name
        FROM    products 
        LEFT JOIN categories ON products.category_id = categories.id
        ORDER BY products.sort_order ASC
        LIMIT   :limit
        OFFSET  :offset
    ";

    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Count total products (for page‑count calculation).
 *
 * @return int  Total number of rows in `products`
 */
function getTotalProductCount(): int
{
    global $pdo;

    // No need to join here; COUNT(*) on products is enough
    $stmt = $pdo->query("SELECT COUNT(*) FROM products");
    return (int) $stmt->fetchColumn();
}
