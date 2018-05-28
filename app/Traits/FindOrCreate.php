<?php

namespace App\Traits;

trait FindOrCreate {

    /**
     * @param $name
     * @return \Illuminate\Database\Eloquent\Model
     */
    static function findByNameOrCreate($name)
    {
        $model = self::where('name', $name)->first();
        if (empty($model)){
            $model = new self;
            $model->name = $name;
            $model->save();
        }
        return $model;
    }

    /**
     * @param $attribute
     * @param $value
     * @return \Illuminate\Database\Eloquent\Model
     */
    static function findByAttributeOrCreate($attribute, $value)
   {
       $model = self::where($attribute, $value->first);
       if (empty($model)) {
           $model = new self;
           $model->{$attribute} = $value;
           $model->save();
       }
       return $model;
   }
}