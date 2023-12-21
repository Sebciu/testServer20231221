<?php

namespace Src\Repositories;

use Src\Models\Tree;

class TreeRepository
{
    private array $trees = [];

    public function addTree(Tree $tree): void
    {
        $this->trees[] = $tree;
    }

    public function getAllTrees(): array
    {
        return $this->trees;
    }

    public function getTreeById(int $id): ?Tree
    {
        foreach ($this->trees as $tree) {
            if ($tree->getId() === $id) {
                return $tree;
            }
        }

        return null;
    }

}