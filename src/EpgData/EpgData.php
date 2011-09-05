<?php

/*
 * This file is part of the EpgData package, a project developed for Gruner+Jahr.
 *
 * (c) 2011-2012 Christian Schaefer, Gruner+Jahr
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EpgData;

use EpgData\Package\IncludesPackage;
use EpgData\Package\DataPackage;
use EpgData\DataIterator\BroadcastIterator;
use EpgData\DataIterator\CategoryIterator;
use EpgData\DataIterator\ChannelIterator;
use EpgData\DataIterator\GenreIterator;

class EpgData
{
    private $baseUrl;
    private $pin;
    private $tempDir;
    private $defaultParams = array('iOEM' => 'vdr', 'dataType' => 'xml');
    private $includesPackage;
    private $dataPackage;

    public function __construct($baseUrl, $pin, $tempDir = false)
    {
        $this->baseUrl = $baseUrl;
        $this->pin = $pin;
        $this->tempdir = $tempDir ?: get_cfg_var('upload_tmp_dir');
    }

    public function getIncludesPackage()
    {
        if (!$this->includesPackage) {
            $url = $this->baseUrl . $this->getParams('sendInclude');
            $this->includesPackage = new IncludesPackage($url, $this->tempDir);
        }
        return $this->includesPackage;
    }

    public function getDataPackage($dayOffset)
    {
        if (!$this->dataPackage) {
            $url = $this->baseUrl . $this->getParams('sendPackage', array('dayOffset' => $dayOffset));
            $this->dataPackage = new DataPackage($url, $this->tempDir);
        }
        return $this->dataPackage;
    }

    public function getBroadcastIterator($dayOffset)
    {
        $package = $this->getDataPackage($dayOffset);
        return new BroadcastIterator($package);
    }

    public function getCategoryIterator()
    {
        $package = $this->getIncludesPackage();
        return new CategoryIterator($package);
    }

    public function getChannelIterator($group)
    {
        $package = $this->getIncludesPackage();
        return new ChannelIterator($package, $group);
    }

    public function getGenreIterator()
    {
        $package = $this->getIncludesPackage();
        return new GenreIterator($package);
    }

    private function getParams($action, array $additional = array())
    {
        if ('file' !== parse_url($this->baseUrl, PHP_URL_SCHEME)) {
            $params = array_merge($this->defaultParams, array('action' => $action, 'pin' => $this->pin), $additional);
            return '?'.http_build_query($params);
        }

        return '';
    }

    public function setDefaultParams(array $params)
    {
        $this->defaultParams = $params;
    }
}