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

interface PackageInterface
{
    public function __construct($url, $targetDir);
    public function __destruct();
    public function downloadArchive();
    public function unpackArchive($targetDir = false);
    public function removeArchive();
    public function removeContents();
    public function keepArchive($keep = true);
    public function keepContents($keep = true);
}