<?php

use Src\FillingData;
use Src\Controllers\TreeDecoratorController;
use Src\Services\TreeDecoratorService;
use Src\Services\PricingCalculatorService;
use Src\Views\BasicViev;

require_once __DIR__ . '/../vendor/autoload.php';


list($ornamentRepository, $treeRepository) = FillingData::fillData();
$selectedTreeId = rand(1,count($treeRepository->getAllTrees()));

$controller = new TreeDecoratorController(
    new TreeDecoratorService($ornamentRepository, $treeRepository),
    new PricingCalculatorService()
);


$decoratedTreeWithObjects = $controller->decorateCompleteTreeWithObjectsByTreeSizeId($selectedTreeId);
$prices = $controller->calculatePriceForDecoratedTree($decoratedTreeWithObjects);

$view = new BasicViev();
echo $view->renderTree($decoratedTreeWithObjects);
echo $view->renderPrices($prices);
