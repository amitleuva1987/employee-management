<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //  list all companies
        $companies = Company::all();
        return view('company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // create company form
        return view('company.add_company');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  add company
        $request->validate([
            'company_name' => 'required|unique:companies|max:255',
            'company_type' => 'required',
            'website' => 'required|url',
            'company_description' => 'required'
        ]);

        $company = Company::create([
            'company_name' => $request->company_name,
            'company_type' => $request->company_type,
            'website' => $request->website,
            'company_description' => $request->company_description
        ]);

        if($company){
            return redirect()->route('companies.index')->with('message','Company created successfully!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
        // Edit company
          return view('company.edit_company',compact('company'));        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([
            'company_name' => 'required|max:255',
            'company_type' => 'required',
            'website' => 'required|url',
            'company_description' => 'required'
        ]);

        $company->company_name = $request->company_name;
        $company->company_type = $request->company_type;
        $company->website = $request->website;
        $company->company_description = $request->company_description;
        if($company->isDirty()){
        $company->save() ;

        return redirect()->route('companies.index')->with('message','Company updated successfully!');
        } else {
        return redirect()->back()->with('error','You have made no changes in the company detail.');    
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        // delete company
        $company->employees()->delete();
        $company->delete();
        return redirect()->route('companies.index')->with('message','Company deleted successfully!');
    }
}
