-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 07, 2024 lúc 02:01 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `shoe_seller`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `account_guest`
--

CREATE TABLE `account_guest` (
  `id` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `account_guest`
--

INSERT INTO `account_guest` (`id`, `email`, `name`, `password`) VALUES
(2, 'qanh123@gmail.com', 'qanh123', '1'),
(4, 'qanh@gmail.com', 'qanh', '1'),
(5, 'bac@gmail.com', 'bac', '1'),
(6, 'man@gmail.com', 'man', '1');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `user_id` int(100) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_id` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(100) NOT NULL,
  `max_quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`user_id`, `product_name`, `product_id`, `price`, `quantity`, `image`, `max_quantity`) VALUES
(0, 'SHOE 2', '002', 20000, 1, 'shoe2.jpg', 0),
(2, 'SHOE 1', '001', 10000, 1, 'shoe1.jpg', 0),
(2, 'SHOE 2', '002', 20000, 1, 'shoe2.jpg', 0),
(5, 'SHOE 2', '002', 20000, 1, 'shoe2.jpg', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `id` varchar(3) NOT NULL,
  `price` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`id`, `price`, `name`, `quantity`, `image`) VALUES
('001', 10000, 'SHOE 1', 3, 'shoe1.jpg'),
('002', 20000, 'SHOE 2', 5, 'shoe2.jpg'),
('003', 15000, 'SHOE 3', 8, 'shoe3.jpg'),
('004', 18000, 'SHOE 4', 4, 'shoe4.jpg'),
('005', 22000, 'SHOE 5', 6, 'shoe5.jpg'),
('006', 25000, 'SHOE 6', 7, 'shoe6.jpg'),
('007', 19000, 'SHOE 7', 9, 'shoe7.jpg'),
('008', 23000, 'SHOE 8', 3, 'shoe8.jpg'),
('009', 28000, 'SHOE 9', 5, 'shoe9.jpg'),
('010', 21000, 'SHOE 10', 10, 'shoe10.jpg'),
('011', 27000, 'SHOE 11', 6, 'shoe11.jpg'),
('012', 30000, 'SHOE 12', 8, 'shoe12.jpg'),
('013', 25000, 'SHOE 13', 5, 'shoe13.jpg'),
('014', 28000, 'SHOE 14', 7, 'shoe14.jpg'),
('015', 32000, 'SHOE 15', 9, 'shoe15.jpg'),
('016', 23000, 'SHOE 16', 4, 'shoe16.jpg'),
('017', 35000, 'SHOE 17', 6, 'shoe17.jpg'),
('018', 27000, 'SHOE 18', 8, 'shoe18.jpg'),
('019', 29000, 'SHOE 19', 5, 'shoe19.jpg'),
('020', 33000, 'SHOE 20', 7, 'shoe20.jpg');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `account_guest`
--
ALTER TABLE `account_guest`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`product_id`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `account_guest`
--
ALTER TABLE `account_guest`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
