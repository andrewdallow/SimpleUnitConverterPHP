<?php

namespace MVC;

/**
 * Abstract model of a Unit converter
 */
abstract class UnitConverterAbstract
{
    protected $_baseValue;
    protected $_rates;

    /**
     * Convert the base value to the given unit
     *
     * @param string $unit
     *
     * @return float
     */
    abstract public function convertToUnit(string $unit): float;

    /**
     * Set the base value with the specified unit.
     *
     * @param float  $amount
     * @param string $unit
     */
    abstract public function setBaseValue(float $amount, string $unit): void;

    /**
     * Get a list of available rates.
     *
     * @return array|null
     */
    public function getRates(): ?array
    {
        return array_keys($this->_rates);
    }
}

/**
 * Class representing Length Conversions.
 */
class LengthConverter extends UnitConverterAbstract
{

    public function __construct()
    {
        $this->_rates
            = [
            'Metre'      => 1,
            'Centimetre' => 10,
            'Kilometre'  => 0.001,
            'Miles'      => 0.000621371,
            'Inch'       => 39.3701,
            'Foot'       => 3.28084,
            'Yard'       => 1.09361
        ];
    }

    public function convertToUnit(string $unit): float
    {
        if (isset($this->_rates[$unit])) {
            return $this->_baseValue * $this->_rates[$unit];
        }
        return 0;
    }

    public function setBaseValue(float $amount, string $unit): void
    {
        if (isset($this->_rates[$unit])) {
            $this->_baseValue = $amount * (1 / $this->_rates[$unit]);
        }
    }
}
