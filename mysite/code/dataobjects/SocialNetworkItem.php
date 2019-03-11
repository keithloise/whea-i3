<?php
class SocialNetworkItem extends DataObject {

    private static $db = array(
        'Title' => "Enum('Facebook, Twitter, LinkedIn, Youtube, Vimeo, Instagram, GooglePlus, Email')",
        'Link'  => 'Varchar(255)',
        'Sort'  => 'Int'
    );

    private static $has_one = array(
        'SiteConfig' => 'SiteConfig'
    );

    private static $default_sort = 'Sort';

    public function getCMSFields(){
        $fields = parent::getCMSFields();


        $fields->removeByName(array('SiteConfigID', 'Sort'));
        return $fields;
    }

    public function getIconClass(){
        if($this->Title == 'GooglePlus'){
            $class = 'fa-google-plus';
        }
        elseif($this->Title == 'Youtube'){
            $class = 'fa-youtube';
        }
        elseif($this->Title == 'Vimeo'){
            $class = 'fa-vimeo-v';
        }
        elseif($this->Title == 'LinkedIn'){
            $class = 'fa-linkedin-in';
        }
        elseif($this->Title == 'Facebook'){
            $class = 'fa-facebook-f';
        }
        elseif($this->Title == 'Email'){
            $class = 'fas fa-envelope';
        }
        else {
            $class = 'fa-'.strtolower($this->Title);
        }
        return $class;
    }
}