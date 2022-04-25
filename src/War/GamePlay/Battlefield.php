<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay;

use Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface;

/**
 * A manager that will roll the dice and compute the winners of a battle.
 */




class Battlefield implements BattlefieldInterface
{

    public function rollDice(CountryInterface $country, bool $isAttacking): array
    {
        $isAttacking ? $troopsInCountry = $country->getNumberOfTroops() - 1 : $troopsInCountry = $country->getNumberOfTroops();
        $diceValues = [];
        for ($i = 0; $i < $troopsInCountry; $i++) {
            $diceValues[] = rand(1, 6);
        }
        rsort($diceValues);
        return $diceValues;
    }

    public function computeBattle(
        CountryInterface $attackingCountry,
        array $attackingDice,
        CountryInterface $defendingCountry,
        array $defendingDice
    ): void {
        $troopsToAttack = $attackingDice > $defendingDice ? sizeof($defendingDice) : sizeof($attackingDice);
        $attackingWins = 0;
        $defendingWins = 0;

        while ($troopsToAttack != 0) {
            if ($attackingDice[$troopsToAttack - 1] > $defendingDice[$troopsToAttack - 1])
                ++$attackingWins;
            else
                ++$defendingWins;
            --$troopsToAttack;
        }
        print "\nO ataque perdeu " . $defendingWins . " tropas, e a defesa perdeu " . $attackingWins . " tropas nessa batalha\n";

        $attackingCountry->killTroops($defendingWins);
        $defendingCountry->killTroops($attackingWins);
    }
}
