<?php

namespace Src\Repositories;


use Src\Models\Ornament;
use Src\Models\Tree;

class OrnamentRepository
{
    private array $ornaments = [];

    public function addOrnament(Ornament $ornament): void
    {
        $this->ornaments[] = $ornament;
    }

    public function getAllOrnaments(): array
    {
        return $this->ornaments;
    }

    public function getAvailableOrnaments(Tree $tree): array
    {
        $allOrnaments = $this->getAllOrnaments();
        $excludedSizes = $tree->getExcludedOrnamentSizes();

        return array_filter($allOrnaments, function (Ornament $availableOrnament) use ($excludedSizes) {
            return !in_array($availableOrnament->getSizeId(), $excludedSizes);
        });
    }
    public function extractOrnamentIds(array $ornaments): array
    {
        $ornamentIds = [];
        foreach ($ornaments as $ornament) {
            $ornamentIds[] = $ornament->getId();
        }

        return $ornamentIds;
    }


    public function getOrnamentById(int $id): ?Ornament
    {
        foreach ($this->ornaments as $ornament) {
            if ($ornament->getId() === $id) {
                return $ornament;
            }
        }

        return null;
    }
}