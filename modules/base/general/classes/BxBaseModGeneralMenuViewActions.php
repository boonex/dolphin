<?php defined('BX_DOL') or die('hack attempt');
/**
 * Copyright (c) UNA, Inc - https://una.io
 * MIT License - https://opensource.org/licenses/MIT
 *
 * @defgroup    BaseGeneral Base classes for modules
 * @ingroup     UnaModules
 *
 * @{
 */

/**
 * View entry social actions menu
 */
class BxBaseModGeneralMenuViewActions extends BxTemplMenuCustom
{
    protected $_sModule;
    protected $_oModule;

    protected $_oMenuAction;
    protected $_oMenuActionsMore;
    protected $_oMenuSocialSharing;

    protected $_iContentId;
    protected $_aContentInfo;

    protected $_bDynamicMode;
    protected $_bShowAsButton;
    protected $_bShowTitle;

    public function __construct($aObject, $oTemplate = false)
    {
        parent::__construct($aObject, $oTemplate);

        $this->_oModule = BxDolModule::getInstance($this->_sModule);

        $this->setContentId(bx_process_input(bx_get('id'), BX_DATA_INT));

        $this->_oMenuActions = null;
        $this->_oMenuActionsMore = null;
        $this->_oMenuSocialSharing = null;

        $this->_bShowAsButton = true;
        $this->_bShowTitle = false;
    }

    public function setContentId($iContentId)
    {
        $this->_iContentId = (int)$iContentId;

        $this->_aContentInfo = $this->_oModule->_oDb->getContentInfoById($this->_iContentId);
        if($this->_aContentInfo)
            $this->addMarkers(array('content_id' => (int)$this->_iContentId));
    }

    protected function _getMenuItemDefault ($aItem)
    {
        $aItem['class_wrp'] = 'bx-base-general-entity-action' . (!empty($aItem['class_wrp']) ? ' ' . $aItem['class_wrp'] : '');

        if($this->_bShowAsButton)
            $aItem['class_link'] = 'bx-btn' . (!empty($aItem['class_link']) ? ' ' . $aItem['class_link'] : '');

        if(!$this->_bShowTitle)
            $aItem['bx_if:title']['condition'] = false;

        return parent::_getMenuItemDefault ($aItem);
    }

    protected function _getMenuItemView($aItem, $aParams = array())
    {
        $CNF = &$this->_oModule->_oConfig->CNF;

        $sObject = !empty($aParams['object']) ? $aParams['object'] : '';
        if(empty($sObject) && !empty($CNF['OBJECT_VIEWS']))
            $sObject = $CNF['OBJECT_VIEWS'];

        $iId = !empty($aParams['id']) ? (int)$aParams['id'] : '';
        if(empty($iId))
            $iId = $this->_iContentId;

        $oObject = !empty($sObject) ? BxDolView::getObjectInstance($sObject, $iId) : false;
        if(!$oObject || !$oObject->isEnabled())
            return '';

    	return $oObject->getElementBlock(array(
            'dynamic_mode' => $this->_bDynamicMode,
            'show_do_view_as_button' => $this->_bShowAsButton,
            'show_do_view_label' => $this->_bShowTitle
        ));
    }

    protected function _getMenuItemComment($aItem, $aParams = array())
    {
        $CNF = &$this->_oModule->_oConfig->CNF;

        $sObject = !empty($aParams['object']) ? $aParams['object'] : '';
        if(empty($sObject) && !empty($CNF['OBJECT_COMMENTS']))
            $sObject = $CNF['OBJECT_COMMENTS'];

        $iId = !empty($aParams['id']) ? (int)$aParams['id'] : '';
        if(empty($iId))
            $iId = $this->_iContentId;

        $oObject = !empty($sObject) ? BxTemplCmts::getObjectInstance($sObject, $iId) : false;
        if(!$oObject || !$oObject->isEnabled())
            return '';

        return $oObject->getElementBlock(array(
            'dynamic_mode' => $this->_bDynamicMode,
            'show_do_comment_as_button' => $this->_bShowAsButton,
            'show_do_comment_label' => $this->_bShowTitle
        ));
    }

