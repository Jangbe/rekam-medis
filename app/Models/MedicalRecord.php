<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicalRecord extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['is_checked'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function rujukan($a)
    {
        return json_decode($this->rujukan, true)[$a];
    }

    public function getIsCheckedAttribute()
    {
        return !is_null($this->anamnesa);
    }

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }

}
