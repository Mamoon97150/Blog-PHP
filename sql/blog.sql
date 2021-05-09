-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 04, 2021 at 01:23 AM
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
-- Database: `blog`
--
CREATE DATABASE IF NOT EXISTS `blog` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `blog`;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'lifestyle'),
(2, 'projects'),
(3, 'tools'),
(4, 'tutorials');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `comment` text CHARACTER SET utf8 DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp(),
  `approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`, `updated_at`, `approved`) VALUES
(1, 7, 4, '<p>Somehow, I doubt that. You have a good heart, Dexter. You&#39;re a killer. I catch killers. I&#39;m generally confused most of the time. I&#39;m a sociopath; there&#39;s not much he can do for me.</p>\r\n', '2021-04-28 20:13:27', '2021-04-28 20:27:47', 1),
(2, 4, 1, '<p>All I&#39;ve got to do is pass as an ordinary human being. Simple. What could possibly go wrong? Sorry, checking all the water in this area; there&#39;s an escaped fish. Father Christmas. Santa Claus. Or as I&#39;ve always known him: Jeff.</p>\r\n', '2021-05-02 18:26:46', '2021-05-02 18:26:46', 0);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(150) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp(),
  `answered` tinyint(1) NOT NULL DEFAULT 0,
  `answer` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `name`, `email`, `subject`, `message`, `created_at`, `updated_at`, `answered`, `answer`) VALUES
(1, 'Martin', 'martin@fake.com', 'test 1', '<p>Annihilate? No. No violence. I won\'t stand for it. Not now, not ever, do you understand me?! I\'m the Doctor, the Oncoming Storm - and you basically meant beat them in a football match, didn\'t you? You hit me with a cricket bat.</p>', '2021-04-30 17:38:58', '2021-04-30 17:38:58', 0, NULL),
(2, 'lili', 'lili@fake.com', 'test 5', '<p>It\'s art! A statement on modern society, \'Oh Ain\'t Modern Society Awful?\'! You know how I sometimes have really brilliant ideas? I am the last of my species, and I know how that weighs on the heart so don\'t lie to me!</p>\r\n', '2021-05-02 17:18:41', '2021-05-02 17:18:41', 0, NULL),
(3, 'Djamina', 'djamina.marboeuf@gmail.com', 'Real life test #1', '<p>All I&#39;ve got to do is pass as an ordinary human being. Simple. What could possibly go wrong? Sorry, checking all the water in this area; there&#39;s an escaped fish. Father Christmas. Santa Claus. Or as I&#39;ve always known him: Jeff.</p>\r\n', '2021-05-02 17:46:29', '2021-05-02 18:19:15', 1, '<p>Saving the world with meals on wheels. I&#39;m the Doctor. Well, they call me the Doctor. I don&#39;t know why. I call me the Doctor too. I still don&#39;t know why. It&#39;s art! A statement on modern society, <em>&#39;Oh Ain&#39;t Modern Society Awful?&#39;</em>!</p>\r\n\r\n<p><strong>*Insistently*</strong> Bow ties are cool! Come on Amy, I&#39;m a normal bloke, tell me what normal blokes do! You know how I sometimes have really brilliant ideas? Aw, you&#39;re all Mr. Grumpy Face today. I&#39;m nobody&#39;s taxi service; I&#39;m not gonna be there to catch you every time you feel like jumping out of a spaceship.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `hook` text NOT NULL,
  `content` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `img` mediumtext DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `category_id`, `title`, `hook`, `content`, `created_at`, `updated_at`, `img`, `user_id`) VALUES
