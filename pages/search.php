<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';

$searchValue = $_GET['value'] ?? '';
$searchValue = trim($searchValue);
$products = getSearchProducts($searchValue);

?>


<section class="search_page_section">
  <div class="search_page_container">
    <h1 class="search_page_title">Search Result</h1>

    <!-- Product Grid -->
    <?php if (count($products) == 0): ?>
      <h2 class="search_page_product-title">No products found</h2>
    <?php else:
      foreach ($products as $product): ?>
        <div class="search_page_product-grid">

          <!-- Product Card -->

          <div class="search_page_product-card">
            <div class="search_page_product-image">
              <a href="details.html" style="position:absolute;top:0;left:0;right:0;bottom:0;z-index:10;"></a>
              <img src="../public/images/n1.png" alt="Product Name">
            </div>

            <div class="search_page_product-content">
              <div>
                <div class="search_page_product-title"><?= htmlspecialchars($product['name']) ?></div>
                <div class="search_page_stars">
                  <!-- 4 yellow stars -->
                  <svg viewBox="0 0 20 20">
                    <polygon
                      points="10,1 12.59,7.36 19.51,7.36 13.97,11.63 16.56,17.99 10,13.72 3.44,17.99 6.03,11.63 0.49,7.36 7.41,7.36" />
                  </svg>
                  <svg viewBox="0 0 20 20">
                    <polygon
                      points="10,1 12.59,7.36 19.51,7.36 13.97,11.63 16.56,17.99 10,13.72 3.44,17.99 6.03,11.63 0.49,7.36 7.41,7.36" />
                  </svg>
                  <svg viewBox="0 0 20 20">
                    <polygon
                      points="10,1 12.59,7.36 19.51,7.36 13.97,11.63 16.56,17.99 10,13.72 3.44,17.99 6.03,11.63 0.49,7.36 7.41,7.36" />
                  </svg>
                  <svg viewBox="0 0 20 20">
                    <polygon
                      points="10,1 12.59,7.36 19.51,7.36 13.97,11.63 16.56,17.99 10,13.72 3.44,17.99 6.03,11.63 0.49,7.36 7.41,7.36" />
                  </svg>
                  <!-- 1 gray star -->
                  <svg class="search_page_gray" viewBox="0 0 20 20">
                    <polygon
                      points="10,1 12.59,7.36 19.51,7.36 13.97,11.63 16.56,17.99 10,13.72 3.44,17.99 6.03,11.63 0.49,7.36 7.41,7.36" />
                  </svg>
                  <span style="font-size: 0.75rem; color: #6b7280; margin-left: 4px;">(4.0)</span>
                </div>
              </div>

              <p class="search_page_product-description">
                <?= htmlspecialchars($product['description']) ?>
              </p>

              <div class="search_page_product-footer">
                <div class="search_page_product-price"><?= $product['price'] ?>€</div>
                <a href="details.php?id=<?= $product['id'] ?>" class="search_page_view-button">
                  <!-- cart icon -->
                  <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                    stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                      d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m4-9v9m4-9l2 9" />
                  </svg>
                  View Details
                </a>
              </div>
            </div>
          </div>

        </div>
      <?php endforeach; endif; ?>
  </div>
</section>