<?php

namespace App\Uuid;
 //Pasta Vendor
 use Ramsey\Uuid\Uuid;

 trait UuidTraits
 {
     protected static function boot()
     {
         parent::boot();

         static::creating(function ($model) {
             $model->{$model->getKeyName()} = $model->generateNewUuid();
             return true;
         });
     }
     /**
      * Get a new version 4 (random) UUID.
      *
      * @return \Rhumsaa\Uuid\Uuid
      */
     public function generateNewUuid()
     {
         return Uuid::uuid4();
     }
 }
