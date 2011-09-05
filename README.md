# EpgData - Electronic Program Guide

EpgData is a simple and convenient PHP API to the data provided by www.epgdata.com which covers mainly German TV. It takes care about the download management and provides simple array access to the downloaded XML structures.

    <?php
    use EpgData\EpgData;
    use EpgData\DataIterator\BroadcastIterator;
    use EpgData\DataIterator\CategoryIterator;
    use EpgData\DataIterator\ChannelIterator;
    use EpgData\DataIterator\GenreIterator;
    
    $epg = new EpgData('http://www.epgdata.com/index.php', 'YOUR_KEY');

    $broadcasts = $epg->getBroadcastIterator(0); // offset can be 0-6
    foreach ($broadcasts as $i => $bc) {
        printf('%04d - %s'.PHP_EOL, $i, $bc['title']);
    }
    
    $categories = $epg->getCategoryIterator();
    foreach ($categories as $i => $ca) {
        printf('%04d - %s'.PHP_EOL, $i, $ca['category_long_de']);
    }
    
    $channels = $epg->getChannelIterator('b'); // channel group can be b, e, m, n, s, x, y or z
    foreach ($channels as $i => $ch) {
        printf('%04d - %s'.PHP_EOL, $i, $ch['tvchannel_name']);
    }
    
    $genres = $epg->getGenreIterator();
    foreach ($genres as $i => $g) {
        printf('%04d - %s'.PHP_EOL, $i, $g['genre']);
    }

To test this API with locally stored archives you can do the following:


    <?php
    use EpgData\EpgData;

    $epg = new EpgData('file:///path/to/your/archive.zip', 'NO_KEY');

