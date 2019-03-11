<?php
class WinnerItem extends DataObject {

    private static $default_sort = 'Sort';

    private static $db = array(
        'Title'     => 'Varchar(255)',
        'EntryType' => 'Enum(array("Poster Presentation","Oral Presentation","Nomination")',
        'Content'   => 'HTMLText',
        'Category'  => 'Varchar(255)',
        'Year'      => 'Varchar(255)',
        'Sort'      => 'Int'
    );

    private static $has_one = array(
        'WinnersPage' => 'WinnersPage'
    );

    private static $summary_fields = array(
        'Title'     => 'Title',
        'EntryType' => 'Entry Type',
        'Year'      => 'Year'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Title'));
        $fields->addFieldToTab('Root.Main', DropdownField::create('EntryType', 'Entry Type', $this->dbObject('EntryType')->enumValues()));
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('Content', 'Content'));
        $fields->addFieldToTab('Root.Main', TextField::create('Category', 'Category'));
        $fields->addFieldToTab('Root.Main', TextField::create('Year', 'Year'));
        $fields->addFieldToTab('Root.Main', new HiddenField('Sort', 'Sort'));

        return $fields;
    }
}