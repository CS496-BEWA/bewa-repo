<?php
 
namespace Textmagic\Services\Models; 
 
class Sessions extends BaseModel {

    protected $resourceName = 'sessions';
    
    protected $allowMethods = array('getList', 'get', 'delete', 'getMessages');

    public function getMessages($id) {
        $this->checkPermissions('getMessages');
        
        return $this->client->retrieveData($this->resourceName . '/' . $id . '/messages');
    }
    
}
