-- ChatGPTに作ってもらったもの
CREATE TABLE posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  body TEXT,
  created_at TIMESTAMP DEFAULT NOW(),
  FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE likes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  post_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT NOW(),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (post_id) REFERENCES posts(id)
);

CREATE TABLE follows (
  id INT AUTO_INCREMENT PRIMARY KEY,
  follower_id INT NOT NULL,
  following_id INT NOT NULL,
  created_at TIMESTAMP DEFAULT NOW(),
  FOREIGN KEY (follower_id) REFERENCES users(id),
  FOREIGN KEY (following_id) REFERENCES users(id)
);


-- 昔作ったもの

-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2020 年 3 月 08 日 07:33
-- サーバのバージョン： 5.7.26
-- PHP のバージョン: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `portfolioDB`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `bord`
--

CREATE TABLE `bord` (
  `id` int(1) NOT NULL,
  `sale_user` int(11) DEFAULT NULL,
  `buy_user` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `delete_flg` tinyint(1) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `category`
--

CREATE TABLE `category` (
  `id` int(1) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `delete_flg` tinyint(1) DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `category`
--

INSERT INTO `category` (`id`, `name`, `delete_flg`, `create_date`, `update_date`) VALUES
(1, 'システム開発・運用', 0, NULL, NULL),
(2, 'Web制作・Webデザイン', 0, NULL, NULL),
(3, '翻訳・通訳サービス', 0, NULL, NULL),
(4, 'デザイン制作', 0, NULL, NULL),
(5, 'ライティング・ネーミング', 0, NULL, NULL),
(6, '営業・マーケティング・企画・広報', 0, NULL, NULL),
(7, '写真・動画・ナレーション', 0, NULL, NULL),
(8, '事務・コンサル・専門職', 0, NULL, NULL),
(9, 'タスク・作業', 0, NULL, NULL),
(10, 'その他', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- テーブルの構造 `good`
--

CREATE TABLE `good` (
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `delete_flg` tinyint(1) DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `good`
--

INSERT INTO `good` (`product_id`, `user_id`, `delete_flg`, `create_date`, `update_date`) VALUES
(1, 2, 0, '2020-01-26 09:10:57', '2020-01-26 09:10:57');

-- --------------------------------------------------------

--
-- テーブルの構造 `message`
--

CREATE TABLE `message` (
  `id` int(1) NOT NULL,
  `bord_id` int(11) DEFAULT NULL,
  `send_date` datetime DEFAULT NULL,
  `to_user` int(11) DEFAULT NULL,
  `from_user` int(11) DEFAULT NULL,
  `msg` varchar(255) DEFAULT NULL,
  `delete_flg` tinyint(1) DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- テーブルの構造 `products`
--

CREATE TABLE `products` (
  `id` int(1) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `pic1` varchar(255) DEFAULT NULL,
  `pic2` varchar(255) DEFAULT NULL,
  `pic3` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `delete_flg` tinyint(1) DEFAULT '0',
  `create_date` datetime DEFAULT NULL,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `products`
--

INSERT INTO `products` (`id`, `name`, `category_id`, `comment`, `price`, `pic1`, `pic2`, `pic3`, `user_id`, `delete_flg`, `create_date`, `update_date`) VALUES
(1, 'dad', 1, 'dsa', 1234, 'uploads/9796baaf6a8fddc72cf79b5469e4f7a8d17a4213.png', '', '', 1, 0, '2020-01-17 14:44:07', '2020-01-17 14:44:07'),
(2, 'test123', 1, '-----詳細テンプレート-----・案件名・職種・勤務地（都道府県名）・勤務地(最寄り駅など)・単価(税込)・案件内容■スキル： ■人数 ： ■性別 ： ■国籍 ： ■特記', 1234, 'uploads/64bf121176848dfa79f970b4ae0fbe9b3840dc11.png', '', '', 1, 0, '2020-01-17 14:44:23', '2020-01-17 14:44:23'),
(3, 'test', 1, '-----詳細テンプレート-----・案件名・職種・勤務地（都道府県名）・勤務地(最寄り駅など)・単価(税込)・案件内容■スキル： ■人数 ： ■性別 ： ■国籍 ： ■特記', 1234, 'uploads/ca113526d54f352b519bca211cebed8743aebbe4.png', '', '', 1, 0, '2020-01-17 14:44:37', '2020-01-17 14:44:37');

-- --------------------------------------------------------

--
-- テーブルの構造 `users`
--

CREATE TABLE `users` (
  `id` int(1) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `tel` varchar(255) DEFAULT NULL,
  `zip` int(11) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  `addr` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `delete_flg` tinyint(1) DEFAULT '0',
  `login_time` timestamp NULL DEFAULT NULL,
  `create_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;





--
-- テーブルのデータのダンプ `users`
--

INSERT INTO `users` (`id`, `username`, `age`, `tel`, `zip`, `pic`, `addr`, `email`, `password`, `delete_flg`, `login_time`, `create_date`, `update_date`) VALUES
(1, 'テスト太郎', 22, '08033339999', 1234567, '', '北海道', 'test01@gmail.com', '$2y$10$b1JkCF3TuvKkX4XDoAEgy.m1iH3x6/4VXnaTVcWFmA.Om5KgAoOZK', 0, '2020-01-17 05:43:39', '2020-01-17 14:43:39', '2020-01-19 09:37:42'),
(2, NULL, NULL, NULL, NULL, NULL, NULL, 'test02@gmail.com', '$2y$10$sCRPN6seOaCEeYPUyIpJ9OtrYp8AZ7DX1coFWRjy5WpJ5ZyvX.HYe', 0, '2020-01-17 05:46:00', '2020-01-17 14:46:00', '2020-01-17 14:46:00');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `bord`
--
ALTER TABLE `bord`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- テーブルのインデックス `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `bord`
--
ALTER TABLE `bord`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `category`
--
ALTER TABLE `category`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- テーブルのAUTO_INCREMENT `message`
--
ALTER TABLE `message`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT;

--
-- テーブルのAUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- テーブルのAUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
