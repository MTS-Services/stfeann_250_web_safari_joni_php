<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/function.php';

$searchValue = $_GET['value'] ?? '';
$searchValue = trim($searchValue);
$products = getSearchProducts($searchValue);

?>
<style>
  /* General Styling */
  .search_page_section {
    margin: 4rem 0;
    background-color: #f3f4f6;
    padding: 2rem 1rem;
  }

  .search_page_container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 1rem;
  }

  .search_page_title {
    font-size: 2.5rem;
    font-weight: bold;
    padding: 2rem 0;
    text-align: left;
  }

  /* Product Grid */
  .search_page_product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 1.5rem;
  }

  /* Product Card Wrapper Link */
  .search_page_product-link {
    text-decoration: none;
    color: inherit;
    display: block;
    transition: box-shadow 0.3s;
    border-radius: 0.5rem;
  }

  .search_page_product-link:hover {
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
  }

  /* Product Card */
  .search_page_product-card {
    display: flex;
    flex-direction: column;
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    height: 100%;
    transition: transform 0.3s ease;
  }

  .search_page_product-card:hover {
    transform: translateY(-4px);
  }

  /* Product Image */
  .search_page_product-image {
    height: 250px;
    width: 100%;
    overflow: hidden;
    padding: 10px;
  }

  .search_page_product-image img {
    width: 100%;
    height: 100%;
    border-radius: 10px;
    object-fit: cover;
    transition: transform 0.5s;
  }

  .search_page_product-link:hover .search_page_product-image img {
    transform: scale(1.02);
  }

  /* Product Content */
  .search_page_product-content {
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
  }

  .search_page_product-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
  }

  .search_page_stars {
    display: flex;
    align-items: center;
    margin-bottom: 1rem;
  }

  .search_page_stars svg {
    width: 16px;
    height: 16px;
    fill: #facc15;
    margin-right: 2px;
  }

  .search_page_stars .search_page_gray {
    fill: #d1d5db;
  }

  .search_page_product-description {
    font-size: 0.875rem;
    color: #4b5563;
    line-height: 1.5;
    margin-bottom: 1rem;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
  }

  /* Product Footer */
  .search_page_product-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: auto;
  }

  .search_page_product-price {
    font-size: 1.25rem;
    font-weight: bold;
  }

  .search_page_view-button {
    background-color: #ef4444;
    color: white;
    border: none;
    border-radius: 0.375rem;
    padding: 0.5rem 1rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: background-color 0.3s;
    font-size: 0.875rem;
  }

  .search_page_product-link:hover .search_page_view-button {
    background-color: #dc2626;
  }

  /* Large Screens (1024px and up) */
  @media (min-width: 1024px) {
    .search_page_product-grid {
      grid-template-columns: repeat(auto-fit, minmax(600px, 1fr));
    }

    .search_page_product-card {
      flex-direction: row;
      height: 280px;
    }

    .search_page_product-image {
      width: 40%;
      height: 100%;
    }

    .search_page_product-content {
      width: 60%;
    }
  }

  /* Medium Screens (768px - 1023px) */
  @media (max-width: 1023px) and (min-width: 768px) {
    .search_page_title {
      font-size: 2rem;
    }

    .search_page_product-card {
      flex-direction: row;
    }

    .search_page_product-grid {
      grid-template-columns: repeat(auto-fit, minmax(450px, 1fr));
    }
  }

  /* Small Screens (480px - 767px) */
  @media (max-width: 767px) and (min-width: 480px) {
    .search_page_title {
      font-size: 1.75rem;
      padding: 1.5rem 0;
    }

    .search_page_product-image {
      height: 220px;
    }

    .search_page_product-content {
      padding: 1.25rem;
    }
  }

  /* Extra Small Screens (below 480px) */
  @media (max-width: 479px) {
    .search_page_section {
      margin: 2rem 0;
      padding: 1rem 0.5rem;
    }

    .search_page_title {
      font-size: 1.5rem;
      padding: 1rem 0;
    }

    .search_page_product-grid {
      grid-template-columns: 1fr;
      gap: 1rem;
    }

    .search_page_product-image {
      height: 200px;
    }

    .search_page_product-content {
      padding: 1rem;
    }

    .search_page_product-title {
      font-size: 1.1rem;
    }

    .search_page_product-description {
      font-size: 0.8125rem;
      -webkit-line-clamp: 2;
    }

    .search_page_product-price {
      font-size: 1.1rem;
    }

    .search_page_view-button {
      padding: 0.4rem 0.8rem;
      font-size: 0.8125rem;
    }
  }

  /* Very Small Screens (below 360px) */
  @media (max-width: 359px) {
    .search_page_product-image {
      height: 180px;
    }

    .search_page_product-footer {
      flex-direction: column;
      align-items: flex-start;
      gap: 0.75rem;
    }

    .search_page_view-button {
      width: 100%;
      justify-content: center;
    }
  }
