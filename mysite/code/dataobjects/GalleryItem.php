<?php
class GalleryItem extends DataObject {

    private static $default_sort = 'Sort';

    private static $db = array(
        'Title'   => 'Varchar(255)',
        'Content' => 'HTMLText',
        'Sort'    => 'Int'
    );

    private static $has_one = array(
        'GalleryPage'  => 'GalleryPage',
        'GalleryImage' => 'Image'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Title'));
        $fields->addFieldToTab('Root.Main', UploadField::create('GalleryImage', 'Image Gallery'));
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('Content', 'Content'));

        $fields->addFieldToTab('Root.Main', new HiddenField('Sort', 'Sort'));

        return $fields;
    }
}