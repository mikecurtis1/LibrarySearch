<?php 

class Record implements RecordInterface
{
    protected $metadata_source = '';
    protected $metadata_source_id = '';
    protected $authors;
    protected $creation_date = '';
    protected $series = '';
    protected $title = '';
    protected $subtitle = '';
    protected $chapter = '';
    protected $journal = '';
    protected $volume = '';
    protected $issue = '';
    protected $pagination = '';
    protected $start_page = '';
    protected $publisher = '';
    protected $edition = '';
    protected $physical_description = '';
    protected $media_type = '';
    protected $language = '';
    protected $topics;
    protected $relations;
    protected $description = '';
    protected $identifiers;
    protected $availability = '';
    protected $agent = '';
    protected $location = '';
    protected $url = '';
    protected $session_key = '';
    
    public function __construct()
    {
        $this->authors = SetFactory::build('Authors', 'AuthorizedTermInterface');
        $this->topics = SetFactory::build('Topics', 'AuthorizedTermInterface');
        $this->relations = SetFactory::build('Relations', 'AuthorizedTermInterface');
        $this->identifiers = SetFactory::build('Identifiers', 'AuthorizedTermInterface');
    }
    
    public function setMetadataSource($arg='')
    {
        $this->metadata_source = trim($arg);
    }
    
    public function setMetadataSourceId($arg='')
    {
        $this->metadata_source_id = trim($arg);
    }
    
    public function setAuthor($arg='')
    {
        if ( $arg instanceof Author ) {
            $this->authors->addMember($arg);
        }
    }
    
    public function setCreationDate($arg='')
    {
        $this->creation_date = trim($arg);
    }
    
    public function setSeries($arg='')
    {
        $this->series = trim($arg);
    }
    
    public function setTitle($arg='')
    {
        $this->title = trim($arg);
    }
    
    public function setSubtitle($arg='')
    {
        $this->subtitle = trim($arg);
    }
    
    public function setChapter($arg='')
    {
        $this->chapter = trim($arg);
    }
    
    public function setJournal($arg='')
    {
        $this->journal = trim($arg);
    }
    
    public function setVolume($arg='')
    {
        $this->volume = trim($arg);
    }
    
    public function setIssue($arg='')
    {
        $this->issue = trim($arg);
    }
    
    public function setDescription($arg='')
    {
        $this->description = trim($arg);
    }
    
    public function setLanguage($arg='')
    {
        $this->language = trim($arg);
    }
    
    public function setIdentifier($arg='')
    {
        if ($arg instanceof Identifier) {
            $this->identifiers->addMember($arg);
        }
    }
    
    public function setTopic($arg='')
    {
        if ($arg instanceof Topic) {
            $this->topics->addMember($arg);
        }
    }
    
    public function setRelation($arg='')
    {
        if ($arg instanceof Relation) {
            $this->relations->addMember($arg);
        }
    }
    
    public function setPublisher($arg='')
    {
        $this->publisher = trim($arg);
    }
    
    public function setPagination($arg='')
    {
        $this->pagination = trim($arg);
    }
    
    public function setStartPage($arg='')
    {
        $this->start_page = trim($arg);
    }
    
    public function setPhysicalDescription($arg='')
    {
        $this->physical_description = trim($arg);
    }
    
    public function setMediaType($arg='')
    {
        $this->media_type = trim($arg);
    }
    
    public function setEdition($arg='')
    {
        $this->edition = trim($arg);
    }
    
    public function setAvailability($arg='')
    {
        $this->edition = trim($arg);
    }
    
    public function setAgent($arg='')
    {
        $this->edition = trim($arg);
    }
    
    public function setLocation($arg='')
    {
        $this->edition = trim($arg);
    }
    
    public function setURL($arg='')
    {
        if (filter_var($arg, FILTER_VALIDATE_URL)) {
            $this->edition = trim($arg);
        }
    }
    
    public function setSessionKey($arg='')
    {
        $this->session_key = $arg;
    }
    
    public function checkValue($name='', $arg=null)
    {
        if (isset($this->{$name})) {
            if ($this->{$name} === $arg) {
                return true;
            }
        }
        
        return false;
    }
    
    public function getCount($name='')
    {
        if (isset($this->{$name})) {
            if ($this->{$name} instanceof Set) {
                return $this->{$name}->getCount();
            } else {
                if ($this->{$name} !== '') {
                    return 1;
                } else {
                    return 0;
                }
            }
        } else {
            return 0;
        }
    }
    
    public function getTitle()
    {
        return $this->title;
    }
    
    public function getValue($name='')
    {
        if (isset($this->{$name})) {
            if ($this->{$name} instanceof Set) {
                if ($value = $this->{$name}->getMemberByKey(0)) {
                    return $value;
                }
            } else {
                return $this->{$name};
            }
        }
        
        return '';
    }
    
    public function getValues($name='')
    {
        if ($this->{$name} instanceof Set) {
            return $this->{$name};
        }
        
        return array();
    }
    
    public function getSessionKey()
    {
        return $this->session_key;
    }
}
