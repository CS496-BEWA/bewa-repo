<?php
 
namespace Textmagic\Services\Models; 
 
class Templates extends BaseModel {

    protected $resourceName = 'templates';

    protected $allowMethods = array('getList', 'create', 'get', 'update', 'delete', 'search');

}
