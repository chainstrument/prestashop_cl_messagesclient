<?php 

class AdminClMessagesController extends ModuleAdminController
{



    public function __construct()
    {
        
        $this->bootstrap = true; //Gestion de l'affichage en mode bootstrap 
        $this->table = Message::$definition['table']; //Table de l'objet
        $this->identifier = Message::$definition['primary'] . 'cl_messages'; //Clé primaire de l'objet
        $this->className = Message::class; //Classe de l'objet
        $this->lang = true; //Flag pour dire si utilisation de langues ou non
 
        //Appel de la fonction parente pour pouvoir utiliser la traduction ensuite
        parent::__construct();
        
         //Liste des champs de l'objet à afficher dans la liste
         $this->fields_list = [
            'id' => [ //nom du champ sql
                'title' => $this->module->l('ID'), //Titre
                'align' => 'center', // Alignement
                'class' => 'fixed-width-xs' //classe css de l'élément
            ],
            'id_user' => [
                'title' => $this->module->l('name'),
                'align' => 'left',
            ], 
            'subject' => [
                'title' => $this->module->l('subject'),
                'lang' => true, //Flag pour dire d'utiliser la langue
                'align' => 'left',
            ],
            'message' => [
                'title' => $this->module->l('message'),
                'lang' => true, //Flag pour dire d'utiliser la langue
                'align' => 'left',
            ]
        ];
 
        //Ajout d'actions sur chaque ligne
        $this->addRowAction('edit');
        $this->addRowAction('delete');


    }
}