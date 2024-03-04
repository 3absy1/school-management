<?php

namespace App\Models;

use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Classroom extends Model
{
    use HasFactory;
    use HasTranslations;


    protected $table = 'classrooms';
    public $translatable = ['Name_Class'];
    public $timestamps = true;
    protected $fillable=['Name_Class','Grade_id'];


    public function Grades()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }



}
