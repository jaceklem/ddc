<?php
  class Template {
    private function loadMain() {
      $text = file_get_contents('templates/index.html');
      return $text;
    }

    public function generateTemplate($name,$values = array()) {
      $val = $values;
      $text = file_get_contents("templates/".$name.".html");
      $val["CONTENT"] = $text;

      $main = $this->loadMain();
      foreach (array_keys($val) as $key) {
        $main = str_replace(" ".$key." ",$val[$key],$main);
      }
        return $main
    }
  }

?>
