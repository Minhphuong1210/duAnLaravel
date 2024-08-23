<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BaiViet;
use App\Models\ChiTietDonHang;
use App\Models\DonHang;
use App\Models\SanPham;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function thongKe(Request $request)
    {

        // dd($request->all());
        $totalProduct = SanPham::sum('so_luong');
        $totalOrder = ChiTietDonHang::query()->sum('so_luong');
        $totalPrice = ChiTietDonHang::query()->sum('thanh_tien');
        $posts_view = BaiViet::query()->orderBy('view', 'desc')->limit(5)->get();
        $product_view = SanPham::query()->orderBy('luot_xem', 'desc')->limit(4)->get();
        $product_bought = ChiTietDonHang::query()
        // ->whereNotNull('deleted_at')
        ->select('san_pham_id', DB::raw('SUM(so_luong) AS tong_so_luong'), 'don_gia')
        ->groupBy('san_pham_id', 'don_gia')
        ->orderBy('tong_so_luong', 'DESC')
        ->limit(5)
        ->get();
    
        $product_view = SanPham::query()->orderBy('luot_xem', 'desc')->limit(4)->get();
        // sản phẩm chưa có trong bảng chi tiết đơn hàng 
        $product_not_boughts = SanPham::whereNotIn('id', function ($query) {
            $query->select('san_pham_id')->from('chi_tiet_don_hangs');
        })->limit(5)->get();
        // bảng theo tuần bắt đầu từ chủ nhật

        if ($request->isMethod('POST') && $request->has(['start_date', 'end_date'])) {
            $startOfWeek = Carbon::parse($request->input('start_date'));
            $endOfWeek = Carbon::parse($request->input('end_date'));
        } else {
            $startOfWeek = Carbon::now()->startOfWeek();
            $endOfWeek = Carbon::now()->endOfWeek();
        }
        $chitietdonhangs = ChiTietDonHang::query()
            ->whereBetween('created_at', [$startOfWeek, $endOfWeek])
            ->get();
        // dd($chitietdonhangs);    
        // Tạo mảng để chứa dữ liệu theo ngày trong tuần
        $dataByDay = [
            'Mon' => [],
            'Tue' => [],
            'Wed' => [],
            'Thu' => [],
            'Fri' => [],
            'Sat' => [],
            'Sun' => []
        ];
        foreach ($chitietdonhangs as $record) {
            $dateString = $record->created_at;
            $carbonDate = new Carbon($dateString);
            // Lấy thứ trong tuần và giờ
            $dayOfWeek = $carbonDate->format('D');
            // thằng h là lấy 24h còn thằng a để gọi là am hay pm
            $hourOfDay = $carbonDate->format('H A');
            $quantity = $record->so_luong;
            // Thêm dữ liệu vào mảng
            $dataByDay[$dayOfWeek][] = ['y' => $quantity, 'x' => $hourOfDay];
        }
        // Chuyển đổi dữ liệu thành định dạng JSON để sử dụng trong JavaScript
        $jsonData = json_encode(array_map(function ($day, $data) {
            return ['name' => $day, 'data' => $data];
        }, array_keys($dataByDay), $dataByDay));
        // dd($dataByDay);
        // tìm theo tháng 
        if ($request->isMethod('POST') && $request->has(['start_month', 'end_month'])) {
            $startMonth = Carbon::parse($request->input('start_month'))->startOfMonth();
            $endMonth = Carbon::parse($request->input('end_month'))->endOfMonth();
        } else {

            $startMonth = Carbon::now()->startOfMonth();
            $endMonth = Carbon::now()->endOfMonth();
        }

        $monthlyData = ChiTietDonHang::query()
        // lọc bản ghi theo tháng bắt đầu và kết thúc
    ->whereBetween('created_at', [$startMonth, $endMonth])
    // chọn tháng từ cootj create_at và tổng hợp số lượng
    ->selectRaw('MONTH(created_at) as month, sum(so_luong) as count')
    // Nhóm các bản ghi theo tháng
    ->groupBy('month')
    // sắp xếp các bản ghi theo tháng
    ->orderBy('month')
    //lấy tổng số lượng theo tháng của nó 
    ->pluck('count', 'month');

        $monthlySalesData = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlySalesData[] = $monthlyData->get($month, 0);
        }
// dd($monthlySalesData);
// $HuyHang = DonHang::onlyTrashed()->count();

// Tính tổng số đơn hàng và số đơn hàng bị hủy cho từng sản phẩm


        return view('admins.dashboard', compact('totalProduct', 'totalOrder', 'totalPrice', 'posts_view', 'product_view', 'product_bought', 'product_not_boughts', 'jsonData','monthlySalesData'));
    }
}
