<?php

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Methods: PUT');
header(
    'Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With'
);

class Reservations extends Controller
{
    public function __construct()
    {
        $this->reservationModel = $this->model('Reservation');
    }

    public function getAll()
    {
        if ($this->reservationModel->getReservation()) {
            $reservations = $this->reservationModel->getReservation();
            echo json_encode([
                'data' => $reservations,
            ]);
        } else {
            echo json_encode([
                'message' => 'Ops something wrong',
            ]);
        }
    }

    public function getOne($id)
    {
        $this->reservationModel->id = $id;
        $reservation = $this->reservationModel->getOneReservation();
        echo json_encode([
            'data' => $reservation,
        ]);
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $info = json_decode(file_get_contents('php://input'));

            if (!empty($info)) {
                $data = [
                    'first_name' => $info->first_name,
                    'last_name' => $info->last_name,
                    'birthday' => $info->birthday,
                    'nationalite' => $info->nationalite,
                    'situation' => $info->situation,
                    'adresse' => $info->adresse,
                    'type_visa' => $info->type_visa,
                    'date_depart' => $info->date_depart,
                    'date_arriver' => $info->date_arriver,
                    'type_document' => $info->type_document,
                    'numero_document' => $info->numero_document,
                ];

                if ($this->reservationModel->addReservation($data)) {
                    echo json_encode([
                        'message' => 'reservation added successfully',
                        'error' => false,
                    ]);
                } else {
                    echo json_encode([
                        'message' => 'Ops Somthing wrong',
                        'error' => true,
                    ]);
                }
            }
        }
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $info = json_decode(file_get_contents('php://input'));

            if (!empty($info)) {
                $data = [
                    'id' => $id,
                    'first_name' => $info->first_name,
                    'last_name' => $info->last_name,
                    'birthday' => $info->birthday,
                    'nationalite' => $info->nationalite,
                    'situation' => $info->situation,
                    'adresse' => $info->adresse,
                    'type_visa' => $info->type_visa,
                    'date_depart' => $info->date_depart,
                    'date_arriver' => $info->date_arriver,
                    'type_document' => $info->type_document,
                    'numero_document' => $info->numero_document,
                ];

                if ($this->reservationModel->updateReservation($data)) {
                    echo json_encode([
                        'message' => 'reservation Updated successfully',
                        'error' => false,
                    ]);
                } else {
                    echo json_encode([
                        'message' => 'Ops Somthing wrong',
                        'error' => true,
                    ]);
                }
            }
        }
    }


    public function delete($id)
    {
        $this->reservationModel->id = $id;
        if($this->reservationModel->deleteModel()){
            echo json_encode([
                'message' => 'reservation deleted successfully',
                'error' => false,
            ]);
        }else{
            echo json_encode([
                'message' => 'Ops Somthing wrong',
                'error' => true,
            ]);
        }
    }
}
