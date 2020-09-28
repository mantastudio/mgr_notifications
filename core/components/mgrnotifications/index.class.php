<?php
/**
* Action file for mgrnotifications extra
*
* Copyright 2020 by Sinisa Vrhovac https://github.com/mantastudio/
* Created on 28-09-2020
*
 * mgrnotifications is free software; you can redistribute it and/or modify it under the
 * terms of the GNU General Public License as published by the Free Software
 * Foundation; either version 2 of the License, or (at your option) any later
 * version.
 *
 * mgrnotifications is distributed in the hope that it will be useful, but WITHOUT ANY
 * WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR
 * A PARTICULAR PURPOSE. See the GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along with
 * mgrnotifications; if not, write to the Free Software Foundation, Inc., 59 Temple
 * Place, Suite 330, Boston, MA 02111-1307 USA
*
* @package mgrnotifications
*/


abstract class mgrnotificationsManagerController extends modExtraManagerController {
    /** @var mgrnotifications $mgrnotifications */
    public $mgrnotifications = NULL;

    /**
     * Initializes the main manager controller.
     */
    public function initialize() {
        /* Instantiate the mgrnotifications class in the controller */
        $path = $this->modx->getOption('mgrnotifications.core_path',
                NULL, $this->modx->getOption('core_path') .
                'components/mgrnotifications/') . 'model/mgrnotifications/';
        require_once $path . 'mgrnotifications.class.php';
        $this->mgrnotifications = new mgrnotifications($this->modx);

        /* Optional alternative  - install PHP class as a service */

        /* $this->mgrnotifications = $this->modx->getService('mgrnotifications',
             'mgrnotifications', $path);*/

        /* Add the main javascript class and our configuration */
        $this->addJavascript($this->mgrnotifications->config['jsUrl'] .
            'mgrnotifications.class.js');
        $this->addHtml('<script type="text/javascript">
        Ext.onReady(function() {
            mgrnotifications.config = ' . $this->modx->toJSON($this->mgrnotifications->config) . ';
        });
        </script>');
    }

    /**
     * Defines the lexicon topics to load in our controller.
     *
     * @return array
     */
    public function getLanguageTopics() {
        return array('mgrnotifications:default');
    }

    /**
     * We can use this to check if the user has permission to see this
     * controller. We'll apply this in the admin section.
     *
     * @return bool
     */
    public function checkPermissions() {
        return true;
    }

    /**
     * The name for the template file to load.
     *
     * @return string
     */
    public function getTemplateFile() {
        return dirname(__FILE__) . '/templates/mgr.tpl';
        // return $this->mgrnotifications->config['templatesPath'] . 'mgr.tpl';
    }
}

/**
 * The Index Manager Controller is the default one that gets called when no
 * action is present.
 */
class IndexManagerController extends mgrnotificationsManagerController {
    /**
     * Defines the name or path to the default controller to load.
     *
     * @return string
     */
    public static function getDefaultController() {
        return 'home';
    }
}
