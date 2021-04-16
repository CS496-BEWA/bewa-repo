<?php
 
namespace Textmagic\Services\Models; 
 
class Chats extends BaseModel {

    protected $resourceName = 'chats';

    protected $allowMethods = array('getList', 'get');

}
