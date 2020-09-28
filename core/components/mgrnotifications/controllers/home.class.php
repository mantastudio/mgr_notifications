<?php
/**
 * Controller file for mgrnotifications extra
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
 * @subpackage controllers
 */
/* @var $modx modX */

class mgrnotificationsHomeManagerController extends mgrnotificationsManagerController {
    /**
     * The pagetitle to put in the <title> attribute.
     *
     * @return null|string
     */
    public function getPageTitle() {
        return $this->modx->lexicon('mgrnotifications');
    }

    /**
     * Register all the needed javascript files.
     */


    public function loadCustomCssJs() {
        $this->addJavascript($this->mgrnotifications->config['jsUrl'] . 'widgets/chunk.grid.js');
        $this->addJavascript($this->mgrnotifications->config['jsUrl'] . 'widgets/snippet.grid.js');
        $this->addJavascript($this->mgrnotifications->config['jsUrl'] . 'widgets/home.panel.js');
        $this->addLastJavascript($this->mgrnotifications->config['jsUrl'] . 'sections/home.js');

        $this->addCss($this->mgrnotifications->config['cssUrl'] . 'mgr.css');


    }
}