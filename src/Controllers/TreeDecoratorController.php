<?php

namespace Src\Controllers;

use Src\Models\Tree;
use Src\Repositories\OrnamentRepository;
use Src\Repositories\TreeRepository;
use Src\Services\PricingCalculatorService;
use Src\Services\TreeDecoratorService;

class TreeDecoratorController
{
    private TreeDecoratorService $treeDecoratorService;
    private PricingCalculatorService $pricingCalculatorService;

    public function __construct(
        TreeDecoratorService     $treeDecoratorService,
        PricingCalculatorService $pricingCalculator
    ) {
        $this->treeDecoratorService = $treeDecoratorService;
        $this->pricingCalculatorService = $pricingCalculator;
    }

    public function decorateCompleteTreeWithObjectsByTreeSizeId(int $sizeId): array
    {
        list($tree, $ornamentIds) = $this->treeDecoratorService->getOrnamentsIdsForSpecificSizeTree($sizeId);

        $decoratedTree = $this->treeDecoratorService->decorateTreeFromOrnamentsIdsArray($tree, $ornamentIds);
        $completeTree = $this->treeDecoratorService->generateTreeWithObjectsFromIds($decoratedTree['rows'], $decoratedTree['tree']);

        return $completeTree;
    }

    public function calculatePriceForDecoratedTree(array $decoratedTree): array
    {

        $prices = $this->pricingCalculatorService->calculatePrice($decoratedTree);

        return $prices;
    }


}