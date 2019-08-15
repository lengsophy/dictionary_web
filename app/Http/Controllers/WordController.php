<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use Auth;

class WordController extends Controller
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
            $word =  Word::where('percentage', 'LIKE', "%" . $search_info . "%")->orWhere('trip_number', $search_info);
        } else {
            $word = Word::orderBy('id', "DESC");
        }
        $data['discounts'] = $word->where('deleted_at', null)->paginate(10);
        return view('word.index', $data);
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
            return view('word.create');
        } else {
            $validation = $request->validate([
                'percentage' => 'required',
                'trip_number' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if ($validation) {
                Word::create([
                    'percentage' => $request->percentage ? $request->percentage :0,
                    'trip_number' => $request->trip_number ? $request->trip_number : 0,
                    'description' => $request->description,
                    'begin_at' => date("Y-m-d", strtotime($request->start_date)),
                    'end_at' => date("Y-m-d", strtotime($request->end_date)),
                    'created_by' => Auth::user()->id,
                ]);
                flash_message('success', 'Create Word Successfully');
                return redirect("dictionarylist");
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Word $word)
    {
        if (!is_permission('dictionarylist')) {
            return view('errors.404');
        }
        if (!$_POST) {
            $data['item'] = Word::where('id', $request->id)->first();
            return view('word.edit', $data);
        } else {
            $validation = $request->validate([
                'percentage' => 'required',
                'trip_number' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]);
            if ($validation) {
                Word::where('id', $request->id)->update([
                    'percentage' => $request->percentage ? $request->percentage :0,
                    'trip_number' => $request->trip_number ? $request->trip_number : 0,
                    'description' => $request->description,
                    'begin_at' => date("Y-m-d", strtotime($request->start_date)),
                    'end_at' => date("Y-m-d", strtotime($request->end_date)),
                    'updated_by' => Auth::user()->id,
                ]);
                flash_message('success', 'Update Word Successfully');
                return redirect("dictionarylist");
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Word  $word
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Word $word)
    {
        if (!is_permission('dictionarylist')) {
            return view('errors.404');
        }
        $word= Word::where('id', $request->id)->update([
                        'deleted_at' => date('Y-m-d H:i:s'),
                        'deleted_by' => Auth::user()->id,
                    ]);
        if ($word) {
            flash_message('success', 'Delete Word Successfully');
            return redirect('dictionarylist');
        }
    }

    // disnable
    public function disable(Request $request)
    {
        if (!is_permission('dictionarylist')) {
            return view('errors.404');
        }
        $disable = Word::where('id', $request->id)->update(['status' => 0]);
        if ($disable) {
            flash_message('success', 'Disable Word Successfully');
            return redirect('dictionarylist');
        }
    }
    // enable
    public function enable(Request $request)
    {
        if (!is_permission('dictionarylist')) {
            return view('errors.404');
        }
        $enable = Word::where('id', $request->id)->update(['status' => 1]);
        if ($enable) {
            flash_message('success', 'Enable Word Successfully');
            return redirect('dictionarylist');
        }
    }
}
