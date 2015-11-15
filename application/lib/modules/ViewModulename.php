<?php 

class ViewModulename extends AbstractView implements ViewInterface
{
    public function __construct(ConfigInterface $config)
    {
        $this->setTemplatePath($config->getParam('template_name'));
    }
    
    protected function markUpResult($i, $result, $http_request)
    {
        $html = '';
        $html .= '<div class="result">' . "\n";
        $html .= '<div class="title">' . $result->getValue('title') . '</div>' . "\n";
        $html .= '<div class="clear"></div>' . "\n";
        $html .= '</div>' . "\n";
        
        return $html;
    }
    
    protected function markUpForm($http_request)
    {
        $form = '';
        $form .= '<form action="" method="get">' . "\n";
        $form .= '<input type="hidden" name="module" value="'. $http_request->getKEV('module') . '" />' . "\n";
        $form .= '<input type="hidden" name="user_id" value="'. $http_request->getKEV('user_id') . '" />' . "\n";
        $form .= '<input class="search" type="text" size="48" name="query" value="'. $http_request->getKEV('query') . '" />' . "\n";
        $form .= '<select name="index">' . "\n";
        $form .= '<option value="keyword"' . $this->optionSelected($http_request, 'index', 'keyword') . '>keyword</option>' . "\n";
        $form .= '<option value="author"' . $this->optionSelected($http_request, 'index', 'author') . '>author</option>' . "\n";
        $form .= '<option value="title"' . $this->optionSelected($http_request, 'index', 'title') . '>title</option>' . "\n";
        $form .= '<option value="topic"' . $this->optionSelected($http_request, 'index', 'topic') . '>topic</option>' . "\n";
        $form .= '</select>' . "\n";
        $form .= '<input class="button" type="submit" value="search" />' . "\n";
        $form .= '<div class="date"><label>Date:</label><input type="text" size="10" name="date" value="'. $http_request->getKEV('date') . '" /></div>' . "\n";
        $form .= '<div class="search_filters">' . "\n";
        $form .= '<input type="checkbox" name="books" value="books"' . $this->elementChecked($http_request, 'books', 'books') . ' />books ' . "\n";
        $form .= '<input type="checkbox" name="articles" value="articles"' . $this->elementChecked($http_request, 'articles', 'articles') . ' />articles ' . "\n";
        $form .= '<input type="checkbox" name="audio" value="audio"' . $this->elementChecked($http_request, 'audio', 'audio') . ' />audio ' . "\n";
        $form .= '<input type="checkbox" name="video" value="video"' . $this->elementChecked($http_request, 'video', 'video') . ' />video ' . "\n";
        $form .= '</div>' . "\n";
        $form .= '<div class="sort_key"><label>Sort:</label>' . "\n";
        $form .= '<select name="sort_key">' . "\n";
        $form .= '<option value=""' . $this->optionSelected($http_request, 'sort_key', '') . '></option>' . "\n";
        $form .= '<option value="relevance"' . $this->optionSelected($http_request, 'sort_key', 'relevance') . '>relevance</option>' . "\n";
        $form .= '<option value="author"' . $this->optionSelected($http_request, 'sort_key', 'author') . '>author</option>' . "\n";
        $form .= '<option value="title"' . $this->optionSelected($http_request, 'sort_key', 'title') . '>title</option>' . "\n";
        $form .= '<option value="date"' . $this->optionSelected($http_request, 'sort_key', 'date') . '>date</option>' . "\n";
        $form .= '</select>' . "\n";
        $form .= '</div>' . "\n";
        $form .= '</form>' . "\n";
        
        return $form;
    }
    
    private function elementChecked($http_request, $name, $value)
    {
        if ($http_request->getKEV($name) === $value) {
            return ' checked="checked"';
        } else {
            return '';
        }
    }
    
    private function optionSelected($http_request, $name, $value)
    {
        if ($http_request->getKEV($name) === $value) {
            return ' selected="selected"';
        } else {
            return '';
        }
    }
}
