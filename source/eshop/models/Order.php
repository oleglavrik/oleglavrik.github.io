<?php

class Order {
    /**
     * Save a new order
     * @param $userName
     * @param $userPhone
     * @param $userComment
     * @param $userId
     * @param $products
     * @return bool
     */
    public static function save($userName, $userPhone, $userComment, $userId, $products)
    {
        $db = Db::getConnection();

        $sql = 'INSERT INTO product_order (user_name, user_phone, user_comment, user_id, products) '
            . 'VALUES (:user_name, :user_phone, :user_comment, :user_id, :products)';
        $products = json_encode($products);
        $result = $db->prepare($sql);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':user_id', $userId, PDO::PARAM_STR);
        $result->bindParam(':products', $products, PDO::PARAM_STR);
        return $result->execute();
    }

    /**
     * Get all orders
     * @return array
     */
    public static function getOrderList(){
        $orderList = array();
        $db = Db::getConnection();

        $sql = 'SELECT id, user_name, user_phone, date, status FROM product_order';
        $result = $db->prepare($sql);
        $result->execute();

        $i = 0;

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $orderList[$i]['id']         = $row['id'];
            $orderList[$i]['user_name']  = $row['user_name'];
            $orderList[$i]['user_phone'] = $row['user_phone'];
            $orderList[$i]['date']       = $row['date'];
            $orderList[$i]['status']     = $row['status'];
            $i++;
        }

        return $orderList;
    }

    /**
     * Get status text
     * @param $status
     * @return string
     */
    public static function getStatusText($status){
        switch($status){
            case '1' :
                return 'Новий заказ';
                break;
            case '2' :;
                return 'В обработке';
                break;
            case '3' :
                return 'Доставляється';
                break;
            case '4' :;
                return 'Закрыт';
                break;

        }
    }

    /**
     * Delete Order
     * @param $orderId
     * @return bool
     */
    public static function deleteOrderById($orderId){
        $orderId = intval($orderId);

        $db = Db::getConnection();
        $sql = 'DELETE FROM product_order WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $orderId, PDO::PARAM_INT);

        return $result->execute();

    }

    /**
     * Get order by ID
     * @param $orderId
     * @return mixed
     */
    public static function getOrderById($orderId){
        $orderId  = intval($orderId);

        $db = Db::getConnection();
        $sql = 'SELECT id, user_id, user_name, user_phone, user_comment, status, date, products '
        . 'FROM product_order WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $orderId, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Update order
     *
     * @param $id
     * @param $userName
     * @param $userPhone
     * @param $userComment
     * @param $date
     * @param $status
     * @return bool
     */
    public static function updateOrderById($id, $userName, $userPhone, $userComment, $date, $status){
        $db = Db::getConnection();

        $sql = "UPDATE product_order "
        . "SET
            user_name = :user_name,
            user_phone = :user_phone,
            user_comment = :user_comment,
            date = :date,
            status = :status
        WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':user_name', $userName, PDO::PARAM_STR);
        $result->bindParam(':user_phone', $userPhone, PDO::PARAM_STR);
        $result->bindParam(':user_comment', $userComment, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_INT);

        return $result->execute();
    }
} 