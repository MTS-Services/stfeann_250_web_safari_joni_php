<?php
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/../config/function.php';

    $category_id = $_GET['category_id'] ?? ''; 
    
    // Fetch products for the category
    $products = getCategoryProducts($category_id);
?>
<style>
     .dark-mode body {
            background-color: #1f1f1f;
        }
 
        .category-section-container {
            padding: 4rem 1rem;
            margin-top: 5rem;
            min-height: 493px;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 2.5rem;
        }
 
        .category-section-container h2 {
            width: 100%;
            max-width: 1280px;
            font-size: 1.5rem;
        }
 
        .category-section-container h2 span {
            color: #ef4444;
            font-weight: bold;
            font-size: 1.875rem;
        }
 
        .category-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 columns for mobile */
            gap: 1.25rem;
            max-width: 1280px;
            width: 100%;
            padding: 2rem 1rem;
        }
 
        @media (min-width: 1024px) {
            .category-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
 
        @media (min-width: 1280px) {
            .category-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }
 
        .category-card {
            position: relative;
            overflow: hidden;
            background: white;
            border-radius: 0.5rem;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
 
        .category-card:hover {
            transform: translateY(-0.25rem);
            box-shadow: 0 10px 15px rgba(0,0,0,0.1);
        }
 
        .category-image-wrapper {
            position: relative;
            height: 220px;
            overflow: hidden;
            border: 1px solid #e5e7eb;
        }
 
        .category-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s;
        }
 
        .category-card:hover img {
            transform: scale(1.05);
        }
 
        .category-gradient-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.1), transparent, transparent);
            opacity: 0;
            transition: opacity 0.5s;
        }
 
        .category-card:hover .category-gradient-overlay {
            opacity: 0.2;
        }
 
        .category-card-content {
            padding: 0.75rem;
        }
 
        .category-card-content h3 {
            font-size: 0.875rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.25rem;
        }
 
        .category-ratings {
            display: flex;
            align-items: center;
            margin-bottom: 0.25rem;
        }
 
        .category-ratings svg {
            width: 0.875rem;
            height: 0.875rem;
        }
 
        .category-price-add {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 0.5rem;
        }
 
        .category-price {
            font-size: 0.875rem;
            font-weight: bold;
            color: #000;
        }
 
        .category-add-btn {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            background-color: #ef4444;
            color: white;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 0.375rem 0.625rem;
            border-radius: 0.375rem;
            border: none;
            cursor: pointer;
        }
 
        .category-add-btn:hover {
            background-color: #dc2626;
        }
 
        .category-add-btn svg {
            width: 1rem;
            height: 1rem;
        }
</style>
<div class="category-section-container">
    <!-- Category Name -->
    <h2><span>Category Name:</span> 
        <?php 
            // Fetch the category name based on the category_id, if needed
            $stmt = $pdo->prepare("SELECT name FROM categories WHERE id = ?");
            $stmt->execute([$category_id]);
            $category = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($category) {
                echo htmlspecialchars($category['name']);
            } else {
                echo "Category not found";
            }
        ?>
    </h2>

    <!-- Product Grid -->
    <div class="category-grid">
        <?php foreach ($products as $product): ?>
            <div class="category-card">
                <a href="product.php?id=<?= htmlspecialchars($product['id']) ?>" style="position: absolute; inset: 0; z-index: 10;" aria-label="View product details"></a>
                <div class="category-image-wrapper">
                    <!-- Replace static image with product image -->
                    <img src="<?= htmlspecialchars($product['image'] ?? 'https://via.placeholder.com/300x220') ?>" alt="<?= htmlspecialchars($product['name']) ?>">
                    <div class="category-gradient-overlay"></div>
                </div>
                <div class="category-card-content">
                    <h3><?= htmlspecialchars($product['name']) ?></h3>
                    <div class="category-ratings">
                        <!-- Show ratings dynamically (assuming there is a rating field in your product table) -->
                        <?php
                            $rating = $product['rating'] ?? 0; // Assuming you have a rating column in your product table
                            for ($i = 0; $i < 5; $i++) {
                                if ($i < $rating) {
                                    echo '<svg fill="#facc15" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
                                } else {
                                    echo '<svg fill="#d1d5db" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>';
                                }
                            }
                        ?>
                        <span style="margin-left: 0.25rem; font-size: 0.75rem; color: gray;">(<?= number_format($rating, 1) ?>)</span>
                    </div>

                    <div class="category-price-add">
                        <span class="category-price"><?= htmlspecialchars($product['price']) ?>€</span>
                        <button class="category-add-btn">
                            <svg fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4..." />
                            </svg>
                            <span class="hidden sm:inline">Add</span>
                        </button>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
