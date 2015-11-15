<?php 

class Results extends Set
{
    public function titleSort()
    {
        //NOTE: http://stackoverflow.com/questions/4282413/sort-array-of-objects-by-object-fields
        //NOTE: http://www.codingforums.com/php/56027-using-class-method-usort.html#post292581
        usort($this->members, array($this, 'titleUSort'));
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
