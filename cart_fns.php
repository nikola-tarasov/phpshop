<?php



function addToCart($id)
{


    if (isset($_SESSION['cart'][$id])){
    $_SESSION['cart'][$id]++;
    return true;
}
else{

    $_SESSION['cart'][$id] = 1;
    return true;

}
    return false;

}


function upDateCart()
{

    foreach ($_SESSION['cart'] as $id => $qty) {

        if ($_POST[$id] == '0') {
            unset($_SESSION['cart'][$id]);
        } else {
            $_SESSION['cart'][$id] = $_POST[$id];
        }

    }

}

function total_items($arr)
    {
        $numItems = 0;

        if (is_array($arr)){
            foreach ($arr as $id => $qty ){

                $numItems = $numItems + $qty;
            }
        }
        return $numItems;

    }


function  total_price($arr)
    {

        include 'db_fnl.php';

        $total_price = '0.0';

        if($arr){
            foreach ($_SESSION['cart'] as $id => $qty){

                $sql = "SELECT * FROM products WHERE id= :id";

                $res = $conn->prepare($sql);

                $res->execute([
                    'id'=>$id
                ]);

                $product = $res->fetch();

                $total_price = $total_price + $product['price'] * $qty;
            }
        }
        return $total_price;
    }






