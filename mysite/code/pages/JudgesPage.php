<?php
class JudgesPage extends Page {
    private static $icon = 'mysite/images/icons/people.png';
    private static $db = array(
    );

    private static $has_one = array(
    );

    private static $has_many = array(
        'CategoryItems' => 'CategoryItem'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();

        $gridConfig = GridFieldConfig_RecordEditor::create();
        if($this->CategoryItems()->Count()){
            $gridConfig->addComponent(new GridFieldOrderableRows());
        }
        $gridField = GridField::create(
            'CategoryItems',
            'Categories',
            $this->CategoryItems(),
            $gridConfig
        );
        $fields->removeFieldFromTab("Root","CategoryItems");
        $fields->addFieldToTab('Root.CategoryJudges', $gridField);

        return $fields;
    }
}
class JudgesPage_Controller extends Page_Controller {
    private static $allowed_actions = array (
    );
}