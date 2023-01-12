<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

trait HasUuid
{
    public static function bootHasUuid()
    {
        static::creating(function ($model) {
            /**@var $model Model */
            if (!$model->getKey()) {
                $model->{$model->getKeyName()} = DB::raw('uuid()');
            }
        });
    }

    public function getIncrementing()
    {
        return false;
    }

    public function getKeyType()
    {
        return 'string';
    }
}
