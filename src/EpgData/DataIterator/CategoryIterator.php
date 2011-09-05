<?php

/*
 * This file is part of the EpgData package, a project developed for Gruner+Jahr.
 *
 * (c) 2011-2012 Christian Schaefer, Gruner+Jahr
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EpgData\DataIterator;

use EpgData\DataIterator\BaseIterator;
use EpgData\Package\BasePackage;
use EpgData\Package\IncludesPackage;

class CategoryIterator extends BaseIterator
{
    protected $mapping = array(
        'ca0' => 'category_id',
        'ca1' => 'category_long_de',
        'ca2' => 'category_short_de');

    public function __construct(BasePackage $package)
    {
        $this->reader = $package->extractCategoryXmlReader();
        parent::__construct($package);
    }
}