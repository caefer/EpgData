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
use EpgData\Package\DataPackage;

class BroadcastIterator extends BaseIterator
{
    protected $mapping = array(
        'd0'  => 'broadcast_id',
        'd1'  => 'tvshow_id',
        'd2'  => 'tvchannel_id',
        'd3'  => 'tvregionid',
        'd4'  => 'starttime',
        'd5'  => 'endtime',
        'd6'  => 'broadcast_day',
        'd7'  => 'tvshow_length',
        'd8'  => 'vps',
        'd9'  => 'primetime',
        'd10' => 'category_id',
        'd11' => 'technics_bw',
        'd12' => 'technics_co_channel',
        'd13' => 'technics_vt150',
        'd14' => 'technics_coded',
        'd15' => 'technics_blind',
        'd16' => 'age_marker',
        'd17' => 'live_id',
        'd18' => 'tipflag',
        'd19' => 'title',
        'd20' => 'subtitle',
        'd21' => 'comment_long',
        'd22' => 'comment_middle',
        'd23' => 'comment_short',
        'd24' => 'themes',
        'd25' => 'genreid',
        'd26' => 'sequence',
        'd27' => 'technics_stereo',
        'd28' => 'technics_dolby',
        'd29' => 'technics_wide',
        'd30' => 'tvd_total_value',
        'd31' => 'attribute',
        'd32' => 'country',
        'd33' => 'year',
        'd34' => 'moderator',
        'd35' => 'studio_guest',
        'd36' => 'regisseur',
        'd37' => 'actor',
        'd38' => 'image_small',
        'd39' => 'image_middle',
        'd40' => 'image_big');

    public function __construct(BasePackage $package)
    {
        $this->reader = $package->extractBroadcastXmlReader();
        parent::__construct($package);
    }
}