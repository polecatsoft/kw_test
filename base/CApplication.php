<?php

/**
 *
 */
class CUrlManager {

  /**
   *
   */
  public function __construct() {

  }
}

/**
 *
 */
class CRequest {

  /**
   * @var string
   */
  private $_baseUrl = '';

  /**
   * @var string
   */
  private $_requestUri = '';

  /**
   *
   */
  public function __construct() {
    $baseUrl = Core::getConfig('baseUrl', '');
    $this->_baseUrl = 'http://' . $_SERVER['SERVER_NAME'] . $baseUrl;
    if (isset($_SERVER['PATH_INFO'])) {
      $this->_requestUri = substr($_SERVER['PATH_INFO'], 1, strlen($_SERVER['PATH_INFO']));
    } else {
      $requestUri = $_SERVER['REQUEST_URI'];
      if (strpos($requestUri, $baseUrl) !== false) {
        //$requestUri = str_replace($baseUrl, '', $requestUri);
        $requestUri = substr($requestUri, strlen($baseUrl));
      }
      //TODO wtf
      if (strpos('index.php', $baseUrl) !== false) {
        $requestUri = str_replace('index.php', '', $requestUri);
      }
      if (strpos($requestUri, '?') !== false) {
        $requestUri = substr($requestUri, 0, strpos($requestUri, '?'));
      }
      $this->_requestUri = $requestUri;
    }
  }

  /**
   * @return mixed|string
   */
  public function requestUri() {
    return $this->_requestUri;
  }

  /**
   * @return string
   */
  public function baseUrl() {
    return $this->_baseUrl;
  }
}

/**
 *
 */
abstract class CController {

  /**
   * @return string
   */
  private function getViewPath() {
    return Core::getConfig('basePath') . '/views/';
  }

  /**
   * @return mixed
   */
  abstract public function index();

  public function redirect($url, $code = 302) {
    header( "Location: $url", true, $code );
    die();
  }

  /**
   * @param string $file
   */
  public function render($file = '', $data = []) {
    $content = '';
    if (!empty($file)) {
      ob_start();
      ob_implicit_flush(false);
      /** @noinspection PhpIncludeInspection */
      require($this->getViewPath() . $file . '.php');
      $content = ob_get_clean();
    }
    /** @noinspection PhpIncludeInspection */
    require_once $this->getViewPath() . 'layouts/main.php';
  }

  /**
   * @param string $file
   *
   * @return string
   */
  public function renderPartial($file = '') {
    if (empty($file)) {
      return '';
    }
    ob_start();
    ob_implicit_flush(false);
    /** @noinspection PhpIncludeInspection */
    require($this->getViewPath() . $file . '.php');
    return ob_get_clean();
  }

}

/**
 *
 */
class CComponent {

}

/**
 *
 */
class CApplication {

  /**
   * @var CRequest $_request
   */
  private $_request = null;

  /**
   * @var CUrlManager $_urlManager
   */
  private $_urlManager = null;

  /**
   * @return CRequest|null
   */
  public function request() {
    /*if ($this->_request === null) {
      $this->_request = new CRequest();
    }*/
    return $this->_request;
  }

  /**
   * @return CUrlManager|null
   */
  public function urlManager() {
    return $this->_urlManager;
  }

  /**
   * Run application
   */
  public function run() {
    session_start();
    $this->_request = new CRequest();
    $this->createController();
  }

  /**
   *
   */
  private function createController() {
    $error = 0;
    $requestUri = $this->_request->requestUri();
    if (strpos($requestUri, '/') == 0) {
      $requestUri = substr_replace($requestUri, '', 0, 1);
    }
    $controllerName = '';
    if ($requestUri == '') {
      $controllerName = Core::getConfig('baseController') . 'Controller';
      if (!class_exists($controllerName)) {
        $error = 404;
      }
    } else {
      $aController = explode('/', $requestUri);
      if (count($aController) > 1) {
        if (empty($aController[0])) {
          //TODO: create not found - error 404 or else.
          $error = 404;
        } else {
          $controllerName = ucfirst($aController[0]) . 'Controller';
          if (!class_exists($controllerName)) {
            $error = 404;
          }
        }
      }
    }
    if ($error == 0 && !empty($controllerName)) {
      $defaultAction = 'index';
      $controller = new $controllerName();
      if (empty($aController[1])) {
        $method = $defaultAction;
      } else {
        $method = $aController[1];
      }

      if (method_exists($controller, $method)) {
        call_user_func(array($controller, $method));
      } else {
        call_user_func(array($controller, $defaultAction));
      }
    } elseif ($error > 0) {
      $this->showError($error);
    } else {
      $this->showError();
    }
  }

  private function showError($error = 0) {
    switch ($error) {
      case 0:
        echo 'undefined Error';
        break;
      case 404:
        echo '404';
        break;
      default:
        echo 'undefined Error';
        break;
    }
  }
}

/**
 * Class ClassLoader
 */
class ClassLoader {

  public static function init() {

  }

  public static function Load($class_name) {
    $basePath = Core::getConfig('basePath', '');
    $includes = Core::getConfig('includes', array());

    foreach ($includes as $include) {
      $filePath = $basePath . DIRECTORY_SEPARATOR . $include . DIRECTORY_SEPARATOR . $class_name . '.php';
      if (file_exists($filePath)) {
        require_once $filePath;
      }
    }
  }
}

ClassLoader::init();
function __autoload($class_name) {
  ClassLoader::Load($class_name);
}