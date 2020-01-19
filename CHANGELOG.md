VERSION 4.2.0
-------------
Release date: ?

 - added default home route (the / route)
 - updated docker php version from 7.3 to 7.4
 - updated monolog version
 - switched from zendframework/zend-diactoros to laminas/laminas-diactoros

VERSION 4.1.2
-------------
Release date: 2020-01-07

 - fixed typo in Core\Service\ContainerService
 - updated composer.json
 - simplified public/index.php

VERSION 4.0.1
-------------
Release date: 2019-06-29

 - added missing laravel database and phinx migration
 - removed realpath() from constants.php which cause problem on some linux server
 - added Core\Service\ContainerService
 - added tests for services
 - added phpstan

VERSION 4.0.0
-------------
Release date: 2019-06-24

 - First release for Peak Framework 4.0.0