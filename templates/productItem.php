<div class="product__item">
    <div class="product__item__pic set-bg" onclick="location.href='<?= $base_url ?>produk-<?= $item['produk_seo'] ?>'" style="background-size: auto; cursor: pointer;" data-setbg="assets/img/product/<?= $item['gambar'] ?>">
        <div class="product__label">
            <a href="shop?category=<?= $item['kategori_seo'] ?>">
                <span><?= $item['nama_kategori'] ?></span>
            </a>
        </div>
    </div>
    <div class="product__item__text">
        <h6>
            <a href="produk-<?= $item['produk_seo'] ?>">
                <?= $item['nama_produk'] ?>
            </a>
        </h6>
        <div class="product__item__price" data-price="<?= $item['harga'] ?>"><?= "Rp " . format_rupiah($item['harga']) ?></div>
        <div class="cart_add">
            <input type="hidden" name="act" value="add">
            <input type="hidden" name="id_produk" value="<?= $item['id_produk'] ?>">
            <a class="btn_add" style="cursor: pointer;">Add to cart</a>
        </div>
    </div>
</div>