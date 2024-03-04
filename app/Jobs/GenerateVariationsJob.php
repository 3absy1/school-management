<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class GenerateVariationsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $attributes;
    protected $attributes_values;

    /**
     * Create a new job instance.
     */
    public function __construct($attributes, $attributes_values)
    {
        $this->attributes = $attributes;
        $this->attributes_values = $attributes_values;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $results = $this->generateVariationsRecursive($this->attributes, $this->attributes_values);

    }

    private function generateVariationsRecursive($attributes, $attributes_values, $index = 0, $current_values = [], $results = [])
    {
        if ($index == count($attributes)) {
            $results[] = $current_values;
            return $results;
        }

        $current_attribute = $attributes[$index];
        $values = $attributes_values[$current_attribute];

        foreach ($values as $value) {
            $temp = array_merge($current_values, [$value]);
            $next_index = $index + 1;
            $results = $this->generateVariationsRecursive($attributes, $attributes_values, $next_index, $temp, $results);
        }

        return $results;
    }
}
