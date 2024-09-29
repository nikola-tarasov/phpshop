<h2 align="center">Оформления заказов</h2>
<?php

//если есть сессия масси и не нажата кнопка
if($_SESSION['cart'] && !isset($_POST['order'])){
    echo '
<form action="index.php?view=orders" method="post" id="cart-form">

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
            <p align="center" style="color: aqua">Ваш e-mail <input type="text" name="email" id=""> </p>
            <p align="center" style="color: aqua">Ваш адрес <input type="text" name="adress" id=""> </p>
            <p align="center"><input type="submit" name="order" value="Заказать" /></p>
</form>';
}

//если есть массив сессии и нажата кнопка order то добавляються из формы в бд таблицу orders
if ($_SESSION['cart'] && isset($_POST['order'])){

    $name = $_POST['name'];
    $s_name = $_POST['s-name'];
    $post_index = $_POST['post-index'];
    $email = $_POST['email'];
    $adress = $_POST['adress'];
    $data = date('Y-m-d');
    $time = date('H:i:s');

    foreach ($_SESSION['cart'] as $id=>$quantity) {

        $sql = "SELECT * FROM products WHERE id= :id";

        $res = $conn->prepare($sql);

        $res->execute([
            'id' => $id
        ]);

        $product = $res->fetch();

        $insert_sql = "INSERT INTO orders (product, prod_id, price, qty, name, s_name, post_index, email, date, time, adress) VALUES (:product, :prod_id, :price, :qty, :name, :s_name, :post_index, :email, :date, :time, :adress)";

        $stmt= $conn->prepare($insert_sql);

        $stmt->execute(['product' => $product['title'],
            'prod_id' => $product['id'],
            'price' => $product['price'],
            'qty' => $quantity,
            'name' => $name,
            's_name' => $s_name,
            'post_index' => $post_index,
            'email' => $email,
            'date' => $data,
            'time' => $time,
            'adress' => $adress
        ]);
    }

//    выводиться если прошла оплата
    echo "Спасибо! Заказ оформлен!";

}


?>




