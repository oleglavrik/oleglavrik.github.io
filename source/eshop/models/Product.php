<?php

class Product {
    const SHOW_BY_DEFAULT = 6;

    /**
     * Get latest products
     * @param int $count
     * @return array
     */
    public static function getLatestProduct($count = self::SHOW_BY_DEFAULT){
        $count = intval($count);
        $db = Db::getConnection();

        $productList = array();

        $query = $db->query('SELECT id, name, image, price, image, is_new FROM product '
        . 'WHERE status = "1"'
        . 'ORDER BY id DESC '
        . 'LIMIT ' . $count);


        $i = 0;
        while ($row = $query->fetch(\PDO::FETCH_ASSOC)){
            $productList[$i]['id']     = $row['id'];
            $productList[$i]['name']   = $row['name'];
            $productList[$i]['price']  = $row['price'];
            $productList[$i]['image']  = $row['image'];
            $productList[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $productList;

    }

    /**
     * Get products list by one category
     * @param bool $categoryId
     * @param int $page
     * @return array
     */
    public static function getProductsListByCategory($categoryId = false, $page = 1){
        $page = intval($page);
        $offset = ($page - 1) * self::SHOW_BY_DEFAULT;

        $db = Db::getConnection();
        $products = array();

        $result = $db->query("SELECT id, name, price, image, is_new FROM product "
        . "WHERE status = '1' AND category_id = '$categoryId' "
        . "ORDER BY id "
        . "LIMIT " . self::SHOW_BY_DEFAULT
        . " OFFSET " . $offset);

        $i = 0;
        while($row = $result->fetch(\PDO::FETCH_ASSOC)){
            $products[$i]['id']     = $row['id'];
            $products[$i]['name']   = $row['name'];
            $products[$i]['price']  = $row['price'];
            $products[$i]['image']  = $row['image'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $products;

    }

    /**
     * Get product by ID
     * @param $id
     * @return mixed
     */
    public static function getProductById($id){
        $id = intval($id);

        if($id){
            $db = Db::getConnection();

            $result = $db->query('SELECT * FROM product WHERE id = ' . $id);

            return $result->fetch(\PDO::FETCH_ASSOC);
        }
    }

    /**
     * Get quantity products the same category
     * @param $categoryId
     * @return mixed
     */
    public static function getTotalProductsInCategory($categoryId){
        $db = Db::getConnection();
        $result = $db->query("SELECT count(id) AS count FROM product "
        . 'WHERE status = "1" AND category_id = "'.$categoryId.'"');

        $row = $result->fetch(\PDO::FETCH_ASSOC);

        return $row['count'];

    }

    /**
     * Get some products by ID's
     * @param $idsArray
     * @return array
     */
    public static function getProductsByIds($idsArray){
        $products = array();

        $db = Db::getConnection();

        $idString = implode(', ', $idsArray);

        $sql = "SELECT * FROM product WHERE status = '1' AND id IN ($idString)";
        $result = $db->query($sql);
        $result->setFetchMode(PDO::FETCH_ASSOC);

        $i = 0;
        while($row = $result->fetch()){
            $products[$i]['id']    = $row['id'];
            $products[$i]['code']  = $row['code'];
            $products[$i]['name']  = $row['name'];
            $products[$i]['price'] = $row['price'];
            $i++;
        }

        return $products;

    }

    /**
     * Get recommended products for slider
     * @param $count
     * @return array
     */
    public static function getRecommendedProducts($count){
        $count = intval($count);
        $products = array();

        $db = Db::getConnection();

        $sql = "SELECT * FROM product WHERE is_recommended = '1' "
        . "LIMIT :count";
        $result = $db->prepare($sql);
        $result->bindParam(':count', $count, PDO::PARAM_INT);
        $result->execute();

        $i = 0;

        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $products[$i]['id']     = $row['id'];
            $products[$i]['name']   = $row['name'];
            $products[$i]['price']  = $row['price'];
            $products[$i]['image']  = $row['image'];
            $products[$i]['is_new'] = $row['is_new'];
            $i++;
        }

        return $products;
    }

    /**
     * Get all products
     * @return array
     */
    public static function getProductsList(){
        $productList = array();

        $db = Db::getConnection();
        $result = $db->query('SELECT id, name, price, code FROM product ORDER BY id ASC');

        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $productList[$i]['id']    = $row['id'];
            $productList[$i]['name']  = $row['name'];
            $productList[$i]['price'] = $row['price'];
            $productList[$i]['code']  = $row['code'];
            $i++;
        }

        return $productList;
    }

    /**
     *
     * Delete product by ID
     * @param int $id
     * @return bool
     */
    public static function deleteProductById($id){
        $id = intval($id);

        $db = Db::getConnection();

        $sql = 'DELETE FROM product WHERE id = :id';
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();

    }

    /**
     * Create product
     * @param $options
     * @return int|string
     */
    public static function createProduct($options){
        $db = Db::getConnection();

        $sql = 'INSERT INTO product '
            . '(name, code, price, category_id, brand, availability,'
            . 'description, is_new, is_recommended, status)'
            . 'VALUES '
            . '(:name, :code, :price, :category_id, :brand, :availability,'
            . ':description, :is_new, :is_recommended, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);

        if($result->execute()){
            return $db->lastInsertId();
        }

        return 0;

    }

    /**
     * Update product
     * @param $id
     * @param $options
     * @return bool
     */
    public static function updateProductById($id, $options){
        # connect to DB
        $db = Db::getConnection();
        # sql
        $sql = "UPDATE product
            SET
                name = :name,
                code = :code,
                price = :price,
                category_id = :category_id,
                brand = :brand,
                availability = :availability,
                description = :description,
                is_new = :is_new,
                is_recommended = :is_recommended,
                status = :status
            WHERE id = :id";
        # prepare sql
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], PDO::PARAM_STR);
        $result->bindParam(':code', $options['code'], PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':brand', $options['brand'], PDO::PARAM_STR);
        $result->bindParam(':availability', $options['availability'], PDO::PARAM_INT);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);
        $result->bindParam(':is_new', $options['is_new'], PDO::PARAM_INT);
        $result->bindParam(':is_recommended', $options['is_recommended'], PDO::PARAM_INT);
        $result->bindParam(':status', $options['status'], PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Get image
     * @param $id
     * @return string
     */
    public static function getImage($id){
        $noImage = 'no-image.jpg';

        $path = '/upload/images/products/';
        $pathToProductImage = $path . $id . '.jpg';
        if(file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)){
            return $pathToProductImage;
        }

        return $path . $noImage;
    }
} 