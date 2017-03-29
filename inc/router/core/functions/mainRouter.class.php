<?php
class mainRouter
{
  //Function for the default route, "index"
  public function defaultRoute($filename)
  {
    if (file_exists('views/' . $filename)) {
      if ($_SERVER['REQUEST_URI'] === R_BASEPATH) {
        require_once 'views/' . $filename; //Include/Show default view file
        return true;
      }
    }
  }
  //Main function for routing pages
  public function route($path,$filename)
  {
    if (file_exists('views/' . $filename)){
      if ($_SERVER['REQUEST_URI'] === R_BASEPATH . $path . "/") {
        $time_start = microtime(true); //Start page render timer
        require_once 'views/' . $filename; //Include/Show view file
        $this->renderTime("stop", $time_start);
        return true;
      }
    }
    //If defined file does not exist and debug mode on, return error
    else if (!file_exists('views/' . $filename) && ($_SERVER['REQUEST_URI'] !== R_BASEPATH . "") && (R_DEBUG_LEVEL >= 1)) {
        echo R_ERROR_VIEW_NOTFOUND;
        return false;
    }
  }
  //Function for printing out some text
  public function routeWrite($path,$string)
  {
    if ($string !== ""){
      if ($_SERVER['REQUEST_URI'] === R_BASEPATH . $path . "/"){
        $time_start = microtime(true); //Start page render timer
        echo $string; //Print defined text
        $this->renderTime("stop", $time_start);
        return true;
      }
    }
    //If defined string ist empty and debug mode on, return error
    else {
      echo R_ERROR_DEF_STRING_EMPTY;
      return false;
    }
  }
  //Function for rendertime
  private function renderTime($action, $ts)
  {
    if ($action == "stop" && R_DEBUG_LEVEL == 2) {
      $time_end = microtime(true);
      $time = $time_end - $ts;
      echo "<p>Page render time: $time seconds</p>";
    }
  }

}
