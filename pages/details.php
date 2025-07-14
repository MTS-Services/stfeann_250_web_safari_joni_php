<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';

$data = [
    'name' => '',
    'slug' => '',
    'stock_no' => '',
    'description' => '',
    'price' => '',
    'category_id' => '',
];

$id = isset($_GET['id']) ? intval($_GET['id']) : null;
if (!empty($id)) {
    $data = getProduct($id);
}
$images = getProductImages($id);
$products = getAllProducts();
?>
<section id="detail" class="bg-white">
    <section class="detail-section">
        <div class="detail-container">
            <div class="detail-left">
                <div class="detail-image-box">
                    <img id="mainImage" src="/public/uploads/products/<?= $data['product_image'] ?>" alt="Main Product"
                        class="detail-main-image" />
                </div>
                <div class="detail-slider-wrapper">
                    <div id="thumbnailScroll" class="detail-no-scrollbar">
                        <?php foreach ($images as $image): ?>
                            <img src="/public/uploads/products/<?= $image['image'] ?>" alt="Thumb 2" />
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="detail-product-info">
                <p>Home / T-shirt Valgrit</p>
                <h1 class="detail-title"><?= htmlspecialchars($data['name']) ?></h1>
                <div class="detail-rating">★★★★☆ <span>(4.5 Rating)</span></div>
                <div class="detail-price">Price: <?= $data['price'] ?>€</div>
                <div class="detail-options">
                    <div>
                        <label for="size">Size:</label>
                        <select id="size">
                            <option disabled selected>Tamanho</option>
                            <option value="s">S</option>
                            <option value="m">M</option>
                            <option value="l">L</option>
                            <option value="l">XL</option>
                            <option value="l">XXL</option>
                        </select>
                    </div>
                    <div>
                        <label for="quantity">Quantity:</label>
                        <input type="number" id="quantity" value="1" min="1" />
                    </div>
                </div>
                <button class="detail-add-cart">Adicionar ao Carrinho</button>
                <div class="detail-description">
                    <h2>Descrição</h2>
                    <p>
                        <?= htmlspecialchars($data['description']) ?>
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="detail-related">
        <h2 class="detail-related-title">Recommended Products</h2>
        <p>New arrivals for your wardrobe</p>
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <?php foreach ($products as $product): ?>

                    <div class="swiper-slide detail-related-card">
                       <div class="detail-related-image-box">
                         <img  src="/public/uploads/products/<?= $product['product_image'] ?>" alt="Product Image" />
                       </div>
                        <div class="detail-related-info">
                            <h5><?= htmlspecialchars($product['name']) ?></h5>
                            <h4>$<?= $product['price'] ?></h4>
                        </div>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
    </section>


</section>