<? defined('BX_DOL') or die('hack attempt');
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 * 
 * @defgroup    Developer Developer
 * @ingroup     DolphinModules
 *
 * @{
 */

bx_import('BxTemplStudioModule');

class BxDevStudioPage extends BxTemplStudioModule {
    protected $oModule;
    protected $sUrl;

    function BxDevStudioPage($sModule = "", $sPage = "") {
        parent::BxTemplStudioModule($sModule, $sPage);

        bx_import('BxDolModule');
        $this->oModule = BxDolModule::getInstance('bx_developer');

        $this->sUrl = BX_DOL_URL_STUDIO . 'module.php?name=%s&page=%s';
    }

    function getPageMenu($aMenu = array(), $aMarkers = array()) {
        $this->aMenuItems = array();
        foreach($this->oModule->aTools as $aTool)
            $this->aMenuItems[] = array(
                'name' => $aTool['name'],
                'icon' => 'bx-dev-mi-' . $aTool['name'] . '.png',
                'link' => sprintf($this->sUrl, $this->sModule, $aTool['name']),
                'title' => '',
                'selected' => $aTool['name'] == $this->sPage
            );

        bx_import('BxTemplStudioMenu');
        $oMenu = new BxTemplStudioMenu(array('template' => 'menu_main.html', 'menu_items' => $this->aMenuItems), $this->oModule->_oTemplate);
        return $oMenu->getCode();
    }

    function getPageCode($bHidden = false) {
        if(in_array($this->sPage, array('general')) || (int)$this->aModule['enabled'] == 0)
            $this->oModule->_oTemplate->addStudioInjection('injection_body_style', 'text', ' bx-dev-page-body-single');
        else
            $this->oModule->_oTemplate->addStudioInjection('injection_body_style', 'text', ' bx-dev-page-body-columns'); 

        return parent::getPageCode();
    }

    protected function getForms() {
        $sPage = bx_get('form_page');
        $sPage = $sPage !== false ? bx_process_input($sPage) : '';

        $oContent = new BxDevForms(array(
            'page' => $sPage,
            'url' => sprintf($this->sUrl, $this->sModule, BX_DEV_TOOLS_FORMS),
        ));
        return $this->oModule->_oTemplate->displayPageContent($oContent);
    }

    protected function getNavigation() {
        $sPage = bx_get('nav_page');
        $sPage = $sPage !== false ? bx_process_input($sPage) : '';

        $oContent = new BxDevNavigation(array(
            'page' => $sPage,
            'url' => sprintf($this->sUrl, $this->sModule, BX_DEV_TOOLS_NAVIGATION),
        ));
        return $this->oModule->_oTemplate->displayPageContent($oContent);
    }

    protected function getPages() {
        $sType = bx_get('bp_type');
        $sType = $sType !== false ? bx_process_input($sType) : '';

        $sPage = bx_get('bp_page');
        $sPage = $sPage !== false ? bx_process_input($sPage) : '';

        $oContent = new BxDevBuilderPage(array(
        	'type' => $sType,
            'page' => $sPage,
            'url' => sprintf($this->sUrl, $this->sModule, BX_DEV_TOOLS_PAGES),
        ));
        $oContent->init();
        return $this->oModule->_oTemplate->displayPageContent($oContent);
    }

    protected function getPermissions() {
        $sPage = bx_get('prm_page');
        $sPage = $sPage !== false ? bx_process_input($sPage) : '';

        $oContent = new BxDevPermissions(array(
            'page' => $sPage,
            'url' => sprintf($this->sUrl, $this->sModule, BX_DEV_TOOLS_PERMISSIONS),
        ));
        return $this->oModule->_oTemplate->displayPageContent($oContent);
    }
}

/** @} */
