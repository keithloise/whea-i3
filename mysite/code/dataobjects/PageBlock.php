<?php
class PageBlock extends DataObject {

    private static $default_sort = 'Sort';

    private static $db = array(
        'Title'       => 'Varchar(255)',
        'Content'     => 'HTMLText',
        'Width'       => 'Enum(array("size1of1","size1of2","size1of3", "size2of3", "size1of4", "size3of4", "size1of5","size2of5","size3of5","size4of5"))',
        'BlockAlign'  => 'Enum(array("center-align","left-align","right-align", "default")',
        'Height'      => 'Int',
        'Animate'     => 'Enum(array("(Select one)","fadeIn","fadeInDown", "fadeInDownBig", "fadeInLeft", "fadeInLeftBig", "fadeInRight","fadeInRightBig","fadeInUp","fadeInUpBig"))',
        'ContentIcon' => 'Boolean',
        'Archived'    => 'Boolean',
        'Sort'        => 'Int'
    );

    private static $has_one = array(
        'PageBlockContainer'   => 'PageBlockContainer',
        'SVGImage' => 'File',
        'Image'    => 'Image'
    );

    private static $summary_fields = array(
        'TitleName' => 'Title',
        'Content'   => 'Content',
        'Width'     => 'Width',
        'ArchivedReadable' => 'Status'
    );

    public function getCMSFields(){
        $fields = parent::getCMSFields();

        $fields->addFieldToTab('Root.Main', TextField::create('Title', 'Title'));
        $fields->addFieldToTab('Root.Main', HtmlEditorField::create('Content', 'Content'));
        $fields->addFieldToTab('Root.Main', UploadField::create('Image', 'Image'));
        $fields->addFieldToTab('Root.Main', UploadField::create('SVGImage', 'SVG image'));
        $fields->addFieldToTab('Root.Main', CheckboxField::create('ContentIcon', 'Make as Content Icon'));

        $fields->addFieldToTab('Root.Main', DropdownField::create('Width', 'Width', $this->dbObject('Width')->enumValues()));
        $fields->addFieldToTab('Root.Main', DropdownField::create('BlockAlign', 'Block Alignment', $this->dbObject('BlockAlign')->enumValues()));
        $fields->addFieldToTab('Root.Main', $height = TextField::create('Height', 'Custom Height'));
        $height->setDescription('Note: Please input a number. E.g 200 for 200px height');
        $fields->addFieldToTab('Root.Animation', DropdownField::create('Animate', 'Animation', $this->dbObject('Animate')->enumValues()));
        $fields->addFieldToTab('Root.Main', CheckboxField::create('Archived'));
        $fields->addFieldToTab('Root.Main', new HiddenField('Sort', 'Sort'));

        return $fields;
    }

    public function getTitleName() {
       $title =  $this->Title;

       if(!$title) {
           return "No Title";
       } else {
           return $title;
       }
    }

    public function ArchivedReadable(){
        if($this->Archived == 1) return _t('GridField.Archived', 'Archived');
        return _t('GridField.Live', 'Live');
    }

    public function canCreate($member = null) {
        return $this->PageBlockContainer()->canCreate($member);
    }

    public function canEdit($member = null) {
        return $this->PageBlockContainer()->canEdit($member);
    }

    public function canDelete($member = null) {
        return $this->PageBlockContainer()->canDelete($member);
    }

    public function canView($member = null) {
        return $this->PageBlockContainer()->canView($member);
    }
}