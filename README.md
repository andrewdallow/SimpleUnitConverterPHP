## MVC Unit Converter

This unit converter can be used to convert between any type of units.
  For example, from metric to imperial units as already implemented here.
  It is not limited to just Length conversion, but any converter which
  can extend the UnitConverterAbstract class.
 
  The Converter is Designed around the Model-View-Controller Pattern where:
  
       Model: UnitConverterAbstract
       View: ViewConverter
       Controller: ControllerConverter