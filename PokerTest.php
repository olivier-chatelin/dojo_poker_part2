<?php

namespace app;

use PHPUnit\Framework\TestCase;
require 'Poker.php';

class PokerTest extends TestCase
{
    public function testRetrieveCombinaison()
    {
        $poker = new Poker();
        $this->assertEquals('nothing',$poker->retrieveCombinaison([['A','H'],['2','C'],['4','S'],['8','D'],['10','S']]));
        $this->assertEquals('nothing',$poker->retrieveCombinaison([['A','H'],['2','C'],['4','S'],['8','D'],['10','S']]));
    }
}
