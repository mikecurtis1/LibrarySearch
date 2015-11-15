<?php 

class SearchInfoMember implements SearchInfoMemberInterface
{
    private $process_id = '';
    private $interpretation = '';
    private $hits = 0;
    
    private function __construct($process_id, $interpretation, $hits)
    {
        $this->process_id = $process_id;
        $this->interpretation = $interpretation;
        $this->hits = $hits;
    }
    
    public static function build(ProcessProfileInterface $process_profile, InterpreterInterface $interpreter, $hits=0)
    {
        if (is_int($hits)) {
            return new SearchInfoMember($process_profile->getID(), $interpreter->getInterpretation(), $hits);
        }
    }
    
    public function getProcessId()
    {
        return $this->process_id;
    }
    
    public function getInterpretation()
    {
        return $this->interpretation;
    }
    
    public function getHits()
    {
        return $this->hits;
    }
}
