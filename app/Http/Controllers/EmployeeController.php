<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    // Ажилтнуудын жагсаалтыг харуулах
    public function index()
    {
        $employees = Employee::all();
        return view('table', compact('employees'));
    }

    // Ажилтан нэмэх формыг харуулах
    public function create()
    {
        return view('form');
    }

    // Шинэ ажилтны мэдээллийг хадгалах
    public function store(Request $request)
    {
        // Өгөгдлийг баталгаажуулах
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
            'photo' => 'nullable|image|max:2048', // Зургийг хадгална гэж үзэж байна
            'state' => 'required|string|max:255',
        ]);

        // Шинэ Employee объектыг үүсгэх
        $employee = new Employee($validatedData);

        // Хэрэв зураг байвал зураг хадгалах
        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $employee->photo = $path;
        }

        // Ажилтны мэдээллийг өгөгдлийн санд хадгалах
        $employee->save();

        
        // Ажилтнуудын жагсаалтын хуудас руу амжилтын мэдэгдэлтэйгээр чиглүүлэх
        return redirect()->route('employee.index')->with('success', 'Employee created successfully.');
    }
    // Show the form for editing the specified resource.
    public function edit(Employee $employee)
    {
        return view('edit', compact('employee'));
    }

    // Update the specified resource in storage.
    public function update(Request $request, Employee $employee)
    {
        $validatedData = $request->validate([
            'last_name' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'reg_number' => 'required|string|max:255|unique:employees,reg_number,' . $employee->id,
            'position' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:employees,email,' . $employee->id,
            'phone_number' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'birth_date' => 'required|date',
            'start_date' => 'required|date',
            'home_number' => 'nullable|string|max:255',
            'work_number' => 'nullable|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'state' => 'required|string|max:255',
        ]);

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('photos', 'public');
            $employee->photo = $path;
        }

        $employee->update($validatedData);

        return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
    }

    // Remove the specified resource from storage.
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully.');
    }
}
