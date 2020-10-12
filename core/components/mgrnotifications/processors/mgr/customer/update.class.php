<?php

class mgrnotificationsCustomerUpdateProcessor extends modObjectUpdateProcessor
{
    public $classKey = 'customers';
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
        if ($this->getProperty('Status')) {
            $this->setProperty('Status', 1);
        } else {
            $this->setProperty('Status', 0);
        }
        return parent::beforeSet();
    }

    /**
     * Override in your derivative class to do functionality after save() is run
     *
     * @return boolean
     */
    public function beforeSave()
    {

        return parent::beforeSave();
    }

}

return 'mgrnotificationsCustomerUpdateProcessor';