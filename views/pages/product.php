<table align="center" cellpadding="0" cellspacing="0" class="product" border="0">
    <tr>
        <td valign="top">
            <div><a href="index.php?view=product&id='<?=$product['id']?>"><img src="userfiles/<?=$product['image']?>" alt="" /></a></div>
            <div class="description">
                <div class="product-name"><a href="#"><?= $product['title']?></a></div>
                <div class="product-price"><?=$product['price']?>$</div>
            </div>
            <td valign="top">
                <div><?= $product['description'] ?></div>
                <div><a href="index.php?view=add_to_cart&id=<?= $product['id']?>">Добавить в корзину</a></div>
            </td>
        </td>
    </tr>
</table>


