<?php

$view = isset($_GET['view']) ? $_GET['view'] : 'login';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bookipedia — Login</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Lato:wght@600;700&family=Onest:wght@700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="stylesheet" href="assets/css/bookipedia.css">
</head>
<body class="bp-body" data-bp-theme="login">
   <?php include 'header.php'; ?>

  <main class="bp-auth-wrap">
    <div class="bp-auth-card">
      
      <div class="bp-auth-toggle mb-4">
        <a href="login.php?view=login" style="flex:1; text-decoration:none;">
            <button type="button" class="<?php echo ($view === 'login') ? 'is-active' : ''; ?>" style="width:100%">Login</button>
        </a>
        <a href="login.php?view=register" style="flex:1; text-decoration:none;">
            <button type="button" class="<?php echo ($view === 'register') ? 'is-active' : ''; ?>" style="width:100%">Register</button>
        </a>
      </div>

      <?php if(isset($_GET['error'])): ?>
        <div class="alert alert-danger py-2 small text-center" role="alert">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
      <?php endif; ?>

      <form id="bpPaneLogin" action="auth.php" method="POST" <?php echo ($view !== 'login') ? 'hidden' : ''; ?>>
        <div class="mb-3">
          <label class="form-label" for="loginEmail">Email address</label>
          <input type="email" name="email" class="form-control" id="loginEmail" autocomplete="username" placeholder="reader@example.com" required>
        </div>
        <div class="mb-4">
          <label class="form-label" for="loginPassword">Password</label>
          <input type="password" name="password" class="form-control" id="loginPassword" autocomplete="current-password" placeholder="••••••••" required>
        </div>
        <button type="submit" name="action" value="login" class="bp-btn-signin mb-3" id="bpLoginSubmit">Sign in</button>
      </form>

      <form id="bpPaneRegister" action="auth.php" method="POST" <?php echo ($view !== 'register') ? 'hidden' : ''; ?>>
        <div class="mb-3">
          <label class="form-label" for="regName">Full name</label>
          <input type="text" name="full_name" class="form-control" id="regName" placeholder="just enter your name" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="regEmail">Email address</label>
          <input type="email" name="email" class="form-control" id="regEmail" autocomplete="email" placeholder="reader@example.com" required>
        </div>
        <div class="mb-3">
          <label class="form-label" for="regPhone">Phone</label>
          <input type="tel" name="phone" class="form-control" id="regPhone" placeholder="+1 …">
        </div>
        <div class="mb-3">
          <label class="form-label" for="regAddress">Street address</label>
          <input type="text" name="address" class="form-control" id="regAddress" placeholder="City / street">
        </div>
        <div class="mb-4">
          <label class="form-label" for="regPassword">Password</label>
          <input type="password" name="password" class="form-control" id="regPassword" autocomplete="new-password" placeholder="Create a secure password" required>
        </div>
        <button type="submit" name="action" value="register" class="bp-btn-signin" id="bpRegSubmit">Create account</button>
      </form>

    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>