<nav class="navbar navbar-edit navbar-expand-lg navbar-light <?= !isset($_SESSION['ID']) ? "Login" : "" ?> <?= $titlePage == "Home Page" ? "Home" : "" ?>">
    <div class="container">
        <a class="navbar-brand logo" href="/Mihna"><span>M</span>IHNA</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <?php if(isset($_SESSION['ID']) && $_SESSION['type'] == "مقدم حرفة"):
                    $stmt = $connect->prepare("SELECT * FROM crafts WHERE user_id = ?");
                    $stmt->execute([$_SESSION['ID']]);
                    $craft = $stmt->rowCount();
                    if($craft <= 0): ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="add-craft.php"><i class="fas fa-plus-circle"></i>أضافة حرفة</a>
                    </li>
                <?php else: ?>
                    <?php
                            $stmt4 = $connect->prepare("SELECT * FROM crafts WHERE user_id = ?");
                            $stmt4->execute([$_SESSION['ID']]);
                            $craft = $stmt4->fetch();
                    ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="details.php?id=<?= $craft['id'] ?>" style="padding: 0.375rem 0.29rem;"><i class="far fa-eye"></i>عرض الحرفة</a>
                    </li>
                <?php endif; endif; ?>
                <li class="nav-item">
                <a class="nav-link" href="categories.php"><i class="fas fa-boxes"></i>الحرف في الموقع</a>
                </li>
                <?php if(isset($_SESSION['ID'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="edit-profile.php"><i class="fas fa-user-alt"></i>الصفحة الشخصية</a>
                    </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="contact.php"><i class="fas fa-phone"></i>التواصل معنا</a>
                </li>
                <?php if(isset($_SESSION['ID'])): ?>
                    <li class="nav-item">
                        <a href="logout.php" type="button" class="btn btn-outline-light sign-btns"style="color:#c6ad8f!important;"><i class="fas fa-sign-out-alt"></i>تسجيل الخروج</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a href="Login.php" type="button" class="btn btn-outline-light sign-btns" style="padding: 0.375rem 0.72rem;color:#c6ad8f!important;"><i class="fas fa-sign-out-alt"></i>تسجيل الدخول</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
    <!--end navbar-->