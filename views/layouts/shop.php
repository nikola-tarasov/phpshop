



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link href="style/css.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Магазин</title>
</head>

<body>

<table align="center" width="900" cellpadding="0" cellspacing="0" border="0" id="main-table">
<tr>
	<td>
        <div id="header"></div>
        <div id="menu">
            <div><a href="index.php">Главная</a></div>
<!--            тут подключаем php вывода в меню категорий из бд -->
            <?php
//            запрос sql для вывода категорий в меню из бд
            $sql = "SELECT * FROM categories";

//            сам результат выборки
            $result_product = $conn->query($sql);

//            проходим в цикле  и вовдим в row значения
            foreach ($result_product as $row){

               echo '<div><a href="index.php?view=cat&id=' . $row['cat_id'] . '">' . $row['name'] . '</a></div>';
            }

            ?>
            <div id="cart"><a href="index.php?view=cart">Ваша корзина <?= $_SESSION['total_items'] ?></a> -<?= $_SESSION['total_price']?> $</div>
        </div>
    </td>
</tr>
<tr>
	<td id="main-block" valign="top">
    
    <?php include($_SERVER['DOCUMENT_ROOT'].'/views/pages/'.$view.'.php'); ?>
    
    
    
        
        <div style="clear: both;"></div>
        
        
        
    </td>
</tr>
<tr>
    <td id="footer-td">
        <div align="center">
            <div class="footer">&copy; mysite.com 2012</div>
        </div>
    </td>
</tr>
</table>

</body>
</html>