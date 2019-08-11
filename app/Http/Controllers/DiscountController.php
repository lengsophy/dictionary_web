<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Discount;
use Auth;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (!is_permission('dictionarylist')) {
            return view('errors.404');
        }
        if ($request->name) {
            $search_info = trim($request->name);
            $discount =  Discount::where('percentage', 'LIKE', "%" . $search_info . "%")->orWhere('trip_number', $search_info);
        } else {
            $discount = Discount::orderBy('id', "DESC");
        }
        $data['discounts'] = $discount->where('deleted_at', null)->paginate(10);
        return view('discount.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (!is_permission('dictionarylist')) {
            return view('errors.404');
        }
        if (!$_POST) {
            return view('discount.create');
        } else {
            $validation = $request->validate([
                'percentage' => 'required',
                'trip_number' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if ($validation) {
                Discount::create([
                    'percentage' => $request->percentage ? $request->percentage :0,
                    'trip_number' => $request->trip_number ? $request->trip_number : 0,
                    'description' => $request->description,
                    'begin_at' => date("Y-m-d", strtotime($request->start_date)),
                    'end_at' => date("Y-m-d", strtotime($request->end_date)),
                    'created_by' => Auth::user()->id,
                ]);
                flash_message('success', 'Create Discount Successfully');
                return redirect("dictionarylist");
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Discount $discount)
    {
        if (!is_permission('dictionarylist')) {
            return view('errors.404');
        }
        if (!$_POST) {
            $data['item'] = Discount::where('id', $request->id)->first();
            return view('discount.edit', $data);
        } else {
            $validation = $request->validate([
                'percentage' => 'required',
                'trip_number' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if ($validation) {
                Discount::where('id', $request->id)->update([
                    'percentage' => $request->percentage ? $request->percentage :0,
                    'trip_number' => $request->trip_number ? $request->trip_number : 0,
                    'description' => $request->description,
                    'begin_at' => date("Y-m-d", strtotime($request->start_date)),
                    'end_at' => date("Y-m-d", strtotime($request->end_date)),
                    'updated_by' => Auth::user()->id,
                ]);
                flash_message('success', 'Update Discount Successfully');
                return redirect("dictionarylist");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discount  $discount
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Discount $discount)
    {
        if (!is_permission('discount')) {
            return view('errors.404');
        }
        $discount= Discount::where('id', $request->id)->update([
                        'deleted_at' => date('Y-m-d H:i:s'),
                        'deleted_by' => Auth::user()->id,
                    ]);
        if ($discount) {
            flash_message('success', 'Delete Discount Successfully');
            return redirect('dictionarylist');
        }
    }

    // disnable
    public function disable(Request $request)
    {
        if (!is_permission('discount')) {
            return view('errors.404');
        }
        $disable = Discount::where('id', $request->id)->update(['status' => 0]);
        if ($disable) {
            flash_message('success', 'Disable Discount Successfully');
            return redirect('dictionarylist');
        }
    }
    // enable
    public function enable(Request $request)
    {
        if (!is_permission('dictionarylist')) {
            return view('errors.404');
        }
        $enable = Discount::where('id', $request->id)->update(['status' => 1]);
        if ($enable) {
            flash_message('success', 'Enable Discount Successfully');
            return redirect('dictionarylist');
        }
    }
}
