<?php

/*
 * This file is part of the EpgData package, a project developed for Gruner+Jahr.
 *
 * (c) 2011-2012 Christian Schaefer, Gruner+Jahr
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EpgData\Package;

use \XMLReader;

use EpgData\Package\BasePackage;

class DataPackage extends BasePackage
{
    public function extractBroadcastXmlReader()
    {
        $this->downloadArchive();
        $this->unpackArchive();

        list($xmlfile) = glob($this->contentsDir.'/*.xml');

        $reader = new XMLReader();
        $reader->open($xmlfile, null, XMLReader::VALIDATE | XMLReader::SUBST_ENTITIES);

        return $reader;
    }
}