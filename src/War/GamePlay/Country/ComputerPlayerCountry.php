<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay\Country;

/**
 * Defines a country that is managed by the Computer.
 */
class ComputerPlayerCountry extends BaseCountry {

  /**
   * Choose one country to attack, or none.
   *
   * The computer may choose to attack or not. If it chooses not to attack,
   * return NULL. If it chooses to attack, return a neighbor to attack.
   *
   * It must NOT be a conquered country.
   *
   * @return \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface|null
   *   The country that will be attacked, NULL if none will be.
   */
  public function chooseToAttack(): ?CountryInterface {
    /*O random_int(0,3) garante 75% de chance de atacar, isso da mais dinamica para CPU
    **ja que havera mais ataques por rodada.
    */
   if($this->getNumberOfTroops() > 1 && rand(0,3) != 0){
     $neighborToAttack = $this->neighbors[array_rand($this->neighbors)];
      while($neighborToAttack->isConquered()){
        $neighborToAttack = $neighborToAttack->getConqueror();
      }
      if($neighborToAttack != $this){
    return $neighborToAttack;
    }
   }
    return null;
  }

}
