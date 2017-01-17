<?php

class AdminCategoryController extends AdminBase {
    public function actionIndex(){
        # check access
        self::checkAdmin();
        $categoriesList = Category::getCategoriesListAdmin();
        require_once(ROOT . '/views/admin_category/index.php');
        return true;
    }

    public function actionDelete($id){
        # check access
        self::checkAdmin();

        if(isset($_POST['submit'])){
            Category::deleteCategoryById($id);
            header('Location: /admin/category/');
        }

        require_once(ROOT . '/views/admin_category/delete.php');
        return true;
    }

    public function actionCreate(){
        # check access
        self::checkAdmin();

        if(isset($_POST['submit'])){
            # get category data
            $name      = $_POST['name'];
            $sortOrder = $_POST['sort_order'];
            $status    = $_POST['status'];

            # errors flag
            $errors = false;

            # valid field
            if(!isset($name) || empty($name)){
                $errors[] = ' - The name is empty';
            }

            # check errors
            if($errors == false){
                Category::createCategory($name, $sortOrder, $status);
                header('Location: /admin/category/');
            }
        }

        require_once(ROOT . '/views/admin_category/create.php');
        return true;
    }

    public function actionUpdate($id){
        # check access
        self::checkAdmin();
        # get current category
        $category = Category::getCategoryById($id);

        if(isset($_POST['submit'])){
            # get edited category data
            $name       = $_POST['name'];
            $sort_order = $_POST['sort_order'];
            $status     = $_POST['status'];

            # update category
            Category::updateCategoryById($id, $name, $sort_order, $status);

            # redirect
            header("Location: /admin/category");
        }

        require_once(ROOT . '/views/admin_category/update.php');
        return true;
    }
} 