<?php
class PageBlockContainer extends DataObject {

    private static $default_sort = 'Sort';

    private static $db = array(
        'Title'     => 'Varchar(255)',
        'ShowTitle' => 'Boolean',
        'Archived'  => 'Boolean',
        'Sort'      => 'Int'
    );

    private static $has_one = array(
        'Page' => 'Page'
    );

    private static $has_many = array(
        'PageBlocks' => 'PageBlock'
    );

    private static $summary_fields = array(
        'Title' => 'Title',
        'ArchivedReadable' => 'Status'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Title'));
        $fields->addFieldToTab('Root.Main', CheckboxField::create('ShowTitle', 'Show Title'));
        $fields->addFieldToTab('Root.Main', CheckboxField::create('Archived'));

        $gridConfig = GridFieldConfig_RecordEditor::create();
        if($this->PageBlocks()->Count()){
            $gridConfig->addComponent(new GridFieldOrderableRows());
        }

        $gridConfig->addComponent(new GridFieldEditableColumns());
        $gridConfig->getComponentByType('GridFieldEditableColumns')->setDisplayFields(array(
            'Width' => array(
                'title' => 'Width',
                'callback' => function($record, $column, $grid) {
                    $field = DropdownField::create($column, $column, singleton('PageBlock')->dbObject('Width')->enumValues());
                    return $field;
                }),
            'Archived' => array(
                'title' => 'Archive',
                'callback' => function($record, $column, $grid) {
                    return CheckboxField::create($column);
                })
        ));

        $gridField = GridField::create(
            'PageBlocks',
            'Page Blocks',
            $this->PageBlocks(),
            $gridConfig
        );
        $fields->removeFieldFromTab("Root","PageBlocks");
        $fields->addFieldToTab('Root.Main', $gridField);

        $fields->addFieldToTab('Root.Main', new HiddenField('Sort', 'Sort'));

        return $fields;
    }

    public function blockID($id) {
        $string = str_replace(' ', '', $id);
        return $string;
    }

    public function getVisibleItems() {
        return $this->PageBlocks()->filter('Archived', false)->sort('Sort');
    }

    public function ArchivedReadable(){
        if($this->Archived == 1) return _t('GridField.Archived', 'Archived');
        return _t('GridField.Live', 'Live');
    }

    public function canCreate($member = null) {
        return $this->Page()->canCreate($member);
    }

    public function canEdit($member = null) {
        return $this->Page()->canEdit($member);
    }

    public function canDelete($member = null) {
        return $this->Page()->canDelete($member);
    }

    public function canView($member = null) {
        return $this->Page()->canView($member);
    }
}