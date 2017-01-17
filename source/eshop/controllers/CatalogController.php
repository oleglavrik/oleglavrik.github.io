<?php

class CatalogController {
    public function actionIndex(){
        # getCategories
        $categories = array();
        $categories = Category::getCategory();

        # get latest products
        $latestProduct = array();
        $latestProduct = Product::getLatestProduct(6);
        require_once(ROOT . '/views/catalog/index.php');

        return true;
    }

    public function actionCategory($categoryId, $page = 1){
        $page       = intval($page);
        $categoryId = intval($categoryId);
        # getCategories
        $categories = array();
        $categories = Category::getCategory();

        #get category by id
        $categoryProducts = array();
        $categoryProducts = Product::getProductsListByCategory($categoryId, $page);

        $total = Product::getTotalProductsInCategory($categoryId);

        $pagination = new Pagination($total, $page, Product::SHOW_BY_DEFAULT, 'page-');

        require_once(ROOT . '/views/catalog/catalog.php');

        return true;
    }
} 