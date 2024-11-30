<?php
namespace App\Entities;

abstract class AbstractEntity{

    public function toArray(): array{
        $array = [];
        foreach($this as $key => $value){
            $array[$key] = $value;
        }
        return $array;
    }
}