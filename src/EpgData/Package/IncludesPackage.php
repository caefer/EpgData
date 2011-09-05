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

class IncludesPackage extends BasePackage
{
    public function extractCategoryXmlReader()
    {
        return $this->extractXmlReader('/category.xml');
    }

    public function extractChannelXmlReader($group)
    {
        return $this->extractXmlReader('/channel_'.$group.'.xml');
    }

    public function extractGenreXmlReader()
    {
        return $this->extractXmlReader('/genre.xml');
    }

    private function extractXmlReader($filename)
    {
        $this->downloadArchive();
        $this->unpackArchive();

        $xmlfile = $this->contentsDir.'/'.$filename;

        $reader = new XMLReader();
        $reader->open($xmlfile, null, XMLReader::VALIDATE | XMLReader::SUBST_ENTITIES);

        return $reader;
    }
}