<?php
 
namespace Textmagic\Services\Models; 
 
class Stats extends BaseModel {

    protected $resourceName = 'stats';

    protected $allowMethods = array('spending', 'messaging');

    public function spending($params = array()) {
        $this->checkPermissions('spending');
        
        return $this->client->retrieveData($this->resourceName . '/spending', $params);
    }
    
    public function messaging($params = array()) {
        $this->checkPermissions('messaging');
        
        return $this->client->retrieveData($this->resourceName . '/messaging', $params);
    }
    
}
