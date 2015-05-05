<?php
return array(
  'baseUrl'        => '/test_app',
  'basePath'       => realpath(dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR),
  'baseController' => 'Index',
  'includes'       => array(
    'controllers'
  ),
  'save_config'    => array(),
  'db'             => array(
    'host'     => 'localhost',
    'user'     => 'root',
    'password' => 'root',
  )
);
