<?php 

class ContentMember implements ContentMemberInterface
{
    private $process_profile = null;
    private $content = null;
    
    private function __construct($process_profile, $content)
    {
        $this->process_profile = $process_profile;
        $this->content = $content;
    }
    
    public static function build($process_profile, $content=null)
    {
        if ($process_profile instanceof ProcessProfileInterface) {
            return new ContentMember($process_profile, $content);
        } else {
            return false;
        }
    }
        
    public function getProcessProfile()
    {
        return $this->process_profile;
    }
        
    public function getContentData()
    {
        return $this->content;
    }
}
