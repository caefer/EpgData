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

use \Iterator;
use \XMLReader;

use EpgData\Package\BasePackage;

abstract class BaseIterator implements Iterator
{
    protected $mapping = array();
    protected $package;
    protected $count = 0;
    protected $reader;
    protected $current = false;
    protected $next = false;

    public function __construct(BasePackage $package)
    {
        $this->package = $package;
    }

    public function __destruct()
    {   
        $this->reader->close();
        $this->package->__destruct();
        unset($this->package);
    }

    public function current()
    {
        if(false === $this->current)
        {
            $this->current = $this->readItem();
        }
        return $this->current;
    }

    public function key()
    {  
        return $this->count;
    }

    public function next()
    {  
        $this->current = $this->readItem();
    }

    public function rewind()
    {  
    }

    public function valid()
    {  
        return (false !== $this->current());
    }

    protected function readItem()
    {  
        if (false !== $this->next)
        {  
            $next = $this->next;
            $this->next = false;
            return $next;
        }

        $data = array();
        while ($this->reader->read())
        {  
            if ('data' == $this->reader->name && $this->reader->nodeType == XMLReader::ELEMENT)
            {  
                while ($this->reader->read())
                {  
                    if('data' == $this->reader->name && $this->reader->nodeType == XMLReader::END_ELEMENT)
                    {  
                        $this->count++;
                        return $data;
                    }
                    else if($this->reader->nodeType == XMLReader::ELEMENT)
                    {  
                        if (isset($this->mapping[$this->reader->name]))
                        {  
                            $data[$this->mapping[$this->reader->name]] = str_replace('&amp;', '&', $this->reader->readInnerXML());
                        }
                    }
                }
            }
        }

        return false;
    }

    public function setMapping(array $mapping)
    {
        $this->mapping = $mapping;
    }
}