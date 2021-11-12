<?php


class RouterAutoload {

    private static function dirToArray($dir) {
        $result = array();
        $cdir = scandir($dir);
        foreach ($cdir as $key => $value) {
            if (!in_array($value,array(".",".."))) {
                if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
                    $result[$value] = dirToArray($dir . DIRECTORY_SEPARATOR . $value);
                }
                else {
                    $result[] = $value;
                }
            }
        }
        return $result;
    }

    public static function loadRoute() {
        $dir = '../app/controllers';
        $file = '../app/routes/routes.php';

        $route = [];
        foreach (self::dirToArray($dir) as $file) {
            $nameclass = str_replace('.php','', $file);
            $new = new $nameclass;
            $cmeth = get_class_methods($new);
            if ($cmeth[0] == '__construct') {
                $cmeth = array_splice($cmeth, 1);
            }
            foreach ($cmeth as $v) {
                $file = '../app/routes/routes.php';
                $route[] = "Router::add('$nameclass/$v', ['controller' =>'$nameclass', 'action'=>'$v']);\n";
            }
        }
        if(file_exists($file)) {
            unlink($file);
            file_put_contents($file, $route, FILE_APPEND);
        }

        $php = "<?php\n";
        $mainroute = "Router::add('', ['controller' =>'main', 'action'=>'index']);\n";
        $file_data = $php.$mainroute;
        $file_data .= file_get_contents($file);
        file_put_contents($file, $file_data);
    }
}




