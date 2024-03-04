<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Illuminate\Http\Request;
use App\Jobs\GenerateVariationsJob;

class TestController extends Controller
{

    // public function generateVariations(Request $request)
    // {
    //     // ,'14'
    //     // ,'14' =>['15','16','17']
    //      $attributes        = ['11','12','13'];
    //     $attributes_values = ['11' => ['1', '2', '3'],'12' => ['4', '5', '6'],'13' => ['7', '8', '9']];

    //     $results = $this->generateVariationsRecursive($attributes, $attributes_values);

    //     return response()->json($results);
    // }

    // private function generateVariationsRecursive($attributes, $attributes_values, $index = 0, $current_values = [])
    // {
    //     $results = [];

    //     if ($index == count($attributes)) {
    //         $results[] = $current_values;
    //         return $results;
    //     }

    //     $current_attribute = $attributes[$index];
    //     $values = $attributes_values[$current_attribute];

    //     foreach ($values as $value) {
    //         $temp = array_merge($current_values, [$value]);
    //         $next_index = $index + 1;
    //         $results = array_merge($results, $this->generateVariationsRecursive($attributes, $attributes_values, $next_index, $temp));
    //     }

    //     return $results;
    // }

    public function generateVariations(){
        $attributes        = ['11','12','13'];
        $attributes_values = ['11' => ['1', '2', '3'],'12' => ['4', '5', '6'],'13' => ['7', '8', '9']];

        for($i=1; $i<count($attributes);$i++){
        foreach ($attributes_values[$attributes[0]] as $value1) {

                $results[]=[$value1,$attributes_values[$attributes[$i]]];

        }
    }


        // $matrix = new Test($attributes_values);
        // $transposedMatrix = $matrix->transpose();
        // $transposedData = $transposedMatrix->getMatrix();


        // $results[]=GenerateVariationsJob::dispatch($attributes, $attributes_values)->onQueue('variations');

                //     foreach ($attributes_values[$attributes[0]] as $value1) {
                //         foreach ($attributes_values[$attributes[1]] as $value2) {
                //              foreach ($attributes_values[$attributes[2]] as $value3) {
                //             $results[]=[$value1,$value2,$value3];
                //         }
                //     }
                // }
                                return response($results);
    }
}
