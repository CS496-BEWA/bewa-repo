<?php
 
namespace Textmagic\Services\Models; 
 
class CustomFields extends BaseModel {

    protected $resourceName = 'customfields';

    protected $allowMethods = array('getList', 'create', 'get', 'update', 'delete', 'updateContact');

    public function updateContact($id, $params = array()) {
        $this->checkPermissions('updateContact');
        
        return $this->client->updateData($this->resourceName . '/' . $id . '/update', $params);
    }
    
}
