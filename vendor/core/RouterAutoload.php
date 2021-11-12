<?php


class RouterAutoload {

    /*
     * This method forms an array of file names from the directory passed to it.
     */
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

    /*
    * This method autoloads all routes to a file app/routes/routes.php in the format of a controller class / controller method.
    */
    public static function loadRoute() {
        $dir = '../app/controllers';
        $file = '../app/routes/routes.php';

        $route = [];
        foreach (self::dirToArray($dir) as $file) {
            //get class name without .php
            $nameclass = str_replace('.php','', $file);

            //create class object
            $new = new $nameclass;

            //get class method
            $cmeth = get_class_methods($new);

            //get array without __constructor
            if ($cmeth[0] == '__construct') {
                $cmeth = array_splice($cmeth, 1);
            }

            //get array all routes in site
            foreach ($cmeth as $v) {
                $file = '../app/routes/routes.php';
                $route[] = "Router::add('$nameclass/$v', ['controller' =>'$nameclass', 'action'=>'$v']);\n";
            }
        }
        //check if the file routes.php in case true delete file and create new file routes.php with new content
        if(file_exists($file)) {//
            unlink($file);
            file_put_contents($file, $route, FILE_APPEND);
        }

        //append in start of file routes.php <?php, and main routes.
        $php = "<?php\n";
        $mainroute = "Router::add('', ['controller' =>'main', 'action'=>'index']);\n";
        $file_data = $php.$mainroute;
        $file_data .= file_get_contents($file);
        file_put_contents($file, $file_data);
    }
}




