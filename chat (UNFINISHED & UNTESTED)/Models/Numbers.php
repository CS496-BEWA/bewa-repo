<?php
 
namespace Textmagic\Services\Models; 
 
class Numbers extends BaseModel {

    protected $resourceName = 'numbers';

    protected $allowMethods = array('getList', 'getAvailable', 'create', 'get', 'delete');
    
    public function getAvailable($params = array()) {
        $this->checkPermissions('getAvailable');
        
        return $this->client->retrieveData($this->resourceName . '/available', $params);
    }
    
}
