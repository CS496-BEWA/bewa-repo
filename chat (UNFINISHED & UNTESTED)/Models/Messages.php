<?php
 
namespace Textmagic\Services\Models; 
 
class Messages extends BaseModel {

    protected $resourceName = 'messages';

    protected $allowMethods = array('getList', 'create', 'get', 'delete', 'search', 'getPrice');

    public function getPrice($params) {
        $this->checkPermissions('getPrice');
        
        return $this->client->retrieveData($this->resourceName . '/price', $params);
    }
    
}
