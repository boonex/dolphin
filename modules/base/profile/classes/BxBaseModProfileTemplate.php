<?php defined('BX_DOL') or die('hack attempt');
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 *
 * @defgroup    BaseProfile Base classes for profile modules
 * @ingroup     TridentModules
 *
 * @{
 */

/*
 * Profile based modules representation.
 */
class BxBaseModProfileTemplate extends BxBaseModGeneralTemplate
{
    function __construct(&$oConfig, &$oDb)
    {
        parent::__construct($oConfig, $oDb);
    }

    /**
     * Get profile unit
     */
    function unit ($aData, $isCheckPrivateContent = true, $sTemplateName = 'unit.html')
    {
        // TODO: add privacy checking here

        $aVars = $this->unitVars ($aData, $isCheckPrivateContent, $sTemplateName);

        return $this->parseHtmlByName($sTemplateName, $aVars);
    }

    function unitVars ($aData, $isCheckPrivateContent = true, $sTemplateName = 'unit.html')
    {
        $CNF = &$this->_oConfig->CNF;

        // get profile's url
        $sUrl = BX_DOL_URL_ROOT . BxDolPermalinks::getInstance()->permalink('page.php?i=' . $CNF['URI_VIEW_ENTRY'] . '&id=' . $aData[$CNF['FIELD_ID']]);

        // generate html
        return array (
            'id' => $aData[$CNF['FIELD_ID']],
            'thumb_url' => $this->thumb ($aData),
            'content_url' => $sUrl,
            'title' => bx_process_output($aData[$CNF['FIELD_NAME']]),
            'module_name' => _t($CNF['T']['txt_sample_single']),
            'ts' => $aData[$CNF['FIELD_ADDED']],
        );
    }

    /**
     * Get profile cover
     */
    function setCover ($aData, $sTemplateName = 'cover.html')
    {
        $CNF = &$this->_oConfig->CNF;

        if (CHECK_ACTION_RESULT_ALLOWED !== $this->getModule()->checkAllowedViewProfileImage($aData)) {
            $CNF = &$this->_oConfig->CNF;
            $aData[$CNF['FIELD_PICTURE']] = 0;
        }
        
        if (CHECK_ACTION_RESULT_ALLOWED !== $this->getModule()->checkAllowedViewCoverImage($aData)) {
            $CNF = &$this->_oConfig->CNF;
            $aData[$CNF['FIELD_COVER']] = 0;
        }
        
        $sUrl = BX_DOL_URL_ROOT . BxDolPermalinks::getInstance()->permalink('page.php?i=' . $CNF['URI_VIEW_ENTRY'] . '&id=' . $aData[$CNF['FIELD_ID']]);

        $sUrlPicture = $this->urlPicture ($aData);
        $sUrlAvatar = $this->urlAvatar ($aData);
        $sUrlPictureChange = BX_DOL_URL_ROOT . BxDolPermalinks::getInstance()->permalink('page.php?i=' . $CNF['URI_EDIT_ENTRY'] . '&id=' . $aData[$CNF['FIELD_ID']]);

        $sUrlCover = $this->urlCover ($aData);
        $sUrlCoverChange = BX_DOL_URL_ROOT . BxDolPermalinks::getInstance()->permalink('page.php?i=' . $CNF['URI_EDIT_COVER'] . '&id=' . $aData[$CNF['FIELD_ID']]);

        $sCoverPopup = '';
        $sCoverPopupId = $this->MODULE . '-popup-cover';
        if ($aData[$CNF['FIELD_COVER']]) {
            $sCoverPopup = BxTemplFunctions::getInstance()->transBox($sCoverPopupId, $this->parseHtmlByName('image_popup.html', array (
                'image_url' => $sUrlCover,
                'bx_if:owner' => array (
                    'condition' => CHECK_ACTION_RESULT_ALLOWED === $this->getModule()->checkAllowedChangeCover($aData),
                    'content' => array (
                        'change_image_url' => $sUrlCoverChange,
                    ),
                ),
            )), true, true);
        }

        $sPicturePopup = '';
        $sPicturePopupId = $this->MODULE . '-popup-picture';
        if ($aData[$CNF['FIELD_PICTURE']]) {
            $sPicturePopup = BxTemplFunctions::getInstance()->transBox($sPicturePopupId, $this->parseHtmlByName('image_popup.html', array (
                'image_url' => $sUrlPicture,
                'bx_if:owner' => array (
                    'condition' => CHECK_ACTION_RESULT_ALLOWED === $this->getModule()->checkAllowedEdit($aData),
                    'content' => array (
                        'change_image_url' => $sUrlPictureChange,
                    ),
                ),
            )), true, true);
        }

        $oMenu = BxTemplMenu::getObjectInstance($this->_oConfig->CNF['OBJECT_MENU_ACTIONS_VIEW_ENTRY']);

        // generate html
        $aVars = array (
            'id' => $aData[$CNF['FIELD_ID']],
            'content_url' => $sUrl,
            'title' => bx_process_output($aData[$CNF['FIELD_NAME']]),
            //'menu' => BxDolMenu::getObjectInstance($CNF['OBJECT_MENU_SUBMENU_VIEW_ENTRY_COVER'])->getCode(), // TODO: check if menu is used somewhere

            'action_menu' => $oMenu ? $oMenu->getCode() : '',

            'picture_avatar_url' => $sUrlAvatar,
            'picture_popup' => $sPicturePopup,
            'picture_popup_id' => $sPicturePopupId,
            'picture_url' => $sUrlPicture,
            'picture_href' => !$aData[$CNF['FIELD_PICTURE']] && CHECK_ACTION_RESULT_ALLOWED === $this->getModule()->checkAllowedEdit($aData) ? $sUrlPictureChange : 'javascript:void(0);',

            'cover_popup' => $sCoverPopup,
            'cover_popup_id' => $sCoverPopupId,
            'cover_url' => $sUrlCover,
            'cover_href' => !$aData[$CNF['FIELD_COVER']] && CHECK_ACTION_RESULT_ALLOWED === $this->getModule()->checkAllowedChangeCover($aData) ? $sUrlCoverChange : 'javascript:void(0);',
        );

        BxDolCover::getInstance($this)->set($aVars, $sTemplateName);
    }

    /**
     * Get profile picture thumb url
     */
    function thumb ($aData, $bSubstituteNoImage = true)
    {
        $CNF = &$this->_oConfig->CNF;
        return $this->_image ($CNF['FIELD_PICTURE'], $CNF['OBJECT_IMAGES_TRANSCODER_THUMB'], 'no-picture-thumb.png', $aData, $bSubstituteNoImage);
    }

    /**
     * Get profile picture icon url
     */
    function icon ($aData, $bSubstituteNoImage = true)
    {
        $CNF = &$this->_oConfig->CNF;
        return $this->_image ($CNF['FIELD_PICTURE'], $CNF['OBJECT_IMAGES_TRANSCODER_ICON'], 'no-picture-icon.png', $aData, $bSubstituteNoImage);
    }

    /**
     * Get profile avatar url
     */
    function urlAvatar ($aData, $bSubstituteNoImage = true)
    {
        $CNF = &$this->_oConfig->CNF;
        return $this->_image ($CNF['FIELD_PICTURE'], $CNF['OBJECT_IMAGES_TRANSCODER_AVATAR'], 'no-picture-preview.png', $aData, $bSubstituteNoImage);
    }

    /**
     * Get profile picture url
     */
    function urlPicture ($aData, $bSubstituteNoImage = true)
    {
        $CNF = &$this->_oConfig->CNF;
        return $this->_image ($CNF['FIELD_PICTURE'], $CNF['OBJECT_IMAGES_TRANSCODER_PICTURE'], 'no-picture-preview.png', $aData, $bSubstituteNoImage);
    }

    /**
     * Get profile cover image url
     */
    function urlCover ($aData, $bSubstituteNoImage = true)
    {
        $CNF = &$this->_oConfig->CNF;
        return $this->_image ($CNF['FIELD_COVER'], $CNF['OBJECT_IMAGES_TRANSCODER_COVER'], 'cover.jpg', $aData, $bSubstituteNoImage);
    }

    /**
     * Get profile picture icon url
     */
    function _image ($sField, $sTranscodeObject, $sNoImage, $aData, $bSubstituteNoImage = true)
    {
        $sImageUrl = false;
        if ($aData[$sField]) {
            $oImagesTranscoder = BxDolTranscoderImage::getObjectInstance($sTranscodeObject);
            if ($oImagesTranscoder)
                $sImageUrl = $oImagesTranscoder->getFileUrl($aData[$sField]);
        }
        return $bSubstituteNoImage && !$sImageUrl ? $this->getImageUrl($sNoImage) : $sImageUrl;
    }
}

/** @} */
