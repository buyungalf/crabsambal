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
        <form action="shop" method="GET">
            <div class="cart_add">
                <input type="hidden" name="act" value="add">
                <input type="hidden" name="id_product" value="<?= $item['id_produk'] ?>">
                <button style="background: none;color: inherit;border: none;padding: 0;font: inherit;cursor: pointer;outline: inherit;color: #111111;font-size: 16px;font-weight: 600;display: inline-block;border-bottom: 2px solid #8ECA36;padding-bottom: 4px;
                                        " class="btn_add" type="submit">Add to cart</button>
            </div>
        </form>
    </div>
</div>