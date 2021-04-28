-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2021 at 06:38 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: blog
--

-- --------------------------------------------------------

--
-- Table structure for table categories
--

CREATE TABLE categories (
  id int(11) NOT NULL,
  name varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table categories
--

INSERT INTO categories (id, name) VALUES
(1, 'lifestyle'),
(2, 'projects'),
(3, 'tools'),
(4, 'tutorials');

-- --------------------------------------------------------

--
-- Table structure for table comments
--

CREATE TABLE comments (
  id int(11) NOT NULL,
  post_id int(11) DEFAULT NULL,
  user_id int(11) DEFAULT NULL,
  comment text CHARACTER SET utf8 DEFAULT NULL,
  created_at datetime DEFAULT NULL,
  updated_at datetime DEFAULT NULL,
  approved tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table posts
--

CREATE TABLE posts (
  id int(11) NOT NULL,
  category_id int(11) DEFAULT NULL,
  title varchar(255) NOT NULL,
  hook text NOT NULL,
  content longtext NOT NULL,
  created_at timestamp NULL DEFAULT current_timestamp(),
  updated_at timestamp NULL DEFAULT current_timestamp(),
  img mediumtext DEFAULT NULL,
  user_id int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table posts
--

INSERT INTO posts (id, category_id, title, hook, content, created_at, updated_at, img, user_id) VALUES
(1, 1, 'How I deal with stress...', '<p><em>I found what I need. And it&#39;s not friends, it&#39;s things. I haven&#39;t felt much of anything since my guinea pig died. Yeah, lots of people did. With gusto. I am the man with no name, Zapp Brannigan! Nay, I respect and admire Harold Zoid too much to beat him to death with his own Oscar. Five hours? Aw, man! <strong> Couldn&#39;t you just get me the death penalty?</strong> Negative, bossy meat creature! Bender, quit destroying the universe!</em></p>\r\n', '<h1>I suppose I could part with &#39;one&#39; and still be feared&hellip;</h1>\r\n\r\n<p>Man, I&#39;m sore all over. I feel like I just went ten rounds with mighty Thor. Wow! A superpowers drug you can just rub onto your skin? You&#39;d think it would be something you&#39;d have to freebase. Hello Morbo, how&#39;s the family?</p>\r\n<ol>\r\n	<li>Bender?! You stole the atom.</li>\r\n	<li>We can&#39;t compete with Mom! Her company is big and evil! Ours is small and neutral!</li>\r\n	<li>In your time, yes, but nowadays shut up! Besides, these are adult stemcells, harvested from perfectly healthy adults whom I killed for their stemcells.</li>\r\n</ol>\r\n<h3>Goodbye, cruel world. Goodbye, cruel lamp. Goodbye, cruel velvet drapes, lined with what would appear to be some sort of cruel muslin and the cute little pom-pom curtain pull cords. Cruel though they may be&hellip;</h3>\r\n<blockquote>With gusto. I never loved you.</blockquote>\r\n<p>Michelle, I don&#39;t regret this, but I both rue and lament it. Ummm&hellip;to eBay? My fellow Earthicans, as I have explained in my book &#39;Earth in the Balance&#39;&#39;, and the much more popular &#39;&#39;Harry Potter and the Balance of Earth&#39;, we need to defend our planet against pollution. Also dark wizards.</p>\r\n<ul>\r\n	<li>Oh, how awful. Did he at least die painlessly? &hellip;To shreds, you say. Well, how is his wife holding up? &hellip;To shreds, you say.</li>\r\n	<li>I saw you with those two &quot;ladies of the evening&quot; at Elzars. <u>Explain that.</u></li>\r\n	<li>Good man. Nixon&#39;s pro-war and pro-family.</li>\r\n</ul>\r\n<p>Guards! Bring me the forms I need to fill out to have her taken away! It doesn&#39;t look so shiny to me. Five hours? Aw, man! Couldn&#39;t you just get me the death penalty? I usually try to keep my sadness pent up inside where it can fester quietly as a mental illness. Meh. A sexy mistake. As an interesting side note, as a head without a body, I envy the dead. Oh, I don&#39;t have time for this. I have to go and buy a single piece of fruit with a coupon and then return it, making people wait behind me while I complain. Oh, how awful. Did he at least die painlessly? &hellip;To shreds, you say. Well, how is his wife holding up? &hellip;To shreds, you say. And when we woke up, we had these bodies. Spare me your space age technobabble, Attila the Hun!</p>\r\n<p>Hey, guess what you&#39;re accessories to. You&#39;ll have all the Slurm you can drink when you&#39;re partying with Slurms McKenzie! Stop! Don&#39;t shoot fire stick in space canoe! Cause explosive decompression! I just want to talk. It has nothing to do with mating. Fry, that doesn&#39;t make sense.Fatal. Come, Comrade Bender! We must take to the streets! I found what I need. And it&#39;s not friends, it&#39;s things. Oh, I always feared he might run off like this. Why, why, why didn&#39;t I break his legs? No, I&#39;m Santa Claus!Kids don&#39;t turn rotten just from watching TV. Would you censor the Venus de Venus just because you can see her spewers? We don&#39;t have a brig. Yes. You gave me a dollar and some candy. Well, thanks to the Internet, I&#39;m now bored with sex. Is there a place on the web that panders to my lust for violence?</p>\r\n<p>You know, I was God once. Check it out, y&#39;all. Everyone who was invited is here. Oh Leela! You&#39;re the only person I could turn to; you&#39;re the only person who ever loved me. Now that the, uh, garbage ball is in space, Doctor, perhaps you can help me with my sexual inhibitions?Ok, we&#39;ll go deliver this crate like professionals, and then we&#39;ll go ride the bumper cars. I decline the title of Iron Cook and accept the lesser title of Zinc Saucier, which I just made up. Uhh&hellip; also, comes with double prize money.</p>\r\n<p>I could if you hadn&#39;t turned on the light and shut off my stereo. When the lights go out, it&#39;s nobody&#39;s business what goes on between two consenting adults. I guess because my parents keep telling me to be more ladylike. As though!Large bet on myself in round one. No! Don&#39;t jump! That could be &#39;my&#39; beautiful soul sitting naked on a couch. If I could just learn to play this stupid thing. And remember, don&#39;t do anything that affects anything, unless it turns out you were supposed to, in which case, for the love of God, don&#39;t not do it!</p>\r\n<p>No! I want to live! There are still too many things I don&#39;t own! But I know you in the future. I cleaned your poop. Uh, is the puppy mechanical in any way? Look, last night was a mistake.</p>', '2021-04-11 09:41:55', '2021-04-11 11:16:12', '/public/img/loaders/we-are-all-mad-here.jpg', 1),
(2, 4, 'How to set up PHPStorm with XAMPP', '<p>I don&#39;t criticize you! And if you&#39;re worried about criticism, sometimes a diet is the best defense. I&#39;ve opened a door here that I regret. Oh, you&#39;re gonna be in a coma, all right. I&#39;m half machine. I&#39;m a monster. It&#39;s called &#39;taking advantage.&#39; It&#39;s what gets you ahead in life. I care deeply for nature. Well, what do you expect, mother? Now, when you do this without getting punched in the chest, you&#39;ll have more fun.</p>\r\n', '<h1>But I bought a yearbook ad from you, doesn&#39;t that mean anything anymore?</h1>\r\n\r\n<p>That&#39;s why you always leave a note! I&#39;m afraid I just blue myself. No, I did not kill Kitty. However, I am going to oblige and answer the nice officer&#39;s questions because I am an honest man with no secrets to hide. Say goodbye to these, because it&#39;s the last time! <strong> I&#39;m a monster.</strong> <em> There&#39;s so many poorly chosen words in that sentence.</em> I don&#39;t understand the question, and I won&#39;t respond to it.</p>\r\n\r\n<h2>I&#39;m half machine. I&#39;m a monster.</h2>\r\n\r\n<p>I&#39;m a monster. I don&#39;t criticize you! And if you&#39;re worried about criticism, sometimes a diet is the best defense. Guy&#39;s a pro. We just call it a sausage.</p>\r\n\r\n<ol>\r\n	<li>As you may or may not know, Lindsay and I have hit a bit of a rough patch.</li>\r\n	<li>I hear the jury&#39;s still out on science.</li>\r\n	<li>Now, when you do this without getting punched in the chest, you&#39;ll have more fun.</li>\r\n</ol>\r\n\r\n<h3>There&#39;s so many poorly chosen words in that sentence.</h3>\r\n\r\n<p>There&#39;s so many poorly chosen words in that sentence. It&#39;s a hug, Michael. I&#39;m hugging you. That&#39;s why you always leave a note! No&hellip; but I&#39;d like to be asked! Get me a vodka rocks. And a piece of toast.</p>\r\n\r\n<ul>\r\n	<li>No&hellip; but I&#39;d like to be asked!</li>\r\n	<li>Across from where?</li>\r\n	<li>That&#39;s why you always leave a note!</li>\r\n</ul>\r\n\r\n<p>No! I was ashamed to be SEEN with you. I like being with you. I&#39;ve opened a door here that I regret. Now, when you do this without getting punched in the chest, you&#39;ll have more fun. It&#39;s called &#39;taking advantage.&#39; It&#39;s what gets you ahead in life.Army had half a day. As you may or may not know, Lindsay and I have hit a bit of a rough patch. Army had half a day. Across from where? Army had half a day. I don&#39;t understand the question, and I won&#39;t respond to it.</p>\r\n\r\n<p>Across from where? He&#39;ll want to use your yacht, and I don&#39;t want this thing smelling like fish. I&#39;m afraid I just blue myself. But I bought a yearbook ad from you, doesn&#39;t that mean anything anymore? Oh, you&#39;re gonna be in a coma, all right. I&#39;m afraid I just blue myself. No&hellip; but I&#39;d like to be asked! But I bought a yearbook ad from you, doesn&#39;t that mean anything anymore? I don&#39;t criticize you! And if you&#39;re worried about criticism, sometimes a diet is the best defense.</p>\r\n\r\n<p>Did you enjoy your meal, Mom? You drank it fast enough. Army had half a day. But I bought a yearbook ad from you, doesn&#39;t that mean anything anymore? Whoa, this guy&#39;s straight? Get me a vodka rocks. And a piece of toast. There&#39;s only one man I&#39;ve ever called a coward, and that&#39;s Brian Doyle Murray. No, what I&#39;m calling you is a television actor. As you may or may not know, Lindsay and I have hit a bit of a rough patch.</p>\r\n\r\n<p>Not tricks, Michael, illusions. Say goodbye to these, because it&#39;s the last time! That&#39;s why you always leave a note! I care deeply for nature. As you may or may not know, Lindsay and I have hit a bit of a rough patch. What&#39;s Spanish for &quot;I know you speak English?&quot; I&#39;ve opened a door here that I regret. As you may or may not know, Lindsay and I have hit a bit of a rough patch.</p>\r\n\r\n<p>We just call it a sausage. Marry me. I hear the jury&#39;s still out on science. Bad news. Andy Griffith turned us down. He didn&#39;t like his trailer. No! I was ashamed to be SEEN with you. I like being with you.</p>\r\n', '2021-04-11 09:52:56', '2021-04-11 09:52:56', '/public/img/loaders/library2.jpeg', 1),
(3, 2, 'My first blog', '<p><em>I&#39;ve lived in darkness a long time. Over the years my eyes adjusted until the dark became my world and I could see. You look&hellip;perfect. I have a dark side, too. I&#39;m really more an apartment person. Rorschach would say you have a hard time relating to others. Watching ice melt. This is fun. God created pudding, and then he rested. I feel like a jigsaw puzzle missing a piece. And I&#39;m not even sure what the picture should be.</em></p>\r\n', '<h1>Only you could make those words cute.</h1>\r\n\r\n<p>Watching ice melt. This is fun. Hello, Dexter Morgan. I will not kill my sister. I will not kill my sister. I will not kill my sister. I will not kill my sister. I will not kill my sister. I will not kill my sister. He taught me a code. To survive. I will not kill my sister. I will not kill my sister. <strong> I will not kill my sister.</strong> <em> I&#39;ve lived in darkness a long time.</em> Over the years my eyes adjusted until the dark became my world and I could see.</p>\r\n\r\n<h2>I love Halloween. The one time of year when everyone wears a mask &hellip; not just me.</h2>\r\n\r\n<p>Hello, Dexter Morgan. I have a dark side, too. Like a sloth. I can do that. Under normal circumstances, I&#39;d take that as a compliment. I am not a killer.</p>\r\n\r\n<ol>\r\n	<li>I&#39;m really more an apartment person.</li>\r\n	<li>Pretend. You pretend the feelings are there, for the world, for the people around you. Who knows? Maybe one day they will be.</li>\r\n	<li>Hello, Dexter Morgan.</li>\r\n</ol>\r\n\r\n<h3>I&#39;m a sociopath; there&#39;s not much he can do for me.</h3>\r\n\r\n<p>I&#39;m a sociopath; there&#39;s not much he can do for me. I&#39;m partial to air conditioning. I&#39;m a sociopath; there&#39;s not much he can do for me. You look&hellip;perfect.</p>\r\n\r\n<ul>\r\n	<li>I feel like a jigsaw puzzle missing a piece. And I&#39;m not even sure what the picture should be.</li>\r\n	<li>You all right, Dexter?</li>\r\n	<li>Hello, Dexter Morgan.</li>\r\n</ul>\r\n\r\n<p>Rorschach would say you have a hard time relating to others. I&#39;m thinking two circus clowns dancing. You? I&#39;m really more an apartment person. Makes me a &hellip; scientist. I&#39;m doing mental jumping jacks. I&#39;m generally confused most of the time. Keep your mind limber. Somehow, I doubt that. You have a good heart, Dexter. I feel like a jigsaw puzzle missing a piece. And I&#39;m not even sure what the picture should be. I am not a killer. I&#39;m a sociopath; there&#39;s not much he can do for me. I like seafood. Tell him time is of the essence. Under normal circumstances, I&#39;d take that as a compliment. You&#39;re a killer. I catch killers. Finding a needle in a haystack isn&#39;t hard when every straw is computerized. You&#39;re a killer. I catch killers.</p>\r\n\r\n<p>I like seafood. Finding a needle in a haystack isn&#39;t hard when every straw is computerized. I love Halloween. The one time of year when everyone wears a mask &hellip; not just me. Like a sloth. I can do that. You look&hellip;perfect. Hello, Dexter Morgan. Like a sloth. I can do that. You look&hellip;perfect. I&#39;m Dexter, and I&#39;m not sure what I am. Tonight&#39;s the night. And it&#39;s going to happen again and again. It has to happen. I&#39;m really more an apartment person. I love Halloween. The one time of year when everyone wears a mask &hellip; not just me.</p>\r\n\r\n<p>I think he&#39;s got a crush on you, Dex! Under normal circumstances, I&#39;d take that as a compliment. You all right, Dexter? I am not a killer. I think he&#39;s got a crush on you, Dex! Under normal circumstances, I&#39;d take that as a compliment. Rorschach would say you have a hard time relating to others. He taught me a code. To survive. I&#39;m generally confused most of the time.</p>\r\n', '2021-04-11 09:56:19', '2021-04-11 09:56:19', '/public/img/loaders/lotrwall.jpeg', 3),
(4, 3, '3 best IDE to develop with PHP', '<p><em>Saving the world with meals on wheels. Annihilate? No. No violence. I won&#39;t stand for it. Not now, not ever, do you understand me?! I&#39;m the Doctor, the Oncoming Storm - and you basically meant beat them in a football match, didn&#39;t you? All I&#39;ve got to do is pass as an ordinary human being. Simple. What could possibly go wrong? Sorry, checking all the water in this area; there&#39;s an escaped fish. <strong> Father Christmas.</strong> Santa Claus. Or as I&#39;ve always known him: Jeff.</em></p>\r\n', '<h1>It&#39;s a fez. I wear a fez now. Fezes are cool.</h1>\r\n<blockquote>\r\n   Stop talking, brain thinking. Hush.\r\n</blockquote>\r\n<p>Sorry, checking all the water in this area; there&#39;s an escaped fish. Stop talking, brain thinking. Hush. They&#39;re not aliens, they&#39;re Earth&hellip;liens! Father Christmas. Santa Claus. Or as I&#39;ve always known him: Jeff.</p>\r\n<ol>\r\n	<li>I hate yogurt. It&#39;s just stuff with bits in.</li>\r\n	<li>Stop talking, brain thinking. Hush.</li>\r\n	<li>Stop talking, brain thinking. Hush.</li>\r\n</ol>\r\n<h3>Sorry, checking all the water in this area; there&#39;s an escaped fish.</h3>\r\n<p>I hate yogurt. It&#39;s just stuff with bits in. Did I mention we have comfy chairs? Sorry, checking all the water in this area; there&#39;s an escaped fish. Saving the world with meals on wheels. *Insistently* Bow ties are cool! Come on Amy, I&#39;m a normal bloke, tell me what normal blokes do!</p>\r\n<ul>\r\n	<li>You hate me; you want to kill me! Well, go on! Kill me! KILL ME!</li>\r\n	<li>No, I&#39;ll fix it. I&#39;m good at fixing rot. Call me the Rotmeister. No, I&#39;m the Doctor. Don&#39;t call me the Rotmeister.</li>\r\n	<li>They&#39;re not aliens, they&#39;re Earth&hellip;liens!</li>\r\n</ul>\r\n\r\n<p>I am the Doctor, and you are the Daleks! You&#39;ve swallowed a planet! You know how I sometimes have really brilliant ideas? You&#39;ve swallowed a planet! Aw, you&#39;re all Mr. Grumpy Face today.</p>\r\n<p>They&#39;re not aliens, they&#39;re Earth&hellip;liens! The way I see it, every life is a pile of good things and bad things.&hellip;hey.&hellip;the good things don&#39;t always soften the bad things; but vice-versa the bad things don&#39;t necessarily spoil the good things and make them unimportant.It&#39;s art! A statement on modern society, &#39;Oh Ain&#39;t Modern Society Awful?&#39;! You&#39;ve swallowed a planet! You hit me with a cricket bat. Annihilate? No. No violence. I won&#39;t stand for it. Not now, not ever, do you understand me?! I&#39;m the Doctor, the Oncoming Storm - and you basically meant beat them in a football match, didn&#39;t you?</p>\r\n<p>It&#39;s art! A statement on modern society, &#39;Oh Ain&#39;t Modern Society Awful?&#39;! Sorry, checking all the water in this area; there&#39;s an escaped fish. You know when grown-ups tell you &#39;everything&#39;s going to be fine&#39; and you think they&#39;re probably lying to make you feel better? I&#39;m nobody&#39;s taxi service; I&#39;m not gonna be there to catch you every time you feel like jumping out of a spaceship. Heh-haa! Super squeaky bum time! You&#39;ve swallowed a planet! Sorry, checking all the water in this area; there&#39;s an escaped fish.I hate yogurt. It&#39;s just stuff with bits in. All I&#39;ve got to do is pass as an ordinary human being. Simple. What could possibly go wrong? *Insistently* Bow ties are cool! Come on Amy, I&#39;m a normal bloke, tell me what normal blokes do!</p>\r\n<p>It&#39;s art! A statement on modern society, &#39;Oh Ain&#39;t Modern Society Awful?&#39;! No&hellip; It&#39;s a thing; it&#39;s like a plan, but with more greatness. Annihilate? No. No violence. I won&#39;t stand for it. Not now, not ever, do you understand me?! I&#39;m the Doctor, the Oncoming Storm - and you basically meant beat them in a football match, didn&#39;t you?Aw, you&#39;re all Mr. Grumpy Face today. You&#39;ve swallowed a planet! You know when grown-ups tell you &#39;everything&#39;s going to be fine&#39; and you think they&#39;re probably lying to make you feel better? I am the Doctor, and you are the Daleks!</p>\r\n<p>I&#39;m the Doctor. Well, they call me the Doctor. I don&#39;t know why. I call me the Doctor too. I still don&#39;t know why. I&#39;m the Doctor, I&#39;m worse than everyone&#39;s aunt. *catches himself* And that is not how I&#39;m introducing myself. Heh-haa! Super squeaky bum time! They&#39;re not aliens, they&#39;re Earth&hellip;liens! Did I mention we have comfy chairs? I&#39;m nobody&#39;s taxi service; I&#39;m not gonna be there to catch you every time you feel like jumping out of a spaceship. I am the Doctor, and you are the Daleks! Annihilate? No. No violence. I won&#39;t stand for it. Not now, not ever, do you understand me?! I&#39;m the Doctor, the Oncoming Storm - and you basically meant beat them in a football match, didn&#39;t you?</p>\r\n', '2021-04-11 10:04:07', '2021-04-11 11:08:04', '/public/img/loaders/blog-2.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table users
--

CREATE TABLE users (
  id int(11) NOT NULL,
  img longtext NOT NULL,
  username varchar(16) NOT NULL,
  email varchar(255) DEFAULT NULL,
  password varchar(255) NOT NULL,
  created_at timestamp NULL DEFAULT current_timestamp(),
  role varchar(10) DEFAULT 'user',
  updated_at timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table users
--

INSERT INTO users (id, img, username, email, password, created_at, role, updated_at) VALUES
(1, '/public/img/profile/guilherme-stecanella-UrS5HkBr1Rc-unsplash.jpg', 'Djamina', 'djamina.marboeuf@gmail.com', '$2y$10$b4zI7.HAxoKNjRbx1BbFeOjqsm158nNmwCjdEQ6lisbiMbtyqDAYC', '2021-04-11 09:26:42', 'admin', '2021-04-11 09:26:42'),
(2, '/public/img/profile/lee-chinyama-hR9nE6FHD2Q-unsplash.jpg', 'Peggy', 'peggy@fake.com', '$2y$10$HOe1WGxmwMgjc4VQ.mzd5e5Uk3H6nkKLuP4YcUu/2BrAwyN6UzqdW', '2021-04-11 09:27:41', 'user', '2021-04-11 09:27:41'),
(3, '/public/img/profile/marcelo-marques-d9STlut5sWQ-unsplash.jpg', 'Danooh', 'danooh@fake.com', '$2y$10$pkP7U9UigQ4Hfp1m60fBZOONNVcR8ar4PICjW7XHbcHNMnx9GQIXS', '2021-04-11 09:30:45', 'admin', '2021-04-11 09:33:30'),
(4, '/public/img/profile/jason-blackeye-zkUdDlyefew-unsplash.jpg', 'Gaby', 'gabriel@fake.com', '$2y$10$SYrvZpBqFXFLVohsA5rKaOMc19LmuMriY4Hf5710.2oJv3WiHZcPm', '2021-04-11 09:32:01', 'user', '2021-04-11 09:32:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table categories
--
ALTER TABLE categories
  ADD PRIMARY KEY (id) USING BTREE;

--
-- Indexes for table comments
--
ALTER TABLE comments
  ADD PRIMARY KEY (id),
  ADD KEY INDEX_post_id (post_id) USING BTREE,
  ADD KEY INDEX_user_id (user_id) USING BTREE;

--
-- Indexes for table posts
--
ALTER TABLE posts
  ADD PRIMARY KEY (id),
  ADD KEY INDEX_user_id (user_id),
  ADD KEY INDEX_category_id (category_id) USING BTREE;

--
-- Indexes for table users
--
ALTER TABLE users
  ADD PRIMARY KEY (id);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table categories
--
ALTER TABLE categories
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table comments
--
ALTER TABLE comments
  MODIFY id int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table posts
--
ALTER TABLE posts
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table users
--
ALTER TABLE users
  MODIFY id int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table comments
--
ALTER TABLE comments
  ADD CONSTRAINT comments_ibfk_1 FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT comments_ibfk_2 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE NO ACTION,
  ADD CONSTRAINT fk_Comments_Posts1 FOREIGN KEY (post_id) REFERENCES posts (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT fk_Comments_User1 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table posts
--
ALTER TABLE posts
  ADD CONSTRAINT fk_Posts_Category FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT fk_Posts_User1 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT posts_ibfk_1 FOREIGN KEY (category_id) REFERENCES categories (id) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT posts_ibfk_2 FOREIGN KEY (user_id) REFERENCES users (id) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
