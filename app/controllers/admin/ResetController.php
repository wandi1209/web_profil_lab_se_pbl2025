<?php

namespace Polinema\WebProfilLabSe\Controllers\Admin;

use Polinema\WebProfilLabSe\Core\Controller;
use Polinema\WebProfilLabSe\Models\PasswordReset;
use Polinema\WebProfilLabSe\Middlewares\AuthMiddleware;

class ResetController extends Controller
{
    private $resetModel;

    public function __construct()
    {
        // Middleware level Controller
        AuthMiddleware::isSuperAdmin();
        
        $this->resetModel = new PasswordReset();
    }

    public function index()
    {
        $requests = $this->resetModel->getAllPending();
        
        $data = [
            'title' => 'Permintaan Reset Password',
            'requests' => $requests
        ];

        $this->view('pages/admin/reset_password/index', $data, true, 'admin');
    }

    public function approve()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestId = $_POST['request_id'];
            $newPassword = $_POST['new_password'];

            if (empty($newPassword)) {
                $_SESSION['error'] = "Password baru tidak boleh kosong";
            } else {
                if ($this->resetModel->approveReset($requestId, $newPassword)) {
                    $_SESSION['success'] = "Password berhasil direset!";
                } else {
                    $_SESSION['error'] = "Gagal mereset password.";
                }
            }
            header('Location: ' . $_ENV['APP_URL'] . '/admin/reset-requests');
            exit;
        }
    }

    public function reject()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $requestId = $_POST['request_id'];
            $this->resetModel->rejectRequest($requestId);
            $_SESSION['success'] = "Permintaan ditolak.";
            header('Location: ' . $_ENV['APP_URL'] . '/admin/reset-requests');
            exit;
        }
    }
}