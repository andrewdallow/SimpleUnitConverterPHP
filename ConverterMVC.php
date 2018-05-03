<?php
/**
 * Represents a Unit Converter in the Model-View-Controller Pattern
 *
 * This unit converter can be used to convert between any type of units.
 * For example, from metric to imperial units as already implemented here.
 * It is not limited to just Length conversion, but any converter which
 * can extend the UnitConverterAbstract class.
 *
 * The Converter is Designed around the Model-View-Controller Pattern where:
 *      Model: UnitConverterAbstract
 *      View: ViewConverter
 *      Controller: ControllerConverter
 */

namespace MVC;

include_once 'UnitConverterAbstract.php';

/**
 * Represents the View of the Unit converter
 */
class ViewConverter
{
    private $_modelConverter;
    private $_unit;

    public function __construct(UnitConverterAbstract $converter, string $unit)
    {
        $this->_modelConverter = $converter;
        $this->_unit = $unit;
    }

    /**
     * Get a single for for the current unit.
     *
     * @return string
     */
    public function outputSingleUnit(): string
    {
        return $this->_getForm($this->_unit);
    }

    /**
     * Output html forms for each unit.
     *
     * @return string
     */
    public function outputAllUnits(): string
    {
        $html = '';
        $units = $this->_modelConverter->getRates();

        foreach ($units as $unit) {
            $html .= $this->_getForm($unit);
        }

        return $html;
    }

    /**
     * HTML template for a form.
     *
     * @param string $unit
     *
     * @return string
     */
    private function _getForm(string $unit): string
    {
        $form = '<form action="?action=convert" method="post">'
            . '<input name="unit" type="hidden" value="' . $unit
            . '"/>'
            . '<label>' . $unit . ':</label>'
            . '<input name="amount" type="text" value="'
            . round($this->_modelConverter->convertToUnit($unit), 4)
            . '"/>'
            . '<input type="submit" value="Convert"/>'
            . '</form>';
        return $form;
    }

}

/**
 * Represents the Controller of the Unit Converter.
 */
class ControllerConverter
{
    private $_modelConverter;

    public function __construct(UnitConverterAbstract $converter)
    {
        $this->_modelConverter = $converter;
    }

    public function convert($request): void
    {
        if (isset($request['unit'], $request['amount'])) {
            $this->_modelConverter->setBaseValue(
                $request['amount'], $request['unit']
            );
        }
    }


}