</style>

<section class="search_page_section">
  <div class="search_page_container">
    <h1 class="search_page_title">Search Results</h1>

    <?php if (count($products) == 0): ?>
      <h2 class="search_page_product-title">No products found</h2>
    <?php else: ?>
      <div class="search_page_product-grid">
        <?php foreach ($products as $product): ?>
          <!-- Product Card -->
          <a href="details.php?id=<?= $product['id'] ?>" class="search_page_product-link">
            <div class="search_page_product-card">
              <div class="search_page_product-image">
                <img src="/public/uploads/products/<?= $product['product_image'] ?>"
                  alt="<?= htmlspecialchars($product['name']) ?>">
              </div>

              <div class="search_page_product-content">
                <div>
                  <div class="search_page_product-title"><?= htmlspecialchars($product['name']) ?></div>
                  <div class="search_page_stars">
                    <?php for ($i = 0; $i < 4; $i++): ?>
                      <svg viewBox="0 0 20 20">
                        <polygon
                          points="10,1 12.59,7.36 19.51,7.36 13.97,11.63 16.56,17.99 10,13.72 3.44,17.99 6.03,11.63 0.49,7.36 7.41,7.36" />
                      </svg>
                    <?php endfor; ?>
                    <svg class="search_page_gray" viewBox="0 0 20 20">
                      <polygon
                        points="10,1 12.59,7.36 19.51,7.36 13.97,11.63 16.56,17.99 10,13.72 3.44,17.99 6.03,11.63 0.49,7.36 7.41,7.36" />
                    </svg>
                    <span style="font-size: 0.75rem; color: #6b7280; margin-left: 4px;">(4.0)</span>
                  </div>
                </div>

                <p class="search_page_product-description">Descrição do ProdutoCriado para quem dá tudo em cada treino, este
                  modelo combina performance, conforto e estilo num só.Fabricado com materiais respiráveis e de secagem
                  rápida, adapta-se aos movimentos do teu corpo e mantém-te focado, mesmo nas sessões mais intensas. A
                  costura reforçada e o corte ergonómico garantem liberdade total de movimentos — sem distrações, sem
                  limitações.Ideal para treino de força, cardio ou uso no dia a dia. Porque quem vive com disciplina merece
                  roupa à altura da sua dedicação.Porque vestir-se bem também é parte do mindset.Destaques:Tecido técnico
                  com elasticidade e respirabilidadeSecagem rápidaCorte atlético e confortávelCosturas reforçadas para maior
                  durabilidadeProduzido localmente com atenção ao detalhe</p>

                <div class="search_page_product-footer">
                  <div class="search_page_product-price"><?= $product['price'] ?>€</div>
                  <button class="search_page_view-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="none" stroke="currentColor"
                      stroke-width="2" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2 9m5-9v9m4-9v9m4-9l2 9" />
                    </svg>
                    View Details
                  </button>
                </div>
              </div>
            </div>
          </a>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</section>