<?php

namespace Database\Factories;

use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MedicalRecord>
 */
class MedicalRecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $patients = Patient::pluck('id')->toArray();
        $tanggal = $this->faker->dateTime();
        return [
            'patient_id' => $patients[array_rand($patients)],
            'order' => rand(),
            'anamnesa' => $this->faker->sentence(),
            'physical_check' => $this->faker->sentence(),
            'diagnose' => $this->faker->sentence(),
            'theraphy' => $this->faker->sentence(),
            'receipt' => $this->faker->sentence(),
            'doctor_price' => $this->faker->numberBetween(50000, 100000),
            'created_at' => $tanggal,
            'updated_at' => $tanggal,
        ];
    }
}
