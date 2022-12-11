<?php

class RaceResultClass
{
    protected $id = 0;
    public $number = "";
    public $name = "";
    public $city = "";
    public $car = "";
    public $attempts = [];
    public $total_count = 0;

    public function __construct($id, $name, $city, $car, $number, $attempts)
    {
        $this->id = $id;
        $this->name = $name;
        $this->city = $city;
        $this->car = $car ;
        $this->number = $number ;
        $this->attempts = $attempts;
        $this->total_count = array_sum($attempts);
    }

    public function carView()
    {
        return "
        ID: {$this->id}<br>
        Имя: {$this->name}<br>
        Город: {$this->city}<br>
        Авто: {$this->car}<br>
        Номер: {$this->number}<br>
        Очки:{$this->total_count}<br>";
    }
}