    protected function _getMenuItemVote($aItem, $aParams = array())
    {
        $CNF = &$this->_oModule->_oConfig->CNF;

        $sObject = !empty($aParams['object']) ? $aParams['object'] : '';
        if(empty($sObject) && !empty($CNF['OBJECT_VOTES']))
            $sObject = $CNF['OBJECT_VOTES'];

        $iId = !empty($aParams['id']) ? (int)$aParams['id'] : '';
        if(empty($iId))
            $iId = $this->_iContentId;

        $oObject = !empty($sObject) ? BxDolVote::getObjectInstance($sObject, $iId) : false;
        if(!$oObject || !$oObject->isEnabled())
            return '';

    	return $oObject->getElementBlock(array(
            'dynamic_mode' => $this->_bDynamicMode,
            'show_do_vote_as_button' => $this->_bShowAsButton,
            'show_do_vote_label' => $this->_bShowTitle
        ));
    }
    
    protected function _getMenuItemScore($aItem, $aParams = array())
    {
        $CNF = &$this->_oModule->_oConfig->CNF;

        $sObject = !empty($aParams['object']) ? $aParams['object'] : '';
        if(empty($sObject) && !empty($CNF['OBJECT_SCORES']))
            $sObject = $CNF['OBJECT_SCORES'];

        $iId = !empty($aParams['id']) ? (int)$aParams['id'] : '';
        if(empty($iId))
            $iId = $this->_iContentId;

        $oObject = !empty($sObject) ? BxDolScore::getObjectInstance($sObject, $iId) : false;
        if(!$oObject || !$oObject->isEnabled())
            return '';

    	return $oObject->getElementBlock(array(
            'dynamic_mode' => $this->_bDynamicMode,
            'show_do_vote_as_button' => $this->_bShowAsButton,
            'show_do_vote_label' => $this->_bShowTitle
        ));
    }

    protected function _getMenuItemFavorite($aItem, $aParams = array())
    {
        $CNF = &$this->_oModule->_oConfig->CNF;

        $sObject = !empty($aParams['object']) ? $aParams['object'] : '';
        if(empty($sObject) && !empty($CNF['OBJECT_FAVORITES']))
            $sObject = $CNF['OBJECT_FAVORITES'];

        $iId = !empty($aParams['id']) ? (int)$aParams['id'] : '';
        if(empty($iId))
            $iId = $this->_iContentId;

        $oObject = !empty($sObject) ? BxDolFavorite::getObjectInstance($sObject, $iId) : false;
        if(!$oObject || !$oObject->isEnabled())
            return '';

    	return $oObject->getElementBlock(array(
            'dynamic_mode' => $this->_bDynamicMode,
            'show_do_favorite_as_button' => $this->_bShowAsButton,
            'show_do_favorite_label' => $this->_bShowTitle
        ));
    }

    protected function _getMenuItemFeature($aItem, $aParams = array())
    {
        $CNF = &$this->_oModule->_oConfig->CNF;

        $sObject = !empty($aParams['object']) ? $aParams['object'] : '';
        if(empty($sObject) && !empty($CNF['OBJECT_FEATURED']))
            $sObject = $CNF['OBJECT_FEATURED'];

        $iId = !empty($aParams['id']) ? (int)$aParams['id'] : '';
        if(empty($iId))
            $iId = $this->_iContentId;

        $oObject = !empty($sObject) ? BxDolFeature::getObjectInstance($sObject, $iId) : false;
        if(!$oObject || !$oObject->isEnabled())
            return '';

    	return $oObject->getElementBlock(array(
            'dynamic_mode' => $this->_bDynamicMode,
            'show_do_feature_as_button' => $this->_bShowAsButton,
            'show_do_feature_label' => $this->_bShowTitle
        ));
    }

    protected function _getMenuItemRepost($aItem, $aParams = array())
    {
        $CNF = &$this->_oModule->_oConfig->CNF;

        $sAction = !empty($aParams['action']) ? $aParams['action'] : '';
        if(empty($sAction))
            $sAction = 'added';

        $iId = !empty($aParams['id']) ? (int)$aParams['id'] : '';
        if(empty($iId))
            $iId = $this->_iContentId;

        if(!BxDolRequest::serviceExists('bx_timeline', 'get_repost_element_block'))
            return '';

    	return BxDolService::call('bx_timeline', 'get_repost_element_block', array(bx_get_logged_profile_id(), $this->_oModule->_oConfig->getName(), $sAction, $iId, array(
            'show_do_repost_as_button' => $this->_bShowAsButton,
            'show_do_repost_text' => $this->_bShowTitle
        )));
    }

