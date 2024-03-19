-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th3 20, 2024 lúc 12:31 AM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `food`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `AD_id` int(11) NOT NULL,
  `AD_ten` varchar(30) NOT NULL,
  `AD_username` varchar(10) NOT NULL,
  `AD_password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`AD_id`, `AD_ten`, `AD_username`, `AD_password`) VALUES
(1, 'Nguyễn Phương Thư', 'thu', '123456'),
(2, 'Nguyễn Thị Phương Thư', 'admin', '123');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `bao_gom`
--

CREATE TABLE `bao_gom` (
  `BG_MA` int(11) NOT NULL,
  `HD_MA` int(10) NOT NULL,
  `MA_MA` int(10) NOT NULL,
  `MA_SL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitiethoadon`
--

CREATE TABLE `chitiethoadon` (
  `HD_MA` int(10) NOT NULL,
  `MA_MA` int(11) NOT NULL,
  `CTHD_SOLUONG` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chitietmonan`
--

CREATE TABLE `chitietmonan` (
  `MA_MA` int(10) NOT NULL,
  `CTMA_DONGIA` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `co_loai_mon_an`
--

CREATE TABLE `co_loai_mon_an` (
  `QA_MA` varchar(10) NOT NULL,
  `LMA_MA` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `co_mon_an`
--

CREATE TABLE `co_mon_an` (
  `LMA_MA` varchar(10) NOT NULL,
  `MA_MA` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `duoc_viet_vao`
--

CREATE TABLE `duoc_viet_vao` (
  `RW_MA` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `feedback`
--

CREATE TABLE `feedback` (
  `FB_MA` int(11) NOT NULL,
  `FB_TEN` varchar(20) NOT NULL,
  `FB_NOIDUNG` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `feedback`
--

INSERT INTO `feedback` (`FB_MA`, `FB_TEN`, `FB_NOIDUNG`) VALUES
(1, 'Ẩn danh 1', 'Bạn mình dẫn đi nên mới biết quán này, nhìn chung không gian oke, yên tĩnh và mở nhạc nhẹ, thích hợp'),
(2, 'Ẩn danh 2', 'Đồ ăn ngon vừa giá tiền , nhân viên nhiệt tình'),
(3, 'Ẩn danh 3', 'Đặt hàng trên FOXFOOD APP lúc 11h24, giao hàng lúc 11h43. Khá nhanh, đồ ăn ngon miệng'),
(4, 'Ẩn danh 4', 'Quán này ăn cũng ngon, vị vừa ăn, nhiều topping');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `hoadon`
--

CREATE TABLE `hoadon` (
  `HD_MA` int(10) NOT NULL,
  `KH_MA` int(10) NOT NULL,
  `HD_SL` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khachhang`
--

CREATE TABLE `khachhang` (
  `KH_MA` int(10) NOT NULL,
  `KH_USERNAME` varchar(10) DEFAULT NULL,
  `KH_PASS` varchar(10) DEFAULT NULL,
  `KH_DIACHI` varchar(100) DEFAULT NULL,
  `KH_TEN` varchar(30) DEFAULT NULL,
  `KH_SDT` decimal(10,0) DEFAULT NULL,
  `KH_EMAIL` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khachhang`
--

INSERT INTO `khachhang` (`KH_MA`, `KH_USERNAME`, `KH_PASS`, `KH_DIACHI`, `KH_TEN`, `KH_SDT`, `KH_EMAIL`) VALUES
(1, 'dang', '123', '21', 'Nguyen Nhat Dang', 912345678, 'example@gmail.com'),
(2, 'thanh', 'thanh', 'Ct', 'Nguyen Ngoc Thanh', 912345678, 'thanh@gmail.com'),
(3, 'thup', '123', '123', 'Phương Thư', 123456789, 'thu@gmail.com'),
(4, 'phuongthu', '123', '123', 'NPT', 123456789, 'thu2@gmail.com'),
(5, 'thuph', '123', '123', 'Lý Trọng Nhân', 123456789, 'tn@gmail.com'),
(6, 'lengoc', '123', '123', 'Lê Ngọc', 123456789, 'lengoc@gmail.com'),
(7, 'linh', '123', 'Cần Thơ', 'Linh', 912345678, 'linh@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `loaimonan`
--

CREATE TABLE `loaimonan` (
  `LMA_MA` varchar(10) NOT NULL,
  `LMA_TEN` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `loaimonan`
--

INSERT INTO `loaimonan` (`LMA_MA`, `LMA_TEN`) VALUES
('01', 'Lẩu'),
('02', 'Ăn vặt'),
('03', 'Trái cây');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `monan`
--

CREATE TABLE `monan` (
  `MA_MA` int(11) NOT NULL,
  `LMA_MA` varchar(10) NOT NULL,
  `MA_TEN` varchar(30) DEFAULT NULL,
  `MA_TINHTRANG` varchar(10) DEFAULT NULL,
  `MA_HINHANH` varchar(200) DEFAULT NULL,
  `MA_MOTA` text NOT NULL,
  `MA_GIA` float NOT NULL,
  `MA_DANHGIA` int(200) NOT NULL,
  `MA_LUOTBAN` int(100) NOT NULL,
  `MA_SAO` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `monan`
--

INSERT INTO `monan` (`MA_MA`, `LMA_MA`, `MA_TEN`, `MA_TINHTRANG`, `MA_HINHANH`, `MA_MOTA`, `MA_GIA`, `MA_DANHGIA`, `MA_LUOTBAN`, `MA_SAO`) VALUES
(1, '02', 'Mì trộn MH', '1', 'product-1.jpg', 'Chúng tôi tự hào giới thiệu món mì trộn đặc biệt tại quán\r\nNguyên Liệu Chất Lượng Cao:\r\n\r\nMì sợi tươi: Chúng tôi sử dụng mì sợi tươi hàng ngày, đảm bảo độ ẩm và độ mềm mịn tốt nhất cho mỗi dĩa mì trộn.\r\nRau sạch: Tất cả các loại rau củ, từ rau xanh tươi mát đến các loại rau củ cắt nhỏ mịn, đều được lựa chọn từ những nguồn cung cấp đáng tin cậy và được giữ nguyên tươi sống.\r\nHương Vị Đa Dạng:\r\n\r\nSự Kết Hợp Hoàn Hảo: Mì trộn của chúng tôi được kết hợp một cách cân đối giữa các thành phần như thịt gà nướng, tôm tươi, đậu hủ, và trứng gà, tạo nên một hương vị phong phú và bổ dưỡng.\r\nSốt Tươi Mới: Chúng tôi sử dụng các loại sốt tự nhiên, được chế biến từ các nguyên liệu tươi mới hàng ngày, tạo nên lớp vị đặc biệt và hấp dẫn cho mỗi dĩa mì trộn.', 28000, 89, 142, 4),
(2, '02', 'Mì cay ITADA', 'còn món', 'product-2.jpg', 'Không gì có thể so sánh với hương vị đậm đà và độ cay nồng của mì cay sốt huyết áp tại Itada. Món ăn này không chỉ là một lựa chọn hoàn hảo cho những người yêu thích mì cay mà còn là một trải nghiệm ẩm thực đặc biệt không thể bỏ qua.\r\n\r\nHương Vị Độc Đáo:\r\n\r\nSốt Cay Huyết Áp: Sự kết hợp độc đáo giữa gia vị cay nồng và hương vị đặc trưng của huyết áp, tạo nên một lớp sốt đậm đà, thơm ngon và bắt mắt. Sốt được chế biến tỉ mỉ từ những nguyên liệu tươi mới và các loại gia vị đặc biệt, mang lại hương vị đặc trưng chỉ có ở Itada.\r\nMì Sợi Mềm Mịn: Mỗi dĩa mì cay được chế biến từ mì sợi mềm mịn, hấp dẫn và dẻo dai, tạo nên sự kết hợp hoàn hảo với lớp sốt cay nồng.\r\nNguyên Liệu Tươi Mới:\r\n\r\nThịt Gà Nướng: Sự kết hợp giữa thịt gà nướng thơm ngon và sốt cay huyết áp tạo nên một hương vị đặc biệt và bổ dưỡng cho mỗi thìa mì.\r\nRau Xanh Tươi Mát: Rau sống như rau cải xanh, cà rốt, và hành tây tươi mát được thêm vào mì cay để tăng thêm độ tươi mát và dinh dưỡng cho món ăn.', 35000, 68, 142, 4),
(3, '02', 'Gỏi cuốn ', 'còn món', 'product-3.jpg', ' Gỏi cuốn của chúng tôi là sự kết hợp hài hòa giữa các nguyên liệu tươi mát và hương vị đa dạng, tạo nên một hương vị đặc trưng và độc đáo mà chỉ có ở [Tên Quán].\r\nNước Chấm Đặc Biệt: Mỗi gỏi cuốn được kèm theo một loại nước chấm đặc biệt, được chế biến từ những nguyên liệu tự nhiên và gia vị tinh tế, tạo nên một hòa quện hoàn hảo và bổ dưỡng.', 6000, 12, 65, 5),
(4, '02', 'Bún đậu mắm tôm Bà ròm', NULL, 'product-4.jpg', 'Bún đậu mắm tôm tại Bà Ròm không chỉ là một món ăn ngon miệng mà còn là biểu tượng của ẩm thực Việt Nam, mang đến hương vị đậm đà, bổ dưỡng và hấp dẫn từ mỗi thìa. Với sự kết hợp tinh tế giữa bún, đậu hũ, các loại rau sống và mắm tôm, món ăn này chắc chắn sẽ làm hài lòng cả vị giác lẫn thị giác của bạn.\r\n\r\nHương Vị Đậm Đà:\r\n\r\nMắm Tôm Chất Lượng: Chúng tôi sử dụng mắm tôm chất lượng cao, được chế biến tỉ mỉ từ những con tôm tươi ngon, tạo nên một lớp mắm tôm đậm đà, thơm ngon và bổ dưỡng.\r\nBún Mềm Mịn: Bún mềm mịn, được chế biến từ những hạt gạo chọn lọc, tạo nên sự hòa quện hoàn hảo với lớp mắm tôm đặc biệt.\r\nNguyên Liệu Tươi Mát:\r\n\r\nĐậu Hũ Ngon: Đậu hũ được chế biến từ đậu nành tươi ngon, giòn ngon và bổ dưỡng, tạo nên một sự kết hợp tuyệt vời với bún và mắm tôm.\r\nRau Sống Tươi Mát: Các loại rau sống như rau sống, rau sống, cà rốt và hành tây được thêm vào bún đậu mắm tôm để tăng thêm vị tươi mát và dinh dưỡng.', 45000, 45, 50, 5),
(5, '02', 'Phúc Long', NULL, 'product-5.jpg', 'Phúc Long\r\nTrà Phúc Long: Với hương vị đặc trưng và độ ngon của trà Phúc Long, chúng tôi mang lại một cảm giác tinh tế và hài hòa từ mỗi giọt nước.\r\nCà Phê Phúc Long: Được pha chế từ hạt cà phê Phúc Long nguyên chất, cà phê của chúng tôi mang lại một hương vị đậm đà và độc đáo, tạo nên một trải nghiệm thưởng thức tuyệt vời.\r\nNguyên Liệu Tươi Mới:\r\n\r\nHạt Trà Và Cà Phê Chọn Lọc: Chúng tôi sử dụng những hạt trà và cà phê được chọn lọc từ vùng trồng trà và cà phê Phúc Long, đảm bảo chất lượng và hương vị tốt nhất.\r\nThành Phần Tự Nhiên: Sản phẩm của chúng tôi không chứa chất bảo quản hay hương liệu nhân tạo, mà chỉ là sự hòa quện hoàn hảo của các nguyên liệu tự nhiên, tạo nên hương vị đặc biệt và tinh tế.', 60000, 96, 189, 4),
(6, '02', 'Cơm gà xối mỡ Ngọc Hằng', NULL, 'product-6.jpg', 'Cơm Gà Xối Mỡ - Món Ăn Đặc Biệt Tại [Tên Quán]\r\n\r\nCơm gà xối mỡ tại Ngọc Hằng không chỉ là một món ăn ngon miệng mà còn là biểu tượng của ẩm thực Việt Nam, mang đến hương vị đậm đà, bổ dưỡng và hấp dẫn từ mỗi thìa. Với sự kết hợp tinh tế giữa gà, cơm, mỡ hành và các loại gia vị, món ăn này chắc chắn sẽ làm hài lòng cả vị giác lẫn thị giác của bạn.\r\n\r\nHương Vị Đậm Đà:\r\n\r\nGà Nướng Mềm Mịn: Chúng tôi sử dụng gà tươi ngon, được nướng mềm mịn và thấm đẫm vị gia vị, tạo nên một lớp vị đặc biệt và thơm ngon cho mỗi miếng thịt gà.\r\nCơm Ngon Hấp Dẫn: Cơm được chế biến từ hạt gạo chọn lọc, hòa quện hoàn hảo với lớp mỡ hành và gia vị, tạo nên một hương vị đậm đà và ngon miệng.\r\nNguyên Liệu Tươi Mát:\r\n\r\nMỡ Hành Thơm Ngon: Mỡ hành được chế biến từ mỡ heo và hành tươi, tạo nên một hương vị đặc biệt và thơm ngon, kết hợp hoàn hảo với cơm và gà.\r\nRau Xanh Tươi Mát: Các loại rau sống như dưa leo, rau sống, cà rốt và hành tây được thêm vào cơm gà xối mỡ để tăng thêm vị tươi mát và dinh dưỡng.', 35000, 0, 0, 0),
(7, '03', 'Dalat Graden', NULL, 'product-7.jpg', 'Tại Tiệm Trái Cây của chúng tôi, chúng tôi tự hào mang đến cho quý khách hàng những trái cây tươi ngon nhất từ những vườn trái cây chọn lọc. Mỗi loại trái cây đều được lựa chọn kỹ lưỡng và kiểm tra chất lượng để đảm bảo mang lại sự tươi mát và hương vị tốt nhất cho mỗi khách hàng.\r\n\r\nĐa Dạng Loại Trái Cây:\r\n\r\nTrái Cây Mùa: Tại Tiệm Trái Cây của chúng tôi, bạn có thể tìm thấy những loại trái cây mùa phong phú như dưa hấu, xoài, lê, cam, và nhiều loại trái cây khác, mang lại một hương vị đặc biệt và tươi mát cho mỗi miếng thưởng thức.\r\nTrái Cây Nhập Khẩu: Ngoài những loại trái cây mùa, chúng tôi cũng cung cấp các loại trái cây nhập khẩu từ các quốc gia khác nhau, như kiwi New Zealand, nho Mỹ, và cherry Chile, mang đến sự đa dạng và phong phú cho thực đơn của chúng tôi.\r\nChất Lượng Đảm Bảo:\r\n\r\nTrái Cây Tươi Mát: Chúng tôi cam kết mang đến cho khách hàng những trái cây tươi mát nhất, được bảo quản và chăm sóc đúng cách từ khi thu hoạch cho đến khi đến tay khách hàng.\r\nKiểm Tra Chất Lượng: Mỗi loại trái cây được kiểm tra chất lượng kỹ lưỡng trước khi được bày bán, đảm bảo không có trái cây nào bị hỏng hoặc không chất lượng được bày bán tại cửa hàng của chúng tôi.', 120000, 0, 0, 0),
(8, '02', 'Pizza Hut', NULL, 'product-8.jpg', '\r\nPizza Hut - Hương Vị Ý Tưởng Tại Pizza Hut\r\nTại Pizza Hut, chúng tôi tự hào mang đến cho quý khách hàng những chiếc pizza tươi mới, đầy đủ hương vị và sự sáng tạo từ những nguyên liệu chất lượng nhất. Mỗi chiếc pizza đều được chế biến tỉ mỉ và nướng chín hoàn hảo, mang lại một trải nghiệm ẩm thực thú vị và đậm đà.\r\n\r\nSự Đa Dạng trong Lựa Chọn:\r\n\r\nPizza Truyền Thống: Với những loại pizza truyền thống như Pizza Margherita, Pizza Pepperoni, và Pizza Hawaiian, chúng tôi đảm bảo mang lại cho khách hàng những món pizza với hương vị đặc trưng và phong phú.\r\nPizza Sáng Tạo: Ngoài ra, chúng tôi cũng cung cấp những loại pizza sáng tạo và độc đáo như Pizza BBQ Gà, Pizza Hải Sản, và Pizza Rau Củ, để khách hàng có thêm nhiều lựa chọn mới mẻ và thú vị.\r\nNguyên Liệu Chất Lượng:\r\n\r\nNguyên Liệu Tươi Mới: Chúng tôi chỉ sử dụng những nguyên liệu tươi mới nhất cho mỗi chiếc pizza, từ bánh pizza, sốt cà chua, đến các loại nhân và phủ bên trên.\r\nPhô Mai Sành Điệu: Phô mai được sử dụng trong mỗi chiếc pizza đều là loại phô mai cao cấp, tạo nên lớp phủ mịn màng và thơm ngon cho mỗi miếng pizza.', 99000, 0, 0, 0),
(9, '01', 'Bún riêu Thanh Kiệp', NULL, 'product-9.jpg', 'Bún Riêu Thanh Kiệp - Hương Vị Đậm Đà Tại Quán Bún Riêu Thanh Kiệp\r\n\r\nTại Quán Bún Riêu của chúng tôi, chúng tôi tự hào giới thiệu một trong những món ăn đặc trưng của ẩm thực miền Nam Việt Nam - Bún Riêu Cua. Mỗi dĩa bún riêu cua tại quán của chúng tôi không chỉ là sự kết hợp tinh tế của các nguyên liệu tươi ngon mà còn là một trải nghiệm về hương vị đậm đà và bổ dưỡng.\r\n\r\nHương Vị Đặc Trưng:\r\n\r\nRiêu Cua Thơm Ngon: Chúng tôi sử dụng riêu cua được chế biến từ cua tươi ngon, tạo nên một lớp nước dùng đậm đà, thơm ngon và đầy đặn vị cua.\r\nBún Mềm Mịn: Bún được chế biến từ bột mì tươi ngon, giòn mịn và dẻo dai, tạo nên sự kết hợp hoàn hảo với riêu cua và các loại rau sống.\r\nNguyên Liệu Tươi Mới:\r\n\r\nCua Tươi Nguyên Con: Chúng tôi chỉ sử dụng cua tươi nguyên con, được chế biến và làm sạch kỹ lưỡng trước khi nấu, đảm bảo hương vị và chất lượng tốt nhất cho mỗi dĩa bún riêu cua.\r\nRau Xanh Tươi Mát: Mỗi dĩa bún riêu cua được thêm vào các loại rau sống như rau sống, mùng tơi, rau mùi và giá, tạo nên sự tươi mát và bổ dưỡng cho món ăn.\r\nTrải Nghiệm Ẩm Thực:', 25000, 0, 0, 0),
(10, '02', 'Chè cô Chu', NULL, 'product-10.jpg', 'Chè Truyền Thống - Hương Vị Độc Đáo Tại Quán Chè Cô Chu\r\n\r\nTại Quán Chè Cô Chu, chúng tôi tự hào giới thiệu những món chè truyền thống đậm đà hương vị, được chế biến và phục vụ với sự tỉ mỉ và tinh tế. Mỗi tô chè tại quán của chúng tôi không chỉ là sự kết hợp tinh tế của các nguyên liệu chất lượng mà còn là một trải nghiệm về hương vị và truyền thống ẩm thực Việt Nam.\r\n\r\nHương Vị Đặc Trưng:\r\n\r\nĐa Dạng Loại Chè: Chúng tôi cung cấp một loạt các loại chè đa dạng như chè đậu xanh, chè thập cẩm, chè bưởi, chè hạt lựu, và nhiều loại chè khác, mỗi loại mang lại một hương vị và cảm nhận riêng biệt.\r\nĐộ Ngọt Vừa Phải: Mỗi tô chè được chế biến với độ ngọt vừa phải, không quá ngọt quá cloying, tạo nên một sự cân đối và hài hòa về hương vị.\r\nNguyên Liệu Chất Lượng:\r\n\r\nNguyên Liệu Tươi Mới: Chúng tôi chỉ sử dụng những nguyên liệu tươi mới nhất cho mỗi tô chè, từ đậu xanh, đậu đỏ, nước cốt dừa, đến các loại hạt và nước cốt trái cây, đảm bảo hương vị và chất lượng tốt nhất.\r\nPhô Mai Sành Điệu: Đối với các loại chè có phô mai, chúng tôi sử dụng phô mai cao cấp, tạo nên lớp phủ mịn màng và thơm ngon cho mỗi tô chè.', 27000, 0, 0, 0),
(11, '01', 'Sabu Sabu', NULL, 'product-11.jpg', 'Lẩu Sabu Sabu - Hòa Quyện Hương Vị Á Đông Tại Quán Sabu Sabu\r\n\r\nTại Quán Sabu Sabu, chúng tôi tự hào giới thiệu một trong những món ăn đặc trưng của ẩm thực Á Đông - Lẩu Sabu Sabu. Mỗi bữa lẩu tại quán của chúng tôi không chỉ là sự kết hợp tinh tế của các nguyên liệu tươi ngon mà còn là một trải nghiệm về hương vị và sự đa dạng trong ẩm thực.\r\n\r\nHương Vị Độc Đáo:\r\n\r\nHương Vị Lẩu Đặc Trưng: Lẩu Sabu Sabu của chúng tôi có hương vị đặc trưng, với nước dùng ngọt tự nhiên từ xương gà, hải sản và rau củ, tạo nên một hòa quyện độc đáo và hấp dẫn.\r\nĐa Dạng Lựa Chọn: Chúng tôi cung cấp nhiều loại nước dùng khác nhau như nước dùng cay, nước dùng chua ngọt, nước dùng cà ri, để khách hàng có thêm nhiều lựa chọn hương vị.\r\nNguyên Liệu Tươi Mới:\r\n\r\nThực Phẩm Chất Lượng: Chúng tôi chỉ sử dụng thực phẩm tươi mới nhất cho mỗi bữa lẩu, từ thịt bò, thịt gà, hải sản, đến rau củ, đảm bảo chất lượng và hương vị tốt nhất cho thực khách.\r\nHải Sản Tươi Ngon: Những loại hải sản như tôm, cá, mực, và sò điệp được chọn lọc kỹ lưỡng và sơ chế một cách tỉ mỉ để đảm bảo độ tươi ngon và nguyên vẹn.', 120000, 0, 0, 0),
(12, '02', 'Highland', NULL, 'product-12.jpg', ' Highland Coffee - Hòa Quyện Hương Vị Cà Phê Đặc Trưng\r\nChúng tôi không chỉ tự hào về những ly cà phê tinh tế mà còn mang lại cho khách hàng những trải nghiệm thưởng thức ly nước độc đáo và đậm đà. Mỗi ly nước tại quán của chúng tôi không chỉ là sự kết hợp tinh tế của các nguyên liệu chất lượng mà còn là một trải nghiệm thưởng thức cà phê đặc trưng của Highland.\r\n\r\nHương Vị Đặc Trưng:\r\n\r\nLy Cà Phê Highland: Với cà phê chế biến từ hạt cà phê Arabica chọn lọc, mỗi giọt cà phê mang lại hương vị đậm đà, thơm ngon và đầy đặn.\r\nLy Cà Phê Pha Phin: Sử dụng phin truyền thống, cà phê pha phin tại quán mang lại hương vị đặc trưng, mạnh mẽ và đậm đà của cà phê Việt Nam.\r\nĐa Dạng Lựa Chọn:\r\n\r\nCà Phê Đá: Cho những ngày nắng nóng, khách hàng có thể lựa chọn cà phê đá - một ly cà phê mát lạnh, thơm ngon và sảng khoái.\r\nCà Phê Sữa Đá: Sự kết hợp hài hòa giữa cà phê đậm đà và sữa đặc ngọt ngào, tạo nên một hương vị đặc trưng của cà phê Việt Nam.', 65000, 100, 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phuong`
--

CREATE TABLE `phuong` (
  `P_MA` int(10) NOT NULL,
  `P_TEN` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `quanhuyen`
--

CREATE TABLE `quanhuyen` (
  `QH_MA` int(10) NOT NULL,
  `P_MA` int(10) NOT NULL,
  `QH_TEN` char(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`AD_id`);

--
-- Chỉ mục cho bảng `bao_gom`
--
ALTER TABLE `bao_gom`
  ADD PRIMARY KEY (`BG_MA`),
  ADD KEY `BAO_GOM_FK` (`HD_MA`),
  ADD KEY `BAO_GOM2_FK` (`MA_MA`);

--
-- Chỉ mục cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD PRIMARY KEY (`HD_MA`,`MA_MA`),
  ADD UNIQUE KEY `HD_MA` (`HD_MA`) USING BTREE,
  ADD KEY `chitiethoadon_ibfk_2` (`MA_MA`);

--
-- Chỉ mục cho bảng `chitietmonan`
--
ALTER TABLE `chitietmonan`
  ADD UNIQUE KEY `MA_MA` (`MA_MA`) USING BTREE;

--
-- Chỉ mục cho bảng `co_loai_mon_an`
--
ALTER TABLE `co_loai_mon_an`
  ADD KEY `CO_LOAI_MON_AN2_FK` (`LMA_MA`),
  ADD KEY `QA_MA` (`QA_MA`);

--
-- Chỉ mục cho bảng `co_mon_an`
--
ALTER TABLE `co_mon_an`
  ADD PRIMARY KEY (`LMA_MA`,`MA_MA`),
  ADD KEY `CO_MON_AN_FK` (`LMA_MA`),
  ADD KEY `CO_MON_AN2_FK` (`MA_MA`);

--
-- Chỉ mục cho bảng `duoc_viet_vao`
--
ALTER TABLE `duoc_viet_vao`
  ADD PRIMARY KEY (`RW_MA`);

--
-- Chỉ mục cho bảng `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FB_MA`);

--
-- Chỉ mục cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`HD_MA`),
  ADD KEY `KH_MA` (`KH_MA`);

--
-- Chỉ mục cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`KH_MA`);

--
-- Chỉ mục cho bảng `loaimonan`
--
ALTER TABLE `loaimonan`
  ADD PRIMARY KEY (`LMA_MA`);

--
-- Chỉ mục cho bảng `monan`
--
ALTER TABLE `monan`
  ADD PRIMARY KEY (`MA_MA`),
  ADD KEY `FK_MONAN` (`LMA_MA`);

--
-- Chỉ mục cho bảng `phuong`
--
ALTER TABLE `phuong`
  ADD PRIMARY KEY (`P_MA`),
  ADD UNIQUE KEY `PHUONG_PK` (`P_MA`);

--
-- Chỉ mục cho bảng `quanhuyen`
--
ALTER TABLE `quanhuyen`
  ADD PRIMARY KEY (`QH_MA`),
  ADD KEY `P_MA` (`P_MA`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `AD_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `bao_gom`
--
ALTER TABLE `bao_gom`
  MODIFY `BG_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT cho bảng `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FB_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `HD_MA` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1555037803;

--
-- AUTO_INCREMENT cho bảng `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `KH_MA` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `monan`
--
ALTER TABLE `monan`
  MODIFY `MA_MA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `phuong`
--
ALTER TABLE `phuong`
  MODIFY `P_MA` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `quanhuyen`
--
ALTER TABLE `quanhuyen`
  MODIFY `QH_MA` int(10) NOT NULL AUTO_INCREMENT;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `bao_gom`
--
ALTER TABLE `bao_gom`
  ADD CONSTRAINT `bao_gom_ibfk_1` FOREIGN KEY (`HD_MA`) REFERENCES `hoadon` (`HD_MA`);

--
-- Các ràng buộc cho bảng `chitiethoadon`
--
ALTER TABLE `chitiethoadon`
  ADD CONSTRAINT `chitiethoadon_ibfk_1` FOREIGN KEY (`HD_MA`) REFERENCES `hoadon` (`HD_MA`),
  ADD CONSTRAINT `chitiethoadon_ibfk_2` FOREIGN KEY (`MA_MA`) REFERENCES `monan` (`MA_MA`);

--
-- Các ràng buộc cho bảng `chitietmonan`
--
ALTER TABLE `chitietmonan`
  ADD CONSTRAINT `chitietmonan_ibfk_1` FOREIGN KEY (`MA_MA`) REFERENCES `monan` (`MA_MA`);

--
-- Các ràng buộc cho bảng `co_loai_mon_an`
--
ALTER TABLE `co_loai_mon_an`
  ADD CONSTRAINT `co_loai_mon_an_ibfk_1` FOREIGN KEY (`LMA_MA`) REFERENCES `co_mon_an` (`LMA_MA`);

--
-- Các ràng buộc cho bảng `co_mon_an`
--
ALTER TABLE `co_mon_an`
  ADD CONSTRAINT `co_mon_an_ibfk_1` FOREIGN KEY (`LMA_MA`) REFERENCES `loaimonan` (`LMA_MA`);

--
-- Các ràng buộc cho bảng `hoadon`
--
ALTER TABLE `hoadon`
  ADD CONSTRAINT `hoadon_ibfk_4` FOREIGN KEY (`KH_MA`) REFERENCES `khachhang` (`KH_MA`);

--
-- Các ràng buộc cho bảng `monan`
--
ALTER TABLE `monan`
  ADD CONSTRAINT `FK_MONAN` FOREIGN KEY (`LMA_MA`) REFERENCES `loaimonan` (`LMA_MA`);

--
-- Các ràng buộc cho bảng `quanhuyen`
--
ALTER TABLE `quanhuyen`
  ADD CONSTRAINT `quanhuyen_ibfk_2` FOREIGN KEY (`P_MA`) REFERENCES `phuong` (`P_MA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
