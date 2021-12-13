<?php

namespace app;

use PHPUnit\Framework\TestCase;
require 'Poker.php';

class PokerTest extends TestCase
{
    public function testRetrieveCombinaison()
    {
        $poker = new Poker();
        $this->assertEquals('High card',$poker->retrieveCombinaison([['A','H'],['2','C'],['4','S'],['8','D'],['10','S']]));
        $this->assertEquals('One pair',$poker->retrieveCombinaison([['A','H'],['A','C'],['4','S'],['8','D'],['10','S']]));
        $this->assertEquals('Three of a kind',$poker->retrieveCombinaison([['A','H'],['A','C'],['A','S'],['8','D'],['10','S']]));
        $this->assertEquals('Four of a kind',$poker->retrieveCombinaison([['A','H'],['A','C'],['A','S'],['A','D'],['10','S']]));
        $this->assertEquals('Two pairs',$poker->retrieveCombinaison([['A','H'],['A','C'],['3','S'],['3','D'],['10','S']]));
        $this->assertEquals('Full house',$poker->retrieveCombinaison([['A','H'],['A','C'],['3','S'],['3','D'],['3','S']]));
        $this->assertEquals('Flush',$poker->retrieveCombinaison([['A','H'],['3','H'],['5','H'],['10','H'],['K','H']]));
        $this->assertEquals('Straight',$poker->retrieveCombinaison([['2','H'],['3','S'],['A','H'],['5','H'],['4','H']]));
        $this->assertEquals('Straight',$poker->retrieveCombinaison([['A','H'],['K','S'],['Q','H'],['J','H'],['10','H']]));
        $this->assertEquals('Straight',$poker->retrieveCombinaison([['A','H'],['K','S'],['Q','H'],['J','H'],['10','H']]));
        $this->assertEquals('Straight flush',$poker->retrieveCombinaison([['A','H'],['2','H'],['5','H'],['4','H'],['3','H']]));
        $this->assertEquals('Royal flush',$poker->retrieveCombinaison([['A','H'],['J','H'],['K','H'],['Q','H'],['10','H']]));
    }
}
