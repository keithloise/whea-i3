<?php
class JudgeItem extends DataObject {

    private static $default_sort = 'Sort';

    private static $db = array(
        'Title'     => 'Varchar(255)',
        'Position'  => 'Varchar(255)',
        'Sort'      => 'Int'
    );

    private static $has_one = array(
        'CategoryItem' => 'CategoryItem',
        'ProfileImage' => 'Image'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Title'));
        $fields->addFieldToTab('Root.Main', UploadField::create('ProfileImage', 'Upload profile image'));
        $fields->addFieldToTab('Root.Main', TextField::create('Position', 'Position'));

        $fields->addFieldToTab('Root.Main', new HiddenField('Sort', 'Sort'));

        return $fields;
    }
}