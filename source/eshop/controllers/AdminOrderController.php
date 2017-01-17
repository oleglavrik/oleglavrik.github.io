<?php

/**
 * Class AdminOrderController
 */
class AdminOrderController extends AdminBase {
    public function actionIndex(){
        # check access
        self::checkAdmin();
        # get orderList
        $ordersList = Order::getOrderList();

        require_once(ROOT . '/views/admin_order/index.php');
        return true;
    }

    public function actionDelete($id){
        # check access
        self::checkAdmin();
        if(isset($_POST['submit'])){
            # delete current order
            Order::deleteOrderById($id);
            # redirect
            header('Location: /admin/order/');
        }

        require_once(ROOT . '/views/admin_order/delete.php');
        return true;
    }

    public function actionUpdate($id){
        # check access
        self::checkAdmin();

        # get order info
        $order = Order::getOrderById($id);

        if(isset($_POST['submit'])){
            # get update data
            $options['user_name']    = $_POST['userName'];
            $options['user_phone']   = $_POST['userPhone'];
            $options['user_comment'] = $_POST['userComment'];
            $options['date']         = $_POST['date'];
            $options['status']       = $_POST['status'];

            # errors flag
            $errors = false;

            # valid field
            if(!isset($options['user_name']) || empty($options['user_name'])){
                $errors[] = ' - The user name is empty';
            }
            if(!isset($options['user_phone']) || empty($options['user_phone'])){
                $errors[] = ' - The user phone is empty';
            }

            if(!isset($options['date']) || empty($options['date'])){
                $errors[] = ' - The date is empty';
            }

            if($errors == false){
                Order::updateOrderById(
                                        $id,
                                        $options['user_name'],
                                        $options['user_phone'],
                                        $options['user_comment'],
                                        $options['date'],
                                        $options['status']);

                header('Location: /admin/order/');
            }


        }
        require_once(ROOT . '/views/admin_order/update.php');
        return true;
    }

    public function actionView($id){
        # check access
        self::checkAdmin();

        $order = Order::getOrderById($id);
        $productsQuantity = json_decode($order['products'], true);
        $productsIds = array_keys($productsQuantity);

        $products = Product::getProductsByIds($productsIds);

        require_once(ROOT . '/views/admin_order/view.php');
        return true;
    }
} 