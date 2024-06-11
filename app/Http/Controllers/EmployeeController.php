<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        $conn = $this->db_conn();
        $sql = "SELECT * FROM employees";
        $result = mysqli_query($conn, $sql);
        $employees = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $employees[] = $row;
        }

        mysqli_close($conn);

        return view('table', compact('employees'));
    }

    public function create()
    {
        return view('form');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'reg_number' => 'required|string|max:255|unique:employees,reg_number',
            'position' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email',
            'phone_number' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'birth_date' => 'required|date',
            'start_date' => 'required|date',
            'home_number' => 'nullable|string|max:255',
            'work_number' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'state' => 'required|string|max:255',
        ]);

        $conn = $this->db_conn();

        $lastName = $request->input('last_name');
        $firstName = $request->input('first_name');
        $regNumber = $request->input('reg_number');
        $position = $request->input('position');
        $email = $request->input('email');
        $phoneNumber = $request->input('phone_number');
        $gender = $request->input('gender');
        $birthDate = $request->input('birth_date');
        $startDate = $request->input('start_date');
        $homeNumber = $request->input('home_number');
        $workNumber = $request->input('work_number');
        $state = $request->input('state');
        $photo = null;

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $photo = $path;
        }

        $sql = "INSERT INTO employees (last_name, first_name, reg_number, position, email, phone_number, gender, birth_date, start_date, home_number, work_number, photo, state) 
                VALUES ('$lastName', '$firstName', '$regNumber', '$position', '$email', '$phoneNumber', '$gender', '$birthDate', '$startDate', '$homeNumber', '$workNumber', '$photo', '$state')";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function edit($id)
    {
        $conn = $this->db_conn();

        $sql = "SELECT * FROM employees WHERE id='$id'";
        $result = mysqli_query($conn, $sql);
        $employee = mysqli_fetch_assoc($result);

        mysqli_close($conn);

        return view('edit', compact('employee'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'reg_number' => 'required|string|max:255|unique:employees,reg_number,' . $id,
            'position' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $id,
            'phone_number' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'birth_date' => 'required|date',
            'start_date' => 'required|date',
            'home_number' => 'nullable|string|max:255',
            'work_number' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'state' => 'required|string|max:255',
        ]);

        $conn = $this->db_conn();

        $lastName = $request->input('last_name');
        $firstName = $request->input('first_name');
        $regNumber = $request->input('reg_number');
        $position = $request->input('position');
        $email = $request->input('email');
        $phoneNumber = $request->input('phone_number');
        $gender = $request->input('gender');
        $birthDate = $request->input('birth_date');
        $startDate = $request->input('start_date');
        $homeNumber = $request->input('home_number');
        $workNumber = $request->input('work_number');
        $state = $request->input('state');

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $photo = $path;
            $sql = "UPDATE employees SET 
                        last_name='$lastName', 
                        first_name='$firstName', 
                        reg_number='$regNumber', 
                        position='$position', 
                        email='$email', 
                        phone_number='$phoneNumber', 
                        gender='$gender', 
                        birth_date='$birthDate', 
                        start_date='$startDate', 
                        home_number='$homeNumber', 
                        work_number='$workNumber', 
                        photo='$photo', 
                        state='$state'
                    WHERE id='$id'";
        } else {
            $sql = "UPDATE employees SET 
                        last_name='$lastName', 
                        first_name='$firstName', 
                        reg_number='$regNumber', 
                        position='$position', 
                        email='$email', 
                        phone_number='$phoneNumber', 
                        gender='$gender', 
                        birth_date='$birthDate', 
                        start_date='$startDate', 
                        home_number='$homeNumber', 
                        work_number='$workNumber', 
                        state='$state'
                    WHERE id='$id'";
        }

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function destroy($id)
    {
        $conn = $this->db_conn();

        $sql = "DELETE FROM employees WHERE id='$id'";

        if (mysqli_query($conn, $sql)) {
            mysqli_close($conn);
            return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    private function db_conn()
    {
        $sname = "localhost";
        $uname = "root";
        $password = "";
        $db_name = "dastone";

        $conn = mysqli_connect($sname, $uname, $password, $db_name);

        if (!$conn) {
            echo "Connection failed!";
        } else {
            return $conn;
        }
    }
}
