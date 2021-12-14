<?php

require 'Model/Address.php';

class Content
{
    public $city;
    public $district;
    public $road;
    public $zipcode;
    public $other;

    function __construct() 
    {
        $this->city = [];
        $this->district = [];
        $this->road = [];
        $this->zipcode = "";
        $this->other = "";
    }
}

class AddAddressView extends View
{
    public $content;
    private static $cityData;
    public $city;
    public $district;
    public $road;
    public $zipcode;
    public $other;
    public $fullAddress;

    function __construct()
    {
        self::$cityData = json_decode(json_encode(Address::get()), true);
        $this->content = new Content();
        $items = get_class_vars(get_class($this->content));
        foreach ($items as $name => $value) { if($name != "zipcode") $this->$name = isset($_GET[$name]) ? $_GET[$name] : ""; }
    }

    public static function city($city, $content)
    {
        foreach (self::$cityData as $key => $item) 
        {
            if($city == $item['name'])
            {
                $content->city[$key] = self::optionSelect($item['name']);
            } else {
                $content->city[$key] = self::option($item['name']);
            }
        }
    }

    public function district()
    {
        $items = Address::get(new City($this->city));
        $items = json_decode(json_encode($items), true);
        foreach ($items as $key => $item) 
        {
            if ($this->district == $item['name']) 
            {
                $this->content->district[$key] = $this->optionSelect($item['name']);
            } else {
                $this->content->district[$key] = $this->option($item['name']);
            }
        }
    }

    public function road()
    {
        $items = Address::get(new CityDistrict($this->city, $this->district));
        $items = json_decode(json_encode($items), true);
        foreach ($items as $key => $item) 
        {
            if ($this->road == $item['name']) 
            {
                $this->zipcode = $item['zip_code'];
                $this->content->road[$key] = $this->optionSelect($item['name']);
            } else {
                $this->content->road[$key] = $this->option($item['name']);
            }
        }
    }
    public function zipcode() { $this->content->zipcode = $this->optionSelect($this->zipcode); }
    public function other() { $this->content->other = 'value="'.$this->other.'"'; }
  
    public function draw()
    {
        $items = get_class_vars(get_class($this->content));
        foreach ($items as $name => $value) { if ($name != "other") AddAddressView::selectRender($this->content->$name, $name); }
        echo '</div><div class="row"><p> </p></div>';
        AddAddressView::inputRender($this->content->other, "other");
    }
}

class AddAddress
{
    use Event;
    public $view;

    function __construct($view)
    {
        $this->view = $view;
    }

    public function listener()
    {
        AddAddressView::city($this->view->city, $this->view->content);
        if ($this->view->city != "") $this->view->district();
        if ($this->view->district != "") $this->view->road();
        if ($this->view->zipcode != "") $this->view->zipcode();
        if ($this->view->other != "") $this->view->other();
    }

    public function notNull()
    {
        if($this->view->city && $this->view->district && $this->view->road && $this->view->zipcode && $this->view->other)
        {
            $this->view->fullAddress = $this->view->zipcode . $this->view->city . $this->view->district . $this->view->road . $this->view->other;
            return true;
        } else {
            $this->view->fullAddress = "";
            return false;
        }
    }
}