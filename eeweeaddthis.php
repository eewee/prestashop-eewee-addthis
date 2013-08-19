<?php
/**
 * Module - AddThis
 *
 * @category   	Module / Other
 * @author     	eewee.fr <contact@eewee.fr>
 * @copyright  	2013 eewee
 * @version   	1.0	
 * @link       	http://www.eewee.fr
*/

// MANUEL PRESTASHOP : Créer un module Prestashop
// http://doc.prestashop.com/pages/viewpage.action?pageId=15171738#Cr%C3%A9erunmodulePrestaShop-Cr%C3%A9erunmodulePrestaShop

// Security
if (!defined('_PS_VERSION_'))
	exit;
	
// Checking compatibility with older PrestaShop and fixing it
if (!defined('_MYSQL_ENGINE_'))
	define('_MYSQL_ENGINE_', 'MyISAM');

class EeweeAddthis extends Module{

    public function __construct(){
        $this->name = 'eeweeaddthis';
        $this->tab = 'others';
        $this->version = '1.0';
        $this->author = 'Michael DUMONTET';
        $this->ps_versions_compliancy = array( 'min' => '1.5', 'max' => '1.6' ); 
        //$this->dependencies = array('blockcart');
        $this->need_instance = 0;

        parent::__construct();

        $this->displayName = $this->l('Eewee Addthis');
        $this->description = $this->l('Addthis plugin. Social network, Share, ...');

        $this->confirmUninstall = $this->l('Are you sure you want to delete this module ?');
    }

    public function install(){
        // Creation variable
        Configuration::updateValue('ADDTHIS_PUBID_PRIFILE', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_FACEBOOK', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_TWITTER', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_LINKEDIN', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_GOOGLEPLUS', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_LINKEDIN2', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_YOUTUBE', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_FLICKR', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_VIMEO', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_PINTEREST', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_INSTAGRAM', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_FOURSQUARE', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_TUMBLR', "");
        Configuration::updateValue('ADDTHIS_FOLLOW_BTN_RSS', "");
        Configuration::updateValue('ADDTHIS_SHARE_POSITION', "addthis_share_position_left");
        Configuration::updateValue('ADDTHIS_SHARE_QUANTITY', 5);
        Configuration::updateValue('ADDTHIS_RECOMMANDED_CONTENT', "Recommended");
        Configuration::updateValue('ADDTHIS_MOREOPTIONS_THEME', 1);
        
        // Install Module ET creation hook
        return 
        parent::install() && 
        $this->registerHook('header');
    }     
  
