/*
 Navicat Premium Data Transfer

 Source Server         : phpmyadmin
 Source Server Type    : MySQL
 Source Server Version : 100418
 Source Host           : localhost:3306
 Source Schema         : library2021

 Target Server Type    : MySQL
 Target Server Version : 100418
 File Encoding         : 65001

 Date: 18/09/2021 21:16:16
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `FullName` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `AdminEmail` varchar(120) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL,
  `UserName` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Password` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `updationDate` timestamp(0) NOT NULL ON UPDATE CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES (2, 'Clive Dela Cruz', 'doantotnghiep@gmail.com', 'admin', '0e7517141fb53f21ee439b355b5a1d0a', '2021-09-11 12:44:24');

-- ----------------------------
-- Table structure for lend
-- ----------------------------
DROP TABLE IF EXISTS `lend`;
CREATE TABLE `lend`  (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `book_id` int(6) NOT NULL,
  `book_title` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `lend_time` date NOT NULL,
  `return_time` date NULL DEFAULT NULL,
  `user_id` int(3) NOT NULL,
  PRIMARY KEY (`id`, `user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 171 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of lend
-- ----------------------------
INSERT INTO `lend` VALUES (142, 74, '', '2020-02-20', '2020-10-02', 76);
INSERT INTO `lend` VALUES (144, 88, '', '2020-02-20', '2020-12-03', 75);
INSERT INTO `lend` VALUES (147, 104, '', '2020-08-18', '2021-03-13', 82);
INSERT INTO `lend` VALUES (148, 103, '', '2020-08-18', '2021-02-04', 82);
INSERT INTO `lend` VALUES (150, 101, '', '2020-08-18', '2021-05-10', 82);
INSERT INTO `lend` VALUES (151, 100, '', '2020-08-19', '0000-00-00', 82);
INSERT INTO `lend` VALUES (152, 102, '', '2020-08-19', '2021-02-15', 82);
INSERT INTO `lend` VALUES (164, 103, '', '2020-11-24', '2021-07-16', 84);
INSERT INTO `lend` VALUES (165, 104, '', '2020-11-29', '2021-09-22', 84);
INSERT INTO `lend` VALUES (166, 102, '', '2020-11-29', NULL, 84);

-- ----------------------------
-- Table structure for tblcategory
-- ----------------------------
DROP TABLE IF EXISTS `tblcategory`;
CREATE TABLE `tblcategory`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `CategoryName` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `Status` int(1) NULL DEFAULT NULL,
  `Number` int(11) NULL DEFAULT 0,
  `CreationDate` timestamp(0) NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 18 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of tblcategory
-- ----------------------------
INSERT INTO `tblcategory` VALUES (4, '商学', 1, 0, '2021-09-05 20:17:21');
INSERT INTO `tblcategory` VALUES (5, '語学', 1, 0, '2021-09-05 20:19:30');
INSERT INTO `tblcategory` VALUES (6, '英語', 1, 0, '2021-09-05 20:19:57');
INSERT INTO `tblcategory` VALUES (7, 'プログラミング', 1, 0, '2021-09-05 20:20:28');
INSERT INTO `tblcategory` VALUES (8, '技術', 1, 0, '2021-09-06 08:08:20');
INSERT INTO `tblcategory` VALUES (17, 'test', 1, 12, '2021-09-13 10:29:29');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `number` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `password` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `email` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `tel` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  `address` varchar(225) CHARACTER SET utf8 COLLATE utf8_bin NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 89 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (27, 'xiguangjie', '18TE000', 'b59c67bf196a4758191e42f76670ceba', '1258328066@yahoo.co.jp', '080****9889', '東京都江東区亀戸1－2－2');
INSERT INTO `user` VALUES (60, 'xigua', '', 'b59c67bf196a4758191e42f76670ceba', '12331@qq.com', '1232431', '1212222');
INSERT INTO `user` VALUES (62, 'nhat12', '18TE700', 'e10adc3949ba59abbe56e057f20f883e', 'nhatnv950@gmail.com', '0902255', 'hai duong');
INSERT INTO `user` VALUES (63, 'nhatnv123', '', 'e10adc3949ba59abbe56e057f20f883e', 'nhatnv950@gmail.com', '0902255', 'tokyo');
INSERT INTO `user` VALUES (64, 'nhatnv', '18TE900', '827ccb0eea8a706c4c34a16891f84e7b', 'nhatnv950@gmail.com', '111', '111');
INSERT INTO `user` VALUES (65, 'tuannv', '', '827ccb0eea8a706c4c34a16891f84e7b', 'haui@gmail.com', '090002', '東京');
INSERT INTO `user` VALUES (72, '11', '', 'b59c67bf196a4758191e42f76670ceba', '123@qq.com', '03-2101-1545', '台東区');
INSERT INTO `user` VALUES (73, 'ning', '23TE456', 'b59c67bf196a4758191e42f76670ceba', '123@qq.com', '03-2101-1545', '台東区');
INSERT INTO `user` VALUES (74, 'ninglei', '', 'b59c67bf196a4758191e42f76670ceba', '123@qq.com', '03-2101-1545', '台東区');
INSERT INTO `user` VALUES (75, '田中二朗', '18TE777', '888c9ca4c82c4c0fed4d7b0fecf7ef85', 'tanakajiro@gmail.com', '123-456-7888', '台東区7-7-4');
INSERT INTO `user` VALUES (76, 'akiko', '', 'fb793a32ca76c662219266a71dbb7f24', 'akiko777@gmail.com', '123-456-7890', '台東区7-7-4');
INSERT INTO `user` VALUES (77, 'nei', '', 'b59c67bf196a4758191e42f76670ceba', 'l55698174@gmail.com', '0132546452', 'adf');
INSERT INTO `user` VALUES (78, 'asa', '21TE444', '6b620aedfa4cf153467265629501dd61', '123@qq.com', '01233212', '東京');
INSERT INTO `user` VALUES (79, 'assa', '', '6b620aedfa4cf153467265629501dd61', '123@qq.com', '01233212', '東京');
INSERT INTO `user` VALUES (80, 'assa', '', '6b620aedfa4cf153467265629501dd61', '123@qq.com', '01233212', '東京');
INSERT INTO `user` VALUES (81, 'tom', '', '96e79218965eb72c92a549dd5a330112', 'admin@qq.com', '13788990099', '111111');
INSERT INTO `user` VALUES (82, '田中太郎', '18TE500', '202cb962ac59075b964b07152d234b70', '1454275684@qq.com', '08066667777', '東京都北区赤羽1丁目3-13');
INSERT INTO `user` VALUES (83, '123', '', '202cb962ac59075b964b07152d234b70', 'admin1@QQ.com', '12345678909', '22222');
INSERT INTO `user` VALUES (84, '鈴木', '', 'f7748d6b07a7f1edc8b25af9eba89064', 'suzuji@gmail.com', '08037462838', '東京都');
INSERT INTO `user` VALUES (85, '1111', '18te111', 'b59c67bf196a4758191e42f76670ceba', '111@gasddg.com', '08011112222', '1111');

-- ----------------------------
-- Table structure for yoyaku
-- ----------------------------
DROP TABLE IF EXISTS `yoyaku`;
CREATE TABLE `yoyaku`  (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `book_id` int(6) NOT NULL,
  `user_id` int(3) NOT NULL,
  `user_number` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `booking_time` date NOT NULL,
  `user_email` varchar(225) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `book_title` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `book_w` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`, `user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yoyaku
-- ----------------------------
INSERT INTO `yoyaku` VALUES (1, 80, 62, '10', '2021-08-30', 'adad@gmail.com', '', '');

-- ----------------------------
-- Table structure for yx_books
-- ----------------------------
DROP TABLE IF EXISTS `yx_books`;
CREATE TABLE `yx_books`  (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `price` int(11) NULL DEFAULT NULL,
  `images` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `detail` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `uploadtime` datetime(0) NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP(0),
  `type` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `total` int(11) NULL DEFAULT NULL,
  `CatId` int(11) NULL DEFAULT 0,
  `borrow` int(11) NULL DEFAULT NULL,
  `leave_number` int(11) NULL DEFAULT NULL,
  `writer` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `publisher` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `ISBN` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  `link` text CHARACTER SET utf8 COLLATE utf8_bin NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 116 CHARACTER SET = utf8 COLLATE = utf8_bin ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of yx_books
-- ----------------------------
INSERT INTO `yx_books` VALUES (80, 'ASP.NET', 3456, 'asp.jpg', 'ASP.NET MVCはWebアプリケーションの開発手法の1つで、MVC（Model-View-Controller）パターンを使って、Model、View、Controllerという3つの部分に分割してアプリ設計します。', '2021-09-05 23:05:46', 'プログラミング', 0, 7, 7, 6, '増田 智明', '日経BP', '9784822298883', 'https://www.amazon.co.jp/dp/B01N32BTAU/ref=cm_sw_r_cp_api_i_M2j-Db4KEVSQ0\r\n');
INSERT INTO `yx_books` VALUES (65, 'サクッとうかる日商1級', 4850, 'nisho.jpg', '有価証券の保有目的変更、固定資産の割賦購入。新出題区分に完全対応!', '2021-09-05 23:07:24', '商学', 22, 4, 1, 4, 'ネットスクール', 'ネットスクール; 改訂七版', '978-4781011615', 'https://www.amazon.co.jp/dp/4781011616/ref=cm_sw_r_cp_api_i_Zhk-DbFVB5AN7');
INSERT INTO `yx_books` VALUES (71, '日本語総まとめ N1 語彙', 1500, 'N1.jpg', 'ご好評いただいた特長はそのままに、「日本語総まとめ問題集」が、新しい試験に合わせて生まれ変わりました!', '2021-09-05 23:06:56', '語学', 30, 5, 0, 7, '佐々木 仁子 ', 'アスク; B5版', '978-4872177251', 'https://www.amazon.co.jp/dp/4872177258/ref=cm_sw_r_cp_api_i_ack-Db238KW81');
INSERT INTO `yx_books` VALUES (72, '2019年度版CAD利用技術者試験2次元', 3666, 'CAD_1.jpg', 'コンピュータ教育振興協会が主催している「2次元CAD利用技術者基礎試験」や「2次元CAD利用技術者試験2級」を受験する人のための公式ガイドブック(学習書)です。', '2021-09-05 23:11:47', '', 22, 4, 0, 10, 'コンピュータ教育振興協会', '日経BP', '978-4822296780', 'https://www.amazon.co.jp/dp/4822296784/ref=cm_sw_r_cp_api_i_Ahk8DbHDWA6QP');
INSERT INTO `yx_books` VALUES (84, 'リンパの科学', 1100, 'kagaku_1.jpg', '躍動する奔流=血液の氾濫を再吸収し、 体内の水分を有効活用するために誕生したリンパ。', '2021-09-05 13:23:15', '技術', 19, 8, 1, 7, '加藤 征治', '講談社', '978-4062578202', 'https://www.amazon.co.jp/dp/4062578204/ref=cm_sw_r_cp_api_i_K3y-DbG1F2TYR');
INSERT INTO `yx_books` VALUES (81, '独習C 第4版', 3520, 'dokusyu.jpg', '『独習C』は世界中で多くの読者に支持されている、C言語の標準教科書です。', '2021-09-12 20:03:48', 'プログラミング', 18, 7, 0, 7, 'ハーバート・シルト', '翔泳社', '978-4798115771', 'https://www.amazon.co.jp/%E7%8B%AC%E7%BF%92C-%E7%AC%AC4%E7%89%88-%E3%83%8F%E3%83%BC%E3%83%90%E3%83%BC%E3%83%88%E3%83%BB%E3%82%B7%E3%83%AB%E3%83%88/dp/4798115770/ref=pd_aw_sbs_14_7?_encoding=UTF8&pd_rd_i=4798115770&pd_rd_r=71e1799b-aa24-4a52-a2b9-754026ccc100&pd_rd_w=4Gmzo&pd_rd_wg=NHbQb&pf_rd_p=1893a417-ba87-4709-ab4f-0dece788c310&pf_rd_r=7KJMTWSSF8CKJVZ4EEDP&psc=1&refRID=7KJMTWSSF8CKJVZ4EEDP');
INSERT INTO `yx_books` VALUES (82, 'Ruby言語', 3500, 'ruby.jpg', 'Rubyの文法をサンプルコードで学び、例題でプログラミングの流れを体験できる解説書です。 ほかのプログラミング言語で開発経験のある人が、Rubyを学ぶ際に効率的に学べる内容を詰め込みました。', '2021-09-05 23:09:12', '', 0, 7, 1, 4, '山本', '川嶋', '12234', 'https://www.amazon.co.jp/dp/4774193976/ref=cm_sw_r_cp_api_i_0Xj-DbR9GTZBH');
INSERT INTO `yx_books` VALUES (73, 'TOEIC(R)L&R TEST英単語ス', 1540, 'toeic_1.jpg', 'TOEICによく出る3000語を収録した単語集。圧倒的なカバー率で、入門者から高得点ねらいにまで対応する。', '2021-09-12 20:04:52', '語学', 22, 5, 0, 6, '成重 寿', 'Jリサーチ出版; 第3版', '978-4863923744', 'https://www.amazon.co.jp/dp/4863923740/ref=cm_sw_r_cp_api_i_Sak-DbZ5Z4BC5');
INSERT INTO `yx_books` VALUES (103, 'TOEIC(R)TEST長文読解TARG', 1430, 'toeic900.jpg', '大幅なスコアアップに必須のパート7にフォーカスしたコンパクトサイズの問題集。', '2021-09-05 23:11:32', '', 26, 6, 6, 30, '森田 鉄也', 'Jリサーチ出版 ', '978-4863922006', 'https://www.amazon.co.jp/dp/4863922000/ref=sspa_dk_detail_6?psc=1&spLa=ZW5jcnlwdGVkUXVhbGlmaWVyPUEzTTdFSTFWMDJFTTRTJmVuY3J5cHRlZElkPUEwNTMyMTA4MlVEVFZQNkNTQjZTNiZlbmNyeXB0ZWRBZElkPUFaN0dXVjZSRVpTV1Imd2lkZ2V0TmFtZT1zcF9kZXRhaWwmYWN0aW9uPWNsaWNrUmVkaXJlY3QmZG9Ob3RMb2dDbGljaz10cnVl');
INSERT INTO `yx_books` VALUES (74, 'わかりやすいJavaEEウェブシステム', 3148, 'javaee.jpg', 'JavaEE7準拠。ショッピングサイトや業務システムで使われるJavaEE学習書の決定版!やさしいコトバで「わかる」説明。専門用語を知らなくても安心。本当に動く、試して学べる、豊富な例題。はじめてでもできるシステム開発のやり方。', '2021-09-05 13:23:27', 'プログラミング', 10, 8, 1, 7, '川場 隆 ', '秀和システム', '4454-78787-787', 'https://www.amazon.co.jp/%E3%82%8F%E3%81%8B%E3%82%8A%E3%82%84%E3%81%99%E3%81%84JavaEE%E3%82%A6%E3%82%A7%E3%83%96%E3%82%B7%E3%82%B9%E3%83%86%E3%83%A0%E5%85%A5%E9%96%80-%E5%B7%9D%E5%A0%B4-%E9%9A%86/dp/4798042161/ref=tmm_hrd_swatch_0?_encoding=UTF8&qid=&sr=');
INSERT INTO `yx_books` VALUES (85, '簿記教科書', 1650, 'boki2.jpg', '範囲改定のあった3級の復習も掲載し、 試験範囲の改定による勉強の抜けもしっかりフォロー!', '2021-09-05 14:41:44', '経済 1', 12, 4, 0, 5, 'よせだ あつこ 1', ' 翔泳社; 第5版', '978-4798158297', 'https://www.amazon.co.jp/%E7%B0%BF%E8%A8%98%E6%95%99%E7%A7%91%E6%9B%B8-%E3%83%91%E3%83%96%E3%83%AD%E3%83%95%E6%B5%81%E3%81%A7%E3%81%BF%E3%82%93%E3%81%AA%E5%90%88%E6%A0%BC-%E6%97%A5%E5%95%86%E7%B0%BF%E8%A8%982%E7%B4%9A-%E5%95%86%E6%A5%AD%E7%B0%BF%E8%A8%98-%E3%83%86%E3%82%AD%E3%82%B9%E3%83%88/dp/4798158291/ref=pd_aw_sbs_14_6/357-4098857-7533247?_encoding=UTF8&pd_rd_i=4798158291&pd_rd_r=4d68e057-04d1-480b-b692-26456fa825fb&pd_rd_w=SH2bK&pd_rd_wg=wPFEG&pf_rd_p=1893a417-ba87-4709-ab4f-0dece788c310&pf_rd_r=1YH14NNGDF2BKB6PSWQV&psc=1&refRID=1YH14NNGDF2BKB6PSWQV');
INSERT INTO `yx_books` VALUES (76, '経営学の基本', 2600, 'keei.jpg', '第１章　企業システムとはー企業とその仕組みについて理解する／第２章　経営戦略とはー売上アップ・利益アップを狙うために／第３章　経営組織とはービジネスを行う実践部隊／第４章　経営管理とはー経営戦略の実行と評価／第５章　経営課題とはー生き残るために解決すべきこと／第６章　マネジメントとはー成果を上げて社会に貢献するために', '2021-09-05 23:11:20', '', 2, 4, 0, 8, '加藤', '森', '155-4877-7878', 'https://www.amazon.co.jp/dp/B012MLIV2S/ref=cm_sw_r_cp_api_i_R7j-DbFTYES6D\r\n');
INSERT INTO `yx_books` VALUES (77, '商学への招待', 1800, 'images.jpg', '商学の考え方を学べる入門書。会社・金融の制度からｅコマースまで、初学者に必要かつ十分な事項を厳選し、身近なトピックを使ってわかりやすく解説する。【「TRC MARC」の商品解説】', '2021-09-05 23:10:46', '', 3, 4, 0, 13, '石原 武政', '原', '155-748787-787', 'https://www.amazon.co.jp/dp/4641184178/ref=cm_sw_r_cp_api_i_x3j-Db88X4WZW');
INSERT INTO `yx_books` VALUES (88, 'よくわかるPHPの教科書', 2728, 'php.jpg', 'やさしい解説に定評のあるベストセラーがPHP7に対応。', '2021-09-12 20:05:52', 'プログラミング', 9, 7, 2, 10, 'たにぐちまこと', 'マイナビ出版', '978-4839964689', 'https://www.amazon.co.jp/dp/4839964688/ref=cm_sw_r_cp_api_i_ZQi8DbD6PSDM3');
INSERT INTO `yx_books` VALUES (100, '新・明解Java入門', 2970, 'mkJ.jpg', 'プログラミング言語教育界の巨匠による Java入門書の最高峰!!', '2021-09-05 13:23:39', 'プログラミング', 18, 7, 5, 7, '柴田 望洋', 'SBクリエイティブ', '9784797387605', 'https://www.amazon.co.jp/%E6%96%B0%E3%83%BB%E6%98%8E%E8%A7%A3Java%E5%85%A5%E9%96%80-%E6%98%8E%E8%A7%A3%E3%82%B7%E3%83%AA%E3%83%BC%E3%82%BA-%E6%9F%B4%E7%94%B0-%E6%9C%9B%E6%B4%8B/dp/4797387602/ref=tmm_hrd_swatch_0?_encoding=UTF8&qid=&sr=');
INSERT INTO `yx_books` VALUES (101, '新・明解C言語 入門編 ', 2530, 'cmk.jpg', '超ベスト&超ロングセラーの大改訂版 C言語入門書の最高峰', '2021-09-12 20:06:30', 'プログラミング', 10, 7, 4, 12, '柴田 望洋', 'SBクリエイティブ', '9784797377026', 'https://www.amazon.co.jp/%E6%96%B0%E3%83%BB%E6%98%8E%E8%A7%A3C%E8%A8%80%E8%AA%9E-%E5%85%A5%E9%96%80%E7%B7%A8-%E6%98%8E%E8%A7%A3%E3%82%B7%E3%83%AA%E3%83%BC%E3%82%BA-%E6%9F%B4%E7%94%B0-%E6%9C%9B%E6%B4%8B/dp/479737702X/ref=zg_bs_754382_18?_encoding=UTF8&psc=1&refRID=F11GGF6XP5JVZHS8AQ5G');
INSERT INTO `yx_books` VALUES (102, 'PHPフレームワークLaravel入門 ', 3300, 'Laravel.jpg', '人気No. 1 PHPフレームワークのロングセラー定番解説書が、新バージョン対応で改訂!PHPでWebアプリケーションを開発するフレームワークには種々ありますが、圧倒的人気ナンバーワンはLaravel(ララベル)! 本書は、2017年9月の刊行以来大好評を博している『PHPフレームワークLaravel入門』を、2019年9月リリースのバージョン6に対応して全', '2021-09-05 13:23:45', 'プログラミング', 19, 8, 6, 21, '掌田 津耶乃', '秀和システム; 第2版', '9784798060996', 'https://www.amazon.co.jp/PHP%E3%83%95%E3%83%AC%E3%83%BC%E3%83%A0%E3%83%AF%E3%83%BC%E3%82%AFLaravel%E5%85%A5%E9%96%80-%E7%AC%AC%EF%BC%92%E7%89%88-%E6%8E%8C%E7%94%B0-%E6%B4%A5%E8%80%B6%E4%B9%83/dp/4798060992/ref=pd_aw_sbs_14_1/355-5625235-5374629?_encoding=UTF8&pd_rd_i=4798060992&pd_rd_r=8c6b1783-986c-43d0-815c-0b52b7df8c40&pd_rd_w=Reidx&pd_rd_wg=Wd9ro&pf_rd_p=aeee4cf9-9af8-43b4-b05c-0ae7c82d9d5e&pf_rd_r=HWRBC3XN6SYJZBX1PQZV&psc=1&refRID=HWRBC3XN6SYJZBX1PQZV');
INSERT INTO `yx_books` VALUES (104, '令和02年【春期】 基本情報技術者', 1628, 'jyohou.jpg', '合計18回分の演習ができる超定番の対策問題集。', '2021-09-05 13:23:47', 'プログラミング', 29, 4, 10, 37, '山本 三雄', '技術評論社; 第37版', '9784297109615', 'https://www.amazon.co.jp/%E4%BB%A4%E5%92%8C02%E5%B9%B4%E3%80%90%E6%98%A5%E6%9C%9F%E3%80%91-%E5%9F%BA%E6%9C%AC%E6%83%85%E5%A0%B1%E6%8A%80%E8%A1%93%E8%80%85-%E3%83%91%E3%83%BC%E3%83%95%E3%82%A7%E3%82%AF%E3%83%88%E3%83%A9%E3%83%BC%E3%83%8B%E3%83%B3%E3%82%B0%E9%81%8E%E5%8E%BB%E5%95%8F%E9%A1%8C%E9%9B%86-%E5%B1%B1%E6%9C%AC-%E4%B8%89%E9%9B%84/dp/4297109611/ref=sr_1_2?__mk_ja_JP=%E3%82%AB%E3%82%BF%E3%82%AB%E3%83%8A&keywords=%E5%9F%BA%E6%9C%AC%E6%83%85%E5%A0%B1%E5%87%A6%E7%90%86&qid=1582166131&s=books&sr=1-2');

SET FOREIGN_KEY_CHECKS = 1;
