<?php

require_once MODX_CORE_PATH.'model/modx/modprocessor.class.php';
require_once MODX_CORE_PATH.'model/modx/processors/resource/update.class.php';

class ShopmodxResourceUpdateProcessor extends modResourceUpdateProcessor{
    public $objectType = 'shopmodxresource';
    public $relatedObjectRequired = false;

    
    public function beforeSet() {
        //  set relative object data
        $fObjectData = array(
            'sm_name' => $this->getProperty('pagetitle'),
        );
        $this->setProperties($fObjectData);
        return parent::beforeSet();
    }
    
    public function beforeSave() {
        $cansave = $this->getRelatedObject();
        if($cansave != true){
            return $cansave;
        }
        return parent::beforeSave();
    }
    
    public function getRelatedObject(){
        if(!$this->relatedObjectRequired){
            return true;
        }
        if(!$fObject = $this->object->getObject()){
            return "Can not get related object";
        }
        $fObject->fromArray($this->getProperties());
        
        return true;
    }
    
}

return 'ShopmodxResourceUpdateProcessor';