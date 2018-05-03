<?php
/**
 * Example use of the MVC Unit Converter.
 */
namespace MVC;

include_once 'ConverterMVC.php';

// Initialise Model
$unitsLength = new LengthConverter();
$unitsLength->setBaseValue(1, 'Metre');

//Initialise Controller with model
$controllerLength = new ControllerConverter($unitsLength);

// Controller changes model if button pressed
if (isset($_GET['action'])) {
    $controllerLength->{$_GET['action']}($_POST);
}
// View updated with current model
$viewLength = new ViewConverter($unitsLength, 'Metre');

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Unit Converter</title>
</head>
<body>
<h1>Length Converter</h1>
<?php echo $viewLength->outputAllUnits(); ?>
</body>
</html>
