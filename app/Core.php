<?php
class Core {

  /**
   * @var array Config of application
   */
  private static $configs = array();

  /**
   * @var CApplication $application
   */
  private static $_app = null;

  /**
   * getter config value
   *
   * @param string $name    Name of config value
   * @param string $default default value of config
   *
   * @return mixed return value of config
   */
  public static function getConfig($name = '', $default = '') {
    if (empty($name)) {
      return null;
    }
    $result = null;
    if (isset(self::$configs[$name])) {
      $result = self::$configs[$name];
    } else {
      $result = (!empty($default) ? $default : $result);
    }
    return $result;
  }

  /**
   * setter config value
   *
   * @param string $name  Name of config value
   * @param string $value value of config
   */
  public static function setConfig($name = '', $value = '') {
    if (empty($name)) {
      return;
    }
    self::$configs[$name] = $value;
  }

  /**
   * @param mixed(array|string) $configuration Application configuration;
   */
  public static function createApplication($configuration) {
    if (is_string($configuration)) {
      self::$configs = require($configuration);
    } elseif (is_array($configuration)) {
      self::$configs = $configuration;
    }
    self::$_app = new CApplication();
    return self::$_app;
  }

  public static function app() {
    return self::$_app;
  }
}