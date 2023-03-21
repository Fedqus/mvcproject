<?php

namespace core;

use Exception;

class Core {
    private static Core $instance;
    
    public DatabaseContext $context;

    public $route;
    public $content;
    public $config;

    private function __construct() {}

    public static function getInstance() {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function getHtml($viewPath, $params){
        if (!is_file($viewPath)) {
            $params = ["message" => "View not found | $viewPath"];
            $viewPath = "views/errors/404.php";
        }
        ob_start();
        extract($params);
        include($viewPath);
        $html = ob_get_contents();
        ob_end_clean();
        return $html;
    }

    public function initialize() {
        session_start();
        $this->config = json_decode(file_get_contents("config/config.json"));
        
        $this->context = new DatabaseContext(
            $this->config->db_host,
            $this->config->db_name,
            $this->config->db_user,
            $this->config->db_password
        );
    }
    public function run() {
        $route = trim($_SERVER["REQUEST_URI"], "/");
        $routeParts = array_filter(explode("/", $route));
        
        $controllerName = array_shift($routeParts) ?? "main";
        $actionName = array_shift($routeParts) ?? "index";

        $controllerPath = "\\controllers\\".ucfirst($controllerName)."Controller"; 
        $actionPath = $actionName."Action"; 

        try {
            if (!class_exists($controllerPath)) {
                Utils::throwErrorPageNotFound();
            }
            $controller = new $controllerPath();
            if (!method_exists($controller, $actionPath)) {
                Utils::throwErrorPageNotFound();
            }

            $this->route["controllerName"] = $controllerName;
            $this->route["actionName"] = $actionName;
            $this->route["params"] = $routeParts;


            $this->content = $controller->$actionPath($routeParts);
        } catch (Exception $ex) {
            $this->content = self::getHtml("views/errors/".$ex->getCode().".php",[
                "message" => $ex->getMessage()
            ]);
        }
    }
    public function done() {
        $theme = "default";
        $layoutPath = "themes/$theme/layout.php";
        echo self::getHtml($layoutPath, [
            "content" => $this->content
        ]);
    }
}