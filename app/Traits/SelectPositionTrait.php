<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait SelectPositionTrait
{
    public $parents = [];
    public function getCategory($val='')
    {
        $cats = DB::table('employee_positions')->where('company_id', session()->get('company_id'))
            ->orderBy('department', 'asc')
            ->orderBy('division', 'asc')
            ->get();
        $items = [];
        foreach ($cats as $c)
        {

            $items[$c->department][]=[$c->id=>$c->division];
        }

        $list = $this->makeSelection($items, $val);

        return $list;
    }

    public function makeSelection($items, $unt='')
    {
        $list='';
        foreach ($items as $key=>$val)
        {
            $list .='<optgroup label="'.$key.'">';
            foreach ($val as $k=>$v) {
                foreach ($v as $s=>$i)
                $list .='<option value="'.$s.'"';
                if($s == $unt)
                {
                    $list .=' selected ';
                }
                $list .='>'.$i.'</option>';
            }
            $list .='</optgroup>';
        }
        return $list;
    }
}
