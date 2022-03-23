<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Http;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $provincies = Http::get('http://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')->json();
        $provincy = $provincies[array_rand($provincies)];
        $regencies = Http::get('http://www.emsifa.com/api-wilayah-indonesia/api/regencies/'.$provincy['id'].'.json')->json();
        $regency = $regencies[array_rand($regencies)];
        $districts = Http::get('http://www.emsifa.com/api-wilayah-indonesia/api/districts/'.$regency['id'].'.json')->json();
        $district = $districts[array_rand($districts)];
        $villages = Http::get('http://www.emsifa.com/api-wilayah-indonesia/api/villages/'.$district['id'].'.json')->json();
        $village = $villages[array_rand($villages)];
        $name = substr($this->faker->name(), 0, 25);
        return [
            'no_rm' => substr($name, 0, 1).'-'.$this->faker->unique()->randomNumber(4),
            'name' => $name,
            'birth' => $this->faker->date(),
            'gender' => ['L','P'][$this->faker->randomKey(['L','P'])],
            'mother_name' => $this->faker->name('female'),
            'father_name' => $this->faker->name('male'),
            'provincy' => $provincy['name'],
            'regency' => $regency['name'],
            'district' => $district['name'],
            'village' => $village['name'],
            'address' => $this->faker->address(),
            'phone' => $this->faker->e164PhoneNumber(),
        ];
    }
}
