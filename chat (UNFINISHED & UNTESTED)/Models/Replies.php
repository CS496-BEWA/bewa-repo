<?php
 
namespace Textmagic\Services\Models; 
 
class Replies extends BaseModel {

    protected $resourceName = 'replies';

    protected $allowMethods = array('getList', 'get', 'delete', 'search');

}
