<?php

namespace App\Http\Controllers;

use App\Models\employe2;
use GuzzleHttp\Psr7\Response;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if(request()->ajax()){
            return datatables()->of(employe2::select('*'))
            ->addColumn('action', 'employee-action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $employeeId = $request->id;
        $employee = employe2::updateOrCreate(
            [
                'id' => $employeeId
            ],[
                'Nama' => $request->Nama,
                'NIK'=> $request->Nik,
                'Jabatan' => $request->Jabatan,
                'Email'=> $request->Email,
                'Alamat'=> $request->Alamat,
            ]
            );
            return Response()->json($employee);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
