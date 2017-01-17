<?php

class Router {
    private $routes;

    public function __construct(){
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    /**
     * return request query
     *
     * @return string
     */
    private function getURI(){
        if(!empty($_SERVER['REQUEST_URI'])){
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    public function run(){
        #get url
        $uri = $this->getURI();

        foreach($this->routes as $urlPattern => $path){
            if(preg_match("~$urlPattern~", $uri)){

                $internalRoute = preg_replace("~$urlPattern~", $path, $uri);

                # get controller name
                $segments = explode('/', $internalRoute);

                $controllerName = array_shift($segments) . 'Controller';
                $controllerName = ucfirst($controllerName);

                # get action name
                $actionName = 'action' . ucfirst(array_shift($segments));

                #get array parameters
                $parameters = $segments;

                #include controller
                $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
                if(file_exists($controllerFile)){
                    include_once($controllerFile);
                }

                # create object and run method
                $controllerObject = new $controllerName;

                $result = call_user_func_array(array($controllerObject, $actionName), $parameters);

                if($result != null){
                    break;
                }
            }
        }
    }
} 