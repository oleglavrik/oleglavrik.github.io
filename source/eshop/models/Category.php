<?php

class Category {
    /**
     * Get category
     * @return array
     */
    public static function getCategory(){
        $db = Db::getConnection();

        $categoryList = array();

        $result = $db->query("SELECT id, name FROM category ORDER BY sort_order ASC");
        $i = 0;
        while($row = $result->fetch(\PDO::FETCH_ASSOC)){
            $categoryList[$i]['id']   = $row['id'];
            $categoryList[$i]['name'] = $row['name'];
            $i++;
        }

        return $categoryList;
    }

    /**
     * Get all category
     * @return array
     */
    public static function getCategoriesListAdmin(){
        $categoriesList = array();

        $db = Db::getConnection();
        $result = $db->query('SELECT id, name, sort_order, status FROM category ORDER BY sort_order ASC');

        $i = 0;
        while($row = $result->fetch(PDO::FETCH_ASSOC)){
            $categoriesList[$i]['id']         = $row['id'];
            $categoriesList[$i]['name']       = $row['name'];
            $categoriesList[$i]['sort_order'] = $row['sort_order'];
            $categoriesList[$i]['status']     = $row['status'];
            $i++;
        }

        return $categoriesList;

    }

    /**
     * Get status text
     * @param $status
     * @return string
     */
    public static function getStatusText($status){
        switch($status){
            case '1' :
                return 'Отображается';
                break;
            case '0' :;
                return 'Скрыта';
                break;
        }
    }

    /**
     * Delete category
     * @param $categoryId
     * @return bool
     */
    public static function deleteCategoryById($categoryId){
        $categoryId = intval($categoryId);
        # get connect with DB
        $db = Db::getConnection();

        # delete cat
        $sql = "DELETE FROM category WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(':id' ,$categoryId, PDO::PARAM_INT);

        return $result->execute();
    }

    /**
     * Create new category
     * @param $options
     * @return int|string
     */
    public static function createCategory($name, $sortOrder, $status){
        # get connect with DB
        $db = Db::getConnection();

        $sql = 'INSERT INTO category (name, sort_order, status) '
            . 'VALUES (:name, :sort_order, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);

        return $result->execute();

    }

    /**
     * Get category data by Id
     * @param $categoryId
     * @return mixed
     */
    public static function getCategoryById($categoryId){
        $categoryId = intval($categoryId);

        $db = Db::getConnection();

        $sql = "SELECT name, sort_order, status FROM category WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $categoryId, PDO::PARAM_INT);

        $result->execute();

        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public static function updateCategoryById($id, $name, $sortOrder, $status){
        $db = Db::getConnection();

        $sql = 'UPDATE category '
        . 'SET name = :name, sort_order = :sort_order, status = :status '
        . 'WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':sort_order', $sortOrder, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        return $result->execute();

    }
}