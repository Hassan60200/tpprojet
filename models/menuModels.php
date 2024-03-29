<?php

class Menu {

    private $id;
    private $title;
    private $price;
    private $type;
    private $db;

//Connexion à ma BDD
    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=Escale', 'DERKAOUI', 'sharigan60', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        } catch (Exception $ex) {
            die($ex->getMessage());
        }
    }

    // fonctions permettant d'afficher les infos de l'utilisateur
    public function getId() {
        return $this->id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getType() {
        return $this->type;
    }

    public function getPrice() {
        return $this->price;
    }

    //création d'un nouveau menu
    public function createMenu($title, $type, $price) {
        $query = $this->db->prepare('INSERT INTO Menu (title, id_types, price) VALUE (:title, :type, :price)');
        // Lier les variables à l'instruction 'prepare' en tant que valeurs
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':type', $type, PDO::PARAM_INT);
        $query->bindValue(':price', $price, PDO::PARAM_INT);
        //execution de la requete
        return $query->execute();
    }

    //fonction affichage des menus
    public function getAllMenu() {
      //si le champt search est saisi et n'est pas vide alors
        if(isset($_POST['search']) && !empty($_POST['search'])){
          //le champ saise sera afficher dans la barre de recherche
          $search = htmlspecialchars($_POST['search']);
        }else {
          //sinon rien ne sera afficher sur la barre de recherche
          $search = '';
        }
        $sql = 'SELECT Menu.*, `types`.`name` as `type` FROM `Menu` INNER JOIN `types` ON `Menu`.`id_types` = `types`.`id` WHERE `Menu`.`title` LIKE :search OR `types`.`name` LIKE :search' ;
        $menu = $this->db->prepare($sql);
        $menu->bindValue(':search', '%'.$search.'%');
        $menu->execute();
        return $menu->fetchAll(PDO::FETCH_OBJ);
    }

//fonction affichage du menu dans la page updatemenu.php
    public function getMenu($id){
        $sql = 'SELECT Menu.*, `types`.`name` as `type` FROM `Menu` INNER JOIN `types` ON `Menu`.`id_types` = `types`.`id` WHERE Menu.id = :id ';
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //fonction suppression du menu
    public function deleteMenu($id) {
        // On prépare une requête de suppression
        $sql = 'DELETE FROM Menu WHERE id = :id';
        if ($stmt = $this->db->prepare($sql)) {
            // On lie notre variable eventID à notre requête préparée
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            // On tente d'exécuter la requête préparée
            if ($stmt->execute()) {
                // Si la suppression des données s'est bien passée, on redirige vers la page landing.
            }
        }
    }

// fonction de modification
    public function editMenu($id, $title, $price, $id_types) {
        //preparation de la requete
        $query = $this->db->prepare("UPDATE `Menu` SET title = :title, price = :price, id_types = :types WHERE id = :id;");
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':title', $title, PDO::PARAM_STR);
        $query->bindValue(':price', $price, PDO::PARAM_INT);
        $query->bindValue(':types', $id_types, PDO::PARAM_INT);
        //execution de la requete
        $query->execute();
    }
}
