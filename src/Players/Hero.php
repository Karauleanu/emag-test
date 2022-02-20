<?php

namespace EmagHero\Players;

class Hero extends Entity {

    /**
     * Rapid strike skill
     *
     * @var string
     */
    const RAPID_STRIKE_SKILL = 'rapid-strike-skill';

    /**
     * Magic shield skill
     *
     * @var string
     */
    const MAGIC_SHIELD_SKILL = 'magic-shield-skill';

    protected function useRapidStrike(Entity $beast)
    {
        if (rand(0, 100) <= 10) {
            $damage = ($this->getStrength() * 2) - $beast->getDefence();

            $beast->reduceHealth($damage);

            $this->displayMessage(
                $this->getName() . "'s strike's " . $beast->getName() . " with his " .
                self::RAPID_STRIKE_SKILL . ". " .
                $beast->getName() . "'s health is down to " . $beast->getHealth() . "%."
            );
        }
    }

    protected function useMagicShield(Entity $beast)
    {
        if (rand(0, 100) <= 20) {
            $damage = ($beast->getStrength()) - $this->getDefence();

            $this->reduceHealth($damage / 2);

            $this->displayMessage(
                $beast->getName() . "'s strike's " . $this->getName() . " with brutal power, but " . $this->getName() . " uses his " .
                self::MAGIC_SHIELD_SKILL . " to defend. " .
                $this->getName() . "'s health is down to " . $this->getHealth() . "%."
            );
        }
    }
}
