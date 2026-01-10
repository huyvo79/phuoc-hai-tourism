<?php

namespace App\Services;

use App\Interfaces\DashboardServiceInterface;
use App\Models\User;
use App\Models\Category;
use App\Models\Post;
use App\Models\Visitor;
// use App\Models\Location; // Bỏ comment nếu bạn đã có Model Location
use Carbon\Carbon;

class DashboardService implements DashboardServiceInterface
{
    public function getStats()
    {
        $startOfWeek = Carbon::now()->startOfWeek();
        $startOfMonth = Carbon::now()->startOfMonth();

        // 1. Thống kê Visits
        $totalVisits = Visitor::count();
        $visitsThisWeek = Visitor::where('visit_date', '>=', $startOfWeek)->count();
        
        // 2. Thống kê Categories
        $totalCategories = Category::count();
        $newCategories = Category::where('created_at', '>=', $startOfWeek)->count();

        // 3. Thống kê Posts
        $totalPosts = Post::count();
        // Giả sử có cột 'status' = 'pending' cho bài chờ duyệt
        // Nếu không có cột status, bạn có thể xóa dòng này hoặc query theo logic khác
        $pendingPosts = Post::where('created_at', '>=', $startOfWeek)->count(); 

        // 4. Thống kê Admins
        $totalAdmins = User::count();

        return [
            'visitors' => [
                'total' => $totalVisits,
                'growth_text' => "+{$visitsThisWeek} tuần này"
            ],
            'categories' => [
                'total' => $totalCategories,
                'sub_text' => "Đã thêm {$newCategories} mới"
            ],
            'posts' => [
                'total' => $totalPosts,
                'sub_text' => "{$pendingPosts} bài mới tuần này"
            ],
            'admins' => [
                'total' => $totalAdmins,
                'sub_text' => "Đang hoạt động"
            ]
        ];
    }
}