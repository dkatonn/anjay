<!--   product  -->
<?php
    $item_id = $_GET['item_id'] ?? 1;
    foreach ($product->getData() as $item) :
        if ($item['item_id'] == $item_id) :
    
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if (isset($_POST['top_sale_submit'])){
                    // call method addToCart
                    $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
                }
            }        
?>
<section id="product" class="py-3">
    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <img src="<?php echo $item['item_image'] ?? "./assets/ayam bakar.jpg" ?>" alt="product" class="img-fluid">
            </div>
            <div class="col-sm-6">
                <h5 class="font-baloo font-size-30"><?php echo $item['item_name'] ?? "Unknown"; ?></h5>
                <div class="d-flex">
                    <div class="rating text-warning font-size-12">
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="fas fa-star"></i></span>
                        <span><i class="far fa-star"></i></span>
                    </div>
                </div>
                <hr class="m-0">
                <table class="my-3">
                    <tr class="font-rale font-size-14">
                        <td>Harga:</td>
                        <td><span class="font-size-30 text-danger"><?php echo $item['item_price'] ?? 0 ?></span></td>
                    </tr>
                </table>
                <div class="col-12">
                    <h6 class="font-rubik">Deskripsi Produk</h6>
                    <hr>
                    <p class="font-rale font-size-14">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Repellat inventore vero numquam error est ipsa, consequuntur temporibus debitis nobis sit, delectus officia ducimus dolorum sed corrupti. Sapiente optio sunt provident, accusantium eligendi eius reiciendis animi? Laboriosam, optio qui? Numquam, quo fuga. Maiores minus, accusantium velit numquam a aliquam vitae vel?</p>
                </div>
                <form action="post">
                    <button type="submit" class="btn btn-danger btn-lg font-size-12">Langsung Beli</button>
                </form>
                <form method="post">
                    <input type="hidden" name="item_id" value="<?php echo $item['item_id'] ?? '1'; ?>">
                    <input type="hidden" name="user_id" value="<?php echo 1; ?>">
                    <?php
                    if (in_array($item['item_id'], $Cart->getCartId($product->getData('cart')) ?? [])){
                        echo '<button type="submit" disabled class="btn btn-success font-size-12">In the Cart</button>';
                    }else{
                        echo '<button type="submit" name="top_sale_submit" class="btn btn-warning font-size-12">Tambahkan Ke Keranjang</button>';
                    }
                    ?>
                </form>
            </div>
        </div>
    </div>
</section>
<!--   !product  -->
<?php
        endif;
        endforeach;
?>