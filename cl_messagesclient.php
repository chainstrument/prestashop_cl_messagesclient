<?php 

if(!defined('_PS_VERSION_'))
{
    exit;
}

include_once __DIR__ . '/classes/Messages.php';


class Cl_MessagesClient extends Module{




    public function __construct()
    {

        $this->name = 'cl_messagesclient';
        $this->author = 'cl';
        $this->tab = 'front_office_features';
        $this->version = '1.0';
        $this->bootstrap = true;

        parent::__construct();

        $this->displayName = $this->trans('Message client', [], 'Modules.Cl_messagesclient.Admin');
        $this->description = $this->trans(
            'Liste des message de clients',
            [],
            'Modules.CL_messageclient.Admin'
        );
        $this->ps_versions_compliancy = [
            'min' => '1.7.2.0',
            'max' => _PS_VERSION_
        ];


        parent::__construct();

      
    }

    public function install()
    {
       return parent::install() && $this->_installSql() && $this->_installTab();
    }


    public function uninstall()
    {
        return parent::uninstall() && $this->_uninstallSql() && $this->_uninstallTab();
    }

    public function getContent()
    {
        return 'haha';
    }


    /**
     * Création de la base de donnée
     * @return boolean
     */
    protected function _installSql()
    {
        $sqlCreate = "CREATE TABLE `" . _DB_PREFIX_ . Messages::$definition['table'] . "` (
                `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
                `id_user` int(11) unsigned,
                `subject` varchar(255) DEFAULT NULL,
                `message` varchar(255) DEFAULT NULL,
                `date_add` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                `date_upd` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (`id`)
                ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
 
        $sqlCreateLang = "CREATE TABLE `" . _DB_PREFIX_ . Messages::$definition['table'] . "_lang` (
              `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
              `id_lang` int(11) NOT NULL,
              `subject` varchar(255) DEFAULT NULL,
              `message` text,
              PRIMARY KEY (`id`,`id_lang`)
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1;";
 
        return Db::getInstance()->execute($sqlCreate) && Db::getInstance()->execute($sqlCreateLang);
    }
 
    /**
     * Installation du controller dans le backoffice
     * @return boolean
     */
    protected function _installTab()
    {
        $tab = new Tab();
        $tab->class_name = 'AdminClMessages';
        $tab->module = $this->name;
        $tab->id_parent = (int)Tab::getIdFromClassName('DEFAULT');
        $tab->icon = 'settings_applications';
        $languages = Language::getLanguages();
        foreach ($languages as $lang) {
            $tab->name[$lang['id_lang']] = $this->l('CL Messages Admin controller');
        }
        try {
            $tab->save();
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
 
        return true;
    }
 
    /**
     * Désinstallation du controller admin
     * @return boolean
     */
    protected function _uninstallTab()
    {
        $idTab = (int)Tab::getIdFromClassName('AdminClMessages');
        if ($idTab) {
            $tab = new Tab($idTab);
            try {
                $tab->delete();
            } catch (Exception $e) {
                echo $e->getMessage();
                return false;
            }
        }
        return true;
    }
 
    /**
     * Suppression de la base de données
     */
    protected function _uninstallSql()
    {
        $sql = "DROP TABLE ". _DB_PREFIX_ .Messages::$definition['table'].",". _DB_PREFIX_ .Messages::$definition['table']."_lang";
        return Db::getInstance()->execute($sql);
    }
}