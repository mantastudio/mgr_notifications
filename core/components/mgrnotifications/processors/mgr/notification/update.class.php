<?php

class mgrnotificationsNotificationUpdateProcessor extends modObjectUpdateProcessor
{
    public $classKey = 'notifications';
    public $languageTopics = array('mgrnotifications:default');
    public $defaultSortField = 'id';
    public $objectType = 'mgrnotifications.customer';

    /**
     * Override in your derivative class to do functionality before the fields are set on the object
     *
     * @return boolean
     */
    public function beforeSet()
    {

        return parent::beforeSet();
    }

    /**
     * Override in your derivative class to do functionality after save() is run
     *
     * @return boolean
     */
    public function beforeSave()
    {
        if (empty($this->getProperty('Expiry'))){
            $this->object->set('Expiry', null );
        }

        return parent::beforeSave();
    }

}

return 'mgrnotificationsNotificationUpdateProcessor';