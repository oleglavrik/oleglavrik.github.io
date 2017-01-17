<?php

class CartController {

    public function actionIndex(){
        $categories = array();
        $categories = Category::getCategory();

        $productsInCart = false;

        $productsInCart = Cart::getProducts();

        if($productsInCart){
            $prductsIDs = array_keys($productsInCart);
            $products = Product::getProductsByIds($prductsIDs);

            $totalPrice = Cart::getTotalPrice($products);
        }

        require_once(ROOT . '/views/cart/index.php');
        return true;
    }

    public function actionCheckout()
    {
        $productsInCart = Cart::getProducts();

        if ($productsInCart == false) {
            header("Location: /");
        }

        $categories = Category::getCategory();

        $productsIds   = array_keys($productsInCart);
        $products      = Product::getProductsByIds($productsIds);
        $totalPrice    = Cart::getTotalPrice($products);
        $totalQuantity = Cart::countItems();

        $userName    = false;
        $userPhone   = false;
        $userComment = false;

        $result = false;

        if (!User::isGuest()) {
            $userId   = User::checkLogged();
            $user     = User::getUserById($userId);
            $userName = $user['name'];
        } else {
            $userId = false;
        }
        if (isset($_POST['submit'])) {

            $userName    = $_POST['userName'];
            $userPhone   = $_POST['userPhone'];
            $userComment = $_POST['userComment'];

            $errors = false;

            if (!User::checkName($userName)) {
                $errors[] = 'Неправильное имя';
            }
            if (!User::checkPhone($userPhone)) {
                $errors[] = 'Неправильный телефон';
            }

            if ($errors == false) {
                $result = Order::save($userName, $userPhone, $userComment, $userId, $productsInCart);
                if ($result) {
                    /*
                    $adminEmail = 'php.start@mail.ru';
                    $message = '<a href="http://digital-mafia.net/admin/orders">Список заказов</a>';
                    $subject = 'Новый заказ!';
                    mail($adminEmail, $subject, $message);
                    */
                    Cart::clear();
                }
            }
        }
        // Подключаем вид
        require_once(ROOT . '/views/cart/checkout.php');
        return true;
    }

    public function actionAddAjax($id)
    {
        echo Cart::addProduct($id);

        return true;
    }

    public function actionDelete($id){
        Cart::delete($id);
        header('Location: /cart/');
        return true;
    }
} 