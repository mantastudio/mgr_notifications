<?php
/**
 * Plugin1 plugin for mgrnotifications extra
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

/**
 * Description
 * -----------
 * [[+description]]
 *
 * Variables
 * ---------
 * @var $modx modX
 * @var $scriptProperties array
 *
 * @package mgrnotifications
 **/

$modx->regClientStartupHTMLBlock('
    <link rel="stylesheet" type="text/css" href="/assets/components/mgrnotifications/css/mgrnotifications.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
');
$modx->regClientStartupHTMLBlock('
<script>
    let mgrnotifications_URL= "/assets/components/mgrnotifications/connector.php?action=mgr%2fnotification%2fretrieve";
    window.onload = function(){
        const tag = document.createElement("script");
        tag.src = "/assets/components/mgrnotifications/js/notification.js";
        document.getElementsByTagName("body")[0].appendChild(tag);
    };
</script>
');