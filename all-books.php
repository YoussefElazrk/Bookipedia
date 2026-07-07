<?php 
include 'connect.php'; 

// 1. Get the search term
$searchTerm = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$isSearching = ($searchTerm !== '');

// 2. Build the WHERE clause
$whereSQL = "";
if ($isSearching) {
    $whereSQL = " WHERE title LIKE '%$searchTerm%' OR author LIKE '%$searchTerm%' ";
}

// 3. Logic: If searching, show EVERYTHING. If not, use pagination.
if ($isSearching) {
    // Search Mode: No LIMIT
    $sql = "SELECT * FROM books $whereSQL";
    $result = $conn->query($sql);
    $totalCount = $result->num_rows;
    $totalPages = 1; // Everything is on one page
    $startRange = ($totalCount == 0) ? 0 : 1;
    $endRange = $totalCount;
} else {
    // Normal Mode: Standard Pagination
    $limit = 10; 
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    $totalRes = $conn->query("SELECT COUNT(*) as total FROM books");
    $totalCount = $totalRes->fetch_assoc()['total'];
    $totalPages = ceil($totalCount / $limit);

    $sql = "SELECT * FROM books LIMIT $limit OFFSET $offset";
    $result = $conn->query($sql);

    $startRange = ($totalCount == 0) ? 0 : $offset + 1;
    $endRange = min($totalCount, $page * $limit);
}
?>
<!DOCTYPE html>
<html lang="en" class="bp-all-books-html">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bookipedia — All Books</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@600;700&family=Onest:wght@700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/bookipedia.css">
</head>
<body class="bp-body" data-bp-nav="all-books">
  <?php include 'header.php'; ?>

 <main class="bp-ab-main">
    <div id="bpAllBooksHeading" class="bp-page-title">
      <span class="t1">All Books </span>
      <span class="t2">(showing <?php echo "$startRange-$endRange"; ?> out of <?php echo $totalCount; ?> results)</span>
    </div>

    <section class="bp-books-panel">
      <div id="bpAllBooksGrid" class="bp-books-grid">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="bp-book-card">';
                
                
                if($row['is_bestseller']) {
                    echo '<div class="bp-bestseller-pill">BEST SELLER</div>';
                }

                
                echo '<a href= "book.php?id=' . $row['id'] . '" class="cover">';
                echo '<img src="' . $row['cover_path'] . '" alt="' . $row['title'] . '">';
                echo '</a>';

                
                echo '<a href="book.php?id=' . $row['id'] . '" class="ttl">' . $row['title'] . '</a>';

                
                echo '<span class="author">' . $row['author'] . '</span>';
                echo '<span class="price">$' . number_format($row['price'], 2) . '</span>';

                
                echo '<button class="bp-btn-add" onclick="addToCart(' . $row['id'] . ')">';
                echo 'Add to cart <img src="assets/img/figma/icon-cart1.png" alt="">';
                echo '</button>';
                
                echo '</div>';
            }
        } ?>
      </div>

    <?php if (!$isSearching): ?>
     <div class="bp-pagination-figma">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>" class="bp-pag-btn">
                <img src="assets/img/figma/previous<?php echo $page; ?>.png" alt="Back">
            </a>
        <?php else: ?>
            <div class="bp-pag-btn">
                <img src="assets/img/figma/previous1.png" alt="">
            </div>
        <?php endif; ?>

        <span class="page-num"><?php echo $page; ?></span>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>" class="bp-pag-btn">
                <img src="assets/img/figma/nextpag<?php echo $page; ?>.png" alt="Next">
            </a>
        <?php else: ?>
            <div class="bp-pag-btn">
                <img src="assets/img/figma/nextpag<?php echo $page; ?>.png" alt="">
            </div>
        <?php endif; ?>
          </div>
     <?php endif; ?>


      <div class="bp-books-deco-feather"><img id="bpAbFeatherImg" src="assets/img/figma/allbooks-feather.png" alt=""></div>
      <div class="bp-books-deco-sketch"><img id="bpAbSketchImg" src="assets/img/figma/allbooks-sketch-book.png" alt=""></div>
    </section>
</main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!--<script src="js/data.js"></script>-->
  <script src="js/app.js"></script>
</body>
</html>
