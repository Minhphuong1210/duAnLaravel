<!DOCTYPE html>
<html>
<head>
    <title>Xác nhận đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
        }
        h1 {
            color: #333;
        }
        p {
            margin: 0;
            padding: 10px 0;
        }
        .highlight {
            font-weight: bold;
        }
        .item-list {
            margin: 10px 0;
            padding: 0;
            list-style: none;
        }
        .item-list li {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Xác nhận đơn hàng</h1>

        <p>Xin chào <span class="highlight">{{ $donHang->ten_nguoi_nhan }}</span>,</p>

        <p>Cảm ơn bạn đã đặt hàng từ cửa hàng của chúng tôi. Đây là thông tin đơn hàng của bạn:</p>

        <p><span class="highlight">Mã đơn hàng:</span> {{ $donHang->ma_don_hang }}</p>

        <p><span class="highlight">Sản phẩm đã đặt:</span></p>
        <ul class="item-list">
            @foreach ($donHang->chiTietdonHang as $chiTiet)
                <li>{{ $chiTiet->sanPham->ten_san_pham }} :: {{ number_format($chiTiet->thanh_tien) }} VNĐ</li>
            @endforeach
        </ul>

        <p><span class="highlight">Tổng tiền:</span> {{ number_format($donHang->tong_tien) }} VNĐ</p>

        <p>Chúng tôi sẽ liên hệ bạn sớm nhất để xác nhận thông tin giao hàng.</p>

        <p>Cảm ơn đã mua hàng của chúng tôi!</p>

        <p>Trân trọng.</p>
    </div>
</body>
</html>
