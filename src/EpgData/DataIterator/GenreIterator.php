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

class GenreIterator extends BaseIterator
{
    protected $mapping = array(
        'g0' => 'genre_id',
        'g1' => 'genre');

    public function __construct(BasePackage $package)
    {
        $this->reader = $package->extractGenreXmlReader();
        parent::__construct($package);
    }
}