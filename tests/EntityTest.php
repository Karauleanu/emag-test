<?php

namespace EmagHero;

require_once __DIR__ . '../../vendor/autoload.php';

use EmagHero\Players\Beast;
use EmagHero\Players\Hero;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
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
        $beast->setSpeed(90);
        $beast->setLuck(25);
        $this->beast = $beast;
    }

    public function test_hero_attributes_are_set()
    {
        $this->assertEquals(90, $this->hero->getHealth());
        $this->assertEquals(60, $this->hero->getStrength());
        $this->assertEquals(67, $this->hero->getDefence());
        $this->assertEquals(90, $this->hero->getSpeed());
        $this->assertEquals(0.1, $this->hero->getLuck());
    }

    public function test_beast_attributes_are_set()
    {
        $this->assertEquals(80, $this->beast->getHealth());
        $this->assertEquals(50, $this->beast->getStrength());
        $this->assertEquals(70, $this->beast->getDefence());
        $this->assertEquals(90, $this->beast->getSpeed());
        $this->assertEquals(0.25, $this->beast->getLuck());
    }

    public function test_attack()
    {
        $hero  = $this->hero;
        $beast = $this->beast;

        $result = $hero->attack($beast);

        $this->assertNotNull($result);
    }
}
