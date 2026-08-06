<?php

namespace App\Models;

use App\Core\Model;

/**
 * Class Category
 * Quản lý dữ liệu danh mục sản phẩm
 */
class Category extends Model
{
    protected string $table = 'categories';
    protected string $primaryKey = 'category_id';

    /**
     * Lấy tất cả danh mục
     *
     * @return array
     */
    public function getAllCategories(): array
    {
        try {
            // Dùng GROUP BY name để loại bỏ các bản ghi trùng lặp tên trong DB và loại bỏ Lifestyle
            $stmt = $this->db->query("SELECT min(category_id) as category_id, name FROM {$this->table} WHERE name != 'Lifestyle' GROUP BY name ORDER BY name ASC");
            return $stmt->fetchAll() ?: [];
        } catch (\Throwable $e) {
            return [
                ['category_id' => 1, 'name' => 'Running (Giày chạy bộ)']
            ];
        }
    }
}
