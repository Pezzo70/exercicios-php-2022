<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay;

use Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface;

/**
 * A manager that will roll the dice and compute the winners of a battle.
 */




class Battlefield implements BattlefieldInterface {
   
    public function rollDice(CountryInterface $country, bool $isAttacking): array{
        $diceValues = array();
        $isAttacking ? $troops = $country -> getNumberOfTroops() - 1 : $troops = $country -> getNumberOfTroops();
        for($i = 0; $i <= $troops; $i++){
              $diceValues[] = rand()&6;
        }
        sort($diceValues);
        return $diceValues[];
    }
    
    public function computeBattle(CountryInterface $attackingCountry, array $attackingDice, CountryInterface $defendingCountry, array $defendingDice): void{
        sizeof($attackingDice) >= sizeof($defendingDice) ? $isAttackingTroopsBiggerOrEqual = true : $isAttackingTroopsBiggerOrEqual = false;
        if($isAttackingTroopsBiggerOrEqual){
            foreach ($attackingDice as $key => $value) {
                if($attackingDice[$key] > $defendingDice[$key]){
                   $defendingCountry -> killTroops(1);
                }else{
                    $attackingCountry -> killTroops(1);
                }
            }
        }else{
            foreach ($defendingDice as $key => $value) {
                if($attackingDice[$key] > $defendingDice[$key]){
                   $defendingCountry -> killTroops(1);
                }else{
                    $attackingCountry -> killTroops(1);
                }
        }
    }
}
