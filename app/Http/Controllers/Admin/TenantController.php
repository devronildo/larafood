<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateTenant;
use App\Models\Tenant;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class TenantController extends Controller
{

    private $repository;

    public function __construct(tenant $tenant){
        return $this->repository = $tenant;

        $this->middleware(['can:tenants']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tenants = $this->repository->latest()->paginate();

        return view('admin.pages.tenants.index', compact('tenants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.pages.tenants.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateTenant  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateTenant $request)
    {
        $this->repository->create($request->all());

       return redirect()->route('tenants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!$tenant = $this->repository->with('plan')->find($id)){
             return redirect()->back();
        }

        return view('admin.pages.tenants.show', compact('tenant'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!$tenant = $this->repository->find($id)){
            return redirect()->back();
        }

        return view('admin.pages.tenants.edit', compact('tenant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateTenant $request, $id)
    {
        if(!$tenant = $this->repository->find($id)){
            return redirect()->back();
        }

        $data = $request->all();

        $tenant = auth()->user()->tenant;

        if($request->hasFile('logo') && $request->logo->isValid()){

            if(Storage::exists($tenant->logo)){
                 Storage::delete($tenant->logo);
            }

            $data['logo'] = $request->logo->store("tenants/{$tenant->uuid}");
        }

        $tenant->update($data);

        return redirect()->route('tenants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!$tenant = $this->repository->find($id)){
            return redirect()->back();
        }

        if(Storage::exists($tenant->logo)){
            Storage::delete($tenant->logo);
       }

        $tenant->delete();

        return redirect()->route('tenants.index');
    }


   public function search(Request $request)
   {
       $filters = $request->only('filter');

       $tenants = $this->repository
                        ->where(function($query) use ($request) {
                            if($request->filter){
                                 $query->where('name', $request->filter);
                            }

                        })
                         ->latest()
                        ->paginate();

       return view('admin.pages.tenants.index', compact('tenants', 'filters'));
   }
}
