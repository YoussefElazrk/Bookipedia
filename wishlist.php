<?php
session_start();
require_once 'connect.php';


if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];


if (isset($_GET['remove'])) {
    $book_id = intval($_GET['remove']);
    $stmt = $conn->prepare("DELETE FROM wishlist WHERE user_id = ? AND book_id = ?");
    $stmt->bind_param("ii", $user_id, $book_id);
    $stmt->execute();
    $stmt->close();
    header("Location: wishlist.php");
    exit();
}

$sql = "SELECT b.* FROM books b 
        INNER JOIN wishlist w ON b.id = w.book_id 
        WHERE w.user_id = '$user_id'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bookipedia — Wishlist</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@600;700&family=Onest:wght@700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/bookipedia.css">
</head>
<body class="bp-body">
  <?php include 'header.php'; ?>

  <main>
    <div id="bpWishRoot" class="bp-shell px-3">
        <h2 class="mt-5 mb-4 fw-bold">My Wishlist</h2>
        
        <div class="bp-wl-grid">
            <?php if (mysqli_num_rows($result) > 0): ?>
                <?php while ($book = mysqli_fetch_assoc($result)): ?>
                    <div class="bp-wl-card">
                        <div class="d-flex;flex-direction: column;gap-3">
                            <a href="book.php?id=<?php echo $book['id']; ?>">
                                <img src="<?php echo htmlspecialchars($book['cover_path']); ?>" 
                                     alt="<?php echo htmlspecialchars($book['title']); ?>" 
                                     style="width: 100px; height: 145px; object-fit: cover; border-radius: 12px;">
                            </a>
                            
                            <div class="flex-grow-1 d-flex flex-column justify-content-between">
                                <div>
                                    <h5 class="fw-bold mb-1" style="font-family: 'Onest', sans-serif;">
                                        <?php echo htmlspecialchars($book['title']); ?>
                                    </h5>
                                    <p class="text-muted small mb-2"><?php echo htmlspecialchars($book['author']); ?></p>
                                    
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="fw-bold text-success fs-5">$<?php echo number_format($book['price'], 2); ?></span>
                                        <?php if ($book['original_price']): ?>
                                            <span class="text-muted text-decoration-line-through small">$<?php echo $book['original_price']; ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                
                                <div class="d-flex gap-2 mt-3">
                                    <button class="btn btn-success btn-sm flex-grow-1 py-2 fw-semibold" 
                                            onclick="addToCart(<?php echo $book['id']; ?>)" 
                                            style="border-radius: 8px;">
                                        <i class="bi bi-cart-plus me-1"></i> Add to Cart
                                    </button>
                                    
                                    <a href="wishlist.php?remove=<?php echo $book['id']; ?>" 
                                       class="btn btn-outline-danger btn-sm px-3 d-flex align-items-center" 
                                       style="border-radius: 8px;">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <div class="text-center py-5" style="grid-column: 1 / -1;">
                    <i class="bi bi-heart text-muted" style="font-size: 4rem; opacity: 0.3;"></i>
                    <p class="mt-3 fs-5 text-muted">Your wishlist is empty.</p>
                    <a href="all-books.php" class="btn btn-success mt-2 px-4 py-2">Discover Books</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
  </main>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="js/app.js"></script>
  </body>
</html>