<?php

class AdminProductController extends AdminBase {
    public function actionIndex(){
        self::checkAdmin();
        $productsList = Product::getProductsList();

        require_once(ROOT . '/views/admin_product/index.php');
        return true;
    }

    public function actionDelete($id){
        self::checkAdmin();

        if(isset($_POST['submit'])){
            Product::deleteProductById($id);
            header('Location: /admin/product/');
        }

        require_once(ROOT . '/views/admin_product/delete.php');
        return true;
    }

    public function actionCreate(){
        # check access
        self::checkAdmin();
        # get all cat
        $categoriesList = Category::getCategoriesListAdmin();

        if(isset($_POST['submit'])){
            # FORM SENT
            # get data
            $options['name']           = $_POST['name'];
            $options['code']           = $_POST['code'];
            $options['price']          = $_POST['price'];
            $options['category_id']    = $_POST['category_id'];
            $options['brand']          = $_POST['brand'];
            $options['availability']   = $_POST['availability'];
            $options['description']    = $_POST['description'];
            $options['is_new']         = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status']         = $_POST['status'];

            # errors flag
            $errors = false;

            # valid field
            if(!isset($options['name']) || empty($options['name'])){
                $errors[] = ' - The name is empty';
            }

            # check errors
            if($errors == false){
                # add new product and get his id
                $id = Product::createProduct($options);

                if ($id) {
                    # check, the image loaded
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg");
                    }
                };

                # redirect to admin/product
                header("Location: /admin/product");
            }
        }

        require_once(ROOT . '/views/admin_product/create.php');
        return true;
    }

    public function actionUpdate($id){
        # check access
        self::checkAdmin();

        # get all cat
        $categoriesList = Category::getCategoriesListAdmin();

        # get data about current product
        $product = Product::getProductById($id);

        if(isset($_POST['submit'])){
            # FORM SENT
            # get data
            $options['name']           = $_POST['name'];
            $options['code']           = $_POST['code'];
            $options['price']          = $_POST['price'];
            $options['category_id']    = $_POST['category_id'];
            $options['brand']          = $_POST['brand'];
            $options['availability']   = $_POST['availability'];
            $options['description']    = $_POST['description'];
            $options['is_new']         = $_POST['is_new'];
            $options['is_recommended'] = $_POST['is_recommended'];
            $options['status']         = $_POST['status'];

            if(Product::updateProductById($id, $options)){
                # check, the image loaded
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    var_dump(move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/products/{$id}.jpg"));
                }
            }

            header('Location: /admin/product/');
        }

        require_once(ROOT . '/views/admin_product/update.php');
        return true;
    }
} 