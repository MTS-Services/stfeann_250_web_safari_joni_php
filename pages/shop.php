<?php
include_once __DIR__ . '/../config/config.php';
include_once __DIR__ . '/../config/function.php';

$perPage = 2;
$products = getPaginatedProducts($perPage);  // rows for current page
$totalRows = getTotalProductCount();          // total rows
$totalPages = ceil($totalRows / $perPage);     // page count
$currentPage = isset($_GET['paginate']) && is_numeric($_GET['paginate'])
    ? (int) $_GET['paginate']
    : 1;
?>




<section id="page">
    <header>
        <section class="shop-hero-section">
            <img src="../public/images/shop.png" alt="Fitness Background" class="shop-hero-image">
            <div class="shop-hero-overlay">
                <div class="shop-hero-content">
                    <h1 class="shop-hero-title">
                        <span class="shop-hero-title-line">Treina</span>
                        <span class="shop-hero-title-line">Mais</span>
                    </h1>
                    <p class="shop-hero-subtitle">
                        O que fazer para <br> melhorar o teu progresso
                    </p>
                </div>
            </div>
        </section>
    </header>
    <main>
        <section>
            <div class="shop-products-container">
                <div class="shop-grid">
                    <?php foreach ($products as $product): ?>
                        <div class="product-card">
                            <a class="product-card-link" href="?page=details&id=<?= $product['id'] ?>"
                                aria-label="View Product <?= $product['name'] ?> details"></a>
                            <div class="product-card-image-wrapper">
                                <img src="/public/uploads/products/<?= $product['product_image'] ?>"
                                    alt="<?= $product['name'] ?>" class="product-card-image" loading="lazy" width="340"
                                    height="340">
                                <div class="product-card-image-overlay"></div>
                            </div>
                            <div class="product-card-content">
                                <h3 class="product-card-title"><?= $product['name'] ?></h3>
                                <div class="product-card-ratings">
                                    <div class="product-card-stars">
                                        <span>⭐⭐⭐⭐<span class="product-card-star-gray">⭐</span></span>
                                    </div>
                                    <span class="product-card-rating-text">(<?= rand(3, 5) ?>.0)</span>
                                </div>
                                <div class="product-card-info">
                                    <span class="product-card-price"><?= number_format($product['price'], 2) ?>€</span>
                                    <button type="button" class="product-card-button"
                                        aria-label="Add <?= $product['name'] ?> to cart">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="product-card-button-icon" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="product-card-button-text">Add to Cart</span>
                                        <span class="product-card-button-text-sm">Add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                </div>
            </div>
            <div class="pagination-container">
                <!-- Previous Page -->
                <?php if ($currentPage > 1): ?>
                    <a href="?page=shop&paginate=<?= $currentPage - 1 ?>" class="pagination-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </a>
                <?php else: ?>
                    <button class="pagination-button disabled" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                        </svg>
                    </button>
                <?php endif; ?>

                <!-- Page Links -->
                <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <a href="?page=shop&paginate=<?= $i ?>"
                        class="pagination-link <?= $i == $currentPage ? 'current-page' : '' ?>">
                        <?= $i ?>
                    </a>
                <?php endfor; ?>

                <!-- Next Page -->
                <?php if ($currentPage < $totalPages): ?>
                    <a href="?page=shop&paginate=<?= $currentPage + 1 ?>" class="pagination-button">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                <?php else: ?>
                    <button class="pagination-button disabled" disabled>
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </button>
                <?php endif; ?>
            </div>
        </section>
    </main>
</section>