<?php
 require_once 'connect.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$cart_count = 0;
if (isset($_SESSION['user_id'])) {
    $uid = $_SESSION['user_id'];
    $count_res = $conn->query("SELECT SUM(quantity) as total FROM cart WHERE user_id = $uid");
    $count_data = $count_res->fetch_assoc();
    $cart_count = $count_data['total'] ?? 0;
}
?>
<header class="bp-header">
  <div class="bp-header-inner">
    <a class="bp-logo" href="index.php">
      <img id="bpHeaderLogoImg" src="assets/img/figma/logo-header-home.png" width="188" height="46" alt="Bookipedia" />
    </a>
    
    <nav class="bp-nav" aria-label="Primary">
      <a class="bp-nav-link" data-bp-nav="home" href="index.php">Home</a>
      <a class="bp-nav-link" data-bp-nav="all-books" href="all-books.php">All Books</a>
      <a class="bp-nav-link" data-bp-nav="best-sellers" href="best-sellers.php">Best Sellers</a>
      <a class="bp-nav-link" data-bp-nav="about" href="about.php">About</a>
    </nav>
       <!--the search crap -->
   <form class="bp-search-form" id="bpGlobalSearchForm" action="all-books.php" method="get" role="search">
  <div class="bp-search-inner">
    <input 
      id="bpHeaderSearch" 
      name="search" 
      type="search" 
      maxlength="120" 
      autocomplete="off" 
      aria-label="Search books" 
      placeholder="search books..." 
      value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>" 
    />
    <img class="bp-search-glyph" src="assets/img/figma/search.png" alt="" />
      </div>
    </form>

    <div class="bp-header-actions">
      <div id="bpUserSlot">
        <?php if (isset($_SESSION['user_id'])): ?>
          <div class="dropdown bp-user-dd">
            <button class="bp-icon-btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Account menu">
              <i class="bi bi-person-fill" style="color: var(--bp-green);"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item text-danger" href="profile.php?action=logout">Logout</a></li>
            </ul>
          </div>
        <?php else: ?>
          <a class="bp-icon-btn" href="login.php" aria-label="Account">
            <i class="bi bi-person"></i>
          </a>
        <?php endif; ?>
      </div>

       <a class="bp-icon-btn" 
          href="<?php echo isset($_SESSION['user_id']) ? 'wishlist.php' : 'login.php'; ?>" 
              title="Wishlist" 
            aria-label="Wishlist">
          <i class="bi bi-heart"></i>
        </a>
      <a class="bp-icon-btn bp-cart-wrap" 
          href="<?php echo isset($_SESSION['user_id']) ? 'cart.php' : 'login.php'; ?>" 
          title="Cart" 
          aria-label="Cart">
         <i class="bi bi-cart3"></i>
           <span id="bpCartBadge" class="bp-cart-badge <?php echo ($cart_count > 0) ? '' : 'is-hidden'; ?>">
        <?php echo $cart_count; ?>
          </span>
      </a>
    </div>
  </div>
</header>