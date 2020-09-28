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

mgr_notifications.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,items: [{
            html: '<h2>'+'mgr_notifications'+'</h2>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,bodyStyle: 'padding: 10px'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,stateful: true
            ,stateId: 'mgr_notifications-home-tabpanel'
            ,stateEvents: ['tabchange']
            ,getState:function() {
                return {activeTab:this.items.indexOf(this.getActiveTab())};
            }
            ,items: [{
                title: _('snippets')
                ,defaults: { autoHeight: true }
                ,items: [{
                    html: '<p>'+'Demo only . . . grid will change, but no real action is taken'+'</p>'
                    ,border: false
                    ,bodyStyle: 'padding: 10px'
                },{
                    xtype: 'mgr_notifications-grid-snippet'
                    ,preventRender: true
                }]
            },{
                title: _('chunks')
                ,defaults: { autoHeight: true }
                ,items: [{
                    html: '<p>'+'Demo only . . . grid will change, but no real action is taken'+'</p>'
                    ,border: false
                    ,bodyStyle: 'padding: 10px'
                },{
                    xtype: 'mgr_notifications-grid-chunk'
                    ,preventRender: true
                }]
            }]
        }]
    });
    mgr_notifications.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(mgr_notifications.panel.Home,MODx.Panel);
Ext.reg('mgr_notifications-panel-home',mgr_notifications.panel.Home);
        