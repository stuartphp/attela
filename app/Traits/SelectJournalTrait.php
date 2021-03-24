<?php
namespace App\Traits;
use Illuminate\Support\Facades\DB;

trait SelectJournalTrait
{
    public $parents = [];
    public function getCategory($val='')
    {
        $cats = DB::table('journals')->whereIn('company_id', [0,session()->get('company_id')])
            ->orderBy('group', 'asc')
            ->orderBy('name', 'asc')
            ->get();
        $items = [];
        foreach ($cats as $c)
        {

            $items[__('journal_entries.journal_groups.'.$c->group)][]=[$c->id=>__('journal_entries.journal_names.'.$c->name)];
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
