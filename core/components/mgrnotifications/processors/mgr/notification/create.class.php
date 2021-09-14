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
        $object = $this->modx->getObject(
            $this->classKey,
            array(
                'Customer_id' => $this->getProperty('Customer_id'),
                'Published' => 1,
            )
        );
        if ($object){
            return $this->modx->lexicon('ntm.already_published_notification');
        }

        if (empty($this->getProperty('Expiry'))){
            $this->object->set('Expiry', null );
        }

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