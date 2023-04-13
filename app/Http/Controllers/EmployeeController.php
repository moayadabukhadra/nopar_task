<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $companies = Company::all();
        $query_string = '%' . $request->get('search') . '%';
        $selected_company = $request->get('company_id') || null;
        $employees = Employee::with('company')
            ->when($selected_company,function ($query) use ($selected_company){
                $query->where('company_id',$selected_company);
            })
            ->where('first_name','like',$query_string)
            
           ->paginate(10);
        return view('employee.employees-table', compact('employees','companies'));
    }

    public function show(Employee $employee = null)
    {
        $companies = Company::all();
        return view('employee.employee-form', compact('employee', 'companies'));

    }

    public function store(Request $request, Employee $employee = null)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'company_id' => 'required|exists:companies,id',
            'email' => 'nullable',
            'phone' => 'nullable',
        ]);

        $new_employee = Employee::updateOrCreate(
            ['id' => $employee?->id],
            $request->all('first_name', 'last_name', 'company_id', 'email', 'phone')
        );

        return redirect('/employees')->with('success','Employee' . $employee ? "Updated" : "Added" . "Successfully");
    }

    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->back();
    }
}
