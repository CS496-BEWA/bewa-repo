<?php
 
namespace Textmagic\Services\Models; 
 
class Lists extends BaseModel {

    protected $resourceName = 'lists';

    protected $allowMethods = array('getList', 'create', 'get', 'update', 'delete', 'search', 'getContacts', 'updateContacts', 'deleteContacts');

    public function getContacts($id) {
        $this->checkPermissions('getContacts');
        
        return $this->client->retrieveData($this->resourceName . '/' . $id . '/contacts');
    }
    
    public function updateContacts($id, $params = array()) {
        $this->checkPermissions('updateContacts');
        
        return $this->client->updateData($this->resourceName . '/' . $id . '/contacts', $params);
    }
    
    public function deleteContacts($id, $params = array()) {
        $this->checkPermissions('deleteContacts');
        
        return $this->client->deleteData($this->resourceName . '/' . $id . '/contacts', $params);
    }
}
