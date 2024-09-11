<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promotions;
use Illuminate\Http\Request;

class KhuyenMaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listKhuyenMai = Promotions::all();
        $DISCOUNT_Percentage = Promotions::DISCOUNT_Percentage;
        $DISCOUNT_Fixed = Promotions::DISCOUNT_Fixed;
        $STATUS_Active = Promotions::STATUS_Active;
        $STATUS_InActive = Promotions::STATUS_InActive;
        return view('admins.khuyenmais.index',compact('listKhuyenMai','DISCOUNT_Percentage','DISCOUNT_Fixed','STATUS_Active','STATUS_InActive'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $DISCOUNT_Percentage = Promotions::DISCOUNT_Percentage;
        $DISCOUNT_Fixed = Promotions::DISCOUNT_Fixed;
        $STATUS_Active = Promotions::STATUS_Active;
        $STATUS_InActive = Promotions::STATUS_InActive;
        return view('admins.khuyenmais.create',compact('DISCOUNT_Percentage','DISCOUNT_Fixed','STATUS_Active','STATUS_InActive'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        if($request->isMethod('POST')){
            $param = $request->except('_token');
            Promotions::create($param);
            return redirect()->route('admins.khuyenmais.index')->with('success','thêm khuyến mại thành công');
        }
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
        
       $Promotion = Promotions::findOrFail($id);
       $DISCOUNT_Percentage = Promotions::DISCOUNT_Percentage;
       $DISCOUNT_Fixed = Promotions::DISCOUNT_Fixed;
       $STATUS_Active = Promotions::STATUS_Active;
       $STATUS_InActive = Promotions::STATUS_InActive;
    //    dd($Promotion);
       return view('admins.khuyenmais.edit',compact('Promotion','DISCOUNT_Percentage','DISCOUNT_Fixed','STATUS_Active','STATUS_InActive'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $Promotion = Promotions::findOrFail($id);
        if($request->isMethod('PUT')){
            $param = $request->except('_token','_method');
            $Promotion->update($param);
            return redirect()->route('admins.khuyenmais.index')->with('success','Sửa khuyến mại thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
