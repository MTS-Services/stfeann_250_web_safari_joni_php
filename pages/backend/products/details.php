<?php
require_once __DIR__ . '/../../../config/config.php';
require_once __DIR__ . '/../../../config/function.php';


$id = $_GET['id'] ?? null;

$product = getAllProducts();
var_dump($product);
die();
?>
<div class="content">
    <div class="product-main">
        <!-- Image Section -->
        <div class="image-section">
            <div class="primary-image">
                <img src="https://help.rangeme.com/hc/article_attachments/360006928633/what_makes_a_good_product_image.jpg"
                    alt="Neville Rowland Product">
            </div>
        </div>

        <!-- Details Section -->
        <div class="details-section">
            <!-- Price Section -->
            <div class="price-section">
                <div class="price">$202.00</div>
                <div class="price-label">Premium Quality Product</div>
            </div>

            <!-- Status Badges -->
            <div class="status-badges">
                <div class="badge active">
                    <i class="fas fa-check-circle"></i>
                    Active
                </div>
                <div class="badge featured">
                    <i class="fas fa-star"></i>
                    Featured
                </div>
            </div>

            <!-- Product Information -->
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-label">Product Slug</div>
                    <div class="info-value">Aperiam eius est dol</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Stock Number</div>
                    <div class="info-value">Esse nulla molestiae</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Category ID</div>
                    <div class="info-value">#17</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Description</div>
                    <div class="info-value">Nam quis quia sint</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Created Date</div>
                    <div class="info-value">July 14, 2025</div>
                </div>
                <div class="info-card">
                    <div class="info-label">Last Updated</div>
                    <div class="info-value">July 14, 2025</div>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="action-buttons">
                <button class="btn btn-primary">
                    <i class="fas fa-edit"></i>
                    Edit Product
                </button>
                <button class="btn btn-secondary">
                    <i class="fas fa-copy"></i>
                    Duplicate
                </button>
                <button class="btn btn-secondary">
                    <i class="fas fa-download"></i>
                    Export
                </button>
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
            <div class="gallery-item">
                <img src="https://images.pexels.com/photos/335257/pexels-photo-335257.jpeg"
                    alt="Gallery Image 1">
                <div class="gallery-overlay">
                    <i class="fas fa-expand"></i>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.pexels.com/photos/335257/pexels-photo-335257.jpeg"
                    alt="Gallery Image 2">
                <div class="gallery-overlay">
                    <i class="fas fa-expand"></i>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.pexels.com/photos/335257/pexels-photo-335257.jpeg"
                    alt="Gallery Image 3">
                <div class="gallery-overlay">
                    <i class="fas fa-expand"></i>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.pexels.com/photos/335257/pexels-photo-335257.jpeg"
                    alt="Gallery Image 4">
                <div class="gallery-overlay">
                    <i class="fas fa-expand"></i>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.pexels.com/photos/335257/pexels-photo-335257.jpeg"
                    alt="Gallery Image 5">
                <div class="gallery-overlay">
                    <i class="fas fa-expand"></i>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.pexels.com/photos/335257/pexels-photo-335257.jpeg"
                    alt="Gallery Image 6">
                <div class="gallery-overlay">
                    <i class="fas fa-expand"></i>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.pexels.com/photos/335257/pexels-photo-335257.jpeg"
                    alt="Gallery Image 7">
                <div class="gallery-overlay">
                    <i class="fas fa-expand"></i>
                </div>
            </div>
            <div class="gallery-item">
                <img src="https://images.pexels.com/photos/335257/pexels-photo-335257.jpeg"
                    alt="Gallery Image 8">
                <div class="gallery-overlay">
                    <i class="fas fa-expand"></i>
                </div>
            </div>
        </div>
    </div>
</div>