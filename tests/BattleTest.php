<?php

namespace EmagHero;

require_once __DIR__ . '../../vendor/autoload.php';

use EmagHero\Battle;
use EmagHero\Players\Beast;
use EmagHero\Players\Hero;
use PHPUnit\Framework\TestCase;

class BattleTest extends TestCase
{
    public function setUp()
    {
        $hero = new Hero('Orderus');
        $hero->setHealth(90);
        $hero->setStrength(60);
        $hero->setDefence(67);
        $hero->setSpeed(90);
        $hero->setLuck(10);
        $this->hero = $hero;

        $beast = new Beast('Cerberus');
        $beast->setHealth(80);
        $beast->setStrength(50);
        $beast->setDefence(70);
        $beast->setSpeed(70);
        $beast->setLuck(25);
        $this->beast = $beast;

       $this->battle = new Battle();
    }

    public function test_order_in_attack() {
        $result = $this->battle->getOrderInAttack($this->hero, $this->beast);
        $this->assertEquals([$this->hero, $this->beast], $result); //hero speed is > than beast hero, 90 > 70
    }

    public function test_check_for_winner() {
        $this->beast->setHealth(0);
        $result = $this->battle->checkForWinner($this->hero, $this->beast);
        $this->assertTrue($result);
    }

    public function test_get_players() {
        $result = $this->battle->getPlayers();
        $this->assertNotNull($result);
    }
}
