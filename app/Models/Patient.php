<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['date_birth', 'parent', 'age', 'month'];

    public function med_recs()
    {
        return $this->hasMany(MedicalRecord::class);
    }

    public function getDateBirthAttribute(){
        return $this->birth.' ('.Carbon::parse($this->birth)->diff(Carbon::now())->format('%y tahun %m bulan %d hari').')';
    }

    public function getParentAttribute()
    {
        return $this->father_name.' / '.$this->mother_name;
    }

    public function getAgeAttribute()
    {
        $age = Carbon::parse($this->birth)->diff(Carbon::now());
        // ->format('%y tahun %m bulan %d hari');
        $text = '';
        if($age->format('%y')>0){
            $text .= $age->format('%y tahun');
        }
        if($age->format('%m')>0){
            $text .= $age->format(' %m bulan');
        }
        if($age->format('%d')>0){
            $text .= $age->format(' %d hari');
        }
        return $text;
    }

    public function getMonthAttribute()
    {
        return Carbon::parse($this->birth)->diffInMonths(Carbon::now());
    }

}
