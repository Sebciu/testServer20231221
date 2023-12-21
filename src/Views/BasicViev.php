<?php

namespace Src\Views;

use Src\Models\Tree;

class BasicViev
{
    public function renderTree(array $decoratedTreeInfo): string
    {
        $output = "Rozmiar drzewka: {$decoratedTreeInfo['tree']->getName()}, \n cena: {$decoratedTreeInfo['tree']->getNetPricePLN()} netto, {$decoratedTreeInfo['tree']->getTotalPricePLN()} brutto PLN | {$decoratedTreeInfo['tree']->getNetPriceEuro()} netto, {$decoratedTreeInfo['tree']->getTotalPriceEuro()} brutto Euro".PHP_EOL. PHP_EOL;

        foreach ($decoratedTreeInfo['rows'] as $row) {
            $output .= "Rząd {$row['row']} :".PHP_EOL;
            foreach ($row['ornaments'] as $ornament) {
                $output .= "{$ornament->getType()} ({$ornament->getNetPricePLN()} netto, {$ornament->getTotalPricePLN()} brutto PLN | {$ornament->getNetPriceEuro()} netto, {$ornament->getTotalPriceEuro()} brutto Euro), ".PHP_EOL;
            }
            $output .= PHP_EOL. PHP_EOL;
        }
        $output .= '========================================================='. PHP_EOL. PHP_EOL;

        return $output;
    }
    public function renderPrices(array $prices): string
    {
        $output = '';

        foreach (['PLN', 'EURO'] as $currency) {
            if ($prices['showPrices'][$currency] === true) {
                $output .= "Ceny ozdób w $currency:" . PHP_EOL;
                $output .= "- Dla każdego rzędu brutto:" . PHP_EOL;

                foreach ($prices['rowPrices'][$currency] as $rowIndex => $rowPrice) {
                    $output .= "  - Rząd " . ($rowIndex + 1) . ": $rowPrice $currency" . PHP_EOL;
                }

                $output .= "- Suma ozdób dla całego drzewka brutto: {$prices['wholeTreePrices'][$currency]} $currency" . PHP_EOL . PHP_EOL;
                $output .= "Cena drzewka: {$prices['treePrices'][$currency]['net']} netto, {$prices['treePrices'][$currency]['total']} brutto $currency" . PHP_EOL . PHP_EOL;
                $output .= "Suma drzewko + ozdoby brutto: {$prices['treePrices'][$currency]['total']} + {$prices['wholeTreePrices'][$currency]} $currency" . PHP_EOL . PHP_EOL;
            }
            else {
                $output .= "Nie mogę wyświetlić ceny w $currency. Prawdopodobnie brakuje ceny w tej walucie, dla którejś z ozdób. Sprawdź zawartość klasy FillingData::fillData() w sekcji addOrnament()." . PHP_EOL . PHP_EOL;
            }

            $output .= '========================================================='. PHP_EOL;

        }

        return $output;
    }
}