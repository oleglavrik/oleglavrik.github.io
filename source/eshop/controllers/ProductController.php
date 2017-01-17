<?php

class ProductController {
    public function actionView($id){
        $id = intval($id);

        $categories = array();
        $categories = Category::getCategory();

        $product = Product::getProductById($id);

        require_once(ROOT . '/views/product/view.php');
        return true;
    }
} 