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

mgrnotifications.grid.Notifications = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        url: mgrnotifications.config.connector_url
        , baseParams: {
           action: 'mgr/notification/getlist'
           ,thread: config.thread
        }
        , save_action: 'mgr/notification/updateFromGrid'
        , autosave: true
        , pageSize: 300
        , fields: [
            {name:'id', sortType: Ext.data.SortTypes.asInt}
            , {name: 'Customer_id', sortType: Ext.data.SortTypes.asUCString}
            , {name: 'Name', sortType: Ext.data.SortTypes.asUCString}
            , {name: 'Title', sortType: Ext.data.SortTypes.asUCString}
            , {name: 'Message', sortType: Ext.data.SortTypes.asUCString}
            , {name: 'Class', sortType: Ext.data.SortTypes.asUCString}
            , {name: 'Published', sortType: Ext.data.SortTypes.asUCString}
            , {name: 'Created', type: 'date', dateFormat: 'Y-m-d H:i:s', sortType: Ext.data.SortTypes.asDate}
            , {name: 'Expiry', type: 'date', dateFormat: 'Y-m-d H:i:s', sortType: Ext.data.SortTypes.asDate}
            , {name: 'Author', sortType: Ext.data.SortTypes.asUCString}
            , {name: 'First_delivery', type: 'date', dateFormat: 'Y-m-d H:i:s', sortType: Ext.data.SortTypes.asDate}
            , {name: 'Last_delivery', type: 'date', dateFormat: 'Y-m-d H:i:s', sortType: Ext.data.SortTypes.asDate}
         ]
        , paging: true
        , remoteSort: false
        , autoExpandColumn: 'description'
        , cls: 'mgrnotifications-grid'
        , columns: [{
            header: _('ntm.id')
            , dataIndex: 'id'
            , sortable: true
            , width: 50
            , hidden: true
        }, {
            header: _('ntm.customer')
            , dataIndex: 'Customer_id'
            , sortable: true
            , width: 100
            , renderer: this.renderResourceList.createDelegate(this,[this],true)
        }, {
           header: _('ntm.title')
           , dataIndex: 'Title'
           , sortable: true
           , width: 100
           , editor: { xtype: 'textfield', allowBlank: false }
        }, {
            header: _('ntm.message')
            , dataIndex: 'Message'
            , sortable: true
            , width: 100
            , editor: { xtype: 'textfield', allowBlank: false }
        }, {
            header: _('ntm.class')
            , dataIndex: 'Class'
            , sortable: true
            , width: 100
            , editor: { xtype: 'textfield', allowBlank: false }
            , hidden: true
        }, {
            header: _('ntm.published')
            , dataIndex: 'Published'
            , sortable: false
            , width: 30
            , renderer: this.renderYNfield.createDelegate(this,[this],true)
            , editor: { xtype: 'combo-boolean' }
        }, {
            header: _('ntm.created')
            , dataIndex: 'Created'
            , sortable: false
            , width: 50
            , renderer: Ext.util.Format.dateRenderer('d-m-Y')
            , hidden: true
        }, {
            header: _('ntm.expiry')
            , dataIndex: 'Expiry'
            , sortable: false
            , width: 50
            , renderer: Ext.util.Format.dateRenderer('d-m-Y')
            , editor: { xtype: 'datefield', allowBlank: false, format: 'd-m-Y' }
        }, {
            header: _('ntm.author')
            , dataIndex: 'Author'
            , sortable: false
            , hidden: true
            , width: 60
        }, {
            header: _('ntm.first_delivery')
            , dataIndex: 'First_delivery'
            , renderer: Ext.util.Format.dateRenderer('d-m-Y')
            , sortable: false
            , width: 40
        }, {
            header: _('ntm.last_delivery')
            , dataIndex: 'Last_delivery'
            , renderer: Ext.util.Format.dateRenderer('d-m-Y')
            , sortable: false
            , width: 40
        }]

        , tbar: [
            {
                text: _('ntm.create')
                ,cls: 'primary-button'
                ,handler: {
                    xtype: 'mgrnotifications-window-notification-createupdate'
                    ,blankValues: true
                    ,update: false
                }
            }
            , '->'
            , {
                xtype: 'mgrnotifications-combo-customerlist'
                ,name: 'customer'
                ,id: 'mgrnotifications-filter-customer'
                ,width: 150
                ,forceSelection: false
                ,allowBlank: true
                ,emptyText:"- Any -"
                ,listeners: {
                    'select': {fn:this.filterCustomer,scope:this},
                    'blur': {fn:this.filterCustomer,scope:this}
                }
            }
            , {
                xtype: 'textfield'
                ,id: 'mgrnotifications-search2-filter'
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
            }
        ]

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
    mgrnotifications.grid.Notifications.superclass.constructor.call(this, config)
};
Ext.extend(mgrnotifications.grid.Notifications, MODx.grid.Grid, {
    getMenu: function() {
        return [{
            text: _('ntm.update')
            , handler: this.updateNotificationGateway
        }, '-', {
            text: _('ntm.remove')
            , handler: this.removeNotificationGateway
        }];
    }

    , search: function(tf, nv, ov) {
        const s = this.getStore();
        s.baseParams.query = tf.getValue();
        this.getBottomToolbar().changePage(1);
        this.refresh();
    }

    , filterCustomer: function(cb,nv,ov) {
        const val = Ext.isEmpty(nv) || Ext.isObject(nv) ? cb.getValue() : nv;
        if (val === '') {
            this.getStore().clearFilter();
        } else {
            this.getStore().filter('Customer_id', val);
        }
    }

    , updateNotificationGateway: function(btn, e) {
        const w = MODx.load({
            xtype: 'mgrnotifications-window-notification-createupdate'
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

    , removeNotificationGateway: function(btn, e) {
        MODx.msg.confirm({
            title: _('ntm.remove', { title: this.menu.record.title })
            ,text: _('ntm.remove_confirm', { title: this.menu.record.title })
            ,url: this.config.url
            ,params: {
                action: 'mgr/notification/remove'
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
    , renderResourceList: function(v,md,rec,ri,ci,s,g) {
        if(v.length === 0) {
            return '<span style="color:#8A8A8A;"><i>'
                + _('ntm.startpage.default')
                + '</i></span>';
        }
        const r = s.getAt(ri).data;
        return r.Name
            + ' ('
            + _('ntm.startpage.id')
            + ': '
            + v
            + ')';
    }

});
Ext.reg('mgrnotifications-grid-notification', mgrnotifications.grid.Notifications);

// ------------------
// Create window

mgrnotifications.window.NotificationCreateUpdateGateway = function(config) {
    config = config || {};
    this.ident = config.ident || Ext.id();

    Ext.applyIf(config,{
        title: _('ntm.create')
        ,url: mgrnotifications.config.connector_url
        ,baseParams: {
            action: (config.update) ? 'mgr/notification/update' : 'mgr/notification/create'
        }
        ,modal: true
        ,width: 450
        ,autoHeight: true
        ,fields: [{
            xtype: 'hidden'
            ,name: 'id'
        },{
            xtype: 'mgrnotifications-combo-customerlist'
            , id: 'mgrnotifications-customerlist-' + this.ident
            , fieldLabel: _('ntm.customer')
            , name: 'Name'
            , anchor: '100%'
            , allowBlank: false
        },{
            xtype: 'label'
            , html: _('ntm.customer.description')
            , cls: 'desc-under'
        },{
            xtype: 'textfield'
            , fieldLabel: _('ntm.title')
            , name: 'Title'
            , anchor: '100%'
            , allowBlank: true
        },{
            xtype: 'label'
            , html: _('ntm.title.description')
            , cls: 'desc-under'
        },{
            xtype: 'radiogroup',
            fieldLabel: 'Use predefined message:',
            columns: 3,
            itemId: 'languageGroup',
            listeners: {
                'change': { fn: this.defaultMessage ,scope: this }
            },
            items: [
                {
                    xtype: 'radio',
                    boxLabel: '(none)',
                    name: 'language',
                    checked: true,
                    inputValue: ''
                },
                {
                    xtype: 'radio',
                    boxLabel: 'Dutch',
                    name: 'language',
                    inputValue: 'nl'
                },
                {
                    xtype: 'radio',
                    boxLabel: 'English',
                    name: 'language',
                    inputValue: 'en'
                }
            ]
        },{
            xtype: 'textarea'
            , id: 'mgrnotifications-message'
            , fieldLabel: _('ntm.message')
            , hideLabel: true
            , name: 'Message'
            , anchor: '100%'
            , allowBlank: false
        },{
            xtype: 'label'
            , html: _('ntm.message.description')
            , cls: 'desc-under'
        },{
            xtype: 'xcheckbox'
            , hideLabel: true
            , boxLabel: _('ntm.published')
            , name: 'Published'
        },{
            xtype: 'label'
            , html: _('ntm.published.description')
            , cls: 'desc-under'
        },{
            xtype: 'datefield'
            , fieldLabel: _('ntm.expiry')
            , format: 'd-m-Y'
            , renderer: Ext.util.Format.dateRenderer('d/m/Y')
            , name: 'Expiry'
        },{
            xtype: 'label'
            , html: _('ntm.expiry.description')
            , cls: 'desc-under'
        }]
    });
    mgrnotifications.window.NotificationCreateUpdateGateway.superclass.constructor.call(this,config);
};

Ext.extend(mgrnotifications.window.NotificationCreateUpdateGateway, MODx.Window, {
    onResourceList: function(cb) {
        var contextBox = Ext.getCmp('mgrnotifications-contextlist-' + this.ident);
        var s = cb.getStore();
        s.baseParams.cntx = contextBox.getValue();
        s.load();
    }
    ,onSelectContext: function(cb) {
        var resourcesBox = Ext.getCmp('mgrnotifications-resourcelist-' + this.ident);
        this.onResourceList(resourcesBox);
        resourcesBox.clearValue();
    }
    ,defaultMessage: function (cb){
        if (cb.getValue().inputValue == 'en') Ext.getCmp('mgrnotifications-message').setValue(mgrnotifications.config.default_message_en);
        if (cb.getValue().inputValue == 'nl') Ext.getCmp('mgrnotifications-message').setValue(mgrnotifications.config.default_message_nl);
        //if (cb.getValue().inputValue == '') Ext.getCmp('mgrnotifications-message').setValue('');
    }
});

Ext.reg('mgrnotifications-window-notification-createupdate', mgrnotifications.window.NotificationCreateUpdateGateway);
