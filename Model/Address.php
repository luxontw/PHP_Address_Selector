<?php

class Address extends Model
{
    public static function get(?QueryInterface $element = null)
    {
        if($element == null) $element = new AddressQuery();
        $conn = (new static)->db->prepare($element->sql);
        $query = new AddressQuery($conn);
        $query->by($element);
        return $query->result();
    }
}

class AddressQuery extends Query
{
    public string $sql = "SELECT `name` FROM `city`";
    public function bind($query) {}
}

class City extends Sql implements QueryInterface
{
    public string $sql;
    protected $city;

    public function __construct(string $city)
    {
        $this->sql = "SELECT `district`.`name` FROM `district` 
        INNER JOIN `city` ON `district`.`city_id` = `city`.`id` 
        WHERE `city`.`name` = :city";
        $this->city = $city;
    }

    public function bind($query)
    {
        $query->bindValue(':city', $this->city, PDO::PARAM_STR);
    }
}

class CityDistrict extends Sql implements QueryInterface
{
    public string $sql;
    protected $city;
    protected $district;

    public function __construct(string $city, string $district)
    {
        $this->sql = "WITH district AS(
        SELECT district.id, district.city_id FROM district             
        INNER JOIN city ON district.city_id = city.id            
        WHERE city.name = :city AND district.name = :district)
        SELECT road.name, road.zip_code FROM road, district 
        WHERE road.city_id = district.city_id AND road.district_id = district.id";
        $this->city = $city;
        $this->district = $district;
    }

    public function bind($query)
    {
        $query->bindValue(':city', $this->city, PDO::PARAM_STR);
        $query->bindValue(':district', $this->district, PDO::PARAM_STR);
    }
}