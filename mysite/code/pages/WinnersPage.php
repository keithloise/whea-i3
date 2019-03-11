<?php
class WinnersPage extends Page {
    private static $icon = 'mysite/images/icons/achieve.png';

    private static $db = array(
    );

    private static $has_one = array(
    );

    private static $has_many = array(
        'WinnerItems' => 'WinnerItem'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $gridConfig = GridFieldConfig_RecordEditor::create();
        if($this->WinnerItems()->Count()){
            $gridConfig->addComponent(new GridFieldOrderableRows());
        }
        $gridField = GridField::create(
            'WinnerItems',
            'Winners',
            $this->WinnerItems(),
            $gridConfig
        );
        $fields->removeFieldFromTab("Root","WinnerItems");
        $fields->addFieldToTab('Root.Winners List', $gridField);

        return $fields;
    }
}
class WinnersPage_Controller extends Page_Controller {
    private static $allowed_actions = array (
    );
}