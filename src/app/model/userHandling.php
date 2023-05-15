<?php

require_once("../config/functions.php");

class user{
    protected $post;
    protected $emailUser,$numeroUser,$dateInscription,$password,$typeUser,
    $pays,$ville,$adresse;
    function __construct(array $post){
        $this->post=$post;
        $this->setUser(); 
    }
    public function setUser(){ 
        $this->emailUser=$this->post["email"];    
        $this->numeroUser=$this->post["numero"];
        $this->password=$this->post["password"];
        $this->pays=$this->post["pays"];
        $this->ville=$this->post["ville"];
        $this->adresse=$this->post["adresse"];
        $this->typeUser=$this->post["typeUser"];
 
    }
    protected function sendError($err){
        return $err;
    }
    
   protected function prepareUser():int{
        $db=use_db(true);
        $requet="CALL CREATE_USER(?,?,?,?,?,?,?,@id)";
        $objet=$db->prepare($requet);
        $this->password=password_hash($this->password,PASSWORD_BCRYPT);
        $objet->bindValue(1,$this->emailUser,PDO::PARAM_STR);
        $objet->bindValue(2,$this->numeroUser,PDO::PARAM_STR);
        $objet->bindValue(3,$this->password,PDO::PARAM_STR);
        $objet->bindValue(4,$this->pays,PDO::PARAM_STR);
        $objet->bindValue(5,$this->ville,PDO::PARAM_STR);
        $objet->bindValue(6,$this->adresse,PDO::PARAM_STR);
        $objet->bindValue(7,$this->typeUser,PDO::PARAM_STR);


        $objet->execute();
        $last_id = $db->query("SELECT @id as id")->fetch(PDO::FETCH_ASSOC)["id"];
        $db=use_db(false);
        return $last_id;
    }
    static public function getUser($email){
        $requet="SELECT idUser,typeUser,password from user where emailUser=?";
        $db=use_db(true);
        $objet=$db->prepare($requet);
        $objet->bindValue(1,$email,PDO::PARAM_STR);
        $objet->execute();
        $retour=$objet->fetch(PDO::FETCH_ASSOC);
        $db=use_db(false);
        if(empty($retour))
            $retour=null;
        return $retour;        
    }
    
   
}

class particulier extends user{
    protected $nomParticul,$prenomParticul,$dateNaissance,$CNI,$isConfirmed,$extension;

    function __construct(array $post)
    {
        parent::__construct($post);
        $this->nomParticul=$post["nom"];
        $this->prenomParticul=$post["prenom"];
        // $this->dateNaissance=$post["dateNaissance"];
       
    }
    
    public function createParticulier(){
        $id=parent::prepareUser();
        $this->CNI["name"]=$this->nomParticul.$this->prenomParticul.$id."-CNI".".".$this->extension;
        $dir="../../../FTP-server/user_files/information/".$this->CNI["name"];
        move_uploaded_file($this->CNI["tmp_name"],$dir);

        $requet="CALL CREATE_PARTICULIER(?,?,?,?,?)";
        $db=use_db(true);
        $objet=$db->prepare($requet);
        
        $objet->bindValue(1, $id, PDO::PARAM_INT);
        $objet->bindValue(2, $this->nomParticul, PDO::PARAM_STR);
        $objet->bindValue(3, $this->prenomParticul, PDO::PARAM_STR);
        $objet->bindValue(4, $this->dateNaissance, PDO::PARAM_STR);
        $objet->bindValue(5, $dir, PDO::PARAM_STR);

        $objet->execute(); 
        $db=use_db(false);

    }
    static public function getSpecific($id){
        /*getSpecific permet d'obtenir des informations sur un utilisateurs. 
        Cette version concerne les particulier*/ 
        $requet="SELECT emailUser,numeroUser,pays,ville,adresse,logo,nomParticul,prenomParticul,isConfirmed FROM user as u inner join particulier as p on p.idUser=u.idUser where p.idUser=".$id;
        $db=use_db(true);
        $objet=$db->query($requet);
        $db=use_db(false);
        $rsl=$objet->fetch(PDO::FETCH_ASSOC); 
        return $rsl;
    }

}

class entreprise extends user{
    protected $designEntreprise,$IDU,$nom_intermediaire,$prenom_intermediaire,$poste_intermediaire;

    function __construct(array $post)
    {
        parent::__construct($post);
        $this->nom_intermediaire=$post["nom"];
        $this->prenom_intermediaire=$post["prenom"];
        $this->poste_intermediaire=$post["poste"];
        $this->IDU=" ";
        $this->designEntreprise=$post["nomEntreprise"];

    }

    public function createEntreprise(){
        $id=parent::prepareUser();
        $requet="CALL CREATE_ENTREPRISE(?,?,?,?,?,?)";
        $db=use_db(true);
        $objet=$db->prepare($requet);

        $objet->bindValue(1,$id,PDO::PARAM_INT);
        $objet->bindValue(2,$this->designEntreprise,PDO::PARAM_STR);
        $objet->bindValue(3,$this->nom_intermediaire,PDO::PARAM_STR);
        $objet->bindValue(4,$this->prenom_intermediaire,PDO::PARAM_STR);
        $objet->bindValue(5,$this->poste_intermediaire,PDO::PARAM_STR);
        $objet->bindValue(6,$this->IDU,PDO::PARAM_STR);

        $objet->execute();
        $db=use_db(false);

    }
    static public function getSpecific($id){
        $requet="SELECT emailUser,numeroUser,pays,ville,adresse,designEntreprise,logo,nom_intermediaire,prenom_intermediaire,poste_intermediaire FROM user as u inner join entreprise as p on p.idUser=u.idUser where p.idUser=".$id;
        $db=use_db(true);
        $objet=$db->query($requet);
        $db=use_db(false);
        return $objet->fetch(PDO::FETCH_ASSOC);
    }
}

class commissaire extends user{
    protected $nomPr,$prenomPr,$CNI,$isConfirmed,$extension;

    function __construct(array $post)
    {
        parent::__construct($post);
        $this->nomPr=$post["nom"];
        $this->prenomPr=$post["prenom"];
       
    }
    
    public function createCommissaire(){
        $id=parent::prepareUser();
        // $this->CNI["name"]=$this->nomPr.$this->prenomPr.$id."-CNI".".".$this->extension;
        // $dir="../../../FTP-server/user_files/information/".$this->CNI["name"];
        // move_uploaded_file($this->CNI["tmp_name"],$dir);

        $requet="CALL CREATE_COMMISSAIRE(?,?,?)";
        $db=use_db(true);
        $objet=$db->prepare($requet);
        
        $objet->bindValue(1, $id, PDO::PARAM_INT);
        $objet->bindValue(2, $this->nomPr, PDO::PARAM_STR);
        $objet->bindValue(3, $this->prenomPr, PDO::PARAM_STR);

        $objet->execute();
        $db=use_db(false);

    }
    static public function getSpecific($id){
        /*getSpecific permet d'obtenir des informations sur un utilisateurs. 
        Cette version concerne les commissaire*/ 
        $requet="SELECT emailUser,numeroUser,pays,ville,adresse,logo,nomComPr,prenomComPr,isConfirmed FROM user as u inner join commissairePriseur as c on c.idUser=u.idUser where c.idUser=".$id;
        $db=use_db(true);
        $objet=$db->query($requet);
        $db=use_db(false);
        $rsl=$objet->fetch(PDO::FETCH_ASSOC); 
        return $rsl;
    }

}
?>