<?php
class CategoryItem extends DataObject {

    private static $default_sort = 'Sort';

    private static $db = array(
        'Title'     => 'Varchar(255)',
        'Sort'      => 'Int'
    );

    private static $has_one = array(
        'JudgesPage' => 'JudgesPage'
    );

    private static $has_many = array(
        'Judges' => 'JudgeItem'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Title'));

        $gridConfig = GridFieldConfig_RecordEditor::create();
        if($this->Judges()->Count()){
            $gridConfig->addComponent(new GridFieldOrderableRows());
        }
        $gridField = GridField::create(
            'Judges',
            'Judges',
            $this->Judges(),
            $gridConfig
        );
        $fields->removeFieldFromTab("Root","Judges");
        $fields->addFieldToTab('Root.Main', $gridField);

        $fields->addFieldToTab('Root.Main', new HiddenField('Sort', 'Sort'));

        return $fields;
    }
}