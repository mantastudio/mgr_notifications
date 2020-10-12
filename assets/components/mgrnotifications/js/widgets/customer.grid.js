/**
 * JS file for mgrnotifications extra
 *
 * Copyright 2013 by Bob Ray <http://bobsguides.com>
 * Created on 04-13-2013
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

mgrnotifications.grid.Customers = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        url: mgrnotifications.config.connector_url
        , baseParams: {
           action: 'mgr/customer/getlist'
           ,thread: config.thread
        }
        , save_action: 'mgr/customer/updateFromGrid'
        , autosave: true
        , pageSize: 300
        , fields: [
            {name:'id', sortType: Ext.data.SortTypes.asInt}
            , {name: 'Name', sortType: Ext.data.SortTypes.asUCString}
            , {name: 'API_key', sortType: Ext.data.SortTypes.asUCString}
            , {name: 'Status', sortType: Ext.data.SortTypes.asInt}
         ]
        , paging: true
        , remoteSort: false
        , autoExpandColumn: 'Name'
        , cls: 'mgrnotifications-grid'
        , columns: [{
            header: _('ntm.id')
            , dataIndex: 'id'
            , sortable: true
            , width: 50
        }, {
            header: _('ntm.name')
            , dataIndex: 'Name'
            , sortable: true
            , width: 150
            , editor: { xtype: 'textfield', allowBlank: false }
        }, {
            header: _('ntm.api_key')
            , dataIndex: 'API_key'
            , sortable: true
            , width: 150
        }, {
            header: _('ntm.status')
            , dataIndex: 'Status'
            , sortable: false
            , width: 50
            , renderer: this.renderYNfield.createDelegate(this,[this],true)
            , editor: { xtype: 'combo-boolean' }
        }]

        , tbar: [{
            text: _('ntm.create')
            ,cls: 'primary-button'
            ,handler: {
                xtype: 'mgrnotifications-window-customer-createupdate'
                ,blankValues: true
                ,update: false
            }
        }
        , '->'
        , {
            xtype: 'textfield'
            ,id: 'mgrnotifications-search-filter'
            ,emptyText: _('ntm.search')
            ,listeners: {
                'change': { fn: this.search, scope: this }
                ,'render': {
                    fn: function(tf) {
                        tf.getEl().addKeyListener(Ext.EventObject.ENTER, function() {
                            this.search(tf);
                        }, this);
                    },
                    scope: this
                }
            }
        }]

        ,listeners: {
            'afterAutoSave': {
                fn: function(response) {
                    if(response.success) {
                        this.refresh();
                    }
                }
                ,scope: this
            }
        }

    });
    mgrnotifications.grid.Customers.superclass.constructor.call(this, config)
};
Ext.extend(mgrnotifications.grid.Customers, MODx.grid.Grid, {
    getMenu: function() {
        return [{
            text: _('ntm.update')
            , handler: this.updateCustomerGateway
        }, '-', {
            text: _('ntm.remove')
            , handler: this.removeCustomerGateway
        }];
    }

    , search: function(tf, nv, ov) {
        const s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }

    , updateCustomerGateway: function(btn, e) {
        const w = MODx.load({
            xtype: 'mgrnotifications-window-customer-createupdate'
            , record: this.menu.record
            , update: true
            , listeners: {
                'success': {fn: this.refresh, scope: this}
                , 'hide': {
                    fn: function () {
                        this.destroy();
                    }
                }
            }
        });
        w.setTitle(_('ntm.update'));
        w.setValues(this.menu.record);
        w.show(e.target, function() {
            Ext.isSafari ? w.setPosition(null,30) : w.center();
        }, this);
    }

    , removeCustomerGateway: function(btn, e) {
        MODx.msg.confirm({
            title: _('ntm.remove', { title: this.menu.record.title })
            ,text: _('ntm.remove_confirm', { title: this.menu.record.title })
            ,url: this.config.url
            ,params: {
                action: 'mgr/customer/remove'
                ,id: this.menu.record.id
            }
            ,listeners: {
                'success': { fn: this.refresh ,scope: this }
            }
        });
    }

    // SOME RENDERS
    , renderYNfield: function(v,md,rec,ri,ci,s,g) {
        var r = s.getAt(ri).data;
        v = Ext.util.Format.htmlEncode(v);
        var f = MODx.grid.Grid.prototype.rendYesNo;
        return f(v,md,rec,ri,ci,s,g);
    }
});
Ext.reg('mgrnotifications-grid-customer', mgrnotifications.grid.Customers);


// ------------------
// Create window

mgrnotifications.window.CustomerCreateUpdateGateway = function(config) {
    config = config || {};
    this.ident = config.ident || Ext.id();

    Ext.applyIf(config,{
        title: _('ntm.create')
        ,url: mgrnotifications.config.connector_url
        ,baseParams: {
            action: (config.update) ? 'mgr/customer/update' : 'mgr/customer/create'
        }
        ,modal: true
        ,width: 450
        ,autoHeight: true
        ,fields: [{
            xtype: 'hidden'
            ,name: 'id'
        },{
            xtype: 'textfield'
            ,fieldLabel: _('ntm.name')
            ,name: 'Name'
            ,anchor: '100%'
            ,allowBlank: false
        },{
            xtype: 'label'
            ,html: _('ntm.name')
            ,cls: 'desc-under'
        },{
            xtype: 'xcheckbox'
            ,hideLabel: true
            ,default: true
            ,boxLabel: _('ntm.status')
            ,name: 'Status'
        },{
            xtype: 'label'
            ,html: _('ntm.status.description')
            ,cls: 'desc-under'
        }]
    });
    mgrnotifications.window.CustomerCreateUpdateGateway.superclass.constructor.call(this,config);
};

Ext.extend(mgrnotifications.window.CustomerCreateUpdateGateway, MODx.Window, {});

Ext.reg('mgrnotifications-window-customer-createupdate', mgrnotifications.window.CustomerCreateUpdateGateway);