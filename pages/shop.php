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
                    <?php for ($i = 1; $i <= 8; $i++) : ?>
                        <div class="product-card">
                            <a class="product-card-link" href="<?= BASE_URL ?>product-detail-<?= $i ?>.php" aria-label="View Product <?= $i ?> details"></a>
                            <div class="product-card-image-wrapper">
                                <img src="../public/images/product (<?= $i ?>).PNG" alt="Product <?= $i ?>" class="product-card-image" loading="lazy" width="340" height="340">
                                <div class="product-card-image-overlay"></div>
                            </div>
                            <div class="product-card-content">
                                <h3 class="product-card-title">Product <?= $i ?> Name</h3>
                                <div class="product-card-ratings">
                                    <div class="product-card-stars">
                                        <span>⭐⭐⭐⭐<span class="product-card-star-gray">⭐</span></span>
                                    </div>
                                    <span class="product-card-rating-text">(<?= rand(3, 5) ?>.0)</span>
                                </div>
                                <div class="product-card-info">
                                    <span class="product-card-price"><?= rand(15, 50) ?>.00€</span>
                                    <button type="button" class="product-card-button" aria-label="Add Product <?= $i ?> to cart">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="product-card-button-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                                        </svg>
                                        <span class="product-card-button-text">Add to Cart</span>
                                        <span class="product-card-button-text-sm">Add</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    <?php endfor; ?>
                </div>
            </div>
              <div class="pagination-container">
                <!-- Previous Button (Disabled) -->
                <button class="pagination-button disabled" disabled>
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </button>

                <!-- Page Numbers -->
                <a href="#" class="pagination-link current-page">1</a>
                <a href="#" class="pagination-link">2</a>
                <span class="pagination-ellipsis">...</span>
                <a href="#" class="pagination-link">5</a>

                <!-- Next Button -->
                <a href="#" class="pagination-button">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                    </svg>
                </a>
            </div>
        </section>
    </main>
</section>