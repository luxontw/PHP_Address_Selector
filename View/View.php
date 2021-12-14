<?php

class View
{
    public static function selectRender($items, $name) { require 'View/address_select.php'; }
    public static function inputRender($item, $name) { require 'View/address_input.php'; }
    public static function option($item) { return '<option>'.htmlspecialchars($item).'</option>'; }
    public static function optionSelect($item) { return '<option selected="selected">'.htmlspecialchars($item).'</option>'; }
}

trait Event
{
    public $events = array();

    public function trigger($event, $args = array())
    {
        if(isset($this->events[$event]))
        {
            foreach($this->events[$event] as $func)
            {
                call_user_func($func, $args);
            }
        }

    }

    public function bind($event, Closure $func)
    {
        $this->events[$event][] = $func;
    }
}