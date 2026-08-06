<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\Product;

/**
 * Class CartController
 * Quản lý Giỏ hàng và Thanh toán
 */
class CartController extends Controller
{
    private ?Product $productModel = null;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        try {
            $this->productModel = new Product();
        } catch (\Throwable $e) {
            // DB chưa khởi tạo
        }
    }

    /**
     * Hiển thị Trang giỏ hàng
     */
    public function index(): void
    {
        $cart = $_SESSION['cart'] ?? [];
        $cartItems = [];
        $totalAmount = 0;

        foreach ($cart as $productId => $item) {
            $product = $this->productModel ? $this->productModel->getProductById((int)$productId) : null;
            if ($product) {
                $price = !empty($product['sale_price']) ? $product['sale_price'] : $product['price'];
                $itemData = [
                    'product_id' => $product['product_id'],
                    'name' => $product['name'],
                    'image_url' => $product['image_url'],
                    'price' => $price,
                    'quantity' => $item['quantity'],
                    'size' => $item['size'] ?? 41
                ];
                $cartItems[] = $itemData;
                $totalAmount += $price * $item['quantity'];
            } else {
                // Fallback nếu chưa có trong DB
                $cartItems[] = [
                    'product_id' => $productId,
                    'name' => 'Nike Air Zoom Pegasus 39',
                    'image_url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=100&q=80',
                    'price' => 2500000,
                    'quantity' => $item['quantity'] ?? 1,
                    'size' => $item['size'] ?? 41
                ];
                $totalAmount += 2500000 * ($item['quantity'] ?? 1);
            }
        }

        $this->view('client/cart', [
            'title' => 'Giỏ hàng — Sport Shoes Store',
            'currentPage' => 'cart',
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount
        ]);
    }

    /**
     * Thêm sản phẩm vào giỏ hàng
     */
    public function add(): void
    {
        $productId = $_POST['product_id'] ?? $_GET['id'] ?? null;
        $quantity = (int)($_POST['quantity'] ?? 1);
        $size = $_POST['size'] ?? 41;
        $action = $_POST['action'] ?? 'add';

        if ($productId) {
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }

            if (isset($_SESSION['cart'][$productId])) {
                $_SESSION['cart'][$productId]['quantity'] += $quantity;
            } else {
                $_SESSION['cart'][$productId] = [
                    'quantity' => $quantity,
                    'size' => $size
                ];
            }
        }

        if ($action === 'buy_now') {
            $this->redirect('/checkout');
        } else {
            $this->redirect('/cart');
        }
    }

    /**
     * Xóa sản phẩm khỏi giỏ hàng
     */
    public function remove(int $id): void
    {
        if (isset($_SESSION['cart'][$id])) {
            unset($_SESSION['cart'][$id]);
        }
        $this->redirect('/cart');
    }

    /**
     * Xóa sạch giỏ hàng
     */
    public function clear(): void
    {
        $_SESSION['cart'] = [];
        $this->redirect('/cart');
    }

    /**
     * Hiển thị Trang thanh toán
     */
    public function checkout(): void
    {
        $cart = $_SESSION['cart'] ?? [];
        $cartItems = [];
        $totalAmount = 0;

        foreach ($cart as $productId => $item) {
            $product = $this->productModel ? $this->productModel->getProductById((int)$productId) : null;
            $price = $product ? (!empty($product['sale_price']) ? $product['sale_price'] : $product['price']) : 2500000;
            
            $cartItems[] = [
                'product_id' => $productId,
                'name' => $product ? $product['name'] : 'Nike Air Zoom Pegasus 39',
                'image_url' => $product ? $product['image_url'] : '',
                'price' => $price,
                'quantity' => $item['quantity'] ?? 1,
                'size' => $item['size'] ?? 41
            ];
            $totalAmount += $price * ($item['quantity'] ?? 1);
        }

        $this->view('client/checkout', [
            'title' => 'Thanh toán đơn hàng — Sport Shoes Store',
            'currentPage' => 'checkout',
            'cartItems' => $cartItems,
            'totalAmount' => $totalAmount
        ]);
    }

    /**
     * Xử lý Đặt hàng
     */
    public function processCheckout(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Giả lập đặt hàng thành công & xóa giỏ hàng
            $_SESSION['cart'] = [];
            
            echo "<script>
                alert('Đặt hàng thành công! Cảm ơn bạn đã mua hàng tại Sport Shoes Store.');
                window.location.href = '" . base_url('/') . "';
            </script>";
            exit;
        }
    }
}
