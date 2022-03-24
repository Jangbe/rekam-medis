<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public function receipts()
    {
        return $this->hasMany(Receipt::class, 'medical_record_id');
    }

    public function med_rec()
    {
        return $this->hasOne(MedicalRecord::class, 'id', 'med_rec_id');
    }
}
