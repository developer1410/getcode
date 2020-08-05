<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function getImagesAttribute() {
        return explode('|||', $this->attributes['images']);
    }

    public function setImagesAttribute($images) {
        $this->attributes['images'] = implode('|||', $images);
    }
}
