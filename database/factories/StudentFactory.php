<?php

namespace Database\Factories;

use App\Models\Student;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{

    protected $model = Student::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $male = $this->faker->randomElement(['male']);
        $female = $this->faker->randomElement(['female']);
        return [
            'name' => $this->faker->name($gender),
            'email' => $this->faker->unique()->safeEmail(),
            'mobile' => $this->faker->numerify('##########'),
            'class' => $this->faker->numberBetween($min = 1, $max = 12),
            'father_name' => $this->faker->name($male),
            'mother_name' => $this->faker->name($female),
        ];
    }
}
