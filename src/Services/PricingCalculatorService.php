<?php

namespace Src\Services;

use Src\Models\Tree;
use Src\Models\Ornament;
class PricingCalculatorService
{
    const CURRENCY_PLN = 'PLN';
    const CURRENCY_EURO = 'EURO';

    public function calculatePrice(array $decoratedTree): array
    {
        $wholeTreePrices = [
            self::CURRENCY_PLN => 0,
            self::CURRENCY_EURO => 0,
        ];

        $rowPrices = [
            self::CURRENCY_PLN => [],
            self::CURRENCY_EURO => [],
        ];

        $treePrices = [
            self::CURRENCY_PLN => ['net' =>$decoratedTree['tree']->getNetPricePLN(), 'total' => $decoratedTree['tree']->getTotalPricePLN()],
            self::CURRENCY_EURO => ['net' => $decoratedTree['tree']->getNetPriceEuro(), 'total' => $decoratedTree['tree']->getTotalPriceEuro()],
        ];
        $showPrices = [
            self::CURRENCY_PLN => true,
            self::CURRENCY_EURO => true,
        ];

        foreach ($decoratedTree['rows'] as $row) {
            $rowPrice = [
                self::CURRENCY_PLN => 0,
                self::CURRENCY_EURO => 0,
            ];

            foreach ($row['ornaments'] as $ornament) {
                $rowPrice[self::CURRENCY_PLN] += $ornament->getTotalPricePLN();
                $rowPrice[self::CURRENCY_EURO] += $ornament->getTotalPriceEuro();

                if ($ornament->getTotalPricePLN() == 0) {
                    $showPrices[self::CURRENCY_PLN] = false;
                }
                if ($ornament->getTotalPriceEuro() == 0) {
                    $showPrices[self::CURRENCY_EURO] = false;
                }
            }

            $rowPrices[self::CURRENCY_PLN][] = round($rowPrice[self::CURRENCY_PLN], 2);
            $wholeTreePrices[self::CURRENCY_PLN] += $rowPrice[self::CURRENCY_PLN];

            $rowPrices[self::CURRENCY_EURO][] = round($rowPrice[self::CURRENCY_EURO], 2);
            $wholeTreePrices[self::CURRENCY_EURO] += $rowPrice[self::CURRENCY_EURO];
        }

        return [
            'wholeTreePrices' => $wholeTreePrices,
            'rowPrices' => $rowPrices,
            'treePrices' => $treePrices,
            'showPrices' => $showPrices,
        ];
    }
}