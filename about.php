<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bookipedia — About</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@600;700&family=Onest:wght@700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/bookipedia.css">
</head>
<body class="bp-body about-page" data-bp-nav="about" data-bp-theme="about">
   <?php include 'header.php'; ?>

  <main>
    <figure class="bp-about-hero-img">
      <img src="assets/img/figma/about-library-banner.png" alt="Comfortable bookstore reading nook">
    </figure>

    <div class="bp-about-body">
      <h1 class="bp-about-h1">Meet Bookipedia</h1>

      <p class="bp-about-p">
        We shaped Bookipedia as a doorway into stories that feel personal—whether you crave a luminous debut,
        a restorative classic, or the title everyone is quietly passing between friends.
      </p>

      <h2 class="bp-about-section-title">Vision</h2>
      <p class="bp-about-p">
        We believe reading should arrive with certainty: truthful descriptions, conscientious sourcing, speedy dispatch,
        and courteous service when surprises happen.
      </p>

      <h2 class="bp-about-section-title">Mission</h2>
      <p class="bp-about-p">
        Our mission is to give every bookshelf a curator—listening to what you savor, guarding your wish list,
        and celebrating the moment a parcel lands on your porch.
      </p>

      <div class="bp-about-values" role="list">
        <article class="bp-about-value" role="listitem">
          <img src="assets/img/figma/about-icon-open-book.png" alt="">
          <h3>Inclusive catalogs</h3>
          <p>Poetry beside science, YA beside philosophy—all shelved shoulder to shoulder.</p>
        </article>
        <article class="bp-about-value" role="listitem">
          <img src="assets/img/figma/about-icon-book-heart.png" alt="">
          <h3>Thoughtful pacing</h3>
          <p>Seasonal drops, thematic bundles, and slow reads paced for real life.</p>
        </article>
        <article class="bp-about-value" role="listitem">
          <img src="assets/img/figma/about-icon-rocket.png" alt="">
          <h3>Responsible shipping</h3>
          <p>Packaging trimmed to protect spines—not waste and tracking you can rely on.</p>
        </article>
        <article class="bp-about-value" role="listitem">
          <img src="assets/img/figma/about-icon-scale.png" alt="">
          <h3>Fair value</h3>
          <p>Honest editions, deliberate discounts when we can—and clear policies when plans change.</p>
        </article>
      </div>
    </div>
  </main>

  <?php include 'footer.php'; ?>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>
