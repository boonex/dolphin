<?php defined('BX_DOL') or die('hack attempt');
/**
 * Copyright (c) BoonEx Pty Limited - http://www.boonex.com/
 * CC-BY License - http://creativecommons.org/licenses/by/3.0/
 *
 * @defgroup    Events Events
 * @ingroup     TridentModules
 *
 * @{
 */

class BxEventsAlertsResponse extends BxBaseModGroupsAlertsResponse
{
    public function __construct()
    {
    	$this->MODULE = 'bx_events';
        parent::__construct();
    }
}

/** @} */
