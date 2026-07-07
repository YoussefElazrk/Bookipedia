<?php 
include 'connect.php'; 
$sql = "SELECT * FROM books WHERE is_bestseller = 1";
$result = $conn->query($sql);
$totalCount = $result->num_rows;
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bookipedia — Best Sellers</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@600;700&family=Onest:wght@700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/bookipedia.css">
</head>
<body class="bp-body" data-bp-nav="best-sellers">
   <?php include 'header.php'; ?>
  <main class="pb-5">
    <div class="bp-page-title">
        <span class="t1">Best Sellers</span>
   <span class="t2" id="bpBestTitle"> Our top performing titles, Curated for your reading journey</span>
    </div>

    <section class="bp-books-panel">
      <div id="bpBestGrid" class="bp-books-grid">
        <?php 
        if ($totalCount > 0) {
        $counter = 1; 
        
        while($row = $result->fetch_assoc()) {
            $colorClass = "";
            if ($counter == 1) {
                $colorClass = "pill-first"; 
            } elseif ($counter == 2) {
                $colorClass = "pill-second"; 
            } elseif ($counter == 3) {
                $colorClass = "pill-third"; 
            }
                echo '<div class="bp-book-card">';
                
               echo '<div class="bp-bestseller-pill ' . $colorClass . '">BEST SELLER</div>';
                
                echo '<a href= "book.php?id=' . $row['id'] . '" class="cover">';
                echo '<img src="' . $row['cover_path'] . '" alt="">';
                echo '</a>';
                
                echo '<a href="book.php?id=' . $row['id'] . '" class="ttl">' . $row['title'] . '</a>';
                echo '<span class="author">' . $row['author'] . '</span>';
                echo '<span class="price">$' . number_format($row['price'], 2) . '</span>';
                
               echo '<button class="bp-btn-add" onclick="addToCart(' . $row['id'] . ')">';
                echo 'Add to cart <img src="assets/img/figma/icon-cart1.png" alt="">';
                echo '</button>';
                
                echo '</div>';
                $counter++;
            }
        }?>
    </section>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>
