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

bx_import('BxBaseModGeneralRequest');

class BxBaseModProfileRequest extends BxBaseModGeneralRequest
{
    function __construct()
    {
        parent::__construct();
    }
}

/** @} */
