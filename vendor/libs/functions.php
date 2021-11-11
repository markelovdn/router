<?php

function dd($data) {
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

function dirToArray($dir) {

    $result = array();
    $cdir = scandir($dir);
    foreach ($cdir as $key => $value)
    {
        if (!in_array($value,array(".","..")))         {
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

function autoloadRoutes() {
    $dir = '../app/controllers';
    $file = '../app/routes/routes.php';
    $file2 = '../app/routes/routes1.php';

    $a = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $b = file($file2, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

    echo 'Главный файл<br>';
    dd($a);
    echo 'Временный файл<br>';
    dd($b);

    $result = array_diff_assoc($b, $a);
    
    dd($result);
    file_put_contents($file, $result, FILE_APPEND);

    foreach (dirToArray($dir) as $file) {
         $nameclass = str_replace('.php','', $file);
         $new = new $nameclass;
         $cmeth = get_class_methods($new);

         foreach ($cmeth as $v) {
             $file = '../app/routes/routes.php';
             $route = "Router::add('$nameclass/$v', ['controller' =>'$nameclass', 'action'=>'$v']);\n";
                 //file_put_contents($file, $route, FILE_APPEND);
             $route1 = array_fill(0, 1, $route);
         }

    }




    $php = "<?php\n";
    $file_data = $php;
    $file_data .= file_get_contents($file);
    //file_put_contents($file, $file_data);
}

//Router::add('athlete',['controller' =>'athlete', 'action'=>'all']);
//$filecontents = file('../app/controllers/' . $file, FILE_IGNORE_NEW_LINES);
//dd($filecontents);
//if ($filecontents) {
//    foreach ($filecontents as $k) {
//        $a = stristr($k, 'public function');
//        $a = preg_replace('/public function/','', $a);
//        $a= preg_replace('/\)/','', $a);
//        $a= preg_replace('/\(/','', $a);
//        $a= trim(preg_replace('/{/',':', $a));
//        echo $str = preg_replace('/(?!\n)[\p{Cc}]/', '', $a);
//    }
//}