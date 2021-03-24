<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DisciplinaryReason;

class DisciplinarySearch extends Controller
{
    public function index()
    {
        if (request()->ajax()) {
            $search = request()->get('search');
            $res = DisciplinaryReason::where('company_id', 0)
            ->where('incident', 'like', "%$search%")
            ->orderBy('incident')
            ->limit(10)
            ->get();
            foreach ($res as $r)
            {
                $z[]=['id'=>$r->id.'~'.$r->incident.'~'.$r->first.'~'.$r->second.'~'.$r->third.'~'.$r->fourth, 'text'=>substr($r->incident, 0,90).'...'];
            }
            return $z;
        }
    }
}
