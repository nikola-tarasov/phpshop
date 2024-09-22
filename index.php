<?php

//$view = '';
//
//if(empty($_GET['view'])){
//    $view = 'index';
//}
//else{
//    $view = $_GET['view'];
//}



include 'test.php';
include 'db_fnl.php';
include 'cart_fns.php';

session_start();

if (!isset($_SESSION['cart'])){


    $_SESSION['cart'] = [];

    $_SESSION['total_price'] = '0.00';

    $_SESSION['total_items'] = 0;


}




//test($_SESSION['cart']);
//test($_SESSION['total_price']);
//test($_SESSION['total_items']);







// переменная где храниться слаг метода get
//если нет переменной то вывожиться по умолчанию index
//если есть то перенаправляет на папку page страниц
$view = empty($_GET['view']) ? 'index' : $_GET['view'];



switch ($view){

    case('add_to_cart'):

        $id = $_GET['id'];

        $addItem = addToCart($id);

        $_SESSION['total_items'] = total_items($_SESSION['cart']);
        $_SESSION['total_price'] = total_price($_SESSION['cart']);


//        $_SESSION['total_price'] = total_price($_SESSION['cart']);

        header("Location: index.php?view=product&id=$id");

        break;

    case('cat'):
        $cat = $_GET['id'];

        $sql = "SELECT * FROM products WHERE cat= :cat";

        $res = $conn->prepare($sql);

        $res->execute([
            'cat'=>$cat,
        ]);

        break;


    case ('product'):

            $id = $_GET['id'];

            $sql = "SELECT * FROM products WHERE id= :id";

            $res = $conn->prepare($sql);

            $res->execute([
                'id'=>$id
            ]);

            $product = $res->fetch();



            break;

    case('cart'):
        break;

    case ('update_cart'):
        upDateCart();

        $_SESSION['total_items'] = total_items($_SESSION['cart']);
        $_SESSION['total_price'] = total_price($_SESSION['cart']);
        header('Location: index.php?view=cart');
        break;

}

include $_SERVER['DOCUMENT_ROOT'] . '/views/layouts/shop.php';
//подлючение шаблона верстки


