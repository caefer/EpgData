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

class ChannelIterator extends BaseIterator
{
    protected $mapping = array(
        'ch0' => 'tvchannel_name',
        'ch1' => 'tvchannel_short',
        'ch2' => 'language_en',
        'ch3' => 'country_domain',
        'ch4' => 'tvchannel_id',
        'ch5' => 'sort',
        'ch6' => 'package_id',
        'ch7' => 'cni830f1',
        'ch8' => 'cni_vps',
        'ch9' => 'cni830f2',
        'ch10' => 'cnix26dw',
        'ch11' => 'tvchannel_dvb',
        'ch12' => 'tvchannel_type');

    public function __construct(BasePackage $package, $group)
    {
        $this->reader = $package->extractChannelXmlReader($group);
        parent::__construct($package);
    }
}