    protected function _getMenuItemReport($aItem, $aParams = array())
    {
        $CNF = &$this->_oModule->_oConfig->CNF;

        $sObject = !empty($aParams['object']) ? $aParams['object'] : '';
        if(empty($sObject) && !empty($CNF['OBJECT_REPORTS']))
            $sObject = $CNF['OBJECT_REPORTS'];

        $iId = !empty($aParams['id']) ? (int)$aParams['id'] : '';
        if(empty($iId))
            $iId = $this->_iContentId;

        $oObject = !empty($sObject) ? BxDolReport::getObjectInstance($sObject, $iId) : false;
        if(!$oObject || !$oObject->isEnabled())
            return '';

    	return $oObject->getElementBlock(array(
            'dynamic_mode' => $this->_bDynamicMode,
            'show_do_report_as_button' => $this->_bShowAsButton,
            'show_do_report_label' => $this->_bShowTitle
        ));
    }

    protected function _getMenuItemSocialSharingFacebook($aItem)
    {
        return $this->_getMenuItemByNameSocialSharing($aItem);
    }

    protected function _getMenuItemSocialSharingGoogleplus($aItem)
    {
        return $this->_getMenuItemByNameSocialSharing($aItem);
    }

    protected function _getMenuItemSocialSharingTwitter($aItem)
    {
        return $this->_getMenuItemByNameSocialSharing($aItem);
    }

    protected function _getMenuItemSocialSharingPinterest($aItem)
    {
        return $this->_getMenuItemByNameSocialSharing($aItem);
    }

    protected function _getMenuItemByNameActions($aItem, $aParams = array())
    {
        $CNF = &$this->_oModule->_oConfig->CNF;

        if(empty($this->_oMenuActions)) {
            $sObjectMenu = !empty($aParams['object_menu']) ? $aParams['object_menu'] : '';
            if(empty($sObjectMenu) && !empty($CNF['OBJECT_MENU_ACTIONS_VIEW_ENTRY']))
                $sObjectMenu = $CNF['OBJECT_MENU_ACTIONS_VIEW_ENTRY'];

            if(empty($sObjectMenu))
                return '';

            $this->_oMenuActions = BxDolMenu::getObjectInstance($sObjectMenu);
            $this->_oMenuActions->setContentId($this->_iContentId);
        }

        $aItem = $this->_oMenuActions->getMenuItem($aItem['name']);
        if(empty($aItem) || !is_array($aItem))
            return false;

        return $this->_getMenuItemDefault($aItem);
    }

    protected function _getMenuItemByNameSocialSharing($aItem, $aParams = array())
    {
        if(empty($this->_oMenuSocialSharing)) {
            $this->_oMenuSocialSharing = BxDolMenu::getObjectInstance('sys_social_sharing');
            $this->_oMenuSocialSharing->addMarkers($this->_aMarkers);
        }

        $aItem = $this->_oMenuSocialSharing->getMenuItem($aItem['name']);
        if(empty($aItem) || !is_array($aItem))
            return false;

        return $this->_getMenuItemDefault($aItem);
    }

    protected function _getMenuItemByNameActionsMore($aItem)
    {
        $CNF = &$this->_oModule->_oConfig->CNF;

        if(empty($this->_oMenuActionsMore)) {
            if(empty($CNF['OBJECT_MENU_ACTIONS_VIEW_ENTRY_MORE']))
                return '';

            $this->_oMenuActionsMore = BxDolMenu::getObjectInstance($CNF['OBJECT_MENU_ACTIONS_VIEW_ENTRY_MORE']);
            $this->_oMenuActionsMore->setContentId($this->_iContentId);
        }

        $aItem = $this->_oMenuActionsMore->getMenuItem($aItem['name']);
        if(empty($aItem) || !is_array($aItem))
            return false;

        return $this->_getMenuItemDefault($aItem);
    }
}

/** @} */