<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/function.php';


$id = $_GET['id'] ?? null;

$product = getProduct($id);
$images = getProductImages($id);

?>
<div class="content">
    <div class="product-main">
        <!-- Image Section -->
        <div class="image-section">
            <div class="primary-image">
                <img src="/public/uploads/products/<?= $product['product_image'] ?>" alt="Neville Rowland Product">
            </div>
        </div>

        <!-- Details Section -->
        <div class="details-section">
            <!-- Price Section -->
            <div class="price-section">
                <h1><?= $product['name'] ?></h1>
                <div class="price">€<?= $product['price'] ?></div>
                <div class="price-label">Premium Quality Product</div>
            </div>

            <!-- Status Badges -->
            <div class="status-badges">
                <div class="badge active">
                    <i class="fas fa-check-circle"></i>
                    <?= $product['status'] == 1 ? 'Active' : 'Inactive' ?>
                </div>
                <div class="badge featured">
                    <i class="fas fa-star"></i>
                    <?= $product['is_featured'] == 1 ? 'Featured' : 'Not Featured' ?>
                </div>
            </div>

            <!-- Product Information -->
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-label">Product Slug</div>
                    <div class="info-value"><?= $product['slug'] ?></div>
                </div>
                <div class="info-card">
                    <div class="info-label">Stock Number</div>
                    <div class="info-value"><?= $product['stock_no'] ?></div>
                </div>
                <div class="info-card">
                    <div class="info-label">Category</div>
                    <div class="info-value"><?= $product['category_name'] ?></div>
                </div>
                <div class="info-card">
                    <div class="info-label">Description</div>
                    <div class="info-value"><?= $product['description'] ?></div>
                </div>
                <div class="info-card">
                    <div class="info-label">Created Date</div>
                    <div class="info-value"><?= date('Y-m-d', strtotime($product['created_at'])) ?></div>
                </div>
                <div class="info-card">
                    <div class="info-label">Last Updated</div>
                    <div class="info-value"><?= date('Y-m-d', strtotime($product['updated_at'])) ?></div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <a class="btn btn-primary" href="/backend.php?folder=products&page=edit&id=<?= $product['id'] ?>">
                    <i class="fas fa-edit"></i>
                    Edit Product
                </a>
            </div>
        </div>
    </div>

    <!-- Gallery Section -->
    <div class="gallery-section">
        <h2 class="section-title">
            <i class="fas fa-images"></i>
            Product Gallery
        </h2>
        <div class="gallery-grid">
            <?php foreach ($images as $image): ?>
                <div class="gallery-item">
                    <img src="/public/uploads/products/<?= $image['image'] ?>" alt="Gallery Image 1">
                    <div class="gallery-overlay">
                        <i class="fas fa-expand"></i>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>