-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 12 oct. 2023 à 08:56
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `wordpress`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `article_id` int NOT NULL AUTO_INCREMENT,
  `titre_article` varchar(255) NOT NULL,
  `image_article` varchar(255) NOT NULL,
  `contenu_article` text NOT NULL,
  `date_article` date NOT NULL,
  `categorie_article` varchar(50) NOT NULL,
  `statut_article` enum('publié','en attente de relecture','en brouillon') NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`article_id`, `titre_article`, `image_article`, `contenu_article`, `date_article`, `categorie_article`, `statut_article`) VALUES
(1, 'Article 1', 'uploads/6513e2158d7ae.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid quaerat iste neque esse sunt fugit tempore cum, qui facilis architecto doloribus dignissimos nam suscipit, dolorum molestias obcaecati eos expedita? Est quasi aliquid error nostrum doloribus rem maxime iusto libero! Laborum sit modi minus nostrum totam perspiciatis voluptatem voluptates iure laboriosam officiis nisi quos veniam, placeat vero fugit at! Blanditiis, est earum voluptatem, repellat accusantium minima aut vel ullam qui mollitia corrupti. Dignissimos dicta eligendi sit officia! Dicta vitae molestiae repellat voluptas dolor expedita magni cumque, minima dolorem sed adipisci inventore. Accusamus eligendi placeat corporis earum, accusantium iusto! Quas, minima? Sapiente, tempore expedita doloremque corporis dolorem a maxime tempora sed dicta animi natus impedit voluptates dolores vero corrupti saepe, excepturi sint facilis id? Libero, maiores possimus cum corporis, suscipit laudantium et nisi reprehenderit cupiditate nulla quam assumenda quibusdam. Sint ratione cum illum amet deleniti molestiae voluptas perspiciatis sed. Fugiat, natus architecto?', '2023-09-27', 'Politique', 'en attente de relecture'),
(2, 'Article 2', 'uploads/6513e2cb2efaf.jpg', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Aliquid quaerat iste neque esse sunt fugit tempore cum, qui facilis architecto doloribus dignissimos nam suscipit, dolorum molestias obcaecati eos expedita? Est quasi aliquid error nostrum doloribus rem maxime iusto libero! Laborum sit modi minus nostrum totam perspiciatis voluptatem voluptates iure laboriosam officiis nisi quos veniam, placeat vero fugit at! Blanditiis, est earum voluptatem, repellat accusantium minima aut vel ullam qui mollitia corrupti. Dignissimos dicta eligendi sit officia! Dicta vitae molestiae repellat voluptas dolor expedita magni cumque, minima dolorem sed adipisci inventore. Accusamus eligendi placeat corporis earum, accusantium iusto! Quas, minima? Sapiente, tempore expedita doloremque corporis dolorem a maxime tempora sed dicta animi natus impedit voluptates dolores vero corrupti saepe, excepturi sint facilis id? Libero, maiores possimus cum corporis, suscipit laudantium et nisi reprehenderit cupiditate nulla quam assumenda quibusdam. Sint ratione cum illum amet deleniti molestiae voluptas perspiciatis sed. Fugiat, natus architecto?', '2023-09-27', 'Economie', 'en brouillon'),
(3, 'Article 3', 'uploads/6513e3570741d.jpg', 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Earum labore sed minus animi sit a pariatur ad corporis nemo accusantium. Non rerum sit quod magni explicabo, ipsa error. Officia voluptas quam vel sed quisquam, excepturi deleniti non eligendi eveniet sapiente ex architecto atque quas ea porro consectetur, blanditiis id voluptatum sequi asperiores. Vero vel doloremque reprehenderit tempora tempore blanditiis illum accusantium optio, autem fugit, iusto iste exercitationem qui ipsam, quisquam similique. Quas nesciunt quaerat quos illo, aut corrupti magnam reprehenderit, iusto voluptates aliquid id voluptatibus veniam sed dolor, eligendi hic facilis blanditiis quis repellendus excepturi quia fuga veritatis incidunt? Delectus minus similique enim iste? Obcaecati voluptatem reiciendis expedita omnis provident perspiciatis dolorem nemo at molestias accusantium maiores, quas excepturi architecto alias aperiam facere possimus velit quasi ex hic atque sit quaerat? Quae minus, odio voluptas culpa placeat consequuntur iusto velit molestias aliquid illo, accusantium quas a magni. Distinctio quia libero ducimus quas maxime ab consequatur similique enim asperiores, deserunt repellendus labore quasi animi non cumque minima molestias qui ipsam aspernatur aut? Optio voluptas ipsa praesentium quae corrupti alias esse accusamus voluptates! Natus, amet doloremque obcaecati et suscipit ratione nisi sit nulla repellat fugiat, perspiciatis corporis laboriosam expedita voluptatem a voluptas!', '2023-09-27', 'Politique', 'publié'),
(4, 'Article 4', 'uploads/6513e3896e79f.jpg', 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Labore ipsam possimus corporis impedit excepturi alias nisi odio ut nostrum eveniet natus nemo nihil aliquam animi, nesciunt quos perspiciatis debitis quam deserunt voluptates laboriosam asperiores modi accusamus! Itaque, facilis! Totam adipisci nulla vel libero illo perspiciatis atque, voluptates ipsam sint nesciunt distinctio perferendis consectetur nisi sed? Nemo qui beatae laudantium dolor illo, ullam error soluta ad alias suscipit laboriosam facilis aliquid natus recusandae tenetur quos incidunt. Voluptatem nulla recusandae veritatis magnam laborum praesentium sunt quae voluptatibus, culpa suscipit rem quo error, quos laboriosam ullam aperiam consequuntur? Ea nostrum corrupti fugit consequatur corporis neque sed iste quasi placeat non enim, impedit similique, qui possimus? Quo error quae vero! Doloribus voluptatibus asperiores necessitatibus odit totam atque assumenda nostrum fugit laboriosam, optio distinctio eaque animi quibusdam corporis cumque beatae accusamus qui alias libero! Sapiente asperiores itaque quas sint quos laboriosam, quasi veniam dicta aliquam possimus voluptatem corporis fugit nostrum cum, minus nam perspiciatis expedita ullam quae ad? Delectus, velit id eos quidem quae natus, nostrum quasi deserunt quaerat, animi similique dolorem eius aliquid fuga quia consequuntur hic inventore voluptatibus porro enim impedit! Aut, at. Nulla necessitatibus qui, reprehenderit ad officia amet veritatis alias eius?', '2023-09-27', 'Economie', 'en attente de relecture'),
(5, 'Article 5', 'uploads/6513e3b9d6b57.jpg', 'Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam facilis culpa cum quas qui quisquam molestias dolore pariatur nulla ab perspiciatis sapiente modi hic consectetur cupiditate non porro, eveniet facere, sequi blanditiis harum? Officiis praesentium sit aliquam illo odio hic nobis rerum ea est provident nesciunt sapiente, recusandae dolorem commodi iusto reiciendis quaerat, quidem perspiciatis sint deserunt magnam. Quaerat facere obcaecati saepe aperiam fugit enim rerum, eum voluptatum soluta debitis voluptates neque, reiciendis, corrupti illum laboriosam libero aspernatur. Est dolores perferendis explicabo rem commodi suscipit. Impedit unde reprehenderit laborum consectetur quas consequatur itaque quam accusamus saepe. Quas dolore voluptatum ipsa sit non vero neque omnis iusto dolores odit excepturi debitis provident amet, nulla officia nam mollitia, nemo deserunt. Accusamus atque iure obcaecati optio dignissimos impedit dolore. Animi autem at dolor, fuga neque iusto eveniet voluptas, delectus esse nisi tempora recusandae corrupti eum ab? Quibusdam excepturi quis quas? Voluptatem quaerat velit, consequuntur aut sit alias nobis provident harum delectus corporis officiis architecto eum quo, debitis voluptas dolorem eveniet. Veritatis, magnam voluptate eius suscipit amet temporibus tempora aperiam exercitationem reiciendis recusandae maxime assumenda dolores ducimus? Quam accusamus voluptatum nihil doloribus aperiam voluptates earum praesentium dicta enim unde, facere culpa tempore quidem blanditiis.', '2023-09-27', 'Politique', 'publié'),
(6, 'Article 6', 'uploads/6513e511c1b79.jpg', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Temporibus perferendis eos aperiam consectetur, esse qui voluptate eius ratione dicta odit excepturi sit sequi molestias quo unde quos nostrum doloremque dolores? Modi repellat maiores provident, aut quam obcaecati officiis id consequuntur labore beatae quidem vero sunt magni mollitia ea quasi quas ducimus, molestias eveniet blanditiis nihil fugit architecto fuga culpa? Fugit impedit sit exercitationem ut nemo. Architecto maiores ipsum atque quos accusamus libero rem at totam asperiores eos, laborum id facere possimus itaque molestiae ullam officiis sunt, omnis dolores? Tenetur tempora aliquid, facere quasi sed beatae corrupti, adipisci labore quo repellendus vero debitis odio nam. Quaerat omnis eos voluptatem libero aliquam in aperiam unde, hic accusamus voluptas reprehenderit, aut saepe esse natus dicta ad asperiores id nulla numquam excepturi fugiat provident adipisci? Excepturi at reprehenderit ipsum, aut quasi commodi molestias, minima cupiditate illum tenetur illo iste eum laboriosam cumque nulla accusamus odit? Fugiat tenetur atque in cupiditate? Illo, earum? Aliquam necessitatibus libero numquam iusto tempore sapiente adipisci dicta assumenda perferendis distinctio tempora, exercitationem perspiciatis, vitae a tenetur magnam, doloribus corrupti? Iusto consequatur mollitia hic, dolore incidunt explicabo sit fugit cum dolor sequi cupiditate assumenda aut corrupti fuga doloribus, laborum deserunt quas.', '2023-09-27', 'Economie', 'publié');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
