<?php

namespace Database\Factories;

use App\Models\EquipmentProject;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EquipmentProject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'equipment_id' => rand(1, 5),
            'project_id' => rand(1, 20),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
