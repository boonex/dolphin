<?php defined('BX_DOL') or die('hack attempt');
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 *
 * @defgroup    Forum Forum
 * @ingroup     TridentModules
 *
 * @{
 */

class BxForumCmts extends BxTemplCmts
{
	protected $MODULE;
	protected $_oModule;

	public function __construct($sSystem, $iId, $iInit = 1)
    {
    	$this->MODULE = 'bx_forum';
    	$this->_oModule = BxDolModule::getInstance($this->MODULE);

        parent::__construct($sSystem, $iId, $iInit);

        $this->setTableNameFiles('bx_forum_files');
    }

	public function isPostReplyAllowed($isPerformAction = false)
    {
    	$aContentInfo = $this->_oModule->_oDb->getContentInfoById($this->_iId);
        if(!$aContentInfo || (int)$aContentInfo[$this->_oModule->_oConfig->CNF['FIELD_LOCK']] == 1)
            return false;

    	return parent::isPostReplyAllowed($isPerformAction);
    }

    public function getCommentsBlock($iParentId = 0, $iVParentId = 0, $bInDesignbox = true)
    {
        $mixedBlock = parent::getCommentsBlock($iParentId, $iVParentId, $bInDesignbox);
        if (is_array($mixedBlock) && isset($mixedBlock['title']))
            $mixedBlock['title'] = _t('_bx_forum_page_block_title_entry_comments', $this->getCommentsCount());
        return $mixedBlock;
    }

    public function getComment($mixedCmt, $aBp = array(), $aDp = array())
    {
    	return parent::getComment($mixedCmt, $aBp, array_merge($aDp, array(
    		'class_comment' => ' bx-def-box bx-def-padding bx-def-round-corners bx-def-color-bg-box'
    	)));
    }

	protected function _getFormObject($sAction = BX_CMT_ACTION_POST)
    {
    	$CNF = &$this->_oModule->_oConfig->CNF;

    	$oResult = parent::_getFormObject($sAction);
    	if(!isset($oResult->aInputs['cmt_image']))
    		return $oResult;

		$oResult->aInputs['cmt_image']['storage_object'] = $CNF['OBJECT_STORAGE_CMTS']; 
		$oResult->aInputs['cmt_image']['images_transcoder'] = $CNF['OBJECT_IMAGES_TRANSCODER_PREVIEW_CMTS'];
		$oResult->aInputs['cmt_image']['upload_buttons_titles'] = array('Simple' => 'paperclip');

        return $oResult;
    }

    protected function _getForm($sAction, $iId)
    {
    	$oForm = parent::_getForm($sAction, $iId);

    	if(isset($oForm->aInputs['cmt_text'])) {
    		$oForm->aInputs['cmt_text']['html'] = 3;
    		$oForm->aInputs['cmt_text']['db']['pass'] = 'XssHtml';
    	}

    	return $oForm;
    }
}

/** @} */
