<?php
require_once 'connect.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$uId = $_SESSION['user_id'];

if (isset($_GET['remove'])) {
    $bid = (int)$_GET['remove'];
    $conn->query("DELETE FROM cart WHERE user_id = $uId AND book_id = $bid");
    header("Location: cart.php");
    exit();
}

$sql = "SELECT c.*, b.title, b.author, b.price, b.cover_path 
        FROM cart c 
        JOIN books b ON c.book_id = b.id 
        WHERE c.user_id = $uId";
$result = $conn->query($sql);

$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bookipedia — Cart</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Onest:wght@700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="assets/css/bookipedia.css">
</head>
<body class="bp-body">
  <?php include 'header.php'; ?>

  <main class="bp-shell  mt-5">
    <div class="bp-cart-title mb-4">
        <h2>Shopping Cart</h2>
        <p>You have <?php echo $result->num_rows; ?> items in your cart</p>
    </div>

    <div class="row g-4">
      <div class="col-lg-8">
        <?php if ($result->num_rows > 0): ?>
           <?php while($item = $result->fetch_assoc()): 
    $subtotal = $item['price'] * $item['quantity'];
    $total_price += $subtotal;
?>
<div class="bp-cart-row d-flex align-items-center justify-content-between py-3 border-bottom">
    
    <div class="bp-cart-product d-flex align-items-center">
        <a href="book.php?id=<?php echo $item['book_id']; ?>">
            <img src="<?php echo $item['cover_path']; ?>" alt="<?php echo htmlspecialchars($item['title']); ?>" style="width: 80px; height: 120px; object-fit: cover; border-radius: 8px; margin-right: 15px;">
        </a>
        <div>
            <a href="book.php?id=<?php echo $item['book_id']; ?>" class="text-decoration-none text-dark">
                <h5 class="mb-1 fw-bold"><?php echo $item['title']; ?></h5>
            </a>
            <p class="mb-0 text-muted small">By: <?php echo $item['author']; ?></p>
        </div>
    </div>

    <div class="d-flex align-items-center gap-4">
        <div class="bp-qty d-flex align-items-center">
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQty(<?php echo $item['book_id']; ?>, -1)">-</button>
            <span id="qty-<?php echo $item['book_id']; ?>" class="px-3 fw-bold" style="min-width: 30px; text-align: center;">
                <?php echo $item['quantity']; ?>
            </span>
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="updateQty(<?php echo $item['book_id']; ?>, 1)">+</button>
        </div>

        <div class="fw-bold fs-5" style="min-width: 100px; text-align: right;">
            $<?php echo number_format($subtotal, 2); ?>
        </div>

        <a href="cart.php?remove=<?php echo $item['book_id']; ?>" class="text-danger fs-5">
            <i class="bi bi-trash"></i>
        </a>
    </div>

</div> <?php endwhile; ?>
        <?php else: ?>
            <div class="text-center py-5">
                <i class="bi bi-cart-x text-muted" style="font-size: 3rem;"></i>
                <p class="mt-3">Your cart is empty.</p>
                <a href="all-books.php" class="btn " style="background: var(--bp-green-btn); color:#f9f9f9">Continue Shopping</a>
            </div>
        <?php endif; ?>
      </div>

      <div class="col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4" style="background: #f9f9f9;">
            <h4 class="fw-bold mb-4">Order Summary</h4>
            <div class="d-flex justify-content-between mb-2">
                <span>Subtotal</span>
                <span>$<?php echo number_format($total_price, 2); ?></span>
            </div>
            <div class="d-flex justify-content-between mb-4">
                <span>Shipping</span>
                <span class="text-success">Free</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between mb-4 mt-2">
                <span class="fw-bold fs-5">Total</span>
                <span class="fw-bold fs-5 text-primary">$<?php echo number_format($total_price, 2); ?></span>
            </div>
            <a href="cart_logic.php?action=checkout" class="btn btn-success w-100 py-3 rounded-3 fw-bold">
                 Checkout Now
            </a>
        </div>
      </div>
    </div>
  </main>
  <div class="modal fade" id="bpThanksModal" tabindex="-1" aria-labelledby="bpThanksLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content rounded-4 border-0 shadow">
        <div class="modal-header border-0 pb-0">
          <h5 class="modal-title fw-bold" id="bpThanksLabel">Thank you</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body pt-2 pb-4">
          <p class="mb-0 text-muted">Your order is confirmed for this prototype. The cart has been cleared—enjoy your next read.</p>
        </div>
      </div>
    </div>
  </div>

 

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>
