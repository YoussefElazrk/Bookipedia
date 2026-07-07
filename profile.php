<?php
session_start();
require_once 'connect.php';

// 1. منطق تسجيل الخروج (Logout) - إذا جاء طلب بكلمة logout في الرابط
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
    session_destroy(); // إنهاء الجلسة
    header("Location: login.php"); // العودة لصفحة الدخول
    exit();
}

// 2. حماية الصفحة: إذا لم يكن هناك جلسة نشطة، اذهب للـ Login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$success_msg = "";

// 3. معالجة تحديث البيانات (بدون قيود على نوع الحروف أو الأرقام)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_profile'])) {
    // نكتفي بتنظيف النص لحماية قاعدة البيانات فقط (Escape)
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $phone     = mysqli_real_escape_string($conn, $_POST['phone']);
    $address   = mysqli_real_escape_string($conn, $_POST['address']);

    $update_sql = "UPDATE users SET full_name='$full_name', phone='$phone', address='$address' WHERE id='$user_id'";
    
    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['user_name'] = $full_name; // تحديث الاسم في الجلسة ليظهر في الموقع
        $success_msg = "Changes saved!";
    }
}

// 4. جلب بيانات المستخدم الحالية لعرضها
$sql = "SELECT * FROM users WHERE id = '$user_id'";
$res = mysqli_query($conn, $sql);
$user_data = mysqli_fetch_assoc($res);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bookipedia — Profile</title>
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
    <div id="bpProfileHost" class="bp-shell px-3">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8 col-lg-6">
                <div class="bp-auth-card shadow-sm">
                    <h3 class="mb-4 fw-bold"><i class="bi bi-person-circle me-2"></i>My Profile</h3>
                    
                    <?php if($success_msg): ?>
                        <div class="alert alert-success py-2 small"><?php echo $success_msg; ?></div>
                    <?php endif; ?>

                    <form action="profile.php" method="POST">
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="full_name" class="form-control" 
                                   value="<?php echo htmlspecialchars($user_data['full_name']); ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Email (Read-only)</label>
                            <input type="email" class="form-control bg-light" 
                                   value="<?php echo htmlspecialchars($user_data['email']); ?>" readonly>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Phone</label>
                            <input type="text" name="phone" class="form-control" 
                                   value="<?php echo htmlspecialchars($user_data['phone']); ?>">
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Address</label>
                            <textarea name="address" class="form-control" rows="2"><?php echo htmlspecialchars($user_data['address']); ?></textarea>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" name="update_profile" class="bp-btn-signin flex-grow-1">
                                Save Changes
                            </button>
                            <a href="profile.php?action=logout" class="btn btn-outline-danger px-4" style="border-radius: 8px;">
                                Logout
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/app.js"></script>
</body>
</html>