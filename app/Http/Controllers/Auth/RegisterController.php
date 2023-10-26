<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\RegisterResource;
use App\Models\Member;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /**
     * index
     * 
     * @return void
     */
    public function index()
    {
        //get books
        $members = Member::latest()->paginate(5);

        //return collection of books as a resource
        return new RegisterResource(true, 'List Data Anggota', $members);
    }

    /**
     * store
     * 
     * @param mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        //define validation rules
        $validator = Validator::make($request->all(), [
            'noktp'=> 'required',
            'nama' => 'required',
            'password' => 'required|min:6',
            //'alamat' => 'required',
            //'kota' => 'required',
            'email' => 'required|email|unique:members',
            'no_telp' => 'required',
            'file_ktp' => 'file|mimes:jpeg,png,jpg,gif,svg,pdf|max:2048'
        ]);
        //check if validation fails
        if ($validator->fails()){
            return response()->json($validator->errors(), 422);
        }

        //upload ktp
        $file_ktp = $request->file('file_ktp');
        $file_ktp->storeAs('public/members', $file_ktp->hashName());

        //Buat anggota baru
        $member = Member::create([
            'noktp' => $request->noktp,
            'nama' => $request->nama,
            'password' =>$request->password,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'file_ktp' => $file_ktp->hashName(),
        ]);

        //return response
        return new RegisterResource(true, 'Data Anggota Berhasil Ditambahkan!', $member);
    }
}
