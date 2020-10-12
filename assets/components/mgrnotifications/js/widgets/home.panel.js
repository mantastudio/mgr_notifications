/**
* JS file for mgrnotifications extra
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
* @package mgrnotifications
*/

/* These are for LexiconHelper:
 $modx->lexicon->load('mgrnotifications:default');
 include 'mgrnotifications.class.php'
 */

mgrnotifications.panel.Home = function(config) {
    config = config || {};
    Ext.apply(config,{
        border: false
        ,baseCls: 'modx-formpanel'
        ,items: [{
            html: '<h2>'+_('ntm.menu.title')+'</h2><p>'+_('ntm.menu.subtitle')+'</p>'
            ,border: false
            ,cls: 'modx-page-header'
        },{
            xtype: 'modx-tabs'
            ,bodyStyle: 'padding: 10px'
            ,defaults: { border: false ,autoHeight: true }
            ,border: true
            ,stateful: true
            ,stateId: 'mgrnotifications-home-tabpanel'
            ,stateEvents: ['tabchange']
            ,getState:function() {
                return {activeTab:this.items.indexOf(this.getActiveTab())};
            }
            ,items: [{
                title: _('ntm.notifications')
                ,defaults: { autoHeight: true }
                ,items: [{
                    html: '<p>'+'Manage notifications'+'</p>'
                    ,border: false
                    ,bodyStyle: 'padding: 10px'
                },{
                    xtype: 'mgrnotifications-grid-notification'
                    ,preventRender: true
                }]
            },{
                title: _('ntm.customers')
                ,defaults: { autoHeight: true }
                ,items: [{
                    html: '<p>'+'Manage customer records'+'</p>'
                    ,border: false
                    ,bodyStyle: 'padding: 10px'
                },{
                    xtype: 'mgrnotifications-grid-customer'
                    ,preventRender: true
                }]
            }]
        }]
    });
    mgrnotifications.panel.Home.superclass.constructor.call(this,config);
};
Ext.extend(mgrnotifications.panel.Home,MODx.Panel);
Ext.reg('mgrnotifications-panel-home',mgrnotifications.panel.Home);
        