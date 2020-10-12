<?php

class mgrnotificationNotificationsCreateProcessor extends modObjectCreateProcessor
{
    public $classKey = 'notifications';
    public $languageTopics = array('mgrnotifications:default');
    public $defaultSortField = 'id';
    public $objectType = 'mgrnotifications.notifications';

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
     * Override in your derivative class to do functionality before save() is run
     *
     * @return boolean
     */
    public function beforeSave()
    {

        return parent::beforeSave();
    }

    /**
     * Override in your derivative class to do functionality after save() is run
     *
     * @return boolean
     */
    public function afterSave()
    {

        return true;
    }

}

return 'mgrnotificationNotificationsCreateProcessor';