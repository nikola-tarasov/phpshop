<h2 align="center">Ваша корзина товаров</h2>
<?php

if(isset($_SESSION['cart'])){
    echo '
<form action="index.php?view=update_cart" method="post" id="cart-form">

    <table id="mycart" align="center" cellspacing="0" cellpadding="0" border="0">
        <tr>
            <th>Товар</th>
            <th>Цена</th>
            <th>Кол-во</th>
            <th>Всего</th>
        </tr>';


    foreach ($_SESSION['cart'] as $id=>$quantity)
    {

        $sql = "SELECT * FROM products WHERE id= :id";


        $res = $conn->prepare($sql);

        $res->execute([
            'id'=>$id
        ]);

        $product = $res->fetch();


        echo '
        <tr>
            <td align="center">' .$product['title'] . '</td>
            <td align="center">' .number_format($product['price'], 2). '$</td>
            <td align="center"><input type="text" size="2" name="' .$id . '" maxlength="2" value="' .$quantity .'" /></td>
            <td align="center">' .number_format($product['price'] * $quantity, 2 ).'$</td>
        </tr>';
    }

    echo '
    </table>
    <p class="total" align="center">Общая сумма заказа: <span class="product-price">' .number_format($_SESSION['total_price'], 2) . '$</span></p>
    <p align="center"><input type="submit" name="update" value="Обновить" /></p>

</form>';
}
else{
    echo 'ваша корзина пуста';
}

?>




