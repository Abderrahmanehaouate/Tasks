<?php

class Reservation{
    private $db;

    public function __construct(){
        $this->db = new Database;
    }

    public function getReservation(){

        $this->db->query("SELECT * FROM reservation");
        
        return $this->db->resultSet();
    }


    public function getOneReservation(){

        $this->db->query("SELECT * FROM reservation WHERE id = ?");
        $this->db->bind( 1, $this->id);
        return $this->db->resultSet();
    }

    public function addReservation($data){
        $this->db->query("INSERT INTO reservation (first_name ,last_name , birthday,
        nationalite, situation, adresse, type_visa, date_depart, date_arriver, type_document, 
        numero_document)
        VALUES (:first_name, :last_name, :birthday, :nationalite, :situation, :adresse, 
        :type_visa, :date_depart, :date_arriver, :type_document, :numero_document)");

        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':nationalite', $data['nationalite']);
        $this->db->bind(':situation',$data['situation']);
        $this->db->bind(':birthday', $data['birthday']);
        $this->db->bind(':adresse',   $data['adresse']);
        $this->db->bind(':type_visa', $data['type_visa']);
        $this->db->bind(':date_depart', $data['date_depart']);
        $this->db->bind(':date_arriver', $data['date_arriver']);
        $this->db->bind(':type_document', $data['type_document']);
        $this->db->bind(':numero_document', $data['numero_document']);

        if($this->db->execute()){
            return true;
        }else{
            printf('Error : %s\n',$this->db->error);
            return false;
        }
    }

    public function updateReservation($data){
        $this->db->query("UPDATE reservation SET first_name =:first_name ,last_name =:last_name , birthday =:birthday,
        nationalite =:nationalite, situation =:situation, adresse =:adresse, type_visa =:type_visa, date_depart =:date_depart, date_arriver =:date_arriver, type_document =:type_document, 
        numero_document =:numero_document WHERE id = :id ");

        $this->db->bind(':id', $data['id']);
        $this->db->bind(':first_name', $data['first_name']);
        $this->db->bind(':last_name', $data['last_name']);
        $this->db->bind(':nationalite', $data['nationalite']);
        $this->db->bind(':situation',$data['situation']);
        $this->db->bind(':birthday', $data['birthday']);
        $this->db->bind(':adresse',   $data['adresse']);
        $this->db->bind(':type_visa', $data['type_visa']);
        $this->db->bind(':date_depart', $data['date_depart']);
        $this->db->bind(':date_arriver', $data['date_arriver']);
        $this->db->bind(':type_document', $data['type_document']);
        $this->db->bind(':numero_document', $data['numero_document']);

        if($this->db->execute()){
            return true;
        }else{
            printf('Error : %s\n',$this->db->error);
            return false;
        }
    }



    public function deleteModel()
    {
        $this->db->query('DELETE FROM reservation WHERE id =:id');
        //bind values
        $this->db->bind(':id', $this->id);
        // Execute
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}