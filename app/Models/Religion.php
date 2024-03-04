<?php

namespace App\Models;
use Spatie\Translatable\HasTranslations;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Religion extends Model
{
    use HasFactory;
    use HasTranslations;
    public $translatable = ['Name'];
    protected $fillable =['Name'];
    //protected $guarded =[];
}
