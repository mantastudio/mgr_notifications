/**
* JS file for mgr_notifications extra
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
* @package mgr_notifications
*/
        
/* These are for LexiconHelper:
   $modx->lexicon->load('mgr_notifications:default');
   include 'mgr_notifications.class.php'
 */
var mgr_notifications = function (config) {
    config = config || {};
    mgr_notifications.superclass.constructor.call(this, config);
};
Ext.extend(mgr_notifications, Ext.Component, {
    page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}
});
Ext.reg('mgr_notifications', mgr_notifications);

var mgr_notifications = new mgr_notifications();