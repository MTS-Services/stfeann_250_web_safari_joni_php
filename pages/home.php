
<?php
    require_once __DIR__ . '/../config/config.php';
    require_once __DIR__ . '/../config/function.php';
    $categories = getAllCategories();
    $products = getFeaturedProducts();
?>
<section id="page">

    <!-- Hero Section -->
    <section class="home_page_hero">
        <img src="../public/images/Foto_Principal.jpg" alt="Woman tying her shoelaces in a gym" class="home_page_hero-background-image">
        <div class="home_page_hero-overlay"></div>
        <div class="home_page_hero-content">
            <h1 class="home_page_hero-title">VALGRIT</h1>
            <p class="home_page_hero-subtitle">A NOSSA MISSAO</p>
            <a href="#saiba-mais" class="home_page_button-primary">SAIBA MAIS</a>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="home_page_categories-section">
        <div class="home_page_container">
            <div class="swiper home_page_categorySlider">
                <div class="swiper-wrapper">
                     
                    <?php foreach ($categories as $category): ?>
                        <div class="swiper-slide home_page_category-slide">
                            <a href="/../includes/category_product.php?id=<?= $category['id'] ?>" class="home_page_slide-link"></a>
                            <div class="home_page_category-image-container">
                                <img src="../public/uploads/<?= $category['image'] ?>" alt="Fitness Wear Category" class="home_page_category-image">
                            </div>
                            <div class="home_page_category-info">
                                <p class="home_page_category-name"><?= $category['name'] ?></p>
                            </div>
                        </div>
                     <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products Section -->
    <section class="home_page_featured-products-section">
        <div class="home_page_container home_page_text-center">
            <h2 class="home_page_section-title">Destaques</h2>
            <p class="home_page_section-subtitle">Descubra nossa coleção premium de roupas fitness</p>
            <div class="home_page_product-grid">
                 <?php foreach ($products as $product) : ?>
                    <div class="home_page_product-card">
                        <a href="/?page=details&id=<?= $product['id'] ?>" class="home_page_card-link"></a>
                        <div class="home_page_product-image-container">
                            <img src="../public/images/n1.png" alt="Premium Sports Legging" class="home_page_product-image">
                            <div class="home_page_product-image-overlay"></div>
                        </div>
                        <div class="home_page_product-info">
                            <div class="home_page_product_info_wrapper">
                                <h3 class="home_page_product-name"><?= $product['name'] ?></h3>
                                <div class="home_page_product-rating">
                                    <div class="home_page_stars">
                                        ⭐⭐⭐⭐<span class="home_page_star-gray">⭐</span>
                                    </div>
                                    <span class="home_page_rating-value">(4.0)</span>
                                </div>
                            </div>
                            <div class="home_page_product-actions">
                                <span class="home_page_product-price"><?= $product['price'] ?>€</span>
                                <button class="home_page_add-to-cart-button">
                                    <span class="home_page_button-text-desktop">Add to Cart</span>
                                    <span class="home_page_button-text-mobile">Add</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="home_page_about-section">
        <div class="home_page_about-container">
            <div class="home_page_about-image-wrapper">
                <img src="../public/images/Foto_Principal.jpg" alt="Woman in athletic wear posing" class="home_page_about-image">
            </div>
            <div class="home_page_about-content">
                <h1 class="home_page_section-title">Experimente a Diferença da Valgrit: Qualidade Que Se Sente em Cada Fibra!</h1>
                <p>
                    Na Valgrit, não vendemos apenas roupa desportiva – entregamos uma experiência de performance e conforto incomparáveis.
  Cada peça é cuidadosamente desenhada e fabricada com os melhores materiais, garantindo que se sinta no seu melhor, quer esteja a superar os seus limites no ginásio ou a desfrutar de uma corrida ao ar livre.
<br/><br/>
Porque Escolher Valgrit?
<br/><br/>
Durabilidade Superior: Feita para durar, a nossa roupa resiste ao desgaste do treino intenso e às lavagens frequentes, mantendo a sua forma e cor como novas por muito mais tempo. Diga adeus à roupa que cede ou desbota após algumas utilizações!
<br/><br/>
Conforto Inigualável: Selecionamos tecidos respiráveis e de toque suave que se movem consigo, proporcionando liberdade total de movimentos e mantendo a sua pele fresca e seca, mesmo nos treinos mais exigentes. Sinta a diferença de um conforto que o impulsiona.
<br/><br/>
Estilo Que Inspira: Com designs modernos e cortes que realçam a sua silhueta, a roupa Valgrit fará com que se sinta confiante e motivado. Porque sabemos que quando se sente bem, treina melhor.
<br/><br/>
Investimento Inteligente: Ao escolher Valgrit, está a investir em peças que o acompanharão nas suas jornadas desportivas por anos. Menos compras, mais treinos, mais resultados.

  Não se contente com menos. Eleve o seu treino e o seu estilo com a Valgrit. Sinta a qualidade, viva a performance! Visite a nossa loja online e descubra a peça perfeita para si.
                </p>
            </div>
        </div>
    </section>
