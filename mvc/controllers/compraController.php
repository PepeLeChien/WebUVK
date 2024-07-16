<?php

namespace Controllers;

use MVC\Router;
use Models\CompraModel;
use Models\CompraTicketModel;
use Models\ClienteModel;
use Models\FuncionButacaModel;

class CompraController {

    public static function index(Router $router) {
        // Render the main seat selection page
        $router->render('compra/index', [], 'layout_compra');
    }

    public static function tickets(Router $router) {
        // Render the ticket selection page
        $router->render('compra/tickets', [], 'layout_compra');
    }

    public static function pago(Router $router) {
        // Render the payment page
        $router->render('compra/pago', [], 'layout_compra');
    }

    public static function agregar(Router $router) {
        $data = json_decode(file_get_contents('php://input'), true);

        $id_cliente = $data['id_cliente'];
        $id_funcion = $data['id_funcion'];
        $butacas = $data['butacas'];
        $total = $data['total'];

        if (!$id_cliente || !$id_funcion || empty($butacas)) {
            echo json_encode(['error' => 'Datos incompletos']);
            return;
        }

        $compra_id = CompraModel::create([
            'id_cliente' => $id_cliente,
            'fecha' => date('Y-m-d'),
            'total' => $total
        ]);

        foreach ($butacas as $butaca_id) {
            FuncionButacaModel::create([
                'id_funcion' => $id_funcion,
                'id_butaca' => $butaca_id,
                'estado' => 'Ocupado'
            ]);

            CompraTicketModel::create([
                'id_compra' => $compra_id,
                'id_funcionButaca' => $butaca_id,
                'precio' => 20.00 // Suponiendo un precio fijo
            ]);
        }

        echo json_encode(['success' => 'Compra realizada con éxito']);
    }

    public static function obtenerButacasOcupadas(Router $router) {
        $id_funcion = $_GET['id_funcion'] ?? null;
        if ($id_funcion) {
            $butacas = FuncionButacaModel::obtenerButacasOcupadas($id_funcion);
            echo json_encode(['butacas' => $butacas]);
            error_log("Datos de función: " . json_encode(['butacas' => $butacas]));
        } else {
            echo json_encode(['error' => 'ID de función no proporcionado']);
        }
    }
}
?>
