<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $appends = ['date_birth', 'parent', 'age'];

    public function getDateBirthAttribute(){
        return $this->birth.' ('.Carbon::parse($this->birth)->diff(Carbon::now())->format('%y tahun %m bulan %d hari').')';
    }

    public function getParentAttribute()
    {
        return $this->father_name.' / '.$this->mother_name;
    }

    public function getAgeAttribute()
    {
        return Carbon::parse($this->birth)->diff(Carbon::now())->format('%y tahun %m bulan %d hari');
    }

}
