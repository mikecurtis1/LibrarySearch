<?php 

class Results implements Iterator, ResultsInterface
{
    private $position = 0;
    private $results = array();
    
    public function current()
    {
        return $this->results[$this->position];
    }
    
    public function key()
    {
        return $this->position;
    }
    
    public function next()
    {
        ++$this->position;
    }
    
    public function rewind()
    {
        $this->position = 0;
    }
    
    public function valid()
    {
        return isset($this->results[$this->position]);
    }
    
    public function addResult($arg)
    {
        $result_added = false;
        if (gettype($arg) === 'object') {
            if (in_array('RecordInterface', class_implements($arg))) {
                $this->results[] = $arg;
                $result_added = true;
            }
        }
        
        return $result_added;
    }
    
    public function titleSort()
    {
        //NOTE: http://stackoverflow.com/questions/4282413/sort-array-of-objects-by-object-fields
        //NOTE: http://www.codingforums.com/php/56027-using-class-method-usort.html#post292581
        usort($this->results, array($this, 'titleUSort'));
    }
    
    private function titleUSort($a, $b)
    {
        return strnatcasecmp(self::rotate_articles($a->getTitle()), self::rotate_articles($b->getTitle()));
    }
    
    public static function rotate_articles($str='')
    {
        if (strtoupper(substr($str, 0, 4)) === 'THE ') {
            return substr($str, 4).substr($str, 0, 4);
        } elseif (strtoupper(substr($str, 0, 3)) === 'AN ') {
            return substr($str, 3).substr($str, 0, 3);
        } elseif (strtoupper(substr($str, 0, 2)) === 'A ') {
            return substr($str, 2).substr($str, 0, 2);
        } elseif (substr($str, 0, 1) === '\'') {
            return substr($str, 1).substr($str, 0, 1);
        } elseif (substr($str, 0, 1) === '"') {
            return substr($str, 1).substr($str, 0, 1);
        } elseif (substr($str, 0, 1) === chr(226)) { //NOTE: inverted apostrophe, PHP ord() returns 226 for the character
            return mb_substr($str, 1, null,"UTF-8").mb_substr($str, 0, 1,"UTF-8");
        } else {
            return $str;
        }
        return $str;
    }
}
