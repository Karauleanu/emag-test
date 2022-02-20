<?php

namespace EmagHero\Players;

class Beast extends Entity {
    protected function useRapidStrike(Entity $beast)
    {
        return false;
    }

    protected function useMagicShield(Entity $beast)
    {
       return false;
    }

}
