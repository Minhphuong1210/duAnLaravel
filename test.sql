-- Tạo bảng categories
CREATE TABLE categories (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL COMMENT 'đây là danh mục con',
    slug VARCHAR(255) COMMENT 'đây là từ để khi di chuột vào hiện lên chứ không phair id'
);

-- Tạo bảng sub_categories
CREATE TABLE sub_categories (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(255) DEFAULT NULL,
    status INT,
    categories_id BIGINT,
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (categories_id) REFERENCES categories(id)
);

-- Tạo bảng products
CREATE TABLE products (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DOUBLE(8,2) NOT NULL,
    price_sale DOUBLE(8,2) DEFAULT NULL,
    image VARCHAR(255), -- Đổi từ BIGINT thành VARCHAR hoặc TEXT tùy thuộc vào việc lưu trữ hình ảnh
    description VARCHAR(255),
    content TEXT,
    view INT,
    is_sale TINYINT(1) NOT NULL DEFAULT 1,
    is_hot TINYINT(1) NOT NULL DEFAULT 1,
    is_show_home TINYINT(1) NOT NULL DEFAULT 1,
    is_active TINYINT(1) NOT NULL DEFAULT 1,
    product_code VARCHAR(255) NOT NULL,
    sub_categories_id BIGINT,
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (sub_categories_id) REFERENCES sub_categories(id)
);

-- Tạo bảng images
CREATE TABLE images (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    image TEXT,
    product_image_id BIGINT,
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (product_image_id) REFERENCES products(id)
);

-- Tạo bảng product_colors
CREATE TABLE product_colors (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    color_code VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL
);

-- Tạo bảng product_sizes
CREATE TABLE product_sizes (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL
);

-- Tạo bảng product_details
CREATE TABLE product_details (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    size_id BIGINT NOT NULL,
    color_id BIGINT NOT NULL,
    product_id BIGINT NOT NULL,
    quantity DOUBLE(8,2) NOT NULL,
    image_detail VARCHAR(255) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (size_id) REFERENCES product_sizes(id),
    FOREIGN KEY (color_id) REFERENCES product_colors(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Tạo bảng bannermaketings
CREATE TABLE bannermaketings (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    image VARCHAR(255) NOT NULL,
    title VARCHAR(255),
    user_id BIGINT,
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

-- Tạo bảng orders
CREATE TABLE orders (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    code_order VARCHAR(255) UNIQUE NOT NULL COMMENT 'đây là mã đơn hàng không được trùng',
    user_id BIGINT NOT NULL,
    username VARCHAR(255) NOT NULL,
    phone VARCHAR(255) NOT NULL,
    address VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    note TEXT,
    order_status VARCHAR(255), -- Nên tạo bảng riêng cho trạng thái đơn hàng
    order_payment VARCHAR(255), -- Nên tạo bảng riêng cho trạng thái thanh toán
    commodity_money DOUBLE(8,2),
    total_amount DOUBLE(8,2),
    shipping_id BIGINT,
    promotion_id BIGINT,
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (shipping_id) REFERENCES shippings(id),
    FOREIGN KEY (promotion_id) REFERENCES promotions(id)
);

-- Tạo bảng order_details
CREATE TABLE order_details (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    total INT NOT NULL,
    order_id BIGINT NOT NULL,
    product_detail_id BIGINT NOT NULL,
    price DOUBLE(8,2),
    quantity DOUBLE,
    total_amount DOUBLE(8,2),
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_detail_id) REFERENCES product_details(id)
);

-- Tạo bảng promotions
CREATE TABLE promotions (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(255),
    discount DOUBLE(8,2),
    discount_type ENUM('percentage', 'fixed'), -- Thay đổi enum theo nhu cầu
    start_date DATE,
    end_date DATE,
    usage_limit INT,
    status ENUM('active', 'inactive') -- Thay đổi enum theo nhu cầu
);

-- Tạo bảng shippings
CREATE TABLE shippings (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    description TEXT,
    cost DOUBLE(8,2)
);

-- Tạo bảng comments
CREATE TABLE comments (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    comment TEXT,
    user_id BIGINT NOT NULL,
    product_id BIGINT NOT NULL,
    status BOOLEAN,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Tạo bảng whishLists
CREATE TABLE whishLists (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    `like` BOOLEAN,
    user_id BIGINT NOT NULL,
    product_id BIGINT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

-- Tạo bảng users
CREATE TABLE users (
    id BIGINT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    email_verified_at TIMESTAMP DEFAULT NULL,
    password VARCHAR(255) NOT NULL,
    address VARCHAR(255) DEFAULT NULL,
    phone VARCHAR(255) DEFAULT NULL,
    remember_token VARCHAR(100) DEFAULT NULL,
    created_at TIMESTAMP DEFAULT NULL,
    updated_at TIMESTAMP DEFAULT NULL,
    role ENUM('Admin', 'Manager', 'View') NOT NULL DEFAULT 'View'
);
