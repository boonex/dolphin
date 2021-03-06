<?php defined('BX_DOL') or die('hack attempt');
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 *
 * @defgroup    TridentStudio Trident Studio
 * @{
 */

define('BX_DOL_STUDIO_TEMPLATE_DEFAULT_CODE', 'uni');

define('BX_PAGE_COLUMN_DUAL', 3); ///< page, with 2 columns

bx_import('BxDolTemplate');

class BxDolStudioTemplate extends BxDolTemplate implements iBxDolSingleton
{
    function __construct()
    {
        if (isset($GLOBALS['bxDolClasses'][get_class($this)]))
            trigger_error ('Multiple instances are not allowed for the class: ' . get_class($this), E_USER_ERROR);

        parent::__construct();

        $this->_sRootPath = BX_DOL_DIR_STUDIO;
        $this->_sRootUrl = BX_DOL_URL_STUDIO;
        $this->_sPrefix = 'BxDolStudioTemplate';
        $this->_sInjectionsTable = 'sys_injections_admin';
        $this->_sInjectionsCache = 'sys_injections_admin.inc';

        $this->_sCodeKey = 'sskin';
        $this->_sCode = isset($_COOKIE[$this->_sCodeKey]) && preg_match('/^[A-Za-z0-9_-]+$/', $_COOKIE[$this->_sCodeKey]) ? $_COOKIE[$this->_sCodeKey] : BX_DOL_STUDIO_TEMPLATE_DEFAULT_CODE;
        $this->_sCode = isset($_GET[$this->_sCodeKey]) && preg_match('/^[A-Za-z0-9_-]+$/', $_GET[$this->_sCodeKey]) ? $_GET[$this->_sCodeKey] : $this->_sCode;

        $this->addLocation('studio', $this->_sRootPath, $this->_sRootUrl);
        $this->addLocationJs('system_admin_js', $this->_sRootPath . 'js/' , $this->_sRootUrl . 'js/');
    }

    /**
     * Prevent cloning the instance
     */
    public function __clone()
    {
        if (isset($GLOBALS['bxDolClasses'][get_class($this)]))
            trigger_error('Clone is not allowed for the class: ' . get_class($this), E_USER_ERROR);
    }

    /**
     * Get singleton instance of the class
     */
    public static function getInstance()
    {
        if (!isset($GLOBALS['bxDolClasses'][__CLASS__])) {
            $GLOBALS['bxDolClasses'][__CLASS__] = new BxDolStudioTemplate();
            $GLOBALS['bxDolClasses'][__CLASS__]->init();
        }

        return $GLOBALS['bxDolClasses'][__CLASS__];
    }

    function init()
    {
        parent::init();

        //--- Add default CSS in output
        $this->addCssSystem(array(
            'common.css',
            'default.less',
            'general.css',
        	'menu.css',
        ));

        //--- Add default JS in output
        $this->addJsSystem(array(
            'jquery/jquery.min.js',
            'jquery/jquery-migrate.min.js',
            'jquery-ui/jquery.ui.position.min.js',
            'spin.min.js',
            'jquery.dolPopup.js',
        ));

        bx_import('BxTemplStudioConfig');
        $this->_oConfigTemplate = BxTemplStudioConfig::getInstance();
    }

    function parseSystemKey($sKey, $mixedKeyWrapperHtml = null, $bProcessInjection = true)
    {
        $sRet = '';
        switch( $sKey ) {
            case 'version':
                $sRet = bx_get_ver();
                break;
            case 'page_breadcrumb':
                $sRet = $this->getPageBreadcrumb();
                break;
            case 'dol_images':
                $sRet = $this->_processJsImages();
                break;
            case 'dol_lang':
                $sRet = $this->_processJsTranslations();
                break;
            case 'dol_options':
                $sRet = $this->_processJsOptions();
                break;
            case 'menu_top':
                bx_import('BxTemplStudioMenuTop');
                $sRet = BxTemplStudioMenuTop::getInstance()->getCode();
                break;
            case 'copyright':
                $sRet = _t( '_copyright',   date('Y') ) . getVersionComment();
                break;
            default:
                $sRet = parent::parseSystemKey($sKey, $mixedKeyWrapperHtml, false);
        }

        return $this->processInjection($this->getPageNameIndex(), $sKey, $sRet);
    }

    function setPageBreadcrumb($aItems)
    {
        $this->aPage['breadcrumb'] = $aItems;
    }

    function getPageBreadcrumb()
    {
        if(empty($this->aPage['breadcrumb']) || !is_array($this->aPage['breadcrumb']))
           return "";

        $aItems = array();
        foreach($this->aPage['breadcrumb'] as $aItem) {
            $bLink = isset($aItem['link']) && $aItem['link'] != '';

            $aItems[] = array(
                'bx_if:show_link' => array(
                    'condition' => $bLink,
                    'content' => array(
                        'link' => $bLink ? $aItem['link'] : '',
                        'title' => _t($aItem['title'])
                    )
                ),
                'bx_if:show_text' => array(
                    'condition' => !$bLink,
                    'content' => array(
                        'title' => _t($aItem['title'])
                    )
                )
            );
        }

        return $this->parseHtmlByName('breadcrumb.html', array('bx_repeat:items' => $aItems));
    }

    function getIcon($mixedId, $aParams = array())
    {
        return $this->_getImage('icon', $mixedId, $aParams);
    }

    function getImage($mixedId, $aParams = array())
    {
        return $this->_getImage('image', $mixedId, $aParams);
    }

    protected function _getImage($sType, $mixedId, $aParams = array())
    {
        $sUrl = "";
        $aType2Method = array('image' => 'getImageUrl', 'icon' => 'getIconUrl');

        //--- Check in System Storage.
        if(is_numeric($mixedId) && (int)$mixedId > 0) {
            bx_import('BxDolStorage');
            if(($sResult = BxDolStorage::getObjectInstance(BX_DOL_STORAGE_OBJ_IMAGES)->getFileUrlById((int)$mixedId)) !== false)
                $sUrl = $sResult;
        }

        //--- Check in template folders.
        if($sUrl == "" && is_string($mixedId) && strpos($mixedId, '.') !== false)
            $sUrl = $this->$aType2Method[$sType]($mixedId);

        if($sUrl != "") {
            $bClass = isset($aParams['class']) && !empty($aParams['class']);

            return $this->parseHtmlByName('bx_img.html', array(
                'bx_if:class' => array(
                    'condition' => $bClass,
                    'content' => array(
                        'content' => $bClass ? $aParams['class'] : ''
                    )
                ),
                'src' => $sUrl,
                'alt' => isset($aParams['alt']) ? $aParams['alt'] : ''
            ));
        }

        //--- Use iconic font.
        return $this->parseHtmlByName('bx_icon.html', array(
            'name' => $mixedId
        ));
    }

    function displayMsg ($s, $bTranslate = false)
    {
        $sTitle = $bTranslate ? _t($s) : $s;

        $sContent = MsgBox($sTitle);
        $sContent = $this->parseHtmlByName('page_not_found.html', array (
            'content' => $sContent
        ));

        $this->setPageNameIndex(BX_PAGE_DEFAULT);
        $this->setPageHeader($sTitle);
        $this->setPageContent('page_main_code', $sContent);
        $this->getPageCode();
        exit;
    }
}

/** @} */
