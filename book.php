<?php 
session_start();
include 'connect.php'; 

$bookId = isset($_GET['id']) ? (int)$_GET['id'] : 0;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['toggle_wishlist'])) {
    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
        
        
        $checkSql = "SELECT * FROM wishlist WHERE user_id = $userId AND book_id = $bookId";
        $checkRes = $conn->query($checkSql);

        if ($checkRes->num_rows > 0) {
           
            $conn->query("DELETE FROM wishlist WHERE user_id = $userId AND book_id = $bookId");
        } else {
            
            $conn->query("INSERT INTO wishlist (user_id, book_id) VALUES ($userId, $bookId)");
        }
        
    } else {
       
        header("Location: login.php");
        exit();
    }
}


$sql = "SELECT * FROM books WHERE id = $bookId";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $book = $result->fetch_assoc();
} else {
    die("Book not found.");
}


$isFavorite = false;
if (isset($_SESSION['user_id'])) {
    $uId = $_SESSION['user_id'];
    $favCheck = $conn->query("SELECT book_id FROM wishlist WHERE user_id = $uId AND book_id = $bookId");
if ($favCheck && $favCheck->num_rows > 0) $isFavorite = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bookipedia — <?php echo htmlspecialchars($book['title']); ?></title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@600;700&family=Onest:wght@700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/bookipedia.css">
</head>
<body class="bp-body" data-bp-nav="book-details">
  <?php include 'header.php'; ?>
  <main>
   <div id="bpBookRoot">
  <div class="bp-detail-shell">
    <div class="bp-detail-card">
      
      <?php if($book['is_bestseller']): ?>
        <div class="px-5 pt-4"><span class="bp-best-tag">BEST SELLER</span></div>
      <?php endif; ?>

      <div class="bp-detail-grid">
        <div class="bp-cover-wrap">
          <div class="bp-cover">
            <img src="<?php echo $book['cover_path']; ?>" alt="">
          </div>
        </div>

        <div class="bp-detail-info">
          <h1><?php echo $book['title']; ?></h1>
          <div class="bp-byline">
            <span class="lbl">By: </span>
            <span class="name"><?php echo strtoupper($book['author']); ?></span>
          </div>

          <div class="bp-price-row">
            <span class="now">$<?php echo number_format($book['price'], 2); ?></span>
          </div>

          <p class="bp-short" style="font-style: italic; color: #6c757d; margin: 20px 0; border-left: 2px solid #8aa196; padding-left: 15px; font-size:20px;">
            "9 out of 10 scientists agree that buying this book makes you 100% more likely to own this book." 
          </p>

          <div class="bp-detail-actions">
            <div class="bp-qty">
              <button type="button" data-bp-dec>-</button>
              <button type="button" class="mid" disabled><span id="bpQtyLbl" style="color: black;">1</span></button>
              <button type="button" data-bp-inc>+</button>
            </div>
            <button type="button" class="bp-btn-add-cart-lg" id="bpDetailAdd" data-id="<?php echo $book['id']; ?>">Add to cart</button>
          </div>

          <div class="bp-wishlist-container mt-3">
            <?php if (isset($_SESSION['user_id'])): ?>
              <form method="POST">
                <input type="hidden" name="toggle_wishlist" value="1">
                <button type="submit" class="bp-wishlist-toggle">
                  <i class="bi <?php echo $isFavorite ? 'bi-heart-fill text-danger' : 'bi-heart'; ?> bp-wish-icon"></i>
                  <span class="bp-wish-text"><?php echo $isFavorite ? 'Remove from wishlist' : 'Add to wishlist'; ?></span>
                </button>
              </form>
            <?php else: ?>
              <button type="button" class="bp-wishlist-toggle" onclick="window.location.href='login.php'">
                <i class="bi bi-heart bp-wish-icon"></i>
                <span class="bp-wish-text">Add to wishlist</span>
              </button>
            <?php endif; ?>
          </div>
        </div>
      </div> <div class="bp-tabs-section px-5 pb-5">
        <div class="bp-tabs">
          <div class="bp-tabs-row border-bottom pb-2" style="border-color:#eaeaea;">
            <button type="button" class="bp-tab is-active" data-bp-tab="description">Description</button>
            <button type="button" class="bp-tab" data-bp-tab="details">Details</button>
          </div>
        </div>
        
        <div class="bp-tab-panel mt-4">
          <div id="tab-content-description">
            <?php echo nl2br($book['full_description']); ?>
          </div>
          <div id="tab-content-details" style="display: none;">
            <?php echo nl2br($book['details'] ?? 'No extra details available for this book.'); ?>
          </div>
        </div>
      </div>

    </div> </div>
</div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>