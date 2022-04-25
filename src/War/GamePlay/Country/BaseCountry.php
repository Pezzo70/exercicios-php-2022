<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay\Country;

use Exception;

/**
 * Defines a country, that is also a player.
 */
class BaseCountry implements CountryInterface
{

  /**
   * The name of the country.
   *
   * @var string
   */
  protected $name;

  /**
   * If this country is conquered, this initialize de object country who conquered $this
   * 
   * @var \Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface
   */
  protected $conqueror;

  /**
   *  Number of countries that had been conquered by $this
   * 
   * @var int
   */
  protected $conqueredCountries;

  /**
   * Array with the values of all neighbors from this country
   * 
   * @var array
   */
  protected $neighbors = [];

  /**
   * Number of troops in th country
   * @var int
   */
  protected $troops = 3;

  /**
   * Builder.
   *
   * @param string $name
   *   The name of the country.
   */
  public function __construct(string $name)
  {
    $this->name = $name;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setNeighbors(array $neighbors_): void
  {
    foreach ($neighbors_ as $value) {
      array_push($this->neighbors, $value);
    }
  }

  public function getNeighbors(): array
  {
    return $this->neighbors;
  }

  public function isConquered(): bool
  {
    return $this->troops == 0 ? true : false;
  }

  public function killTroops(int $killedTroops): void
  {
    $this->troops = $this->troops - $killedTroops;
  }

  public function getNumberOfTroops(): int
  {
    return $this->troops;
  }

  public function conquer(CountryInterface $conqueredCountry): void
  {
    $conqueredCountry->setConqueror($this);
    foreach ($conqueredCountry->getNeighbors() as $value) {
      if (!(in_array($value, $this->neighbors)) && !($value->getName() == $this->name)) {
        array_push($this->neighbors, $value);
      }
    }
    unset($this->neighbors[array_search($conqueredCountry, $this->neighbors)]);
    if (in_array($this, $this->neighbors))
      unset($this->neighbors[array_search($this, $this->neighbors)]);
  }
  public function setConqueror(CountryInterface $conquerorCountry): void
  {
    $this->conqueror = $conquerorCountry;
  }
  public function getConqueror(): CountryInterface
  {
    return $this->conqueror;
  }
  public function addTroopsPerRound(int $troopsToBeAdded): void
  {
    $this->troops += $troopsToBeAdded + $this->conqueredCountries;
  }
}
