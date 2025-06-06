<?php  require_once 'layouts/header.php'; ?>
<?php  require_once 'layouts/menu.php'; ?>

<main>
<div class="search-results text-center my-4">
    <h2>Kết quả tìm kiếm</h2>
    <?php if (empty($listSanPham)): ?>
        <p class="text-muted">Không tìm thấy sản phẩm nào phù hợp.</p>
    <?php else: ?>
        <div class="row row-cols-1 row-cols-md-3 g-4 product-grid">
            <?php foreach ($listSanPham as $sanPham): ?>
                <div class="col">
                    <div class="card h-100 text-center product-item">
                        <a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']  ?>">
                        <img 
                            src="<?= $sanPham['hinh_anh']; ?>" 
                            class="card-img-top" 
                            alt="<?= $sanPham['ten_san_pham']; ?>" 
                            style="height: 200px; object-fit: cover;"
                        >
                        </a>
                        <div class="card-body">
                            <h5 class="card-title"><a href="<?= BASE_URL . '?act=chi-tiet-san-pham&id_san_pham=' . $sanPham['id']  ?>"><?= $sanPham['ten_san_pham']; ?></a></h5>
                            <p class="card-text">Danh mục: <?= $sanPham['ten_danh_muc']; ?></p>
                            <p class="card-text">Giá: <?= number_format($sanPham['gia_san_pham'], 0, ',', '.'); ?> VND</p>
                            <?php if ($sanPham['gia_khuyen_mai']): ?>
                                <p class="card-text text-danger">Giá khuyến mãi: <?= number_format($sanPham['gia_khuyen_mai'], 0, ',', '.'); ?> VND</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
</main>

<?php require_once 'layouts/miniCart.php' ?>
<?php require_once 'layouts/footer.php' ?>