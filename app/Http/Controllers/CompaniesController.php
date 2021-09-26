<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Companies\UpdateCompanyRequest;
use App\Companies;
use Illuminate\Support\Facades\Storage;


class CompaniesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('companies.index')->with('companies', Companies::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UpdateCompanyRequest $request)
    {
        $resume='';
        if($request->hasFile('file'))
        {
            $resume = time() . '.' . $request['file']->getClientOriginalExtension();
            $request['file']->move(base_path() . '/storage/app/public', $resume);
        }

        Companies::create([
            'name' => $request->name,
            'email' => $request->email,
            'website' => $request->website,
            'logo' => $resume,
        ]);
        
        session()->flash('success', 'Company created');
        return redirect(route('companies.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Companies $company)
    {
        // $companies = Companies::find($id);
        return view('companies.create')->with('companies', $company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyRequest $request, Companies $company)
    {
        //if someone wants to post undesired data it won't be accepted here.
        $data = $request->only(['name' ,'email', 'website', 'logo']);

        //check if new image
        if($request->hasFile('file'))
        {
           $resume = time() . '.' . $request['file']->getClientOriginalExtension();
           //upload it
           $request['file']->move(base_path() . '/storage/app/public', $resume);
        
           //delete old one
           Storage::disk('public')->delete($company->logo);

           // $post->deleteImage();
           $data['logo'] =  $resume;
        }
        
        //update attributes
        $company->update($data);
        //flash messages
        session()->flash('Success', 'Company Updated Successfully');
        //redirect user
        return redirect(route('companies.index'));
    }



 

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Companies $company)
    {
        // $companies = Companies::find($company->id);
        
        try {

            $company->delete();
            Storage::disk('public')->delete($company->logo);
            session()->flash('success', 'Company Deleted successfully');
            return redirect(route('companies.index'));
          
          } catch (\Exception $e) {
          
            session()->flash('error', 'Cannot delete Company, Company has employees');
            return redirect(route('companies.index'));
          }
        
    }
}
