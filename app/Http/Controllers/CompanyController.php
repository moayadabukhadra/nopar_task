<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $query_string = '%' . $request->get('search') . '%';
        $companies = Company::where('name','like' ,$query_string)->paginate(10);
        return view('company.company-table', compact('companies'));
    }

    public function show(Company $company = null)
    {
        return view('company.company-form', compact('company'));
    }

    public function store(Request $request, Company $company = null)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'nullable|email',
            'logo' => 'nullable|image|dimensions:min_width=100,min_height=100',
            'website' => 'nullable'
        ]);
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logo_name = Str::random(10) . "." . $logo->getClientOriginalExtension();
            $logo->storeAs('public', $logo_name);
        } else {
            $logo_name = $company?->logo;
        }

        $new_company = Company::updateOrCreate(
            ['id' => $company?->id],
            [
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'website' => $request->get('website'),
                'logo' => $logo_name
            ]);

        return redirect('companies')->with('success','Company' . $company ? "Updated" : "Added" . "Successfully");

    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->back();
    }
}