(1, 1, 'How I deal with stress...', '<p><em>I found what I need. And it&#39;s not friends, it&#39;s things. I haven&#39;t felt much of anything since my guinea pig died. Yeah, lots of people did. With gusto. I am the man with no name, Zapp Brannigan! Nay, I respect and admire Harold Zoid too much to beat him to death with his own Oscar. Five hours? Aw, man! <strong> Couldn&#39;t you just get me the death penalty?</strong> Negative, bossy meat creature! Bender, quit destroying the universe!</em></p>\r\n', '<h1>I suppose I could part with &#39;one&#39; and still be feared&hellip;</h1>\r\n\r\n<p>Man, I&#39;m sore all over. I feel like I just went ten rounds with mighty Thor. Wow! A superpowers drug you can just rub onto your skin? You&#39;d think it would be something you&#39;d have to freebase. Hello Morbo, how&#39;s the family?</p>\r\n\r\n<ol>\r\n	<li>Bender?! You stole the atom.</li>\r\n	<li>We can&#39;t compete with Mom! Her company is big and evil! Ours is small and neutral!</li>\r\n	<li>In your time, yes, but nowadays shut up! Besides, these are adult stemcells, harvested from perfectly healthy adults whom I killed for their stemcells.</li>\r\n</ol>\r\n\r\n<h3>Goodbye, cruel world. Goodbye, cruel lamp. Goodbye, cruel velvet drapes, lined with what would appear to be some sort of cruel muslin and the cute little pom-pom curtain pull cords. Cruel though they may be&hellip;</h3>\r\n\r\n<p>Michelle, I don&#39;t regret this, but I both rue and lament it. Ummm&hellip;to eBay? My fellow Earthicans, as I have explained in my book &#39;Earth in the Balance&#39;&#39;, and the much more popular &#39;&#39;Harry Potter and the Balance of Earth&#39;, we need to defend our planet against pollution. Also dark wizards.</p>\r\n\r\n<ul>\r\n	<li>Oh, how awful. Did he at least die painlessly? &hellip;To shreds, you say. Well, how is his wife holding up? &hellip;To shreds, you say.</li>\r\n	<li>I saw you with those two &quot;ladies of the evening&quot; at Elzars. <u>Explain that.</u></li>\r\n	<li>Good man. Nixon&#39;s pro-war and pro-family.</li>\r\n</ul>\r\n\r\n<p>Guards! Bring me the forms I need to fill out to have her taken away! It doesn&#39;t look so shiny to me. Five hours? Aw, man! Couldn&#39;t you just get me the death penalty? I usually try to keep my sadness pent up inside where it can fester quietly as a mental illness. Meh. A sexy mistake. As an interesting side note, as a head without a body, I envy the dead. Oh, I don&#39;t have time for this. I have to go and buy a single piece of fruit with a coupon and then return it, making people wait behind me while I complain. Oh, how awful. Did he at least die painlessly? &hellip;To shreds, you say. Well, how is his wife holding up? &hellip;To shreds, you say. And when we woke up, we had these bodies. Spare me your space age technobabble, Attila the Hun!</p>\r\n\r\n<p>Hey, guess what you&#39;re accessories to. You&#39;ll have all the Slurm you can drink when you&#39;re partying with Slurms McKenzie! Stop! Don&#39;t shoot fire stick in space canoe! Cause explosive decompression! I just want to talk. It has nothing to do with mating. Fry, that doesn&#39;t make sense.Fatal. Come, Comrade Bender! We must take to the streets! I found what I need. And it&#39;s not friends, it&#39;s things. Oh, I always feared he might run off like this. Why, why, why didn&#39;t I break his legs? No, I&#39;m Santa Claus!Kids don&#39;t turn rotten just from watching TV. Would you censor the Venus de Venus just because you can see her spewers? We don&#39;t have a brig. Yes. You gave me a dollar and some candy. Well, thanks to the Internet, I&#39;m now bored with sex. Is there a place on the web that panders to my lust for violence?</p>\r\n\r\n<p>You know, I was God once. Check it out, y&#39;all. Everyone who was invited is here. Oh Leela! You&#39;re the only person I could turn to; you&#39;re the only person who ever loved me. Now that the, uh, garbage ball is in space, Doctor, perhaps you can help me with my sexual inhibitions?Ok, we&#39;ll go deliver this crate like professionals, and then we&#39;ll go ride the bumper cars. I decline the title of Iron Cook and accept the lesser title of Zinc Saucier, which I just made up. Uhh&hellip; also, comes with double prize money.</p>\r\n\r\n<p>I could if you hadn&#39;t turned on the light and shut off my stereo. When the lights go out, it&#39;s nobody&#39;s business what goes on between two consenting adults. I guess because my parents keep telling me to be more ladylike. As though!Large bet on myself in round one. No! Don&#39;t jump! That could be &#39;my&#39; beautiful soul sitting naked on a couch. If I could just learn to play this stupid thing. And remember, don&#39;t do anything that affects anything, unless it turns out you were supposed to, in which case, for the love of God, don&#39;t not do it!</p>\r\n\r\n<p>No! I want to live! There are still too many things I don&#39;t own! But I know you in the future. I cleaned your poop. Uh, is the puppy mechanical in any way? Look, last night was a mistake.</p>\r\n', '2021-04-11 09:41:55', '2021-04-28 22:50:37', '/public/img/loaders/we-are-all-mad-here.jpg', 1),
(2, 4, 'How to set up PHPStorm with XAMPP', '<p>I don&#39;t criticize you! And if you&#39;re worried about criticism, sometimes a diet is the best defense. I&#39;ve opened a door here that I regret. Oh, you&#39;re gonna be in a coma, all right. I&#39;m half machine. I&#39;m a monster. It&#39;s called &#39;taking advantage.&#39; It&#39;s what gets you ahead in life. I care deeply for nature. Well, what do you expect, mother? Now, when you do this without getting punched in the chest, you&#39;ll have more fun.</p>\r\n', '<h1>But I bought a yearbook ad from you, doesn&#39;t that mean anything anymore?</h1>\r\n\r\n<p>That&#39;s why you always leave a note! I&#39;m afraid I just blue myself. No, I did not kill Kitty. However, I am going to oblige and answer the nice officer&#39;s questions because I am an honest man with no secrets to hide. Say goodbye to these, because it&#39;s the last time! <strong> I&#39;m a monster.</strong> <em> There&#39;s so many poorly chosen words in that sentence.</em> I don&#39;t understand the question, and I won&#39;t respond to it.</p>\r\n\r\n<h2>I&#39;m half machine. I&#39;m a monster.</h2>\r\n\r\n<p>I&#39;m a monster. I don&#39;t criticize you! And if you&#39;re worried about criticism, sometimes a diet is the best defense. Guy&#39;s a pro. We just call it a sausage.</p>\r\n\r\n<ol>\r\n	<li>As you may or may not know, Lindsay and I have hit a bit of a rough patch.</li>\r\n	<li>I hear the jury&#39;s still out on science.</li>\r\n	<li>Now, when you do this without getting punched in the chest, you&#39;ll have more fun.</li>\r\n</ol>\r\n\r\n<h3>There&#39;s so many poorly chosen words in that sentence.</h3>\r\n\r\n<p>There&#39;s so many poorly chosen words in that sentence. It&#39;s a hug, Michael. I&#39;m hugging you. That&#39;s why you always leave a note! No&hellip; but I&#39;d like to be asked! Get me a vodka rocks. And a piece of toast.</p>\r\n\r\n<ul>\r\n	<li>No&hellip; but I&#39;d like to be asked!</li>\r\n	<li>Across from where?</li>\r\n	<li>That&#39;s why you always leave a note!</li>\r\n</ul>\r\n\r\n<p>No! I was ashamed to be SEEN with you. I like being with you. I&#39;ve opened a door here that I regret. Now, when you do this without getting punched in the chest, you&#39;ll have more fun. It&#39;s called &#39;taking advantage.&#39; It&#39;s what gets you ahead in life.Army had half a day. As you may or may not know, Lindsay and I have hit a bit of a rough patch. Army had half a day. Across from where? Army had half a day. I don&#39;t understand the question, and I won&#39;t respond to it.</p>\r\n\r\n<p>Across from where? He&#39;ll want to use your yacht, and I don&#39;t want this thing smelling like fish. I&#39;m afraid I just blue myself. But I bought a yearbook ad from you, doesn&#39;t that mean anything anymore? Oh, you&#39;re gonna be in a coma, all right. I&#39;m afraid I just blue myself. No&hellip; but I&#39;d like to be asked! But I bought a yearbook ad from you, doesn&#39;t that mean anything anymore? I don&#39;t criticize you! And if you&#39;re worried about criticism, sometimes a diet is the best defense.</p>\r\n\r\n<p>Did you enjoy your meal, Mom? You drank it fast enough. Army had half a day. But I bought a yearbook ad from you, doesn&#39;t that mean anything anymore? Whoa, this guy&#39;s straight? Get me a vodka rocks. And a piece of toast. There&#39;s only one man I&#39;ve ever called a coward, and that&#39;s Brian Doyle Murray. No, what I&#39;m calling you is a television actor. As you may or may not know, Lindsay and I have hit a bit of a rough patch.</p>\r\n\r\n<p>Not tricks, Michael, illusions. Say goodbye to these, because it&#39;s the last time! That&#39;s why you always leave a note! I care deeply for nature. As you may or may not know, Lindsay and I have hit a bit of a rough patch. What&#39;s Spanish for &quot;I know you speak English?&quot; I&#39;ve opened a door here that I regret. As you may or may not know, Lindsay and I have hit a bit of a rough patch.</p>\r\n\r\n<p>We just call it a sausage. Marry me. I hear the jury&#39;s still out on science. Bad news. Andy Griffith turned us down. He didn&#39;t like his trailer. No! I was ashamed to be SEEN with you. I like being with you.</p>\r\n', '2021-04-11 09:52:56', '2021-04-11 09:52:56', '/public/img/loaders/library2.jpeg', 1),
(3, 2, 'My first blog', '<p><em>I&#39;ve lived in darkness a long time. Over the years my eyes adjusted until the dark became my world and I could see. You look&hellip;perfect. I have a dark side, too. I&#39;m really more an apartment person. Rorschach would say you have a hard time relating to others. Watching ice melt. This is fun. God created pudding, and then he rested. I feel like a jigsaw puzzle missing a piece. And I&#39;m not even sure what the picture should be.</em></p>\r\n', '<h1>Only you could make those words cute.</h1>\r\n\r\n<p>Watching ice melt. This is fun. Hello, Dexter Morgan. I will not kill my sister. I will not kill my sister. I will not kill my sister. I will not kill my sister. I will not kill my sister. I will not kill my sister. He taught me a code. To survive. I will not kill my sister. I will not kill my sister. <strong> I will not kill my sister.</strong> <em> I&#39;ve lived in darkness a long time.</em> Over the years my eyes adjusted until the dark became my world and I could see.</p>\r\n\r\n<h2>I love Halloween. The one time of year when everyone wears a mask &hellip; not just me.</h2>\r\n\r\n<p>Hello, Dexter Morgan. I have a dark side, too. Like a sloth. I can do that. Under normal circumstances, I&#39;d take that as a compliment. I am not a killer.</p>\r\n\r\n<ol>\r\n	<li>I&#39;m really more an apartment person.</li>\r\n	<li>Pretend. You pretend the feelings are there, for the world, for the people around you. Who knows? Maybe one day they will be.</li>\r\n	<li>Hello, Dexter Morgan.</li>\r\n</ol>\r\n\r\n<h3>I&#39;m a sociopath; there&#39;s not much he can do for me.</h3>\r\n\r\n<p>I&#39;m a sociopath; there&#39;s not much he can do for me. I&#39;m partial to air conditioning. I&#39;m a sociopath; there&#39;s not much he can do for me. You look&hellip;perfect.</p>\r\n\r\n<ul>\r\n	<li>I feel like a jigsaw puzzle missing a piece. And I&#39;m not even sure what the picture should be.</li>\r\n	<li>You all right, Dexter?</li>\r\n	<li>Hello, Dexter Morgan.</li>\r\n</ul>\r\n\r\n<p>Rorschach would say you have a hard time relating to others. I&#39;m thinking two circus clowns dancing. You? I&#39;m really more an apartment person. Makes me a &hellip; scientist. I&#39;m doing mental jumping jacks. I&#39;m generally confused most of the time. Keep your mind limber. Somehow, I doubt that. You have a good heart, Dexter. I feel like a jigsaw puzzle missing a piece. And I&#39;m not even sure what the picture should be. I am not a killer. I&#39;m a sociopath; there&#39;s not much he can do for me. I like seafood. Tell him time is of the essence. Under normal circumstances, I&#39;d take that as a compliment. You&#39;re a killer. I catch killers. Finding a needle in a haystack isn&#39;t hard when every straw is computerized. You&#39;re a killer. I catch killers.</p>\r\n\r\n<p>I like seafood. Finding a needle in a haystack isn&#39;t hard when every straw is computerized. I love Halloween. The one time of year when everyone wears a mask &hellip; not just me. Like a sloth. I can do that. You look&hellip;perfect. Hello, Dexter Morgan. Like a sloth. I can do that. You look&hellip;perfect. I&#39;m Dexter, and I&#39;m not sure what I am. Tonight&#39;s the night. And it&#39;s going to happen again and again. It has to happen. I&#39;m really more an apartment person. I love Halloween. The one time of year when everyone wears a mask &hellip; not just me.</p>\r\n\r\n<p>I think he&#39;s got a crush on you, Dex! Under normal circumstances, I&#39;d take that as a compliment. You all right, Dexter? I am not a killer. I think he&#39;s got a crush on you, Dex! Under normal circumstances, I&#39;d take that as a compliment. Rorschach would say you have a hard time relating to others. He taught me a code. To survive. I&#39;m generally confused most of the time.</p>\r\n', '2021-04-11 09:56:19', '2021-04-11 09:56:19', '/public/img/loaders/lotrwall.jpeg', 3),
(4, 3, '3 best IDE to develop with PHP', '<p><em>Saving the world with meals on wheels. Annihilate? No. No violence. I won&#39;t stand for it. Not now, not ever, do you understand me?! I&#39;m the Doctor, the Oncoming Storm - and you basically meant beat them in a football match, didn&#39;t you? All I&#39;ve got to do is pass as an ordinary human being. Simple. What could possibly go wrong? Sorry, checking all the water in this area; there&#39;s an escaped fish. <strong> Father Christmas.</strong> Santa Claus. Or as I&#39;ve always known him: Jeff.</em></p>\r\n', '<h1>It&#39;s a fez. I wear a fez now. Fezes are cool.</h1>\r\n\r\n<blockquote>Stop talking, brain thinking. Hush.</blockquote>\r\n\r\n<p>Sorry, checking all the water in this area; there&#39;s an escaped fish. Stop talking, brain thinking. Hush. They&#39;re not aliens, they&#39;re Earth&hellip;liens! Father Christmas. Santa Claus. Or as I&#39;ve always known him: Jeff.</p>\r\n\r\n<ol>\r\n	<li>I hate yogurt. It&#39;s just stuff with bits in.</li>\r\n	<li>Stop talking, brain thinking. Hush.</li>\r\n	<li>Stop talking, brain thinking. Hush.</li>\r\n</ol>\r\n\r\n<h3>Sorry, checking all the water in this area; there&#39;s an escaped fish.</h3>\r\n\r\n<p>I hate yogurt. It&#39;s just stuff with bits in. Did I mention we have comfy chairs? Sorry, checking all the water in this area; there&#39;s an escaped fish. Saving the world with meals on wheels. *Insistently* Bow ties are cool! Come on Amy, I&#39;m a normal bloke, tell me what normal blokes do!</p>\r\n\r\n<ul>\r\n	<li>You hate me; you want to kill me! Well, go on! Kill me! KILL ME!</li>\r\n	<li>No, I&#39;ll fix it. I&#39;m good at fixing rot. Call me the Rotmeister. No, I&#39;m the Doctor. Don&#39;t call me the Rotmeister.</li>\r\n	<li>They&#39;re not aliens, they&#39;re Earth&hellip;liens!</li>\r\n</ul>\r\n\r\n<p>I am the Doctor, and you are the Daleks! You&#39;ve swallowed a planet! You know how I sometimes have really brilliant ideas? You&#39;ve swallowed a planet! Aw, you&#39;re all Mr. Grumpy Face today.</p>\r\n\r\n<p>They&#39;re not aliens, they&#39;re Earth&hellip;liens! The way I see it, every life is a pile of good things and bad things.&hellip;hey.&hellip;the good things don&#39;t always soften the bad things; but vice-versa the bad things don&#39;t necessarily spoil the good things and make them unimportant.It&#39;s art! A statement on modern society, &#39;Oh Ain&#39;t Modern Society Awful?&#39;! You&#39;ve swallowed a planet! You hit me with a cricket bat. Annihilate? No. No violence. I won&#39;t stand for it. Not now, not ever, do you understand me?! I&#39;m the Doctor, the Oncoming Storm - and you basically meant beat them in a football match, didn&#39;t you?</p>\r\n\r\n<p>It&#39;s art! A statement on modern society, &#39;Oh Ain&#39;t Modern Society Awful?&#39;! Sorry, checking all the water in this area; there&#39;s an escaped fish. You know when grown-ups tell you &#39;everything&#39;s going to be fine&#39; and you think they&#39;re probably lying to make you feel better? I&#39;m nobody&#39;s taxi service; I&#39;m not gonna be there to catch you every time you feel like jumping out of a spaceship. Heh-haa! Super squeaky bum time! You&#39;ve swallowed a planet! Sorry, checking all the water in this area; there&#39;s an escaped fish.I hate yogurt. It&#39;s just stuff with bits in. All I&#39;ve got to do is pass as an ordinary human being. Simple. What could possibly go wrong? *Insistently* Bow ties are cool! Come on Amy, I&#39;m a normal bloke, tell me what normal blokes do!</p>\r\n\r\n<p>It&#39;s art! A statement on modern society, &#39;Oh Ain&#39;t Modern Society Awful?&#39;! No&hellip; It&#39;s a thing; it&#39;s like a plan, but with more greatness. Annihilate? No. No violence. I won&#39;t stand for it. Not now, not ever, do you understand me?! I&#39;m the Doctor, the Oncoming Storm - and you basically meant beat them in a football match, didn&#39;t you?Aw, you&#39;re all Mr. Grumpy Face today. You&#39;ve swallowed a planet! You know when grown-ups tell you &#39;everything&#39;s going to be fine&#39; and you think they&#39;re probably lying to make you feel better? I am the Doctor, and you are the Daleks!</p>\r\n\r\n<p>I&#39;m the Doctor. Well, they call me the Doctor. I don&#39;t know why. I call me the Doctor too. I still don&#39;t know why. I&#39;m the Doctor, I&#39;m worse than everyone&#39;s aunt. *catches himself* And that is not how I&#39;m introducing myself. Heh-haa! Super squeaky bum time! They&#39;re not aliens, they&#39;re Earth&hellip;liens! Did I mention we have comfy chairs? I&#39;m nobody&#39;s taxi service; I&#39;m not gonna be there to catch you every time you feel like jumping out of a spaceship. I am the Doctor, and you are the Daleks! Annihilate? No. No violence. I won&#39;t stand for it. Not now, not ever, do you understand me?! I&#39;m the Doctor, the Oncoming Storm - and you basically meant beat them in a football match, didn&#39;t you?</p>\r\n', '2021-04-11 10:04:07', '2021-04-28 22:50:16', '/public/img/loaders/blog-2.jpg', 1),
(5, 2, 'There\'s no part of that sentence I didn\'t like !', '<p>Stop! Don&#39;t shoot fire stick in space canoe! Cause explosive decompression! And I&#39;m his friend Jesus. THE BIG BRAIN AM WINNING AGAIN! I AM THE GREETEST! NOW I AM LEAVING EARTH, FOR NO RAISEN! Robot 1-X, save my friends! And Zoidberg!</p>\r\n', '<p>Humans dating robots is sick. You people wonder why I&#39;m still single? <strong> It&#39;s &#39;cause all the fine robot sisters are dating humans!</strong> <em> I could if you hadn&#39;t turned on the light and shut off my stereo.</em> Daylight and everything.</p>\r\n\r\n<h2>Oh, how awful. Did he at least die painlessly? &hellip;To shreds, you say. Well, how is his wife holding up? &hellip;To shreds, you say.</h2>\r\n\r\n<p>A sexy mistake. Well, thanks to the Internet, I&#39;m now bored with sex. Is there a place on the web that panders to my lust for violence? Look, last night was a mistake. Well, then good news! It&#39;s a suppository.</p>\r\n\r\n<h3>And I&#39;d do it again! And perhaps a third time! But that would be it.</h3>\r\n\r\n<p>We can&#39;t compete with Mom! Her company is big and evil! Ours is small and neutral! There, now he&#39;s trapped in a book I wrote: a crummy world of plot holes and spelling errors! Yeah, and if you were the pope they&#39;d be all, &quot;Straighten your pope hat.&quot; And &quot;Put on your good vestments.&quot;</p>\r\n\r\n<ul>\r\n	<li>Oh Leela! You&#39;re the only person I could turn to; you&#39;re the only person who ever loved me.</li>\r\n	<li>Okay, it&#39;s 500 dollars, you have no choice of carrier, the battery can&#39;t hold the charge and the reception isn&#39;t very&hellip;</li>\r\n</ul>\r\n\r\n<p>Ven ve voke up, ve had zese wodies. So I really am important? How I feel when I&#39;m drunk is correct? Bender, we&#39;re trying our best. You are the last hope of the universe. Or a guy who burns down a bar for the insurance money!</p>\r\n', '2021-04-17 04:43:57', '2021-04-17 04:57:41', '/public/img/loaders/blog-3.jpg', 1),
(6, 1, 'They only come out in the night. Or in this case, the day.', '<p>Oh, everything looks bad if you remember it. A lifetime of working with nuclear power has left me with a healthy green glow&hellip;and left me as impotent as a Nevada boxing commissioner. Kids, you tried your best and you failed miserably. The lesson is, never try.&nbsp; Kids, we need to talk for a moment about Krusty Brand Chew Goo Gum Like Substance. We all knew it contained spider eggs, but the hantavirus? That came out of left field. So if you&#39;re experiencing numbness and/or comas, send five dollars to antidote, PO box&hellip; I&#39;ll keep it short and sweet &mdash; Family. <strong> Religion.</strong> <em> Friendship.</em> These are the three demons you must slay if you wish to succeed in business.</p>\r\n', '<p>They only come out in the night. Or in this case, the day.</p>\r\n\r\n<p>Oh, everything looks bad if you remember it. A lifetime of working with nuclear power has left me with a healthy green glow&hellip;and left me as impotent as a Nevada boxing commissioner. Kids, you tried your best and you failed miserably. The lesson is, never try.</p>\r\n\r\n<p>Kids, we need to talk for a moment about Krusty Brand Chew Goo Gum Like Substance. We all knew it contained spider eggs, but the hantavirus? That came out of left field. So if you&#39;re experiencing numbness and/or comas, send five dollars to antidote, PO box&hellip; I&#39;ll keep it short and sweet &mdash; Family. Religion. Friendship. These are the three demons you must slay if you wish to succeed in business.<br />\r\nPlease do not offer my god a peanut.</p>\r\n\r\n<p>Please do not offer my god a peanut. Beer. Now there&#39;s a temporary solution. D&#39;oh. Remember the time he ate my goldfish? And you lied and said I never had goldfish. Then why did I have the bowl, Bart? *Why did I have the bowl?*</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; What&#39;s the point of going out? We&#39;re just going to wind up back here anyway.<br />\r\n&nbsp;&nbsp;&nbsp; And here I am using my own lungs like a sucker.<br />\r\n&nbsp;&nbsp;&nbsp; I&#39;ll keep it short and sweet &mdash; Family. Religion. Friendship. These are the three demons you must slay if you wish to succeed in business.</p>\r\n\r\n<p>Me fail English? That&#39;s unpossible.</p>\r\n\r\n<p>Dear Mr. President, There are too many states nowadays. Please, eliminate three. P.S. I am not a crackpot. Get ready, skanks! It&#39;s time for the truth train! This is the greatest case of false advertising I&#39;ve seen since I sued the movie &quot;The Never Ending Story.&quot;</p>\r\n\r\n<p>&nbsp;&nbsp;&nbsp; They only come out in the night. Or in this case, the day.<br />\r\n&nbsp;&nbsp;&nbsp; Marge, it takes two to lie. One to lie and one to listen.<br />\r\n&nbsp;&nbsp;&nbsp; A woman is a lot like a refrigerator. Six feet tall, 300 pounds&hellip;it makes ice.</p>\r\n\r\n<p>The Internet King? I wonder if he could provide faster nudity&hellip; I&#39;m a Spalding Gray in a Rick Dees world. Facts are meaningless. You could use facts to prove anything that&#39;s even remotely true! Marge, it takes two to lie. One to lie and one to listen.</p>\r\n\r\n<p>&quot;Thank the Lord&quot;? That sounded like a prayer. A prayer in a public school. God has no place within these walls, just like facts don&#39;t have a place within an organized religion. Marge, you being a cop makes you the man! Which makes me the woman &mdash; and I have no interest in that, besides occasionally wearing the underwear, which as we discussed, is strictly a comfort thing.</p>\r\n\r\n<p>Kids, we need to talk for a moment about Krusty Brand Chew Goo Gum Like Substance. We all knew it contained spider eggs, but the hantavirus? That came out of left field. So if you&#39;re experiencing numbness and/or comas, send five dollars to antidote, PO box&hellip; Jesus must be spinning in his grave!</p>\r\n\r\n<p>They only come out in the night. Or in this case, the day. Me fail English? That&#39;s unpossible. I&#39;m allergic to bee stings. They cause me to, uh, die. I&#39;ll keep it short and sweet &mdash; Family. Religion. Friendship. These are the three demons you must slay if you wish to succeed in business.</p>\r\n\r\n<p>Kids, kids. I&#39;m not going to die. That only happens to bad people. But, Aquaman, you cannot marry a woman without gills. You&#39;re from two different worlds&hellip; Oh, I&#39;ve wasted my life. Dear Mr. President, There are too many states nowadays. Please, eliminate three. P.S. I am not a crackpot.</p>\r\n\r\n<p>How is education supposed to make me feel smarter? Besides, every time I learn something new, it pushes some old stuff out of my brain. Remember when I took that home winemaking course, and I forgot how to drive? I didn&#39;t get rich by signing checks.</p>\r\n\r\n<p>Bart, with $10,000 we&#39;d be millionaires! We could buy all kinds of useful things like&hellip;love! Here&#39;s to alcohol, the cause of &mdash; and solution to &mdash; all life&#39;s problems. What&#39;s the point of going out? We&#39;re just going to wind up back here anyway.</p>\r\n\r\n<p>Me fail English? That&#39;s unpossible. I like my beer cold, my TV loud and my homosexuals flaming. Bart, with $10,000 we&#39;d be millionaires! We could buy all kinds of useful things like&hellip;love! Shoplifting is a victimless crime. Like punching someone in the dark.</p>\r\n\r\n<p>Oh, so they have Internet on computers now! You don&#39;t like your job, you don&#39;t strike. You go in every day and do it really half-assed. That&#39;s the American way. Dear Mr. President, There are too many states nowadays. Please, eliminate three. P.S. I am not a crackpot.</p>\r\n\r\n<p>Marge, just about everything&#39;s a sin. Y&#39;ever sat down and read this thing? Technically we&#39;re not supposed to go to the bathroom. Slow down, Bart! My legs don&#39;t know how to be as long as yours. I like my beer cold, my TV loud and my homosexuals flaming.</p>\r\n\r\n<p>This is the greatest case of false advertising I&#39;ve seen since I sued the movie &quot;The Never Ending Story.&quot; Dear Mr. President, There are too many states nowadays. Please, eliminate three. P.S. I am not a crackpot.</p>\r\n\r\n<p>&nbsp;</p>\r\n', '2021-04-23 23:25:41', '2021-04-23 23:25:41', '/public/img/loaders/blog-9.jpg', 3),
(7, 4, 'The swallow may fly south with the sun.', '<p>We shall say &#39;Ni&#39; again to you, if you do not appease us. It&#39;s only a model. I don&#39;t want to talk to you no more, you empty-headed animal food trough water! I fart in your general direction! Your mother was a hamster and your father smelt of elderberries! Now leave before I am forced to taunt you a second time!And this isn&#39;t my nose. This is a false one. Bring her forward! Well, Mercia&#39;s a temperate zone! She looks like one. <strong> Well, how&#39;d you become king, then?</strong> <em> On second thoughts, let&#39;s not go there.</em> It is a silly place.</p>\r\n', '<h2>Now, look here, my good man.</h2>\r\n\r\n<p>No, no, no! Yes, yes. A bit. But she&#39;s got a wart. I dunno. Must be a king. Oh, ow! Listen. Strange women lying in ponds distributing swords is no basis for a system of government. Supreme executive power derives from a mandate from the masses, not from some farcical aquatic ceremony.</p>\r\n\r\n<ol>\r\n	<li>Where&#39;d you get the coconuts?</li>\r\n	<li>You can&#39;t expect to wield supreme power just &#39;cause some watery tart threw a sword at you!</li>\r\n	<li>Oh, ow!</li>\r\n</ol>\r\n\r\n<h3>Well, we did do the nose.</h3>\r\n\r\n<p>No, no, no! Yes, yes. A bit. But she&#39;s got a wart. Look, my liege! I&#39;m not a witch. Ni! Ni! Ni! Ni!</p>\r\n\r\n<ul>\r\n	<li>You don&#39;t frighten us, English pig-dogs! Go and boil your bottoms, sons of a silly person! I blow my nose at you, so-called Ah-thoor Keeng, you and all your silly English K-n-n-n-n-n-n-n-niggits!</li>\r\n	<li>Burn her anyway!</li>\r\n	<li>Oh! Come and see the violence inherent in the system! Help, help, I&#39;m being repressed!</li>\r\n</ul>\r\n\r\n<p>He hasn&#39;t got shit all over him. Burn her! And the hat. She&#39;s a witch! Why do you think that she is a witch? The Knights Who Say Ni demand a sacrifice!</p>\r\n\r\n<p>And the hat. She&#39;s a witch! He hasn&#39;t got shit all over him. Who&#39;s that then? Shut up! Ni! Ni! Ni! Ni!</p>\r\n\r\n<p>It&#39;s only a model. Be quiet! Burn her anyway! And this isn&#39;t my nose. This is a false one. Who&#39;s that then?</p>\r\n\r\n<p>Bloody Peasant! Now, look here, my good man. You don&#39;t frighten us, English pig-dogs! Go and boil your bottoms, sons of a silly person! I blow my nose at you, so-called Ah-thoor Keeng, you and all your silly English K-n-n-n-n-n-n-n-niggits!</p>\r\n\r\n<p>It&#39;s only a model. A newt? Oh, ow! Burn her! Ni! Ni! Ni! Ni!</p>\r\n\r\n<p>Ni! Ni! Ni! Ni! And this isn&#39;t my nose. This is a false one. I dunno. Must be a king. Oh, ow!</p>\r\n\r\n<p>Who&#39;s that then? We found them. Shut up! Why? Bloody Peasant!</p>\r\n\r\n<p>Why? And the hat. She&#39;s a witch! Well, I got better. No, no, no! Yes, yes. A bit. But she&#39;s got a wart.</p>\r\n\r\n<p>Well, I didn&#39;t vote for you. You don&#39;t vote for kings. Why do you think that she is a witch? And the hat. She&#39;s a witch! Found them? In Mercia?! The coconut&#39;s tropical! &hellip;Are you suggesting that coconuts migrate?</p>\r\n\r\n<p>A newt? Listen. Strange women lying in ponds distributing swords is no basis for a system of government. Supreme executive power derives from a mandate from the masses, not from some farcical aquatic ceremony.</p>\r\n\r\n<p>Ah, now we see the violence inherent in the system! Well, what do you want? Where&#39;d you get the coconuts? Oh! Come and see the violence inherent in the system! Help, help, I&#39;m being repressed! Why do you think that she is a witch?</p>\r\n', '2021-04-23 23:31:48', '2021-04-24 01:35:31', '/public/img/loaders/blog-4.jpg', 3),
(8, 3, 'Michael!', '<p>There&#39;s so many poorly chosen words in that sentence. Say goodbye to these, because it&#39;s the last time! No, I did not kill Kitty. However, I am going to oblige and answer the nice officer&#39;s questions because I am an honest man with no secrets to hide.</p>\r\n', '<p>Say goodbye to these, because it&#39;s the last time! Get me a vodka rocks. And a piece of toast. As you may or may not know, Lindsay and I have hit a bit of a rough patch. No! I was ashamed to be SEEN with you. I like being with you.</p>\r\n\r\n<h2>Steve Holt!</h2>\r\n\r\n<p>But I bought a yearbook ad from you, doesn&#39;t that mean anything anymore? Marry me. Whoa, this guy&#39;s straight? No, I did not kill Kitty. However, I am going to oblige and answer the nice officer&#39;s questions because I am an honest man with no secrets to hide.</p>\r\n\r\n<p>Get me a vodka rocks. And a piece of toast. I&#39;m half machine. I&#39;m a monster. He&#39;ll want to use your yacht, and I don&#39;t want this thing smelling like fish. Oh, you&#39;re gonna be in a coma, all right.</p>\r\n\r\n<h3>Get me a vodka rocks. And a piece of toast.</h3>\r\n\r\n<p>First place chick is hot, but has an attitude, doesn&#39;t date magicians. Say goodbye to these, because it&#39;s the last time! Really? Did nothing cancel? As you may or may not know, Lindsay and I have hit a bit of a rough patch.</p>\r\n\r\n<p>That&#39;s why you always leave a note! Whoa, this guy&#39;s straight? Across from where? Say goodbye to these, because it&#39;s the last time! It&#39;s a hug, Michael. I&#39;m hugging you.</p>\r\n\r\n<p>Get me a vodka rocks. And a piece of toast. Across from where? Marry me. No&hellip; but I&#39;d like to be asked! Really? Did nothing cancel?</p>\r\n\r\n<p>That&#39;s what it said on &#39;Ask Jeeves.&#39; It&#39;s a hug, Michael. I&#39;m hugging you. I&#39;m afraid I just blue myself. No! I was ashamed to be SEEN with you. I like being with you.</p>\r\n\r\n<p>Oh, you&#39;re gonna be in a coma, all right. Across from where? But I bought a yearbook ad from you, doesn&#39;t that mean anything anymore? Say goodbye to these, because it&#39;s the last time! It&#39;s a hug, Michael. I&#39;m hugging you.</p>\r\n\r\n<p>Well, what do you expect, mother? It&#39;s a hug, Michael. I&#39;m hugging you. No&hellip; but I&#39;d like to be asked! That&#39;s why you always leave a note! Not tricks, Michael, illusions.</p>\r\n\r\n<p>First place chick is hot, but has an attitude, doesn&#39;t date magicians. Steve Holt! Guy&#39;s a pro. Army had half a day.</p>\r\n\r\n<p>As you may or may not know, Lindsay and I have hit a bit of a rough patch. Guy&#39;s a pro. I hear the jury&#39;s still out on science. Marry me. No! I was ashamed to be SEEN with you. I like being with you.</p>\r\n\r\n<p>I&#39;m half machine. I&#39;m a monster. Army had half a day. I&#39;m a monster. What&#39;s Spanish for &quot;I know you speak English?&quot; There&#39;s so many poorly chosen words in that sentence.</p>\r\n\r\n<p>As you may or may not know, Lindsay and I have hit a bit of a rough patch. Guy&#39;s a pro. Marry me. There&#39;s so many poorly chosen words in that sentence.</p>\r\n\r\n<p>Michael! It&#39;s called &#39;taking advantage.&#39; It&#39;s what gets you ahead in life. Get me a vodka rocks. And a piece of toast. Oh, you&#39;re gonna be in a coma, all right. That&#39;s why you always leave a note!</p>\r\n\r\n<p>No! I was ashamed to be SEEN with you. I like being with you. I&#39;m half machine. I&#39;m a monster. As you may or may not know, Lindsay and I have hit a bit of a rough patch. First place chick is hot, but has an attitude, doesn&#39;t date magicians.</p>\r\n\r\n<p>Did you enjoy your meal, Mom? You drank it fast enough. I care deeply for nature. Now, when you do this without getting punched in the chest, you&#39;ll have more fun. No&hellip; but I&#39;d like to be asked! But I bought a yearbook ad from you, doesn&#39;t that mean anything anymore?</p>\r\n', '2021-04-28 22:56:42', '2021-04-28 22:57:30', '/public/img/loaders/blog-8.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `img` longtext NOT NULL,
  `username` varchar(16) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `role` varchar(10) DEFAULT 'user',
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `token` varchar(100) DEFAULT NULL,
  `expDate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `img`, `username`, `email`, `password`, `created_at`, `role`, `updated_at`, `token`, `expDate`) VALUES
(1, '/public/img/profile/guilherme-stecanella-UrS5HkBr1Rc-unsplash.jpg', 'Djamina', 'djamina.marboeuf@gmail.com', '$2y$10$VRQ9Qrrj6FP9OncgqKgu5eqp81TzAKkLpQzPNbKzrL/6jL6sqBIni', '2021-05-03 08:41:51', 'admin', '2021-05-03 08:41:51', NULL, NULL),
(2, '/public/img/profile/lee-chinyama-hR9nE6FHD2Q-unsplash.jpg', 'Peggy', 'peggy@fake.com', '$2y$10$frLFwlrXJc2FcYlAASjyWO/9KBdCTGAST3ouabWJ5P4OLsgSDsKPm', '2021-05-03 09:14:10', 'user', '2021-05-03 09:14:10', NULL, NULL),
(3, '/public/img/profile/marcelo-marques-d9STlut5sWQ-unsplash.jpg', 'Danooh', 'danooh@fake.com', '$2y$10$UUOuvMXxosN44wq.CmWQROFhkvPcMiFfWKwNwFc7r5plNLz.w3WoG', '2021-05-03 09:14:49', 'user', '2021-05-03 09:14:49', NULL, NULL),
(4, '/public/img/profile/jason-blackeye-zkUdDlyefew-unsplash.jpg', 'Gaby', 'gabriel@fake.com', '$2y$10$nbeDGVgT3cUopiz04.gIeue.qQYTZIvixqblQ3R9qL.CDLlyp0tuG', '2021-05-03 09:15:16', 'user', '2021-05-03 09:15:16', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `INDEX_post_id` (`post_id`) USING BTREE,
  ADD KEY `INDEX_user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `INDEX_user_id` (`user_id`),
  ADD KEY `INDEX_category_id` (`category_id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
