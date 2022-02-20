<?php

namespace EmagHero\Players;

abstract class Entity
{
    protected $name;
    protected $health;
    protected $strength;
    protected $defence;
    protected $speed;
    protected $luck;

    public function __construct($name)
    {
        $this->setName($name);
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    public function getStrength()
    {
        return $this->strength;
    }

    public function setStrength($strength)
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDefence()
    {
        return $this->defence;
    }

    public function setDefence($defence)
    {
        $this->defence = $defence;

        return $this;
    }

    public function getSpeed()
    {
        return $this->speed;
    }

    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    public function getLuck()
    {
        return $this->luck;
    }

    public function setLuck($luck)
    {
        $this->luck = $luck / 100;

        return $this;
    }

    abstract protected function useRapidStrike(Entity $player);
    abstract protected function useMagicShield(Entity $player);

    public function attack(Entity $player)
    {
        $this->useRapidStrike($player);
        $this->useMagicShield($player);
        $this->initAttack($player);

        $this->displayMessage(
            $this->getName()."'s attack succeeds. ".
            $player->getName()."'s health is down to ". $player->getHealth(). "%. "
        );

        return true;
    }

    public function initAttack(Entity $player)
    {
        $damage = $this->getStrength() - $player->getDefence();

        if ($this->getLuck() < $player->getLuck()) {
            $damage = 0;
            $this->displayMessage(
                $this->getName()."'s miss the attack. ".
                $player->getName()."'s health remains ". $player->getHealth(). "%. "
            );

        } else if ($this->getLuck() > $player->getLuck()) {
            $damage = 0;
            $this->displayMessage(
                $player->getName()."'s miss the attack. ".
                $this->getName()."'s health remains ". $this->getHealth(). "%. "
            );
        }

        $player->reduceHealth($damage);
    }

    public function reduceHealth($damage)
    {
        $this->health = $this->health - $damage;

        if ($this->health <= 0) {
            $this->health = 0;
        }

        return $this;
    }

    public function displayMessage($message)
    {
        echo $message;
    }
}
