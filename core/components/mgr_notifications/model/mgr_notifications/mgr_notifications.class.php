<?php
/**
 * CMP class file for mgr_notifications extra
 *
 * Copyright 2020 by Sinisa Vrhovac https://github.com/mantastudio/
 * Created on 28-09-2020
 *
 * mgr_notifications is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * mgr_notifications is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * mgr_notifications; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
 *
 * @package mgr_notifications
 */


 class mgr_notifications {
    /** @var $modx modX */
    public $modx;
    /** @var $props array */
    public $config;

    function __construct(modX &$modx,array $config = array()) {
        $this->modx =& $modx;
        $corePath = $modx->getOption('mgr_notifications.core_path',null,
            $modx->getOption('core_path').'components/mgr_notifications/');
        $assetsUrl = $modx->getOption('mgr_notifications.assets_url',null,
            $modx->getOption('assets_url').'components/mgr_notifications/');

        $this->config = array_merge(array(
            'corePath' => $corePath,
            'chunksPath' => $corePath.'elements/chunks/',
            'modelPath' => $corePath.'model/',
            'processorsPath' => $corePath.'processors/',
            'templatesPath' => $corePath . 'templates/',

            'assetsUrl' => $assetsUrl,
            'connector_url' => $assetsUrl.'connector.php',
            'cssUrl' => $assetsUrl.'css/',
            'jsUrl' => $assetsUrl.'js/',
        ),$config);

        $this->modx->addPackage('mgr_notifications',$this->config['modelPath']);
        if ($this->modx->lexicon) {
            $this->modx->lexicon->load('mgr_notifications:default');
        }
    }

    /**
     * Initializes mgr_notifications based on a specific context.
     *
     * @access public
     * @param string $ctx The context to initialize in.
     * @return string The processed content.
     */
    public function initialize($ctx = 'mgr') {
        $output = '';
        switch ($ctx) {
            case 'mgr':
                if (!$this->modx->loadClass('mgr_notifications.request.mgr_notificationsControllerRequest',
                    $this->config['modelPath'],true,true)) {
                        return 'Could not load controller request handler.';
                }
                $this->request = new mgr_notificationsControllerRequest($this);
                $output = $this->request->handleRequest();
                break;
        }
        return $output;
    }
}