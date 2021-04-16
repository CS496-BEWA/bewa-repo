<?php

namespace Textmagic\Services\Models; 

class Contacts extends BaseModel {

    protected $resourceName = 'contacts';

    protected $allowMethods = array('getList', 'create', 'get', 'update', 'delete', 'search', 'getLists');

    public function getLists($id) {
        $this->checkPermissions('getLists');
        
        return $this->client->retrieveData($this->resourceName . '/' . $id . '/lists');
    }
    
}
