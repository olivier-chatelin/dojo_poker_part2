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
    $combinaisons = [
      'One pair' => 0,
      'Two pairs' => 0,
      'Three of a kind' => 0,
      'Straight' => 0,
        'Flush' => 0,
        'Full house' => 0,
        'Four of a kind' => 0,
        'Straight flush' => 0,
        'Royal flush' => 0,
    ];

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
                    $combinaisons['One pair']++;
                    if($combinaisons['One pair'] === 2) {
                       $combinaisons['One pair'] = 0;
                        $combinaisons['Two pairs']++;

                    }
                    break;
                case 3:
                    if($combinaisons['One pair'] === 1) {
                        $combinaisons['One pair'] = 0;
                        $combinaisons['Full house']++;
                    } else{
                        $combinaisons['Three of a kind']++;
                    }
                    break;
                case 4:
                    $combinaisons['Two pairs'] = 0;
                    $combinaisons['Four of a kind']++;
                    break;
            }
        }
        $countColors = array_count_values($colors);
        if(in_array(count($colors),$countColors)) {
            $combinaisons['Flush']++;
        }
        $countSuite = 0;
        for($i = 0; $i < count($values) - 1; $i++) {
            if(self::ORDER_VALUES[$values[$i+1]] - self::ORDER_VALUES[$values[$i]] === 1) {
                $countSuite++;
            }
        }
         if($countSuite === 4){
             $combinaisons['Straight']++;
             if($combinaisons['Flush'] === 1) {
                 $combinaisons['Flush'] = 0;
                 $combinaisons['Straight flush']++;
             }
         }
         if($countSuite === 3 && (self::ORDER_VALUES[$values[count($values) - 1]] - self::ORDER_VALUES[$values[0]]) === 12) {
             $combinaisons['Straight']++;
             if($combinaisons['Flush'] === 1) {
                 $combinaisons['Flush'] = 0;
                 $combinaisons['Royal flush']++;
             }
         }
        foreach ($combinaisons as $combinaisonName => $countCombinaison) {
            if($countCombinaison !== 0) {
                $result = $combinaisonName;
            }
        }
        return $result;
    }
}