    public function uninstall(){
        // Supprimer variable
        Configuration::deleteByName('ADDTHIS_PUBID_PRIFILE');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_FACEBOOK');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_TWITTER');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_LINKEDIN');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_GOOGLEPLUS');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_LINKEDIN2');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_YOUTUBE');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_FLICKR');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_VIMEO');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_PINTEREST');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_INSTAGRAM');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_FOURSQUARE');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_TUMBLR');
        Configuration::deleteByName('ADDTHIS_FOLLOW_BTN_RSS');
        Configuration::deleteByName('ADDTHIS_SHARE_POSITION');
        Configuration::deleteByName('ADDTHIS_SHARE_QUANTITY');
        Configuration::deleteByName('ADDTHIS_RECOMMANDED_CONTENT');
        Configuration::deleteByName('ADDTHIS_MOREOPTIONS_THEME');

        // Uninstall Module
        if (!parent::uninstall() ){ return false; }

        return true;
    }
	
    public function getContent(){
        return $this->processForm().$this->displayForm();
    }
	
    private function processForm(){
        $output = '';
        if (Tools::isSubmit('submit'.$this->name)){
            // get
            $ADDTHIS_PUBID_PROFILE          = Tools::getValue('ADDTHIS_PUBID_PROFILE');
            $ADDTHIS_FOLLOW_BTN_FACEBOOK    = Tools::getValue('ADDTHIS_FOLLOW_BTN_FACEBOOK');
            $ADDTHIS_FOLLOW_BTN_TWITTER     = Tools::getValue('ADDTHIS_FOLLOW_BTN_TWITTER');
            $ADDTHIS_FOLLOW_BTN_LINKEDIN    = Tools::getValue('ADDTHIS_FOLLOW_BTN_LINKEDIN');
            $ADDTHIS_FOLLOW_BTN_GOOGLEPLUS  = Tools::getValue('ADDTHIS_FOLLOW_BTN_GOOGLEPLUS');
            $ADDTHIS_FOLLOW_BTN_LINKEDIN2   = Tools::getValue('ADDTHIS_FOLLOW_BTN_LINKEDIN2');
            $ADDTHIS_FOLLOW_BTN_YOUTUBE     = Tools::getValue('ADDTHIS_FOLLOW_BTN_YOUTUBE');
            $ADDTHIS_FOLLOW_BTN_FLICKR      = Tools::getValue('ADDTHIS_FOLLOW_BTN_FLICKR');
            $ADDTHIS_FOLLOW_BTN_VIMEO       = Tools::getValue('ADDTHIS_FOLLOW_BTN_VIMEO');
            $ADDTHIS_FOLLOW_BTN_PINTEREST   = Tools::getValue('ADDTHIS_FOLLOW_BTN_PINTEREST');
            $ADDTHIS_FOLLOW_BTN_INSTAGRAM   = Tools::getValue('ADDTHIS_FOLLOW_BTN_INSTAGRAM');
            $ADDTHIS_FOLLOW_BTN_FOURSQUARE  = Tools::getValue('ADDTHIS_FOLLOW_BTN_FOURSQUARE');
            $ADDTHIS_FOLLOW_BTN_TUMBLR      = Tools::getValue('ADDTHIS_FOLLOW_BTN_TUMBLR');
            $ADDTHIS_FOLLOW_BTN_RSS         = Tools::getValue('ADDTHIS_FOLLOW_BTN_RSS');
            $ADDTHIS_SHARE_POSITION         = Tools::getValue('ADDTHIS_SHARE_POSITION');
            $ADDTHIS_SHARE_QUANTITY         = Tools::getValue('ADDTHIS_SHARE_QUANTITY');
            $ADDTHIS_RECOMMANDED_CONTENT    = Tools::getValue('ADDTHIS_RECOMMANDED_CONTENT');
            $ADDTHIS_MOREOPTIONS_THEME      = Tools::getValue('ADDTHIS_MOREOPTIONS_THEME');

            // save
            Configuration::updateValue('ADDTHIS_PUBID_PROFILE', $ADDTHIS_PUBID_PROFILE);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_FACEBOOK', $ADDTHIS_FOLLOW_BTN_FACEBOOK);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_TWITTER', $ADDTHIS_FOLLOW_BTN_TWITTER);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_LINKEDIN', $ADDTHIS_FOLLOW_BTN_LINKEDIN);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_GOOGLEPLUS', $ADDTHIS_FOLLOW_BTN_GOOGLEPLUS);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_LINKEDIN2', $ADDTHIS_FOLLOW_BTN_LINKEDIN2);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_YOUTUBE', $ADDTHIS_FOLLOW_BTN_YOUTUBE);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_FLICKR', $ADDTHIS_FOLLOW_BTN_FLICKR);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_VIMEO', $ADDTHIS_FOLLOW_BTN_VIMEO);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_PINTEREST', $ADDTHIS_FOLLOW_BTN_PINTEREST);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_INSTAGRAM', $ADDTHIS_FOLLOW_BTN_INSTAGRAM);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_FOURSQUARE', $ADDTHIS_FOLLOW_BTN_FOURSQUARE);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_TUMBLR', $ADDTHIS_FOLLOW_BTN_TUMBLR);
            Configuration::updateValue('ADDTHIS_FOLLOW_BTN_RSS', $ADDTHIS_FOLLOW_BTN_RSS);
            Configuration::updateValue('ADDTHIS_SHARE_POSITION', $ADDTHIS_SHARE_POSITION);
            Configuration::updateValue('ADDTHIS_SHARE_QUANTITY', $ADDTHIS_SHARE_QUANTITY);
            Configuration::updateValue('ADDTHIS_RECOMMANDED_CONTENT', $ADDTHIS_RECOMMANDED_CONTENT);
            Configuration::updateValue('ADDTHIS_MOREOPTIONS_THEME', $ADDTHIS_MOREOPTIONS_THEME);
            
            // mess validation ok
            $output .= $this->displayConfirmation($this->l('Settings updated'));
        }

        return $output;
    }
    
    public function displayForm(){
        //-------------------------------------------------------------------
        // DOC : http://doc.prestashop.com/display/PS15/HelperForm
        //-------------------------------------------------------------------

        // Get default Language
        $default_lang = (int)Configuration::get('PS_LANG_DEFAULT');

        $options_share_quantity = array(    
            array( 'id_option' => 1, 'name' => '1' ),
            array( 'id_option' => 2, 'name' => '2' ),
            array( 'id_option' => 3, 'name' => '3' ),
            array( 'id_option' => 4, 'name' => '4' ),
            array( 'id_option' => 5, 'name' => '5' ),
            array( 'id_option' => 6, 'name' => '6' ),
        );
        $options_moreoptions_theme = array(    
            array( 'id_option' => 1, 'name' => 'Transparent' ),
            array( 'id_option' => 2, 'name' => 'Light' ),
            array( 'id_option' => 3, 'name' => 'Gray' ),
            array( 'id_option' => 4, 'name' => 'Dark' )
        );
        
        // Init Fields form array
        $fields_form[0]['form'] = array(
            'legend' => array(
                'title' => $this->l('Settings'),
            ),
            'input' => array(
                
                array(
                    'type' => 'text',
                    'label' => $this->l('ADDTHIS : ID Profile'),
                    'name' => 'ADDTHIS_PUBID_PROFILE',
                    'size' => 50,
                    'required' => true,
                    'desc' => $this->l('Id to retrieve your profile AddThis.com')
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : facebook.com/'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_FACEBOOK',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : twitter.com/'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_TWITTER',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : linkedin.com/in/'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_LINKEDIN',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : plus.google.com/'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_GOOGLEPLUS',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : linkedin.com/company/'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_LINKEDIN2',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : youtube.com/user/'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_YOUTUBE',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : flickr.com/photos/'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_FLICKR',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : vimeo.com/'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_VIMEO',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : pinterest.com/'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_PINTEREST',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : instagram.com/'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_INSTAGRAM',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : foursquare.com/'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_FOURSQUARE',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : xxx.tumblr.com'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_TUMBLR',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Follow button : RSS'),
                    'name' => 'ADDTHIS_FOLLOW_BTN_RSS',
                    'size' => 50,
                    'required' => false,
                    'desc' => 'e.g. http://www.eewee.fr/feed'
                ),
                array(
                    'type'      => 'radio',
                    'label'     => $this->l('Share position'),
                    'name'      => 'ADDTHIS_SHARE_POSITION',
                    'required'  => true,
                    'class'     => 't',
                    //'is_bool'   => true,
                    'values'    => array(
                      array(
                        'id'    => 'addthis_share_position_left',
                        'value' => 1,
                        'label' => $this->l('left')
                      ),
                      array(
                        'id'    => 'addthis_share_position_right',
                        'value' => 0,
                        'label' => $this->l('right')
                      )
                    ),
                    'desc'      => $this->l('(Desktop option)')
                ),
                array(
                    'type'      => 'select',
                    'label'     => $this->l('Share quantity'),
                    'name'      => 'ADDTHIS_SHARE_QUANTITY',
                    'required'  => false,
                    'options' => array(
                        'query' => $options_share_quantity,
                        'id'    => 'id_option',
                        'name'  => 'name'
                    )
                ),
                array(
                    'type' => 'text',
                    'label' => $this->l('Rocommanded content'),
                    'name' => 'ADDTHIS_RECOMMANDED_CONTENT',
                    'size' => 50,
                    'required' => false
                ),
                array(
                    'type'      => 'select',
                    'label'     => $this->l('More options'),
                    'name'      => 'ADDTHIS_MOREOPTIONS_THEME',
                    'required'  => false,
                    'options' => array(
                        'query' => $options_moreoptions_theme,
                        'id'    => 'id_option',
                        'name'  => 'name'
                    )
                ),
                
            ),
            
            'submit' => array(
                'title' => $this->l('Save'),
                'class' => 'button'
            )
        );
        
        $helper = new HelperForm();

        // Module, token and currentIndex
        $helper->module = $this;
        $helper->name_controller = $this->name;
        $helper->token = Tools::getAdminTokenLite('AdminModules');
        $helper->currentIndex = AdminController::$currentIndex.'&configure='.$this->name;

        // Language
        $helper->default_form_language = $default_lang;
        $helper->allow_employee_form_lang = $default_lang;

        // Title and toolbar
        $helper->title = $this->displayName;
        $helper->show_toolbar = true;        // false -> remove toolbar
        $helper->toolbar_scroll = true;      // yes - > Toolbar is always visible on the top of the screen.
        $helper->submit_action = 'submit'.$this->name;
        $helper->toolbar_btn = array(
            'save' =>
            array(
                'desc' => $this->l('Save'),
                'href' => AdminController::$currentIndex.'&configure='.$this->name.'&save'.$this->name.
                '&token='.Tools::getAdminTokenLite('AdminModules'),
            ),
            'back' => array(
                'href' => AdminController::$currentIndex.'&token='.Tools::getAdminTokenLite('AdminModules'),
                'desc' => $this->l('Back to list')
            )
        );

        // Load current value
        $helper->fields_value['ADDTHIS_PUBID_PROFILE']          = Configuration::get('ADDTHIS_PUBID_PROFILE');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_FACEBOOK']    = Configuration::get('ADDTHIS_FOLLOW_BTN_FACEBOOK');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_TWITTER']     = Configuration::get('ADDTHIS_FOLLOW_BTN_TWITTER');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_LINKEDIN']    = Configuration::get('ADDTHIS_FOLLOW_BTN_LINKEDIN');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_GOOGLEPLUS']  = Configuration::get('ADDTHIS_FOLLOW_BTN_GOOGLEPLUS');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_LINKEDIN2']   = Configuration::get('ADDTHIS_FOLLOW_BTN_LINKEDIN2');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_YOUTUBE']     = Configuration::get('ADDTHIS_FOLLOW_BTN_YOUTUBE');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_FLICKR']      = Configuration::get('ADDTHIS_FOLLOW_BTN_FLICKR');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_VIMEO']       = Configuration::get('ADDTHIS_FOLLOW_BTN_VIMEO');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_PINTEREST']   = Configuration::get('ADDTHIS_FOLLOW_BTN_PINTEREST');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_INSTAGRAM']   = Configuration::get('ADDTHIS_FOLLOW_BTN_INSTAGRAM');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_FOURSQUARE']  = Configuration::get('ADDTHIS_FOLLOW_BTN_FOURSQUARE');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_TUMBLR']      = Configuration::get('ADDTHIS_FOLLOW_BTN_TUMBLR');
        $helper->fields_value['ADDTHIS_FOLLOW_BTN_RSS']         = Configuration::get('ADDTHIS_FOLLOW_BTN_RSS');
        $helper->fields_value['ADDTHIS_SHARE_POSITION']         = Configuration::get('ADDTHIS_SHARE_POSITION');
        $helper->fields_value['ADDTHIS_SHARE_QUANTITY']         = Configuration::get('ADDTHIS_SHARE_QUANTITY');
        $helper->fields_value['ADDTHIS_RECOMMANDED_CONTENT']    = Configuration::get('ADDTHIS_RECOMMANDED_CONTENT');
        $helper->fields_value['ADDTHIS_MOREOPTIONS_THEME']      = Configuration::get('ADDTHIS_MOREOPTIONS_THEME');
        
        return $helper->generateForm($fields_form);
    }
    
    public function hookDisplayHeader(){
        $this->context->controller->addCSS($this->_path.'views/css/style.css', 'all');
        
        $addthis_pubid                                  = Configuration::get('ADDTHIS_PUBID_PRIFILE');
        $addthis_share_position                         = Configuration::get('ADDTHIS_SHARE_POSITION');
        $addthis_share_numPreferredServices             = Configuration::get('ADDTHIS_SHARE_QUANTITY');
        $addthis_moreoptions_theme                      = Configuration::get('ADDTHIS_MOREOPTIONS_THEME');
        $addthis_follow_services['facebook']            = "{'service': 'facebook', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_FACEBOOK')."'}";
        $addthis_follow_services['twitter']             = "{'service': 'twitter', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_TWITTER')."'}";
        $addthis_follow_services['linkedin']            = "{'service': 'linkedin', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_LINKEDIN')."'}";
        $addthis_follow_services['google_follow']       = "{'service': 'google_follow', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_GOOGLEPLUS')."'}";
        $addthis_follow_services['linkedin_company']    = "{'service': 'linkedin', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_LINKEDIN2')."', 'usertype': 'company'}";
        $addthis_follow_services['youtube']             = "{'service': 'youtube', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_YOUTUBE')."'}";
        $addthis_follow_services['flickr']              = "{'service': 'flickr', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_FLICKR')."'}";
        $addthis_follow_services['vimeo']               = "{'service': 'vimeo', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_VIMEO')."'}";
        $addthis_follow_services['pinterest']           = "{'service': 'pinterest', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_PINTEREST')."'}";
        $addthis_follow_services['instagram']           = "{'service': 'instagram', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_INSTAGRAM')."'}";
        $addthis_follow_services['foursquare']          = "{'service': 'foursquare', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_FOURSQUARE')."'}";
        $addthis_follow_services['tumblr']              = "{'service': 'tumblr', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_TUMBLR')."'}";
        $addthis_follow_services['rss']                 = "{'service': 'rss', 'id': '".Configuration::get('ADDTHIS_FOLLOW_BTN_RSS')."'}";
        $addthis_recommanded_title                      = Configuration::get('ADDTHIS_RECOMMANDED_CONTENT');
        $addthis_follow_service                         = implode( ", ", $addthis_follow_services);
        
        $getAddthis = "
        <!-- AddThis Smart Layers BEGIN -->
        <!-- Go to http://www.addthis.com/get/smart-layers to customize -->
        <script type='text/javascript' src='//s7.addthis.com/js/300/addthis_widget.js#pubid=".$addthis_pubid."'></script>
        <script type='text/javascript'>
          addthis.layers({
            'theme' : '".$addthis_moreoptions_theme."',
            'share' : {
              'position' : '".$addthis_share_position."',
              'numPreferredServices' : ".$addthis_share_numPreferredServices."
            }, 
            'follow' : {
              'services' : [
                ".$addthis_follow_service."
              ]
            },  
            'whatsnext' : {},  
            'recommended' : {
              'title': '".$addthis_recommanded_title."'
            } 
          });
        </script>
        <!-- AddThis Smart Layers END -->";
        
        return $getAddthis;
    }  
        
}