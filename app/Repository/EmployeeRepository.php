<?php

namespace App\Repository;

use App\Models\Employee;
use App\Repository\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function all()
    {
        return Employee::with('company')->get();
    }
}
