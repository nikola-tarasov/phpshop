<?php
//тут подключаем верстку HTML с контентом










//запрос из бд продуктов
$sql = "SELECT * FROM products ORDER BY id DESC";

$result_category = $conn->query($sql);


//вывод в цикле выборки
foreach($result_category as $row){

echo '

        <table align="center" cellpadding="0" cellspacing="0" class="product" border="0">
            <tr>
                <td valign="top">
                    <div><a href="index.php?view=product&id=' . $row['id'] .'"><img src="userfiles/' . $row['image'] .'" alt="" /></a></div>
                <div class="description">
                        <div class="product-name"><a href="#">' . $row['title'] . '</a></div>
                        <div class="product-price">' . $row['price'] . '$</div>
                    </div>
                </td>
            </tr>
        </table>
';

}
?>;






