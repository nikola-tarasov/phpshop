<h2 align="center">оформления заказов</h2>
<?php

if($_SESSION['cart']){
    echo '
<form action="index.php?view=order" method="post" id="cart-form">

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
            <td align="center">' .$quantity . '</td>
            <td align="center">' .number_format($product['price'] * $quantity, 2 ).'$</td>
        </tr>';
    }

    echo '
    </table>
            <p class="total" align="center">Общая сумма заказа: <span class="product-price">' .number_format($_SESSION['total_price'], 2) . '$</span></p>
            <p align="center" style="color: aqua">Ваше имя <input type="text" name="name" id=""></p>
            <p align="center" style="color: aqua">Ваша фамилиия <input type="text" name="s-name" id=""> </p>
            <p align="center" style="color: aqua">Ваша почтовый индекс <input type="text" name="post-index" id=""> </p>
            <p align="center" style="color: aqua">Ваш e-mail <input type="email" name="email" id=""> </p>
            <p align="center" style="color: aqua">Ваш адрес <input type="text" name="adress" id=""> </p>
            <p align="center"><input type="submit" name="order" value="Заказать" /></p>
</form>';
}
?>




