<?php
 
namespace Textmagic\Services\Models; 
 
class User extends BaseModel {

    protected $resourceName = 'user';

    protected $allowMethods = array('get', 'update');

    public function get() {
        $this->checkPermissions('get');
        
        return $this->client->retrieveData($this->resourceName);
    }
    
    public function update($params = array()) {
        $this->checkPermissions('update');
        
        return $this->client->updateData($this->resourceName, $params);
    }
    
}
