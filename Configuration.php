<?php
include_once('helpers/MySqlDatabase.php');
include_once("helpers/MustacheRender.php");
include_once('helpers/Router.php');
include_once('helpers/Logger.php');

include_once('model/LoginModel.php');
include_once('model/PreguntaModel.php');
include_once('model/UsuarioModel.php');
include_once('model/HomeModel.php');
include_once('model/RankingModel.php');
include_once('model/EditorModel.php');
include_once('model/AdminModel.php');

include_once('controller/HomeController.php');
include_once('controller/LoginController.php');
include_once('controller/PreguntaController.php');
include_once('controller/UsuarioController.php');
include_once('controller/RankingController.php');
include_once('controller/EditorController.php');
include_once('controller/AdminController.php');


include_once('third-party/mustache/src/Mustache/Autoloader.php');
include_once('third-party/PHPMailer-master/src/PHPMailer.php');
include_once('third-party/PHPMailer-master/src/Exception.php');
include_once('third-party/PHPMailer-master/src/SMTP.php');

class Configuration {
    private $configFile = 'config/config.ini';

    public function __construct() {
    }

    public function getHomeController() {
        return new HomeController(
            new HomeModel($this->getDatabase()),
            $this->getRenderer());
    }
    public function getRankingController() {
        return new RankingController(
            new RankingModel($this->getDatabase()),
            $this->getRenderer());
    }

    public function getLoginController() {
        return new LoginController(
            new LoginModel($this->getDatabase()),
            $this->getRenderer());
    }

    public function getPreguntaController() {
        return new PreguntaController(
            new PreguntaModel($this->getDatabase()),
            $this->getRenderer());
    }
  
    public function getPartidaController() {
        return new PartidaController(
            new PartidaModel($this->getDatabase()),
            $this->getRenderer());
    }
  
    public function getUsuarioController() {
        return new UsuarioController(
            new UsuarioModel($this->getDatabase()),
            $this->getRenderer());
    }
    public function getEditorController() {
        return new EditorController(
            new EditorModel($this->getDatabase()),
            $this->getRenderer());
    }
    public function getAdminController() {
        return new AdminController(
            new AdminModel($this->getDatabase()),
            $this->getRenderer());
    }

    private function getArrayConfig() {
        return parse_ini_file($this->configFile);
    }

    private function getRenderer() {
        return new MustacheRender('view/partial');
    }

    public function getDatabase() {
        $config = $this->getArrayConfig();
        return new MySqlDatabase(
            $config['servername'],
            $config['username'],
            $config['password'],
            $config['database']);
    }

    public function getRouter() {
        return new Router(
            $this,
            "getHomeController",
            "show");
    }
    
}