<?php
use App\Models\Employee;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeApiTest extends TestCase
{
    use RefreshDatabase;

    public function testFetchEmployees()
    {
        Employee::factory()->count(5)->create();

        $response = $this->get('/api/employees');

        $response->assertStatus(200);
        $response->assertJsonCount(5, 'data');
    }

    public function testAddEmployee()
    {
        $employeeData = [
            'name' => 'John Doe',
            'designation' => 'Software Engineer',
            'email' => 'john@example.com',
            'department' => 'IT',
        ];

        $response = $this->post('/api/employees', $employeeData);

        $response->assertStatus(201);
        $this->assertDatabaseHas('employees', $employeeData);
    }

    public function testEditEmployee()
    {
        $employee = Employee::factory()->create();

        $updatedData = [
            'name' => 'Updated Name',
            'designation' => 'Updated Designation',
            'email' => 'updated@example.com',
            'department' => 'Updated Department',
        ];

        $response = $this->put('/api/employees/' . $employee->id, $updatedData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('employees', $updatedData);
    }

    public function testDeleteEmployee()
    {
        $employee = Employee::factory()->create();

        $response = $this->delete('/api/employees/' . $employee->id);

        $response->assertStatus(204);
        $this->assertDatabaseMissing('employees', ['id' => $employee->id]);
    }
}
