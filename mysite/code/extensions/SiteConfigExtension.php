<?php
class SiteConfigExtension extends DataExtension {
    public static $db = array(
        'LogoTitle'       => 'HTMLText',
        'SiteDescription' => 'Text',
        'GoogleAnalytics' => 'Varchar(255)',
    );

    public static $has_one = array(
        'Logo'       => 'Image',
        'FooterLogo' => 'Image'
    );

    private static $has_many = array(
        'SocialNetworkItems' => 'SocialNetworkItem',
    );

    public function updateCMSFields(FieldList $fields) {

        $fields->addFieldToTab('Root.Settings', HtmlEditorField::create('LogoTitle', 'Logo Title'));
        $fields->addFieldToTab('Root.Settings', $logo = UploadField::create('Logo', 'Logo'));
        $logo->setDescription('Note: Only upload a logo when Logo Title is empty');
        $fields->addFieldToTab("Root.Settings", $googleAnalytics = new TextField("GoogleAnalytics", "Google Analytics"));
        $googleAnalytics->setDescription("Account number to be used all across the site (in the format UA-XXXXX-X)");
        $fields->addFieldToTab("Root.Settings", $siteDescription = new TextareaField("SiteDescription", "Site Description"));

        $fields->addFieldToTab('Root.Footer', $logo = UploadField::create('FooterLogo', 'Footer Logo'));

        $confSocial = GridFieldConfig_RecordEditor::create();
        $confSocial->addComponent(new GridFieldOrderableRows());
        $fields->addFieldToTab('Root.Socials', GridField::create('SocialNetworkItems', 'Social Networks', $this->owner->SocialNetworkItems(), $confSocial));
    }
}