<?php

namespace App\Controllers;

use App\Core\Controller;

/**
 * Class AuthController
 * Quản lý Đăng nhập & Đăng ký tài khoản
 */
class AuthController extends Controller
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Trang & Xử lý Đăng nhập
     */
    public function login(): void
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $error = 'Vui lòng nhập đầy đủ Email và Mật khẩu!';
            } else {
                // Giả lập đăng nhập thành công
                $_SESSION['user'] = [
                    'name' => 'Nguyễn Văn A',
                    'email' => $email,
                    'role' => 'customer'
                ];
                $this->redirect('/');
                return;
            }
        }

        $this->view('client/login', [
            'title' => 'Đăng nhập — Sport Shoes Store',
            'currentPage' => 'login',
            'error' => $error
        ]);
    }

    /**
     * Trang & Xử lý Đăng ký
     */
    public function register(): void
    {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $passwordConfirm = $_POST['password_confirm'] ?? '';

            if (empty($name) || empty($email) || empty($password)) {
                $error = 'Vui lòng nhập đầy đủ thông tin!';
            } elseif ($password !== $passwordConfirm) {
                $error = 'Mật khẩu xác nhận không khớp!';
            } else {
                // Giả lập đăng ký thành công
                $_SESSION['user'] = [
                    'name' => $name,
                    'email' => $email,
                    'role' => 'customer'
                ];
                $this->redirect('/');
                return;
            }
        }

        $this->view('client/register', [
            'title' => 'Đăng ký tài khoản — Sport Shoes Store',
            'currentPage' => 'register',
            'error' => $error
        ]);
    }

    /**
     * Đăng xuất
     */
    public function logout(): void
    {
        unset($_SESSION['user']);
        session_destroy();
        $this->redirect('/');
    }
}
