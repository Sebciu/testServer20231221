<?php

namespace Src\Services;


use Src\Models\Tree;
use Src\Models\Ornament;
use Src\Repositories\OrnamentRepository;
use Src\Repositories\TreeRepository;

class TreeDecoratorService
{
    private $ornamentRepository;
    private $treeRepository;

    public function __construct(OrnamentRepository $ornamentRepository, TreeRepository $treeRepository)
    {
        $this->ornamentRepository = $ornamentRepository;
        $this->treeRepository = $treeRepository;
    }
    public function decorateTreeFromOrnamentsIdsArray(Tree $tree, array &$ornamentsIds): array
    {
        $decoratedTree = ['tree' => $tree, 'rows' => []];
        $allUsedOrnamentsArray = [];
        $temporaryOrnamentsArray = $ornamentsIds;

        shuffle($ornamentsIds);
        for ($i = 1; $i <= $tree->getSize(); $i++) {
            $decoratedRow = $this->decorateRow($i, $ornamentsIds, $allUsedOrnamentsArray, $temporaryOrnamentsArray);
            $decoratedTree['rows'][] = [
                'row' => $decoratedRow['row'],
                'ornament_ids' => $decoratedRow['ornament_ids']
            ];
            $decoratedTree['all_ornaments_used'] = $decoratedRow['all_ornaments_used'];
        }

        return $decoratedTree;
    }

    private function decorateRow(int $row, array &$ornamentsIds, array &$allUsedOrnamentsArray, array $temporaryOrnamentsArray): array
    {
        $decoratedRow = ['row' => $row, 'ornament_ids' => []];

        $selectedOrnaments = array_slice($ornamentsIds, 0, $row);
        array_splice($ornamentsIds, 0, $row);
        shuffle($selectedOrnaments);

        $this->selectUniqueOrnaments($selectedOrnaments, $decoratedRow['ornament_ids']);

        if (empty($ornamentsIds)) {
            $ornamentsIds = $allUsedOrnamentsArray;
            $decoratedRow['all_ornaments_used'] = true;
        }

        $emptyOrnamentsLeftInRow = $row - count($selectedOrnaments);
        if ($emptyOrnamentsLeftInRow > 0) {
            $ornamentsIds = $temporaryOrnamentsArray;
            $counter = 0;
            $this->selectUniqueOrnaments($ornamentsIds, $decoratedRow['ornament_ids'], $emptyOrnamentsLeftInRow, $counter);
        }

        return $decoratedRow;
    }

    private function selectUniqueOrnaments(array &$source, array &$destination, int $limit = PHP_INT_MAX, int &$counter = 0): void
    {
        foreach ($source as $ornament) {
            while (in_array($ornament, $destination, true)) {
                if (empty($source) || $counter >= $limit) {
                    break;
                }
                $ornament = array_shift($source);
            }

            if ($counter < $limit) {
                $destination[] = $ornament;
                $counter++;
            }
        }
    }
    public function generateTreeWithObjectsFromIds(array $ornamentIds, Tree $tree): array
    {
        $generatedTree = ['tree' => $tree, 'rows' => []];

        foreach ($ornamentIds as $rowIndex => $rowArray) {
            $row = ['row' => $rowIndex + 1, 'ornaments' => []];

            foreach ($rowArray['ornament_ids'] as $ornamentId) {

                $ornament = $this->ornamentRepository->getOrnamentById($ornamentId);
                if ($ornament !== null) {
                    $row['ornaments'][] = $ornament;
                }
            }
            $generatedTree['rows'][] = $row;
        }
        return $generatedTree;
    }

    public function getOrnamentsIdsForSpecificSizeTree(int $sizeId){

        $tree = $this->treeRepository->getTreeById($sizeId);
        $ornaments = $this->ornamentRepository->getAvailableOrnaments($tree);
        $ornamentIds = $this->ornamentRepository->extractOrnamentIds($ornaments);

        return [$tree,$ornamentIds];
    }
}