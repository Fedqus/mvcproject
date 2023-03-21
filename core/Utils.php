<?php

namespace core;

use Exception;

class Utils {
    public static function throwErrorPageNotFound(){
        throw new Exception("Page not found", 404);
    }
    public static function throwErrorAccessForbidden(){
        throw new Exception("Forbidden", 403);
    }
    public static function redirect($href){
        header("Location: $href");
    }
}