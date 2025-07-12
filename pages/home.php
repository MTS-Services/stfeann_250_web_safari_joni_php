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
                    <?php for ($i = 1; $i <= 8; $i++) : ?>
                        <div class="swiper-slide home_page_category-slide">
                            <a href="#" class="home_page_slide-link"></a>
                            <div class="home_page_category-image-container">
                                <img src="../public/images/f<?= $i ?>.png" alt="Fitness Wear Category" class="home_page_category-image">
                            </div>
                            <div class="home_page_category-info">
                                <p class="home_page_category-name">Yoga Gear</p>
                            </div>
                        </div>
                    <?php endfor; ?>
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
                <?php for ($i = 1; $i <= 3; $i++) : ?>
                    <div class="home_page_product-card">
                        <a href="#" class="home_page_card-link"></a>
                        <div class="home_page_product-image-container">
                            <img src="../public/images/n<?= $i ?>.png" alt="Premium Sports Legging" class="home_page_product-image">
                            <div class="home_page_product-image-overlay"></div>
                        </div>
                        <div class="home_page_product-info">
                            <div class="home_page_product_info_wrapper">
                                <h3 class="home_page_product-name">Legging Esportiva Premium</h3>
                                <div class="home_page_product-rating">
                                    <div class="home_page_stars">
                                        ⭐⭐⭐⭐<span class="home_page_star-gray">⭐</span>
                                    </div>
                                    <span class="home_page_rating-value">(4.0)</span>
                                </div>
                            </div>
                            <div class="home_page_product-actions">
                                <span class="home_page_product-price">29.90€</span>
                                <button class="home_page_add-to-cart-button">
                                    <span class="home_page_button-text-desktop">Add to Cart</span>
                                    <span class="home_page_button-text-mobile">Add</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
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
                <h1 class="home_page_section-title">Experimente a Diferença da Valgrit</h1>
                <p>
                    Na Valgrit, não vendemos apenas roupa desportiva – entregamos uma experiência de performance e conforto incomparáveis.
                    <br><strong>Porque Escolher Valgrit?</strong><br>
                    - Durabilidade Superior: resistente ao treino intenso e lavagens frequentes.<br>
                    - Conforto Inigualável: tecidos respirráveis que se movem consigo.<br>
                    - Estilo Que Inspira: designs modernos que aumentam a confiança.<br>
                    - Investimento Inteligente: peças que duram anos.<br>
                    <br>Não se contente com menos. Eleve o seu treino com Valgrit!
                </p>
            </div>
        </div>
    </section>
