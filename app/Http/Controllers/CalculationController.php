<?php

namespace App\Http\Controllers;

use App\Models\Variable;
use Illuminate\Http\Request;

class CalculationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $data =  $this->variableList();
        return view('pages.calculation')->with('data' , $data);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function variableList()
    {
        $Variable = Variable::join('criterias', 'criterias.id', '=', 'variables.criteria_id')
                    ->join('alternatives', 'alternatives.id', '=', 'variables.alternative_id')
                    ->select('alternatives.name as alt_name', 'criterias.name as crit_name', 'criterias.value as bobot' , 'variables.*')->get()->toArray();
        $arrVar = [];
        foreach($Variable as $varName){
            $critName = $varName['crit_name'];
            $altName = $varName['alt_name'];
            if(empty($arrVar['rangking'][$altName])){
                $arrVar['rangking'][$altName] = 0;
            }
            $arrVar['raw'][$altName][$critName] = $varName['value'];
                $arrVar['max'][$critName] = $this->getMaxValue($varName['criteria_id']);
                $arrVar['normalisasi'][$altName][$critName] = round($varName['value'] / $arrVar['max'][$critName], 3);
                $arrVar['rangking'][$altName] += round($varName['value'] / $arrVar['max'][$critName], 3) * $varName['bobot'] ;
        }
        return $arrVar;
    }

    public function getMaxValue($id)
    {
        $Variable = Variable::where('criteria_id', $id)->max('value');
        return $Variable;
    }
}
