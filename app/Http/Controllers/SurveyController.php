<?php

namespace App\Http\Controllers;

use App\Models\Alternative;
use App\Models\Criteria;
use App\Models\Survey;
use App\Models\Variable;
use Illuminate\Http\Request;

class SurveyController extends Controller
{
    //
    public function index()
    {

        $data = (object)[
        'criteria'=> Criteria::all(),
        'mitra' => Alternative::all(),
        'survey' => Survey::leftJoin('criterias',  'surveys.criteria_id', '=', 'criterias.id', )
                            ->leftJoin('alternatives',  'surveys.alternative_id', '=', 'alternatives.id', )
                            ->select('surveys.*', 'alternatives.name as altName', 'criterias.name as critName')->get()
        ];
        return view('pages.survey')->with('data', $data);
    }

    public function save(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg',
        ]);

        $path = $request->file('image')->store('images');

        // $save = new Survey;
        // $save->criteria_id = $request->criteria_id;
        // $save->alternative_id = $request->alternative_id;
        // $save->path = $path;
        // $save->detail = $request->detail;
        // $save->save();



        Variable::updateOrCreate(
            [
                'alternative_id' => $request->alternative_id,
                'criteria_id' => $request->criteria_id,
            ],
            ['value' => $request->value]
        );
        
        Survey::updateOrCreate(
            [
                'alternative_id' => $request->alternative_id,
                'criteria_id' => $request->criteria_id,
            ],
            [
                'path' => $request->path,
                'detail' => $request->detail
            ]
        );

        return redirect()->back()->with('status', 'Data telah du Upload');
    }
}
