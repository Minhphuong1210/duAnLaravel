<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NguoiDungController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nguoiDung = User::query()->get();
        return view('admins.nguoidungs.index', compact('nguoiDung'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.nguoidungs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if ($request->isMethod('POST')) {
            // $param = $request->except('_token');
            User::query()->create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => $request->input('password'),
                'role' => $request->input('role'),
                'is_active' => $request->input('is_active'),
            ]);
        }
        return redirect()->route('admins.nguoidungs.index')->with('success', 'thêm người dùng thành công');
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
        $nguoiDung = User::query()->findOrFail($id);
        return view('admins.nguoidungs.edit', compact('nguoiDung'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all());
        if ($request->isMethod('PUT')) {
            $nguoiDung = User::query()->findOrFail($id);
            $param = $request->except('_token', '_method');
            if ($request->filled('password')) {
                $param['password'] = Hash::make($request->input('password'));
            }
            // dd($param);
            $nguoiDung->update($param);
        }
        return redirect()->route('admins.nguoidungs.index')->with('success', 'Cập nhật người dùng thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $nguoiDung = User::query()->findOrFail($id);
        $nguoiDung->delete();
        return redirect()->route('admins.nguoidungs.index')->with('success', 'Xóa người dùng thành công');
    }
}
