<?php
 
namespace Textmagic\Services\Models; 
 
class Utils extends BaseModel {

    protected $allowMethods = array('ping');
    
    public function ping() {
        $this->checkPermissions('ping');
        
        return $this->client->retrieveData('ping');
    }    
    
}
