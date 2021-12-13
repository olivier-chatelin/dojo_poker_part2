<?php

namespace app;

class Poker
{
    public const ORDER_VALUES = [
        'A' => 1,
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        '10' => 10,
        'J' => 11,
        'Q' => 12,
        'K' => 13
    ];
    public function retrieveCombinaison(array $cards): string
    {
        $result = 'High card';
        $values = [];
        $colors = [];
        foreach ($cards as $card) {
            $values[] = $card[0];
            $colors[] = $card[1];
        }
        usort($values, function($a,$b) {
            if(self::ORDER_VALUES[$a] === self::ORDER_VALUES[$b]) {
                return 0;
            }
            return self::ORDER_VALUES[$a] < self::ORDER_VALUES[$b]? -1 : 1;
        });
        $countValues = array_count_values($values);
        foreach ($countValues as $count) {
            switch ($count) {
                case 2:
                    if($result === 'One pair') {
                        $result = 'Two pairs';

                    } else{
                        $result = 'One pair';
                    }
                    break;
                case 3:
                    if($result === 'One pair') {
                        $result = 'Full house';
                    } else{
                        $result = 'Three of a kind';
                    }
                    break;
                case 4:
                    $result = 'Four of a kind';
                    break;
            }
        }
        $countColors = array_count_values($colors);
        if(in_array(count($colors),$countColors)) {
            $result = 'Flush';
        }
        $countSuite = 0;
        for($i = 0; $i < count($values) - 1; $i++) {
            if(self::ORDER_VALUES[$values[$i+1]] - self::ORDER_VALUES[$values[$i]] === 1) {
                $countSuite++;
            }
        }
         if($countSuite === 4){
             if($result === 'Flush') {
                 $result = 'Straight flush';
             } else {
                $result = 'Straight';
             }
         }
         if($countSuite === 3 && (self::ORDER_VALUES[$values[count($values) - 1]] - self::ORDER_VALUES[$values[0]]) === 12) {
             if ($result === 'Flush') {
                 $result = 'Royal flush';
             } else {
                $result = 'Straight';
             }
         }
        return $result;
    }
}