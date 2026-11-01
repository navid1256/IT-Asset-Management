<?php
if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

require_once dirname(__DIR__, 2) . '/bootstrap/constants.php';

if (empty($_SESSION['authenticated_user_id'])) {
    header('Location: ' . BASE_URL . '/pages/normal-login/normal-login.php');
    exit;
}

if (empty($_SESSION['receiver_user_id'])) {
    header('Location: ' . BASE_URL . '/pages/select-user/select-user.php');
    exit;
}

if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

$brands = ['Lenovo', 'HP', 'Dell', 'ASUS', 'Acer', 'MSI', 'Apple', 'Microsoft', 'Samsung'];
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ثبت مشخصات لپ تاپ</title>
    <link rel="stylesheet" href="<?= ASSETS_URL ?>/css/mouse-keyboard.css?v=<?= filemtime(BASE_PATH . '/assets/css/mouse-keyboard.css') ?>">
    <link rel="icon" href="<?= ASSETS_URL ?>/img/logo.png" type="image/png">
</head>

<body>
    <header>
        <h1>نرم افزار مدیریت درخواست و ثبت تجهیزات فناوری</h1>
        <div class="user-profile">
            <img src="<?= ASSETS_URL ?>/img/profile-avatar.avif" alt="user profile" class="avatar">
            <div class="user-info">
                <p class="username">
                    <span>تحویل گیرنده :</span>
                    <span id="profile-full-name">نام کاربر</span>
                </p>
                <p class="userrole" id="profile-department">معاونت / اداره</p>
            </div>
        </div>
        <div class="logged-in-user">
            <span>کاربر :</span>
            <span id="logged-in-username">کاربر نامشخص</span>
        </div>
        <img src="<?= ASSETS_URL ?>/img/logo.png" alt="لوگو شرکت">
    </header>

    <form id="laptop-info-form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="csrf_token"
            value="<?= htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') ?>">
        <fieldset class="form-section">
            <legend>ثبت مشخصات فنی لپ تاپ</legend>
            <div class="device-fields">
                <div class="device-field device-field--brand">
                    <label for="laptop-brand">برند :</label>
                    <select id="laptop-brand" name="laptop_brand" required>
                        <option value="" disabled selected>Select Brand</option>
                        <?php foreach ($brands as $brand): ?>
                            <option value="<?= htmlspecialchars($brand, ENT_QUOTES, 'UTF-8') ?>">
                                <?= htmlspecialchars($brand, ENT_QUOTES, 'UTF-8') ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="device-field">
                    <label for="laptop-model">مدل :</label>
                    <input type="text" id="laptop-model" name="laptop_model"
                        placeholder="Model" maxlength="100" dir="auto" required>
                </div>
            </div>
            <div class="component-upload">
                <input type="file" id="laptop-upload" name="laptop_warranty_file"
                    class="component-file-input" accept="image/*,application/pdf"
                    aria-describedby="laptop-file-name" data-warranty-input>
                <label for="laptop-upload" class="component-upload-button">بارگذاری تصویر گارانتی</label>
                <span id="laptop-file-name" class="component-file-name" aria-live="polite">فایلی انتخاب نشده</span>
            </div>
        </fieldset>
        <div class="form-actions">
            <button type="submit" class="submit-button">ثبت</button>
        </div>
    </form>

    <script src="<?= ASSETS_URL ?>/js/user-profile.js?v=<?= filemtime(BASE_PATH . '/assets/js/user-profile.js') ?>"></script>
    <script src="<?= ASSETS_URL ?>/js/mouse-keyboard.js?v=<?= filemtime(BASE_PATH . '/assets/js/mouse-keyboard.js') ?>"></script>
</body>

</html>
