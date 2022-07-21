<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use App\Models\Employee;
use App\Models\Company;

class EmployeeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    use RefreshDatabase;

    public function test_can_see_employee_list()
    {
        $this->assertDatabaseCount('employees', 0);
        $response = $this->get('/employees');
        $response->assertStatus(200);
    }

    public function test_can_validate_fields_while_adding_an_employee()
    {
        $response = $this->json('POST','/employees',[
            'company_id' => 1,
            'first_name' => 'amit',
            'last_name' => 'leuva',
        ]);

        $response->assertStatus(422);
        
        $response->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "email_address" => ["The email address field is required."],
                "position" => ["The position field is required."],
                "city" => ["The city field is required."],
                "country" => ["The country field is required."],
                "status" => ["The status field is required."],
            ]
        ]);
    }

    public function test_can_create_an_employee()
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $company = Company::factory()->create();
        
        $response = $this->json('POST','/employees',[
            'company_id' => $company->company_id,
            'first_name' => 'ritesh',
            'last_name' => 'patel',
            'email_address' => 'abc@gmail.com',
            'position' => 'tester',
            'city' => 'Ahmedabad',
            'country' => 'India',
            'image' => $file,
            'status' => 'Active'
        ]);

        Storage::disk('local')->assertExists('employees/1/avatar.jpg');
        
        $response->assertStatus(302);

        $this->assertDatabaseHas('employees', [
            'first_name' => 'ritesh',
            'email_address' => 'abc@gmail.com'
        ]);
    }

    public function test_can_validate_fields_while_editing_an_employee()
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $company = Company::factory()->create();

        $employee = Employee::create([
            'company_id' => $company->company_id,
            'first_name' => 'Amit',
            'last_name' => 'Leuva',
            'email_address' => 'amitleuva@gmail.com',
            'position' => 'developer',
            'city' => 'ahmedabad',
            'country' => 'India',
            'image' => $file,
            'status' => 'Active'
        ]);

        $response = $this->json('PUT','/employees/'.$employee->employee_id,[
            'company_id' => $company->company_id,
            'first_name' => 'mohir',
            'last_name' => '',
            'email_address' => 'amitle1uva@gmail.com',
            'position' => '',
            'city' => '',
            'country' => 'India',
            'status' => 'required',
        ]);

        $response->assertStatus(422);

        $response->assertJson([
            "message" => "The given data was invalid.",
            "errors" => [
                "last_name" => ["The Sirname field is required."],
                "position" => ["The position field is required."],
                "city" => ["The city field is required."],
            ]
        ]);
    }

    public function test_can_edit_an_employee()
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $company = Company::factory()->create();

        $employee = Employee::create([
            'company_id' => $company->company_id,
            'first_name' => 'Amit',
            'last_name' => 'Leuva',
            'email_address' => 'amitleuva@gmail.com',
            'position' => 'developer',
            'city' => 'ahmedabad',
            'country' => 'India',
            'image' => $file,
            'status' => 'Active'
        ]);
        
        $response = $this->json('PUT','/employees/'.$employee->employee_id,[
            'company_id' => $employee->company_id,
            'first_name' => 'Mohir',
            'last_name' => 'Mehra',
            'email_address' => 'amitleuva@gmail.com',
            'position' => 'Scrum Master',
            'city' => 'ahmedabad',
            'country' => 'India',
            'image' => $file,
            'status' => 'Active'
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('employees', [
            'first_name' => 'Mohir',
            'last_name' => 'Mehra'
        ]);
    }

    public function test_can_delete_an_employee()
    {
        Storage::fake('avatars');
        $file = UploadedFile::fake()->image('avatar.jpg');
        $company = Company::factory()->create();

        $employee = Employee::create([
            'company_id' => $company->company_id,
            'first_name' => 'Amit',
            'last_name' => 'Leuva',
            'email_address' => 'amitleuva@gmail.com',
            'position' => 'developer',
            'city' => 'ahmedabad',
            'country' => 'India',
            'image' => $file,
            'status' => 'Active'
        ]);

        $this->assertModelExists($employee);
        $this->assertDatabaseCount('employees', 1);

        $response = $this->json('DELETE','/employees/'.$employee->employee_id);

        $this->assertModelMissing($employee);
        $this->assertDatabaseCount('employees', 0);
        
        $response->assertStatus(302);
    }
}
