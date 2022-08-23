<?php 

include_once __DIR__ . '/../../classes/Messages.php';

class AdminClMessagesController extends ModuleAdminController
{



    public function __construct()
    {
        
        $this->bootstrap = true; //Gestion de l'affichage en mode bootstrap 
        $this->table = Messages::$definition['table']; //Table de l'objet
        $this->identifier = Messages::$definition['primary']  ; //Clé primaire de l'objet
        $this->className = Messages::class; //Classe de l'objet
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

    /**
     * Affichage du formulaire d'ajout / création de l'objet
     * @return string
     * @throws SmartyException
     */
    public function renderForm()
    {
        //Définition du formulaire d'édition
        $this->fields_form = [
            //Entête
            'legend' => [
                'title' => $this->module->l('Add new Message'),
                'icon' => 'icon-cog'
            ],
            //Champs
            'input' => [
                [
                    'type' => 'text', //Type de champ
                    'label' => $this->module->l('subject'), //Label
                    'name' => 'name', //Nom
                    'class' => 'input fixed-width-sm', //classes css
                    'size' => 50, //longueur maximale du champ
                    'required' => true, //Requis ou non
                    'empty_message' => $this->l('Please fill the subject'), //Message d'erreur si vide
                    'hint' => $this->module->l('Enter subject name') //Indication complémentaires de saisie
                ],
                [
                    'type' => 'text',
                    'label' => $this->module->l('email'),
                    'name' => 'email',
                    'class' => 'input fixed-width-sm',
                    'size' => 5,
                    'required' => true,
                    'empty_message' => $this->module->l('Please fill email'),
                ],
                [
                    'type' => 'textarea',
                    'label' => $this->module->l('Message'),
                    'name' => 'description',
                    'lang' => true,
                    'autoload_rte' => true, //Flag pour éditeur Wysiwyg
                ],
            ],
            //Boutton de soumission
            'submit' => [
                'title' => $this->l('Save'), //On garde volontairement la traduction de l'admin par défaut
            ]
        ];
        return parent::renderForm();
    }

    /**
     * Gestion de la toolbar
     */
    public function initPageHeaderToolbar()
    {
 
        //Bouton d'ajout
        $this->page_header_toolbar_btn['new'] = array(
            'href' => self::$currentIndex . '&add' . $this->table . '&token=' . $this->token,
            'desc' => $this->module->l('Add new Sample'),
            'icon' => 'process-icon-new'
        );
 
        parent::initPageHeaderToolbar();
    }
}