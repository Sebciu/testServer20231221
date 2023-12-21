<?php

namespace Src;

use Src\Models\Ornament;
use Src\Models\Tree;
use Src\Repositories\OrnamentRepository;
use Src\Repositories\TreeRepository;

class FillingData
{
    public static function fillData(): array
    {
        $ornamentRepository = new OrnamentRepository();
        $treeRepository = new TreeRepository();

        $treeRepository->addTree(new Tree(1, 'małe', 4, [3], 100.0, 40, 0.23)); // excluded_ornament_size = [3]
        $treeRepository->addTree(new Tree(2, 'średnie', 5, [], 200.0, 80, 0.23));
        $treeRepository->addTree(new Tree(3, 'duże', 15, [], 250.0, 100, 0.23));

        $ornamentRepository->addOrnament(new Ornament(1, 'czerwona', 3.3, 2.5 , 1));
        $ornamentRepository->addOrnament(new Ornament(2, 'niebieska', 3.50, 2.7, 1));
        $ornamentRepository->addOrnament(new Ornament(3, 'żółta', 3.60, 2.8, 1));

        $ornamentRepository->addOrnament(new Ornament(4, 'zielona', 4.44, 3.4, 2));
        $ornamentRepository->addOrnament(new Ornament(5, 'biała', 5.55, 4.3, 2));
        $ornamentRepository->addOrnament(new Ornament(6, 'różowa', 6.66, 5.2, 2));

        $ornamentRepository->addOrnament(new Ornament(7, 'bałwan', 8.00, 6.2, 3));
        $ornamentRepository->addOrnament(new Ornament(8, 'mikołaj', 8.00, 6.2, 3));
        $ornamentRepository->addOrnament(new Ornament(9, 'renifer', 8.00, 6.2, 3));

        return [$ornamentRepository, $treeRepository];
    }
}