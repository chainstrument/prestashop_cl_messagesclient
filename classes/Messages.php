<?php 

class Messages extends ObjectModel
{

    public $id; 
    public $id_user;
    public $subject;
    public $message;

    public static $definition = [
        'table' => 'cl_messages',
        'primary' => 'id',
        'multilang' => true,
        'fields' => [
            // Champs Standards
            'id_user' => ['type' => self::TYPE_INT, 'validate' => 'isInt', 'required' => true],
              //Champs langue
            'subject' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml', 'size' => 255,],
            'message' => ['type' => self::TYPE_HTML, 'lang' => true, 'validate' => 'isCleanHtml',],
        ],
    ];
}