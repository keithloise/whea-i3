<?php
class Page extends SiteTree {

	private static $db = array(
	    'CustomScript' => 'Text'
	);

	private static $has_one = array(
	    'BackgroundImage' => 'Image'
	);

	private static $has_many = array(
	    'PageBlockContainers' => 'PageBlockContainer'
    );

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->addFieldToTab('Root.Main', UploadField::create('BackgroundImage', 'Page Background'), 'Content');
        $fields->addFieldToTab('Root.CustomCode', CodeEditorField::create('CustomScript')->setRows(20));

        $gridConfig = GridFieldConfig_RecordEditor::create();
        if($this->PageBlockContainers()->Count()){
            $gridConfig->addComponent(new GridFieldOrderableRows());
        }

        $gridConfig->addComponent(new GridFieldEditableColumns());
        $gridConfig->getComponentByType('GridFieldEditableColumns')->setDisplayFields(array(
            'Archived' => array(
                'title' => 'Archive',
                'callback' => function($record, $column, $grid) {
                    return CheckboxField::create($column);
                })
        ));

        $gridField = GridField::create(
            'PageBlockContainers',
            'Page Block Containers',
            $this->PageBlockContainers(),
            $gridConfig
        );
        $fields->removeFieldFromTab("Root","PageBlockContainers");
        $fields->addFieldToTab('Root.PageBlock', $gridField);

        return $fields;
    }

    public function getVisibleBlocks() {
        return $this->PageBlockContainers()->filter('Archived', false)->sort('Sort');
    }
}
class Page_Controller extends ContentController {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	private static $allowed_actions = array (
	);

	public function init() {
		parent::init();
		// You can include any CSS or JS required by your project here.
		// See: http://doc.silverstripe.org/framework/en/reference/requirements

        //Requirements::css("themes/simple/css/animate.css");
        Requirements::css("themes/simple/css/reset.css");
        Requirements::css("themes/simple/css/animate.css");
        Requirements::css("themes/simple/css/typography.css");
        Requirements::css("themes/simple/css/form.css");
        Requirements::css("themes/simple/css/layout.css");
        Requirements::css("themes/simple/css/lightbox.css");
        Requirements::css("themes/simple/css/style.css");

        Requirements::javascript('framework/thirdparty/jquery/jquery.js');
        Requirements::javascript('themes/simple/javascript/wow.min.js');
        Requirements::javascript('themes/simple/javascript/isotope.pkgd.min.js');
        Requirements::javascript('themes/simple/javascript/imagesloaded.pkgd.min.js');
        Requirements::javascript('themes/simple/javascript/lightbox.js');
        Requirements::javascript('themes/simple/javascript/script.js');

	}

}
