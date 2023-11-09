<?php 
session_start();

include '../function.php';



$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM product WHERE idProduct = '$id'");





if (isset($_POST['addCart'])) {
    foreach($query as $data) {   
        $id = $query['idProduct'];
        $name = $data['productName'];
        $price = $data['price'];
        $quantity = 1;
        $userId = $_SESSION['userId'];
    }
}




mysqli_query($conn, "")


//     $item = [
//         'id' => $id,
//         'name' => $name,
//         'price' => $price,
//         'quantity' => $quantity
//     ];

//     $data = $_SESSION['cart'];
//     $search = array_search($item, $_SESSION['cart']);
//     // var_dump($_SESSION['cart']);
//     var_dump($search); exit();

//     if($search >= 1) {
//         $item['quantity'] + 1;


//     } else {

    

//     $_SESSION['cart'][] = $item;

//     }
// }

// header('Location: ../cart');

?>

