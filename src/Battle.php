<?php

namespace EmagHero;

use EmagHero\Players\Hero;
use EmagHero\Players\Beast;
use EmagHero\Players\Entity;

class Battle
{
    const ROUNDS = 20;
    protected $winner;

    public function execute()
    {
        $this->simulateFight($this->getPlayers());
    }

    public function getPlayers() {
        $players = [];

        $hero = new Hero('Orderus');

        //set Orderus stats
        $hero->setName('Orderus');
        $hero->setHealth(rand(70,100));
        $hero->setStrength(rand(70,80));
        $hero->setDefence(rand(45,55));
        $hero->setSpeed(rand(40,50));
        $hero->setLuck(rand(10,30));

        $players[] = $hero;

        $beast = new Beast('Godzilla');

        //set Godzila stats
        $beast->setName('Godzilla');
        $beast->setHealth(rand(60,90));
        $beast->setStrength(rand(60,90));
        $beast->setDefence(rand(40,60));
        $beast->setSpeed(rand(40,60));
        $beast->setLuck(rand(25,40));

        $players[] = $beast;

        return $players;
    }

    public function simulateFight($players) {
        for ($i = 0; $i <= self::ROUNDS; $i++) {
            if ($i == self::ROUNDS) {
                break;
            }

            $message  = "\n====================================================\n";
            $message .= "Round #".($i + 1);
            $message .= "\n====================================================\n";

            $this->displayMessage($message);

            $participants = $this->getOrderInAttack($players[0], $players[1]);

            $participants[0]->attack($participants[1]);
            if ($this->checkForWinner($participants[0], $participants[1])) {
                break;
            }

            $participants[1]->attack($participants[0]);
            if ($this->checkForWinner($participants[0], $participants[1])) {
                break;
            }
        }

        $this->declareWinner();
    }

    private function displayMessage($message)
    {
        echo $message;
    }

    public function getOrderInAttack(Entity $hero, Entity $beast)
    {
        $hero_speed = $hero->getSpeed();
        $beast_speed = $beast->getSpeed();
        $hero_luck = $hero->getLuck();
        $beast_luck = $beast->getLuck();

        if ($hero_speed > $beast_speed) {
            return [$hero, $beast];
        } else if ($hero_speed < $beast_speed) {
            return [$beast, $hero];
        } else {
            if ($hero_luck > $beast_luck) {
                return [$hero, $beast];
            } else if ($hero_luck < $beast_luck) {
                return [$beast, $hero];
            }
        }

        //default to return
        return [$hero, $beast];
    }

    public function checkForWinner(Entity $hero, Entity $beast)
    {
        if ($hero->getHealth() === 0) {
            $this->setWinner($beast);
            return true;
        } else if ($beast->getHealth() === 0) {
            $this->setWinner($hero);
            return true;
        }

        return false;
    }

    public function getWinner()
    {
        return $this->winner;
    }

    public function setWinner(Entity $winner)
    {
        $this->winner = $winner;
        return $this;
    }

    public function declareWinner()
    {
        $winner = $this->getWinner();

        $message = "\n====================================================\n";
        $message .= "The winner of this epic battle is ". strtoupper($winner->getName());
        $message .= "\n====================================================\n";

        $this->displayMessage($message);
    }
}
