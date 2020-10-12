/**
 * Context list combobox
 */
mgrnotifications.combo.CustomerList = function(config) {
    config = config || {};
    Ext.applyIf(config, {
        name: 'Name'
		,hiddenName: 'Customer_id'
		,displayField: 'Name'
		,valueField: 'id'
		,fields: ['id', 'Name']
		,forceSelection: true
		,typeAhead: true
		,editable: true
		,allowBlank: false
		,autocomplete: true
		,url: mgrnotifications.config.connector_url
		,baseParams: {
            action: 'mgr/customer/getList'
			,combo: true
        }
    });

    mgrnotifications.combo.CustomerList.superclass.constructor.call(this, config);
};

Ext.extend(mgrnotifications.combo.CustomerList, MODx.combo.ComboBox);
Ext.reg('mgrnotifications-combo-customerlist', mgrnotifications.combo.CustomerList);