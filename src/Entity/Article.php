<?php

namespace App\src\Entity;

use App\src\Entity\Database;
use PDO;

class Article extends Database
{
    public $id = 0;
    public $title = '';
    public $content = '';
    public $img = 'http://via.placeholder.com/150';
    public $createdAt = '00/00/0000';
    public $state = false;


    public function __construct()
    {
        parent::__construct();
    }


    /**
     * methode permettant de recuperer la liste des articles
     */
    public function getArticleList()
    {
        $query = 'SELECT `id`,`title`,`content`, `img` , `state`,DATE_FORMAT(`created_at`,\'%e/%m/%Y\') AS `createdAt` FROM `pdo_article`';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * methode permettant de recuperer la liste des articles
     */
    public function getArticles()
    {
        $query = 'SELECT * FROM `pdo_article`';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * methode permettant d'afficher la liste des 5 premier article
     */
    public function getArticleListLimit5()
    {
        $query = 'SELECT `id`,`title`,`content`, `img` , `state`,DATE_FORMAT(`created_at`,\'%e/%m/%Y\') AS `createdAt` FROM `pdo_article` LIMIT 5';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }



    /**
     * methode permettant de recuperer les articles dont le statut est true
     */
    public function getArticleListStateTrue()
    {
        $query = 'SELECT `id`,`title`,`content`, `img` , `state`,DATE_FORMAT(`created_at`,\'%e/%m/%Y\') AS `createdAt` FROM `pdo_article` WHERE `state`=1';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * methode permettant de recuperer la liste des article dont le contenu commence par M et par ordre alphabetique ascendant
     */
    public function getArticleListContentByM()
    {
        $query = 'SELECT `id`,`title`,`content`, `img` , `state`,DATE_FORMAT(`created_at`,\'%e/%m/%Y\') AS `createdAt` FROM `pdo_article` WHERE `content` LIKE \'M%\' ORDER BY content ASC';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }


    /**
     * Methode qui permet de recuperer un articles par son id
     */
    public function getArticleById()
    {
        $requete = 'SELECT * FROM `pdo_article` WHERE `id`=:id ;';
        $find = $this->db->prepare($requete);
        $find->bindValue(':id', $this->id, PDO::PARAM_INT);
        if ($find->execute()) {
            return $find->fetch(PDO::FETCH_OBJ);
        }
    }

    /**
     *
     * retourn le nombre d'article en base de donnée
     */
    public function countArticles()
    {
        $query = 'SELECT COUNT(*) AS `nbArticles` FROM `pdo_article`;';
        $count = $this->db->query($query);
        return $count->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Method qui sert a inserer un article
     * @return requete INSERT
     */
    public function createArticle()
    {
        $insert = 'INSERT INTO `pdo_article` (`content`, `title`, `img`, `state`) VALUES (:content, :title, :img, :state);';
        $insertDb = $this->db->prepare($insert);
        $insertDb->bindValue(':content', $this->content, PDO::PARAM_STR);
        $insertDb->bindValue(':title', $this->title, PDO::PARAM_STR);
        $insertDb->bindValue(':img', $this->img, PDO::PARAM_STR);
        $insertDb->bindValue(':state', $this->state, PDO::PARAM_BOOL);
        return $insertDb->execute();
    }

    /**
     * Method  Qui permet de changer un article
     * @return bool
     */
    public function updateArticleById()
    {
        $query = 'UPDATE `pdo_article` SET `content`=:content , `img`=:img , `title`=:title , `state`=:state WHERE `id`=:id;';
        $findProfil = $this->db->prepare($query);
        $findProfil->bindValue(':title', $this->title, PDO::PARAM_STR);
        $findProfil->bindValue(':img', $this->img, PDO::PARAM_STR);
        $findProfil->bindValue(':content', $this->content, PDO::PARAM_STR);
        $findProfil->bindValue(':state', $this->state, PDO::PARAM_BOOL);
        $findProfil->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $findProfil->execute();
    }
    /**
     * Methode qui permet d'effacer un article
     */
    public function deleteArticleById()
    {
        $query = 'DELETE FROM `pdo_article` WHERE `id`=:id;';
        $article = $this->db->prepare($query);
        $article->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $article->execute();
    }
}
