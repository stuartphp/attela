<?php
/*
Number Search

Find a number in a combination of numbers

*/
namespace App\Services;

class NumberSearchService 
{
    function array_sum_parts($n,$t,$all=false){
        $count_n = count($n); // how much fields are in that array?
        $count = pow(2,$count_n); // we need to do 2^fields calculations to test all possibilities

        # now i want to look at every number from 1 to $count, where the number is representing
        # the array and add up all array-elements which are at positions where my actual number
        # has a 1-bit
        # EXAMPLE:
        # $i = 1  in binary mode 1 = 01  i'll use ony the first array-element
        # $i = 10  in binary mode 10 = 1010  ill use the secont and the fourth array-element
        # and so on... the number of 1-bits is the amount of numbers used in that try

        for($i=1;$i<=$count;$i++){ // start calculating all possibilities
            $total=0; // sum of this try
            $anzahl=0; // counter for 1-bits in this try
            $k = $i; // store $i to another variable which can be changed during the loop
            for($j=0;$j<$count_n;$j++){ // loop trough array-elemnts
                $total+=($k%2)*$n[$j]; // add up if the corresponding bit of $i is 1
                $anzahl+=($k%2); // add up the number of 1-bits
                $k=$k>>1; //bit-shift to the left for looking at the next bit in the next loop
            }
            if($total==$t){
                $loesung[$i] = $anzahl; // if sum of this try is the sum we are looking for, save this to an array (whith the number of 1-bits for sorting)
                if(!$all){
                    break; // if we're not looking for all solutions, make a break because the first one was found
                }
            }
        }

        asort($loesung); // sort all solutions by the amount of numbers used


        // formating the solutions to getting back the original array-keys (which shoud be the return-value)
        foreach($loesung as $val=>$anzahl){
            $bit = strrev(decbin($val));
            $total=0;
            $ret_this = array();
            for($j=0;$j<=strlen($bit);$j++){
                if(isset($bit[$j]) && $bit[$j]=='1'){
                    $ret_this[] = $j;
                }
            }
            $ret[]=$ret_this;
        }

        return $ret;
    }
}

/*
 * $n[0]=6.56;
        $n[1]=8.99;
        $n[2]=1.45;
        $n[3]=4.83;
        $n[4]=8.16;
        $n[5]=2.53;
        $n[6]=0.28;
        $n[7]=9.37;
        $n[8]=0.34;
        $n[9]=5.82;
        $n[10]=8.24;
        $n[11]=4.35;
        $n[12]=9.67;
        $n[13]=1.69;
        $n[14]=5.64;
        $n[15]=0.27;
        $n[16]=2.73;
        $n[17]=1.63;
        $n[18]=4.07;
        $n[19]=9.04;
        $n[20]=6.32;

// Output
        $t=9.37;

        dd($this->array_sum_parts($n,$t)); //returns one possible solution (fuc*** fast)
        Result = [0,5,6]
 */