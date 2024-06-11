<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    // Масс-даатгагдсан аттрибутуудын жагсаалт
    protected $fillable = [
        'last_name', 'first_name', 'reg_number', 'position', 'email', 'phone_number', 'gender', 'birth_date', 'start_date', 'home_number', 'work_number', 'photo', 'state',
    ];

    // Огнооны аттрибутуудын төрлийг тогтоох
    protected $casts = [
        'birth_date' => 'date',
        'start_date' => 'date',
    ];

    // Accessor & Mutator функцууд (хэрэв хэрэгтэй бол)
    // Эцэг/эхийн нэрийг том үсгээр эхлүүлэх
    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucfirst($value);
    }

    // Бүтэн нэрийг авах функц
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
