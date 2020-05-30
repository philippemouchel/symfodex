<?php

namespace App\Helper;

use App\Entity\Pokemon;
use UnitConverter\UnitConverter;

class PokemonHelper
{
    /**
     * @var UnitConverter
     */
    private $converter;

    public function __construct()
    {
        $this->converter = UnitConverter::createBuilder()
            ->addSimpleCalculator()
            ->addDefaultRegistry()
            ->build();
    }

    /**
     * Return formatted height depending on locale.
     *
     * @param string $locale
     * @param Pokemon $pokemon
     * @return string
     */
    public function getHeightByLocale(string $locale, Pokemon $pokemon)
    {
        // Return different format and unit, based on locale.
        switch ($locale) {

            // English: unit is feet
            case 'en':

                // Convert to feet, then convert feet decimal to inches.
                $ftVal = $this->converter->convert($pokemon->getHeight())->from('mm')->to('ft');
                $ft = floor($ftVal);
                $ftDec = $ftVal - $ft;
                $in = round($this->converter->convert($ftDec)->from('ft')->to('in'));

                // If 12 inches after round, simply add one foot.
                if ($in == 12) {
                    $ft++;
                    $in = 0;
                }

                return $ft . '\' ' . sprintf("%'.02d", $in) . '"';

            // French (& fallback): unit is meters
            case 'fr':
            default:
                return $this->converter->convert($pokemon->getHeight())->from('mm')->to('m') . ' m';
        }
    }

    /**
     * Return formatted weight depending on locale.
     *
     * @param string $locale
     * @param Pokemon $pokemon
     * @return string
     */
    public function getWeightByLocale(string $locale, Pokemon $pokemon)
    {
        // Return different format and unit, based on locale.
        switch ($locale) {

            // English: unit is pounds
            case 'en':
                return round($this->converter->convert($pokemon->getWeight())->from('g')->to('lb'), 1) . ' lbs';

            // French (& fallback): unit is kilograms
            case 'fr':
            default:
                return $this->converter->convert($pokemon->getWeight())->from('g')->to('kg') . ' kg';
        }
    }
}
