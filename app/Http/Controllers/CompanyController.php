<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{

    // Check Authentication
    // public function __construct()
    // {
    //   $this->middleware('auth');
    // }

    /**
     * Display index/default page
     */
    public function index()
    {
        $companies = Company::all();
        return view('companies.index', ['companies'=>$companies]);
    }

    /**
     * Show data insert form/page
     */
    public function create()
    {
        return view ('companies.create');
    }

    /**
     * Store/save data
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
          $company = Company::create([
            'name'=>$request->name,
            'description'=>$request->description,
            'user_id'=>Auth::user()->id
          ]);
        }
        if ($company) {
          return redirect()->route('companies.show', $company->id)
          ->with('success', 'Company created successful');
        }
        return back()->withInput()->with('error', 'Some error occure.');
    }

    /**
     * Display details of a individual item
     */
    public function show(Company $company)
    {
      $company = Company::find($company->id);
      return view('companies.show', ['company'=>$company]);
    }

    /**
     * Secify a item and return to edit form with detail
     */
    public function edit(Company $company)
    {
      $company = Company::find($company->id);
      return view('companies.edit', ['company'=>$company]);
      // $company = Company::where('id', $company->id)->first();
    }

    /**
     * Update data item
     */
    public function update(Request $request, Company $company)
    {
      $companyUpdate = Company::where('id', $company->id)
                                ->update([
                                  'name'=>$request->name,
                                  'description'=>$request->description
                                ]);
      if ($companyUpdate) {
        return redirect()->route('companies.show', $company->id)
        ->with('success', 'Company updated successful');
      }
      return back()->withInput()->with('error', 'Some error occure.');
    }

    /**
     * Delete/Destroy/Remove a specific item
     */
    public function destroy(Company $company)
    {
        $companyDelete = Company::find($company->id)->delete();
        if ($companyDelete) {
          return redirect()->route('companies.index')
          ->with('success', 'Company deleted successful');
        }
        return back()->withInput()->with('error', 'Some error occure.');
    }
}
