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

use EpgData\Package\PackageInterface;

abstract class BasePackage implements PackageInterface
{
    protected $archiveDir;
    protected $archiveFilename;
    protected $contentsDir;
    protected $url;
    protected $keepArchive = false;
    protected $keepContents = false;

    public function __construct($url, $targetDir)
    {
        $this->url = $url;
        $this->archiveDir = $targetDir;
    }

    public function __destruct()
    {
        if (!$this->keepArchive) $this->removeArchive();
        if (!$this->keepContents) $this->removeContents();
    }

    public function downloadArchive()
    {
        if (!$this->archiveFilename) {
            $this->archiveFilename = tempnam($this->archiveDir, 'epgdata_data_zip_');

            if ('file' !== parse_url($this->url, PHP_URL_SCHEME)) {
                $fileTarget = fopen($this->archiveFilename, 'w');
                $ch = curl_init($this->url);
                curl_setopt($ch, CURLOPT_FILE, $fileTarget);
                curl_exec($ch);

                if(curl_errno($ch))
                {
                    throw new PackageException('cURL-Error: ' . curl_error($ch));
                }

                curl_close($ch);
            } else {
                copy($this->url, $this->archiveFilename);
            }
        }
    }

    public function unpackArchive($targetDir = false)
    {
        if (!$this->contentsDir) {
            $this->contentsDir = $targetDir ?: $this->archiveFilename.'_unpacked';

            mkdir($this->contentsDir, 0777, true);

            $zip = new \ZipArchive();
            $zip->open($this->archiveFilename);
            $zip->extractTo($this->contentsDir);
            $zip->close();
        }
    }

    public function removeArchive()
    {
        if ($this->archiveFilename) {
            unlink($this->archiveFilename);
            $this->archiveFilename = false;
        }
    }

    public function removeContents()
    {
        if ($this->contentsDir) {
            $files = glob($this->contentsDir.'/*');

            foreach ($files as $file) {
                unlink($file);
            }

            rmdir($this->contentsDir);
            $this->contentsDir = false;
        }
    }

    public function keepArchive($keep = true)
    {
        $this->keepArchive = $keep;
    }

    public function keepContents($keep = true)
    {
        $this->keepContents = $keep;
    }
}