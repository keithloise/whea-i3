<?php
class GalleryPage extends Page {
    private static $icon = 'mysite/images/icons/slides.png';
    private static $db = array(
    );

    private static $has_one = array(
    );

    private static $has_many = array(
        'GalleryItems' => 'GalleryItem'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $gridConfig = GridFieldConfig_RecordEditor::create();
        if($this->GalleryItems()->Count()){
            $gridConfig->addComponent(new GridFieldOrderableRows());
        }
        $gridField = GridField::create(
            'GalleryItems',
            'Galleries',
            $this->GalleryItems(),
            $gridConfig
        );
        $fields->removeFieldFromTab("Root","GalleryItems");
        $fields->addFieldToTab('Root.Gallery', $gridField);

        return $fields;
    }
}
class GalleryPage_Controller extends Page_Controller {
    private static $allowed_actions = array (
    );
}