<section id="detail" class="bg-white">
    <section class="detail-section">
        <div class="detail-container">
            <div class="detail-left">
                <div class="detail-image-box">
                    <img id="mainImage" src="../public/images/product (5).PNG" alt="Main Product" class="detail-main-image" />
                </div>
                <div class="detail-slider-wrapper">
                    <div id="thumbnailScroll" class="detail-no-scrollbar">
                        <img src="../public/images/product (1).PNG" alt="Thumb 1" />
                        <img src="../public/images/product (2).PNG" alt="Thumb 2" />
                        <img src="../public/images/product (3).PNG" alt="Thumb 3" />
                        <img src="../public/images/product (4).PNG" alt="Thumb 4" />
                    </div>
                </div>
            </div>

            <div class="detail-product-info">
                <p>Home / T-shirt Valgrit</p>
                <h1 class="detail-title">Product Name</h1>
                <div class="detail-rating">★★★★☆ <span>(4.5 Rating)</span></div>
                <div class="detail-price">Price: 29.99€</div>
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
                        Descrição do ProdutoCriado para quem dá tudo em cada treino, este modelo combina performance, conforto e estilo num só.Fabricado com materiais respiráveis e de secagem rápida, adapta-se aos movimentos do teu corpo e mantém-te focado, mesmo nas sessões mais intensas. A costura reforçada e o corte ergonómico garantem liberdade total de movimentos — sem distrações, sem limitações.Ideal para treino de força, cardio ou uso no dia a dia. Porque quem vive com disciplina merece roupa à altura da sua dedicação.Porque vestir-se bem também é parte do mindset.Destaques:Tecido técnico com elasticidade e respirabilidadeSecagem rápidaCorte atlético e confortávelCosturas reforçadas para maior durabilidadeProduzido localmente com atenção ao detalhe
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
                <?php for ($i = 1; $i < 9; $i++): ?>
                   
                        <div class="swiper-slide detail-related-card">
                            <img src="../public/images/product (<?= $i ?>).PNG" alt="Product Image <?= $i ?>" />
                            <div class="detail-related-info">
                                <h5>Static Title</h5>
                                <h4>Static Price</h4>
                            </div>
                        </div>
                    
                <?php endfor; ?>
            </div>
        </div>
    </section>


</section>