<?php
Router::add('', ['controller' =>'main', 'action'=>'index']);
Router::add('main/index', ['controller' =>'main', 'action'=>'index']);
Router::add('test/index', ['controller' =>'test', 'action'=>'index']);
Router::add('test/newtest', ['controller' =>'test', 'action'=>'newtest']);
Router::add('test/edittest', ['controller' =>'test', 'action'=>'edittest']);
Router::add('test/deletetest', ['controller' =>'test', 'action'=>'deletetest']);
