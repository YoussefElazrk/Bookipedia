
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bookipedia — Home</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@600;700&family=Onest:wght@700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/bookipedia.css">
</head>
<body class="bp-body" data-bp-nav="home">
  <?php include 'header.php'; ?>

  <main>
    <section class="bp-hero-wrap">
      <div class="bp-hero">
        <!--<div class="bp-hero-ellipse"><img src="assets/img/figma/hero-ellipse-accent.png" alt=""></div>-->
        <div class="bp-hero-copy">
          <h1>Discover Your<br /> Next Favorite<span class="accent"> book</span></h1>
          <p class="lead">Explore a handpicked collection of rich, timeless and inspiring books.</p>
          <a class="bp-btn-shop" href="all-books.php">
            Shop now
            <img src="assets/img/figma/arrow-shop.png" alt="">
          </a>
        </div>
        <div class="bp-hero-photo" aria-hidden="true">
          <img src="assets/img/figma/home-hero-photo.png" alt="">
        </div>
      </div>
    </section>

    <section class="bp-features" aria-label="Highlights">
      <div class="bp-feature">
        <div class="bp-feature-bg"></div>
        <img src="assets/img/figma/truck.png" alt="">
        <h3>Free shipping</h3>
        <p>Anywhere in the Arab world</p>
      </div>
      <div class="bp-feature">
        <div class="bp-feature-bg"></div>
        <img src="assets/img/figma/shield.png" alt="">
        <h3>Secure Payments</h3>
        <p>100% Secure Checkout</p>
      </div>
      <div class="bp-feature">
        <div class="bp-feature-bg"></div>
        <img src="assets/img/figma/headset.png" alt="">
        <h3>24/7 support </h3>
        <p>We are here to help</p>
      </div>
    </section>

    <section class="bp-home-bs" aria-labelledby="bpHomeBsTitle">
      <div class="bp-home-bs-head">
        <h2 id="bpHomeBsTitle">Best sellers</h2>
        <a href="best-sellers.php">See all bestsellers</a>
      </div>
      <div class="bp-home-bs-scroll" id="bpHomeShelf">
        <?php include 'connect.php';
        $sql = "SELECT * FROM books WHERE is_bestseller = 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo '<div class="bp-book-card home-scroll">';
            
            echo '<a href= "book.php?id=' . $row['id'] . '" class="cover">';
            echo '<img src="' . $row['cover_home_path'] . '" alt="' . $row['title'] . '">';
            echo '</a>';
            
             echo '<a href="book.php?id=' . $row['id'] . '" class="ttl">' . $row['title'] . '</a>';
            echo '<span class="author">' . $row['author'] . '</span>';
            echo '<span class="price">$' . number_format($row['price'], 2) . '</span>';
            
            echo '<button class="bp-btn-add" onclick="addToCart(' . $row['id'] . ')">';
            echo 'Add to cart <img src="assets/img/figma/icon-cart1.png" alt="">';
            echo '</button>';
            
            echo '</div>';
        }
    } 
    ?>
      </div>
    </section>
  </main>
  <div class="modal fade" id="bpThanksModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0 shadow">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold">Thank you!</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pt-2 pb-4">
                <p class="mb-0 text-muted">Your order is confirmed. The cart has been cleared—enjoy your next read.</p>
            </div>
        </div>
    </div>
</div>

<?php if (isset($_GET['ordered']) && $_GET['ordered'] === 'true'): ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var myModal = new bootstrap.Modal(document.getElementById('bpThanksModal'));
        myModal.show();
    });
    window.history.replaceState({}, document.title, "index.php");
</script>
<?php endif; ?>
<?php include 'footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>
