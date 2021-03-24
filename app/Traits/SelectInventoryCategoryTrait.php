<?php
namespace App\Traits;

use Illuminate\Support\Facades\DB;

trait SelectInventoryCategoryTrait
{
    public $parents = [];
    public function getCategory($val='')
    {
        $cats = DB::table('inventory_categories')->where('company_id', session()->get('company_id'))
            ->orderBy('main_category', 'asc')
            ->orderBy('sub_category', 'asc')
            ->where('is_active', 1)
            ->get();
        
        $items = [];
        foreach ($cats as $c)
        {
            //$this->parents[$c->id]=$c->sub_category;
            $items[$c->main_category][]=[$c->id=>$c->sub_category];
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
