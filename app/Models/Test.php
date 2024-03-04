<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasFactory;

    protected $matrix;

    public function __construct($matrix)
    {

        $this->matrix = $matrix;
    }

    public function getMatrix()
    {
        return $this->matrix;
    }

    public function transpose()
    {
        return new Test(array_map(null, ...$this->matrix));
    }
}
