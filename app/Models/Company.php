<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $primaryKey = 'company_id';

    protected $fillable = ['company_name', 'company_type', 'website', 'company_description'];

    public function employees()
    {
        return $this->hasMany(Employee::class, 'company_id', 'company_id');
    }

    // public static function boot() {
    //     parent::boot();

    //     static::deleting(function($company) { // before delete() method call this
    //         $company->employees()->delete();
    //     });
    // }
}
