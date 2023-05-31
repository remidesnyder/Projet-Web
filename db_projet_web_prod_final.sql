-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mer. 31 mai 2023 à 11:56
-- Version du serveur : 5.7.39
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `db_projet_web_prod`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` text NOT NULL,
  `reactions` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`id`, `movieID`, `userID`, `content`, `reactions`, `created_at`, `updated_at`) VALUES
(20, 19123, 2, 'C\'était une expérience cinématographique divertissante. Ce film français, réalisé par Francis Veber, est une comédie hilarante qui mêle l\'absurdité et les quiproquos.\r\n\r\nL\'histoire tourne autour d\'un détective malchanceux, joué par Pierre Richard, qui est chargé de retrouver la fille d\'un riche homme d\'affaires. Pour l\'aider dans sa quête, on lui assigne un garde du corps, interprété par Gérard Depardieu, dont l\'incompétence ajoute une dimension comique à l\'intrigue.\r\n\r\n\"La Chèvre\" est un film qui repose principalement sur le duo comique formé par Richard et Depardieu. Leur chimie à l\'écran est indéniable, et ils offrent des performances comiques vraiment mémorables. Les situations loufoques dans lesquelles ils se retrouvent et les dialogues plein d\'humour font mouche et m\'ont fait rire tout au long du film.\r\n\r\nBien que l\'histoire puisse sembler simple, le scénario est bien rythmé et maintient l\'intérêt du spectateur jusqu\'à la fin. La réalisation de Francis Veber est efficace, mettant en valeur le talent des acteurs et la nature comique de l\'histoire.\r\n\r\nEn résumé, \"La Chèvre\" est un classique de la comédie française qui mérite d\'être vu. Si vous recherchez un film léger et amusant, avec des performances comiques mémorables, alors je vous recommande vivement de regarder ce film.', 2, '2023-05-23 20:40:45', '2023-05-23 20:40:45'),
(21, 10484, 2, 'Une comédie divertissante et amusante.', 0, '2023-05-23 20:43:48', '2023-05-23 20:43:48'),
(22, 761, 2, 'Une comédie gastronomique délicieusement drôle.', 0, '2023-05-24 06:55:46', '2023-05-24 06:55:46'),
(23, 71524, 2, 'Une comédie d\'aventure légère et divertissante.', 0, '2023-05-24 06:56:41', '2023-05-24 06:56:41'),
(24, 1672, 2, 'Ce qui rend Le Professionnel si captivant, c\'est le mélange habile d\'action, de suspense et de tension. Les scènes d\'action sont bien chorégraphiées et Belmondo livre une performance remarquable en incarnant un personnage à la fois charismatique et impitoyable. Le film aborde également des thèmes plus profonds, tels que la corruption politique et la loyauté.', 0, '2023-05-24 06:59:37', '2023-05-24 06:59:37'),
(25, 51163, 2, 'Effroyables Jardins est un film qui touche le cœur par sa capacité à aborder des sujets graves avec humanité et tendresse.\r\nEffroyables Jardins est un film émouvant et poignant, porté par des performances remarquables', 0, '2023-05-24 07:02:34', '2023-05-24 07:02:34'),
(26, 9421, 2, 'Le Dîner de Cons repose sur un humour intelligent et des dialogues ciselés. Les situations loufoques et les quiproquos qui se déroulent tout au long du film provoquent des éclats de rire. Les performances de Thierry Lhermitte et Jacques Villeret sont brillantes, avec une chimie comique irrésistible.', 0, '2023-05-24 07:04:09', '2023-05-24 07:04:09'),
(27, 60030, 2, 'C\'est une histoire poignante et émouvante inspirée d\'événements réels.', 0, '2023-05-24 07:04:48', '2023-05-24 07:04:48'),
(28, 360638, 2, 'C\'est un film charmant et drôle qui explore les relations intergénérationnelles.', 0, '2023-05-24 07:06:25', '2023-05-24 07:06:25'),
(29, 54544, 2, 'C\'est un film divertissant et plein d\'humour qui explore les dynamiques familiales et les relations amoureuses.', 0, '2023-05-24 07:07:09', '2023-05-24 07:07:09'),
(30, 36719, 2, 'Les Enfants du marais est un film touchant qui transporte le spectateur dans une époque révolue et offre une belle réflexion sur l\'amitié et les plaisirs simples de la vie.', 0, '2023-05-24 07:08:05', '2023-05-24 07:08:05'),
(31, 49838, 2, '\'Antidote est une comédie française amusante qui offre des moments de rires et de légèreté.', 0, '2023-05-24 07:08:56', '2023-05-24 07:08:56'),
(32, 481848, 2, 'Un film rempli d\'humour, de tendresse et d\'amour', 0, '2023-05-24 07:19:13', '2023-05-24 07:19:13'),
(33, 9317, 3, 'Magnifique', 0, '2023-05-24 07:24:51', '2023-05-24 07:24:51'),
(34, 335977, 3, 'La fin est ....', 0, '2023-05-24 07:25:27', '2023-05-24 07:25:27');

-- --------------------------------------------------------

--
-- Structure de la table `comments_reactions`
--

CREATE TABLE `comments_reactions` (
  `id` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `comments_reactions`
--

INSERT INTO `comments_reactions` (`id`, `commentID`, `userID`, `created_at`) VALUES
(1, 20, 2, '2023-05-23 20:42:54'),
(2, 20, 3, '2023-05-24 07:24:33');

-- --------------------------------------------------------

--
-- Structure de la table `favorites_movies`
--

CREATE TABLE `favorites_movies` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `add_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `favorites_movies`
--

INSERT INTO `favorites_movies` (`id`, `userID`, `movieID`, `add_date`) VALUES
(4, 2, 61864, '2023-05-26 10:07:03'),
(5, 2, 19123, '2023-05-26 10:14:12');

-- --------------------------------------------------------

--
-- Structure de la table `movies`
--

CREATE TABLE `movies` (
  `id` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `overview` text,
  `poster_path` varchar(255) DEFAULT NULL,
  `runtime` int(11) DEFAULT NULL,
  `release_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movies`
--

INSERT INTO `movies` (`id`, `movieID`, `title`, `overview`, `poster_path`, `runtime`, `release_date`) VALUES
(1, 19123, 'La Chèvre', 'La fille du Grand PDG Bens est tellement malchanceuse qu’elle se fait enlever alors qu’elle est en vacances au Mexique. Pour la retrouver, son père engage le détective privé Campana qu’il associe à un gaffeur invétéré dans l’espoir qu’il le rapproche de sa fille…', '/d8n2XF8P6SIP6JywsuWFTmp9OTs.jpg', 90, '1981-12-09 00:00:00'),
(2, 61864, 'La Carapate', 'En mai 1968, un avocat, Jean-Philippe Duroc, quitte Paris afin de rendre visite à son client en prison, Martial Gaulard. Accusé de meurtre, il lui annonce que son pourvoi en cassation a été rejeté, faisant de lui un condamné à la peine capitale. Alors qu\'il apprend la terrible nouvelle, une mutinerie éclate: Gaulard en profite pour s\'échapper, entraînant avec lui, son pauvre avocat dans une véritable course poursuite.', '/6u3Nl8K4JHGBB7rhvleeyrSSdCd.jpg', 100, '1978-10-10 00:00:00'),
(3, 796185, 'Les Trois Mousquetaires : D\'Artagnan', 'Du Louvre au Palais de Buckingham, des bas-fonds de Paris au siège de La Rochelle… Dans un Royaume divisé par les guerres de religion et menacé d’invasion par l’Angleterre, une poignée d’hommes et de femmes vont croiser leurs épées et lier leur destin à celui de la France.', '/lm0pfF0HSLsSpFlhGCmR6Bhl8EE.jpg', 0, '2023-04-05 00:00:00'),
(4, 967874, 'Tirailleurs', '1917. Bakary Diallo s\'enrôle dans l\'armée française pour rejoindre Thierno, son fils de 17 ans, qui a été recruté de force. Envoyés sur le front, père et fils vont devoir affronter la guerre ensemble. Galvanisé par la fougue de son officier qui veut le conduire au cœur de la bataille, Thierno va s\'affranchir et apprendre à devenir un homme, tandis que Bakary va tout faire pour l\'arracher aux combats et le ramener sain et sauf.', '/3kM3NzcsfxDqDRqpTdenSKj4ZGl.jpg', 109, '2023-01-04 00:00:00'),
(6, 502356, 'Super Mario Bros. le film', 'Alors qu’ils tentent de réparer une canalisation souterraine, Mario et son frère Luigi, tous deux plombiers, se retrouvent plongés dans un nouvel univers féerique à travers un mystérieux conduit. Mais lorsque les deux frères sont séparés, Mario s’engage dans une aventure trépidante pour retrouver Luigi.  Dans sa quête, il peut compter sur l’aide du champignon Toad, habitant du Royaume Champignon, et les conseils avisés, en matière de techniques de combat, de la Princesse Peach, guerrière déterminée à la tête du Royaume. C’est ainsi que Mario réussit à mobiliser ses propres forces pour aller au bout de sa mission.', '/ahMxyHMSJXingQr4yJBMzMU9k42.jpg', 0, '2023-04-05 00:00:00'),
(7, 594767, 'Shazam! La rage des Dieux', 'Investis des pouvoirs des dieux, Billy Batson et ses copains apprennent encore à concilier leur vie d’ados avec leurs responsabilités de super-héros dès lors qu’ils se transforment en adultes. Mais quand les Filles de l’Atlas, trio d’anciennes déesses ivres de vengeance, débarquent sur Terre pour retrouver la magie qu’on leur a volée il y a longtemps, Billy, alias Shazam, et sa famille s’engagent dans une bataille destinée à conserver leurs superpouvoirs, à rester en vie et à sauver la planète. Mais une bande d’adolescents peut-elle vraiment empêcher la destruction du monde ? Et, surtout, Billy en a-t-il seulement envie ... ?', '/fcBXkQygo8h2PK0KnxOxzkbD9p.jpg', 0, '2023-03-29 00:00:00'),
(8, 76600, 'Avatar : La Voie de l\'eau', 'Jake Sully et Neytiri sont devenus parents. L\'intrigue se déroule une dizaine d\'années après les événements racontés dans le long-métrage originel. Leur vie idyllique, proche de la nature, est menacée lorsque la « Resources Development Administration », dangereuse organisation non-gouvernementale, est de retour sur Pandora. Contraints de quitter leur habitat naturel, Jake et sa famille se rendent sur les récifs, où ils pensent trouver asile. Mais ils tombent sur un clan, les Metkayina, aux mœurs différentes des leurs...', '/hYeB9GpFaT7ysabBoGG5rbo9mF4.jpg', 0, '2022-12-14 00:00:00'),
(9, 677179, 'Creed III', 'Après avoir dominé le monde de la boxe, Adonis Creed s\'épanouit tant dans sa carrière que dans sa vie de famille. Lorsqu\'un ami d\'enfance et ancien prodige de la boxe, Damien Anderson, refait surface après avoir purgé une longue peine de prison, il est impatient de prouver qu\'il mérite sa chance sur le ring. Le face-à-face entre les anciens amis est plus qu\'un simple combat. Pour régler ses comptes, Adonis doit mettre son avenir en jeu pour affronter Damien - un boxeur qui n\'a rien à perdre.', '/hYQs5RPHiWctoYqvI8baHiIqdd8.jpg', 0, '2023-03-01 00:00:00'),
(10, 700391, '65 : La Terre d\'avant', 'Après un terrible crash sur une planète inconnue, le pilote Mills découvre rapidement qu’il a en réalité échoué sur Terre… il y a 65 millions d’années. Pour réussir leur unique chance de sauvetage, Mills et Koa l’unique autre survivante du crash, doivent se frayer un chemin à travers des terres inconnues peuplées de dangereuses créatures préhistoriques dans un combat épique pour leur survie.', '/jYxRG1aeVKoLG48Jlka0QMpGzsb.jpg', 0, '2023-03-15 00:00:00'),
(11, 638974, 'Murder Mystery 2', 'Désormais détectives à plein temps, Nick et Audrey Spitz peinent à faire décoller leur agence et se retrouvent au cœur d\'une affaire d\'enlèvement internationale lorsque leur ami le maharaja est kidnappé au cours de son propre somptueux mariage.', '/gYF3RJbZuks7PnpL0flaMj9Y9uB.jpg', 0, '2023-03-31 00:00:00'),
(12, 315162, 'Le Chat Potté 2 : la dernière quête', 'Le Chat Potté découvre que sa passion pour l\'aventure et son mépris du danger ont fini par lui coûter cher : il a épuisé huit de ses neuf vies, et en a perdu le compte au passage. Afin de retomber sur ses pattes notre héros velu se lance littéralement dans la quête de sa vie. Il s\'embarque dans une aventure épique aux confins de la Forêt Sombre afin de dénicher la mythique Etoile à vœu, seule susceptible de lui rendre ses vies perdues. Mais quand il ne vous en reste qu’une, il faut savoir faire profil bas, se montrer prudent et demander de l’aide. C’est ainsi qu’il se tourne vers son ancienne partenaire et meilleure ennemie de toujours : l’ensorcelante Kitty Pattes De Velours. Le Chat Potté et la belle Kitty vont être aidés dans leur quête, à leur corps bien défendant, par Perro, un corniaud errant et galleux à la langue bien pendue et d’une inaltérable bonne humeur.', '/kO35BwoKHyP1VRulxZJVeEl5dvS.jpg', 0, '2022-12-07 00:00:00'),
(13, 758323, 'L\'exorciste du Vatican', 'Le film retrace les exploits du Père Gabriele Amorth. Le légendaire prêtre italien était le chef exorciste du Vatican. Il a réalisé plus de 100 000 exorcismes pour l\'Église jusqu\'à sa mort en 2016 durant le tournage du documentaire de William Friedkin, The Devil and Father Amorth.', '/s2h9MG6pFLh7W0oD2R6YUFPn7GO.jpg', 0, '2023-05-10 00:00:00'),
(14, 603692, 'John Wick : Chapitre 4', 'John Wick affronte ses adversaires les plus redoutables dans ce quatrième volet de la série.  De New York à Osaka, en passant par Paris et Berlin, John Wick mène un combat contre la Grande Table, la terrible organisation criminelle qui a mis sa tête à prix, en affrontant ses tueurs les plus dangereux...', '/jAMVKvqxdNbUY2YQWhCclYI6coP.jpg', 0, '2023-03-22 00:00:00'),
(15, 804150, 'Crazy Bear', 'En 1985 une cargaison de cocaïne disparue après le crash de l\'avion qui la transportait, avait été en fait ingérée par un ours brun. Tel est le point de départ de ce thriller haletant où, au cœur d\'une forêt du fin fond de la Georgie, va se former un groupe mal assorti de flics, de criminels, de touristes et d\'adolescents, assemblés pour affronter un super prédateur enragé et assoiffé de sang, rendu complètement fou par l\'ingestion d\'une dose faramineuse de cocaïne.', '/crl0mZX2wPzuB7YYslcU8UIv1Ml.jpg', 0, '2023-03-15 00:00:00'),
(16, 816904, 'Sacrées Momies', 'Vous êtes-vous déjà demandé à quoi ressemblait le monde des momies ? Sous les pyramides d’Egypte se trouve un royaume fabuleux, où les momies conduisent des chars, rêvent de devenir des pop stars et vivent à l’écart de la civilisation humaine. Mais lorsqu’un archéologue sans scrupule pille un de leur trésors, Thut et la princesse Nefer, fiancés malgré eux, se voient contraints de faire équipe et de se rendre dans le monde des vivants. Accompagnés par le frère de Thut et son crocodile domestique, ils vont vivre une aventure hors du commun à Londres et former une amitié inattendue.', '/c672hw7RVSaxRDLt67c38EdFizW.jpg', 0, '2023-02-08 00:00:00'),
(17, 980078, 'Winnie the Pooh: Blood and Honey', 'Après avoir été abandonnés par Christopher Robin à l\'université, Winnie et Porcinet se déchaînent.', '/fNTtVbqI92abEKAgz2ynurCUne.jpg', 0, '2023-03-24 00:00:00'),
(18, 736790, 'Chupa', 'À 13 ans, le timide Alex s\'envole pour le Mexique depuis le Missouri afin de rencontrer sa famille pour la première fois : son grand-père Chava, ancien champion de lucha libre, son cousin Memo, une pile électrique fan de lutte, et sa cousine Luna, intrépide et branchée. Alors qu\'il commence à s\'intégrer, Alex découvre une créature mythique qui vit dans la remise de son grand-père : un bébé chupacabra qui lui rappelle les histoires effrayantes de l\'un de ses congénères adultes s\'attaquant aux bêtes des éleveurs. Alex apprend que son nouvel ami, Chupa, partage un secret avec sa famille et qu\'un chercheur intraitable et dangereux, Richard Quinn, pourchasse la créature incomprise pour tenter d\'exploiter ses pouvoirs. Afin de protéger Chupa, Alex se lance dans une grande aventure qui va mettre à l\'épreuve les liens de sa famille et lui rappeler que les difficultés de la vie sont plus faciles à supporter à plusieurs.', '/ra3xm8KFAkwK0CdbPRkfYADJYTB.jpg', 0, '2023-04-07 00:00:00'),
(19, 640146, 'Ant-Man et la Guêpe : Quantumania', 'Scott Lang et Hope Van Dyne font équipe avec les parents de Hope et la fille de Scott pour explorer le monde quantique, interagir avec d\'étranges nouvelles créatures et se lancer dans une aventure qui les poussera au-delà des limites de ce qu\'ils croyaient possible.', '/xg6acFlE0RVMaNpcZuCq3cMYxx0.jpg', 0, '2023-02-15 00:00:00'),
(20, 505642, 'Black Panther : Wakanda Forever', 'La Reine Ramonda, Shuri, M’Baku, Okoye et les Dora Milaje luttent pour protéger leur nation des ingérences d’autres puissances mondiales après la mort du roi T’Challa. Alors que le peuple s’efforce d’aller de l’avant, nos héros vont devoir s’unir et compter sur l’aide de la mercenaire Nakia et d’Everett Ross pour faire entrer le royaume du Wakanda dans une nouvelle ère. Mais une terrible menace surgit d’un royaume caché au plus profond des océans : Talokan.', '/nsQt8kl5c5I7ZQknTzl133e8reh.jpg', 0, '2022-11-09 00:00:00'),
(21, 436270, 'Black Adam', 'Près de 5000 ans après avoir été doté des pouvoirs tout puissants des dieux égyptiens – et emprisonné très rapidement après – Black Adam est libéré de sa tombe terrestre, prêt à faire régner sa forme unique de justice dans le monde moderne.', '/hYALH5NPM7xk2XQd2J8wrfmliIW.jpg', 0, '2022-10-19 00:00:00'),
(22, 296271, 'The Devil Conspiracy', 'Une puissante société secrète dispose d\'une technologie révolutionnaire lui permettant de cloner les personnes les plus influentes de l\'histoire, avec seulement quelques fragments d\'ADN. Derrière cette entreprise se cache une cabale de satanistes qui volent le suaire de Turin, les mettant ainsi en possession de l\'ADN de Jésus-Christ. Le clone servira d\'offrande ultime au diable.', '/3u2PoQOeGeITp7WoNEBQ5xShg2A.jpg', 0, '2023-03-30 00:00:00'),
(23, 646389, 'Mayday', 'Le pilote Brodie Torrance sauve des passagers d\'un coup de foudre en effectuant un atterrissage risqué sur une île déchirée par la guerre seulement pour découvrir que survivre à l\'atterrissage n\'était que le début. Lorsque de dangereux rebelles prennent la plupart des passagers en otage, la seule personne sur laquelle Torrance peut compter pour obtenir de l\'aide est Louis Gaspare, un meurtrier accusé qui a été transporté par le FBI.', '/qGKE0vJsydUcRzeoR2r5j3W25Il.jpg', 0, '2023-01-25 00:00:00'),
(24, 631842, 'Knock at the Cabin', 'Alors qu’ils passent leurs vacances dans un chalet isolé en pleine nature, une jeune fille et ses parents sont pris en otage par quatre étrangers armés qui exigent d’eux un choix impossible afin d’éviter l’imminence de l’apocalypse. Alors qu’ils n’ont pratiquement aucun moyen de communication avec le reste du monde, ils vont devoir seuls prendre et assumer leur décision.', '/he2uDTy6CFUgdaHw3EeKjRmD92F.jpg', 0, '2023-02-01 00:00:00'),
(25, 536554, 'M3GAN', 'M3GAN est une merveille d\'intelligence artificielle, une poupée réaliste qui est programmée pour être la meilleure compagne d\'un enfant et la meilleure alliée d\'un parent. Conçue par Gemma, une brillante roboticienne, M3GAN peut écouter, regarder et apprendre, car elle joue le rôle d\'amie et d\'enseignante, de compagne de jeu et de protectrice.', '/xBl5AGw7HXZcv1nNXPlzGgO4Cfo.jpg', 0, '2022-12-28 00:00:00'),
(51, 1008005, 'The Communion Girl', 'Espagne, fin des années 1980. Sara, une nouvelle venue, essaie de s’intégrer aux autres adolescents de cette petite ville très unie de la province de Tarrgona. Si seulement elle était plus semblable à sa meilleure amie extravertie, Rebe. Un soir, elles sortent en boîte de nuit et, sur le chemin du retour, elles croisent une petite fille tenant une poupée, habillée pour sa première communion. Et c’est là que le cauchemar commence.', '/sGSzha9K65abyvzBwXXnSV2sHWV.jpg', 0, '2023-01-28 00:00:00'),
(52, 1104040, 'Gangs of Lagos', 'Les destins entrecroisés d\'un jeune caïd et de sa bande d\'amis, qui ont grandi dans les rues d\'un quartier animé et violent de Lagos, au Nigeria.', '/nGwFsB6EXUCr21wzPgtP5juZPSv.jpg', 0, '2023-04-07 00:00:00'),
(53, 713704, 'Evil Dead Rise', 'La réunion de deux sœurs séparées est interrompue par l\'apparition de démons possesseurs de chair, les poussant dans une bataille primitive pour la survie alors qu\'elles font face à la version la plus cauchemardesque de la famille imaginable.', '/eDfimAZLXksB48zMWoZa9uzLzrI.jpg', 0, '2023-04-19 00:00:00'),
(54, 676710, 'Maurice le chat fabuleux', 'Maurice, un chat des rues, a une idée géniale pour gagner de l\'argent. Il trouve un adolescent idiot qui joue de la flûte et qui possède une horde de rats alphabètes. Quand Maurice, le joueur de flûte et les rats atteignent la ville dévastée de Bad Blintz, ils ne vont pas tarder à découvrir que quelque chose de très grave les attend dans les caves de la cité...', '/rSfSTfp2jhPxtqt0kc6Kqh3mIdi.jpg', 0, '2023-02-01 00:00:00'),
(55, 761, 'L\'Aile ou la Cuisse', 'Charles Duchemin, le directeur d’un guide gastronomique qui vient d’être élu à l’Académie Française, se trouve un adversaire de taille en la personne de Jacques Tricatel, le PDG d’une chaîne de restaurants. Son fils Gérard anime en cachette une petite troupe de cirque.', '/bPiy54eS2243YKp6l5u73UOL226.jpg', 104, '1976-10-27 00:00:00'),
(56, 39514, 'Red', 'L\'heure de la retraite a sonné ! Mais dans certaines professions, la transition peut s\'avérer difficile : Franck ne supporte pas l\'inactivité, son collègue Joe végète en maison de retraite, Marvin use d\'amphétamines et Victoria fait des petits boulots. Pas facile de décrocher quand on a été... agents de la CIA toute sa vie ! Pourtant, quand leur ancien employeur décide d\'éliminer pour de bon ces agents un peu trop compromettants, il va découvrir qu\'en dépit de leur âge, ce sont encore de redoutables adversaires.', '/hRTfxanBh6nquaTCrDtRFeLdctD.jpg', 111, '2010-10-13 00:00:00'),
(57, 948713, 'The Last Kingdom : Sept rois doivent mourir', 'Pendant un siècle, la guerre a fait rage entre les habitants de l\'île de Bretagne et les envahisseurs danois. Aujourd\'hui, la paix s\'installe au sein d\'un pays presque unifié, puisque seul le seigneur Uhtred de Bebbanburg, qui règne sur la Northumbrie, doit encore prêter allégeance à la couronne. À la mort du roi Edward, cette harmonie fragile se trouve menacée par la rivalité de ses deux héritiers potentiels, Aethelstan et Aelfweard, qui revendiquent le trône...Dans le même temps, les côtes voient débarquer le roi-guerrier danois Anlaf, venu semer la désolation et exploiter les dissensions à son avantage. Tandis qu\'Aethelstan se fait des ennemis dans toutes les îles britanniques, Anlaf rassemble les personnalités hostiles au roi au sein d\'une grande alliance qui risque de mettre à mal le rêve d\'union de l\'Angleterre. Lorsque Uhtred est pressenti pour les rejoindre, il doit choisir entre ceux qui comptent le plus à ses yeux et sa vision d\'un royaume uni.', '/qcNDxDzd5OW9wE3c8nWxCBQoBrM.jpg', 0, '2023-04-14 00:00:00'),
(58, 10939, 'Le Retour du Grand Blond', 'Trois mois après la fin de Le Grand Blond avec une chaussure noire, le capitaine Cambrai, qui enquête sur la mort étrange du colonel Milan, intercepte une lettre de François Perrin, qui file le grand amour avec Christine à Rio de Janeiro, dans laquelle il avoue à son ami Maurice la supercherie du colonel Toulouse. Ce dernier, mis en difficulté, doit désormais prouver que le grand blond est bien un super agent secret et non pas un inconnu choisi au hasard.', '/vhcOXRmPcUJHcM21TuMWddCnu2j.jpg', 80, '1974-11-12 00:00:00'),
(59, 61852, 'Le Grand Bazar', 'Jean, Phil, Gérard et Jean-Guy sont quatre copains qui habitent la même HLM. Ils préfèrent passer leur temps dans le bistrot d\'Émile plutôt que d\'aller travailler et quand ils vont au travail, ils ne tardent pas à se faire renvoyer à cause de leur manque de professionnalisme. Émile les aidera à retrouver du boulot et quand lui-même sera menacé par la concurrence du supermarché voisin \"Euromarché\", les quatre amis n\'hésiteront pas à l\'aider...', '/lCuWpK6SkUn3lOAvkdCOT3x4jW6.jpg', 86, '1973-09-06 00:00:00'),
(60, 10045, 'Banlieue 13', 'Paris, 2013. Damien est l\'élite de la police. Officier d\'une unité spéciale d\'intervention, expert en arts martiaux, il est passé maître dans l\'art de l\'infiltration et sait mener à terme ses opérations par des actions rapides, précises et néanmoins musclées.Et c\'est bien la mission la plus extrême de sa carrière qui vient de lui être confiée : une arme de destruction massive a été dérobée par le plus puissant gang de la banlieue. Damien est chargé d\'infiltrer dans le secteur pour désamorcer la bombe ou la récupérer.', '/cupEyY2dOGJa9zkEWO3Sy9n2zl9.jpg', 95, '2004-11-09 00:00:00'),
(61, 15357, 'Banlieue 13 : Ultimatum', 'Banlieue 13, deux ans plus tard. Le gouvernement a changé, pas le reste... Le mur d\'isolement - toujours plus haut, toujours plus grand, toujours plus loin - s\'est étendu autour des cités ghettos et les gangs qui y prolifèrent ont encore accru leur influence. Le trafic se répartit désormais entre cinq quartiers ethniques, chacun dirigé par un redoutable chef de gang. Plus que jamais déterminés à \"régler le problème\", les services secrets mettent volontairement le feu aux poudres. Damien, flic expert en arts martiaux, et Leïto, capable de se faufiler dans les moindres recoins de la banlieue, font à nouveau équipe. Leur objectif : sauver la cité du chaos. Leur programme : combats musclés et course-poursuites défiant les lois de la gravité...', '/xDaapoHh6OrPqBPVx0wOFjSglQD.jpg', 98, '2009-02-18 00:00:00'),
(62, 868759, 'Ghosted', 'Cole, un agriculteur sans histoire, tombe éperdument amoureux de la mystérieuse Sadie, mais découvre avec stupeur qu\'elle est agent secret. Avant même un second rencard, Cole et Sadie vont être embarqués dans une aventure au-delà des frontières lors de laquelle ils vont devoir sauver le monde.', '/tds2CSzH5tPAc9CbeUDRtSVzFhs.jpg', 0, '2023-04-21 00:00:00'),
(63, 934433, 'Scream VI', 'Après avoir frappé à trois reprises à Woodsboro, après avoir terrorisé le campus de Windsor et les studios d’Hollywood, Ghostface a décidé de sévir dans Big Apple, mais dans une ville aussi grande que New York personne ne vous entendra crier…', '/yQw8BtQedzm5aUo9zQCUMxQBtIJ.jpg', 0, '2023-03-08 00:00:00'),
(64, 447365, 'Les Gardiens de la Galaxie : Volume 3', 'Peter Quill, encore sous le choc de la perte de Gamora, doit rallier son équipe pour une mission dangereuse visant à sauver Rocket. Une mission qui, en cas d’échec, pourrait bien conduire à la fin des Gardiens tels que nous les connaissons.', '/aaGDsYYjltMxrwgs4qnHse4qlGX.jpg', 0, '2023-05-03 00:00:00'),
(65, 493529, 'Donjons & Dragons : L\'Honneur des voleurs', 'Un voleur beau gosse, une bande d\'aventuriers improbables entreprennent un casse épique pour récupérer une relique perdue. Les choses tournent mal lorsqu\'ils s\'attirent les foudres des mauvaises personnes.  Donjons & Dragons : L\'honneur des voleurs transpose sur grand écran l\'univers riche et l\'esprit ludique du légendaire jeu de rôle à travers une aventure hilarante et pleine d\'action.', '/tT8ys0GKleuWQ3mBHrFdAE0boNf.jpg', 0, '2023-04-12 00:00:00'),
(66, 420808, 'Peter Pan et Wendy', 'Wendy Darling, une jeune fille ayant peur de quitter la maison familiale, qui rencontre Peter Pan, un garçon qui refuse de grandir. Avec ses frères et une petite fée, la fée Clochette, elle voyage avec Peter dans le monde magique du Pays Imaginaire. Elle y rencontre un capitaine pirate maléfique, le capitaine Crochet, et se lance dans une aventure palpitante et dangereuse qui changera sa vie à jamais.', '/c4lNaY2E00EGFh642dHtGOVR6Vc.jpg', 0, '2023-04-28 00:00:00'),
(67, 1102776, 'AKA', 'Adam Franco est un agent infiltré, effectuant le sale boulot partout où il est nécessaire. Sa nouvelle mission, intégrer une organisation mafieuse en France pour déjouer un attentat terroriste imninent dans la capitale.', '/c0Zv7gNTH8LoRnHANhAHGWhGvJC.jpg', 0, '2023-04-28 00:00:00'),
(68, 385687, 'Fast X', 'Après bien des missions et contre toute attente, Dom Toretto et sa famille ont su déjouer, devancer, surpasser et distancer tous les adversaires qui ont croisé leur route. Ils sont aujourd’hui face à leur ennemi le plus terrifiant et le plus intime : émergeant des brumes du passé, ce revenant assoiffé de vengeance est bien déterminé à décimer la famille en réduisant à néant tout ce à quoi, et surtout à qui Dom ait jamais tenu.', '/piYNJlLvSlXYnXh6ZoKzhPdrMfV.jpg', 0, '2023-05-17 00:00:00'),
(69, 727340, 'Hunt', '1980, Corée du Sud. Après l’assassinat du président Park par la CIA coréenne, l’armée prend à nouveau le pouvoir. La Corée du Nord y voit l’opportunité d’une future invasion, et y envoie un de ses espions. Park Pyeong-Ho et Kim Jung-Do, deux hauts responsables de la sécurité sud-coréenne, sont missionnés pour traquer l’infiltré. S’engage alors une terrible course contre la montre. La situation des deux Corée est au bord de l’implosion et les deux agents, au cours de leur enquête, vont déterrer de lourds secrets qui menacent de faire basculer l’Histoire du pays…', '/zI0rMYcSUx16pHnsegWExPf1kDF.jpg', 0, '2022-05-19 00:00:00'),
(70, 283995, 'Les Gardiens de la Galaxie Vol. 2', 'Avec en toile de fond l’Awesome Mixtape #2, Les Gardiens de la Galaxie Vol. 2 poursuit les aventures de l’équipe alors qu’ils traversent les confins du cosmos. Les Gardiens doivent se battre pour que leur nouvelle famille reste ensemble tandis qu’ils cherchent à percer le mystère de la véritable filiation de Star-Lord. De vieux ennemis deviennent de nouveaux alliés et des personnages appréciés des fans, issus des comics, viennent en aide à nos héros alors que l’Univers Cinématographique Marvel continue de se développer.', '/eJz44lc3IaM68BkJtIkm4ia9xpZ.jpg', 0, '2017-04-26 00:00:00'),
(71, 868985, '¡Que Viva México!', 'Après la mort de son grand-père mineur, Pancho se rend avec sa femme et ses enfants dans sa ville natale, où la question de l\'héritage sème la zizanie.', '/ieyUpr5ES9QEz1cn4clCnBf9XJl.jpg', 0, '2023-05-11 00:00:00'),
(72, 649609, 'Renfield', 'Le mal ne saurait survivre une éternité sans un petit coup de pouce. \r Dans cette version moderne du mythe de Dracula, Renfield est l’assistant torturé du maître le plus narcissique qui ait jamais existé : Dracula. Renfield est contraint par son maître de lui procurer des proies et de pourvoir à toutes ses requêtes, mêmes les plus dégradantes. Mais après des siècles de servitude, il est enfin prêt à s’affranchir de l’ombre du Prince des ténèbres. À la seule condition qu’il arrive à mettre un terme à la dépendance mutuelle qui les unit.', '/lm3y4RNPu4aRDePsX5CkB9ndEdQ.jpg', 0, '2023-05-31 00:00:00'),
(73, 552688, 'The Mother', 'Une tueuse à gages de haut vol quitte la clandestinité quand ses anciens partenaires enlèvent la fille qu\'elle a dû abandonner des années plus tôt.', '/qiMsJw3fKtuNvVun14caRkPVCJh.jpg', 0, '2023-05-12 00:00:00'),
(74, 620705, 'Le Cratère', '\"Le Cratère\" suit les aventures du jeune Caleb Channing, qui s\'apprête à quitter la colonie minière lunaire dans laquelle il a grandi pour rejoindre une lointaine planète idyllique suite à la mort de son père. Mais avant de partir, afin d\'exaucer la dernière volonté de son père, Caleb et ses trois meilleurs amis, Dylan, Borney et Marcus, accompagnés d\'une nouvelle venue terrienne, Addison, volent un rover pour vivre une dernière aventure en explorant un mystérieux cratère.', '/6yfN3cW8uEqlU6yJOhuIvnrH4nZ.jpg', 0, '2023-05-12 00:00:00'),
(75, 325358, 'Superfast 8', 'L’officier White, un flic sous couverture, rejoint le gang de courses de voitures illégales de Vin Serento à Los Angeles. Rapides et déjantés, ils planifient d’escroquer le baron du crime Juan Carlos de la Sol qui planque son magot dans un restaurant Taco Bell. Aussi audacieux que ridicule, leur plan consiste à remorquer le restaurant tout entier, à fond les bananes !', '/rXWv98pmLuBlzVHpACanHHYYTkT.jpg', 0, '2015-03-31 00:00:00'),
(76, 385128, 'Fast & Furious 9', 'Dominic Toretto mène une vie tranquille avec Letty et son fils, le petit Brian, mais ils savent que le danger se cache toujours derrière l\'horizon paisible. Cette fois, cette menace obligera Dom à affronter les péchés de son passé s’il veut sauver ceux qu’il aime le plus. Son équipe se réunit pour arrêter un complot mené par l\'assassin le plus talentueux et le meilleur pilote qu\'ils aient jamais rencontré : un homme qui se trouve être également le frère abandonné de Dom, Jakob.', '/5Ww3aXmfmcFPDIbuTX3gQbtueoG.jpg', 0, '2021-07-14 00:00:00'),
(77, 384018, 'Fast & Furious : Hobbs & Shaw', 'Depuis que Hobbs, fidèle agent de sécurité au service diplomatique des États-Unis, combatif mais droit, et Shaw, un homme sans foi ni loi, ancien membre de l’élite militaire britannique, se sont affrontés en 2015 dans Fast & Furious 7, les deux hommes font tout ce qu’ils peuvent pour se nuire l’un à l’autre. Mais lorsque Brixton, un anarchiste génétiquement modifié, met la main sur une arme de destruction massive après avoir battu le meilleur agent du MI6 qui se trouve être la sœur de Shaw, les deux ennemis de longue date vont devoir alors faire équipe pour faire tomber le seul adversaire capable de les anéantir.', '/kgajCPm5pdH2Sa3CTCyHuUmQvgT.jpg', 0, '2019-08-07 00:00:00'),
(78, 964980, 'Air', 'AIR dévoile le partenariat qui a changé la donne entre Michael Jordan, alors inconnu, et le tout jeune département basket de Nike, qui a révolutionné le monde du sport et de la culture avec la marque Air Jordan.', '/6JQu7F1YCPm2ylTTmpxrspwoAFA.jpg', 0, '2023-04-06 00:00:00'),
(79, 447277, 'La Petite Sirène', 'L\'adaptation live-action du film d\'animation La Petite Sirène. Malgré l\'interdiction de son père, le roi Triton, Ariel, la petite sirène, ne peut résister à la tentation d\'aller à la rencontre d\'un monde inconnu, celui des humains. Accompagnée de Polochon, elle gagne la surface de l\'océan et s\'approche d\'un grand navire où est donnée une grande fête en l\'honneur du prince Eric, dont elle tombe immédiatement amoureuse. Une terrible tempête se lève et le prince est projeté par-dessus bord. Ariel le sauve de la noyade, le dépose sur le continent puis disparaît. Mais elle ne réussit pas à oublier le prince.', '/vP4t7DynrGPNwhXX8Z7Guq9FpS3.jpg', 0, '2023-05-24 00:00:00'),
(80, 337339, 'Fast & Furious 8', 'Maintenant que Dom et Letty sont en lune de miel, que Brian et Mia se sont rangés et que le reste de l’équipe a été disculpé, la bande de globe-trotteurs retrouve un semblant de vie normale. Mais quand une mystérieuse femme entraîne Dom dans le monde de la criminalité, ce dernier ne pourra éviter de trahir ses proches qui vont faire face à des épreuves qu’ils n’avaient jamais rencontrées jusqu’alors.  Des rivages de Cuba aux rues de New York en passant par les plaines gelées de la mer arctique de Barrents, notre équipe va sillonner le globe pour tenter d\'empêcher une anarchiste de déchaîner un chaos mondial et de ramener à la maison l’homme qui a fait d’eux une famille.', '/jbNK9y45q5PaKbRWX6C8lnmO7Hq.jpg', 0, '2017-04-12 00:00:00'),
(81, 168259, 'Fast & Furious 7', 'Laissé à moitié mort par Dominic Toretto et son clan de voleur de voitures as du volant, le criminel Owen Shaw gît sur un lit d\'hôpital à Londres. Déterminé à le venger, son frère Deckard Shaw commet des attaques vicieuses contre les membres de la famille de Toretto, notamment contre sa sœur, son beau-frère et leur petit garçon. Une aide inespérée leur parvient en la personne de Frank Petty, agent des services secrets américains aux ressources impressionnantes. Il promet assistance à Dominic, en échange de quoi ce dernier devra libérer une talentueuse informaticienne, nommée Ramsey, qui a mis au point un logiciel de surveillance ultraperfectionné baptisé « God\'s Eye ». La jeune femme est en effet retenue prisonnière par Jakande, un dangereux terroriste, au milieu des inaccessibles montagnes de l\'Azerbaïdjan. Le clan de Dominic se reforme donc pour cette dangereuse mission.', '/wjVn1Qng8B3ySvfJr4ovuehI141.jpg', 0, '2015-04-01 00:00:00'),
(82, 1045944, 'Baby Boss - Le Bonus de Noël', 'Le réveillon de Noël prend une drôle de tournure lorsque Baby Boss échange par accident sa place avec l\'un des elfes du père Noël et se retrouve au pôle Nord.', '/9HO86wbLOmwkYd1SxUiJ2lPR5ag.jpg', 0, '2022-12-06 00:00:00'),
(83, 114, 'Pretty Woman', 'Quand Edward Lewis, businessman de talent, s’offre les services de la belle Vivian, beauté fatale qui arpente chaque nuit les trottoirs d’Hollywood Boulevard, il décide par amusement de l’engager, de lui faire découvrir son style de vie, de la couvrir de cadeaux. Ils vivent ainsi quelque temps, jusqu’au jour où ils découvrent tous deux qu’ils ne peuvent plus se séparer…', '/apTFre4duDr92xJgsAts55OeHs1.jpg', 0, '1990-11-28 00:00:00'),
(84, 882598, 'Smile', 'Après avoir assisté à un incident traumatisant impliquant un patient, le Dr Rose Cotter se met à vivre des évènements effrayants qu\'elle ne peut expliquer. Alors qu\'une terreur écrasante s\'empare de sa vie, Rose doit affronter son passé afin de survivre et d\'échapper à sa nouvelle réalité terrifiante.', '/3kbtoJw6ZN0UUQhSuiRbAatr2kV.jpg', 0, '2022-09-28 00:00:00'),
(85, 955991, 'L\'Emprise du démon', 'Alors qu’ils attendent leur premier enfant Claire et Arthur décident de renouer les liens familiaux. Le jeune couple s’installe dans la vétuste entreprise de pompes funèbres tenue par Saul, le père d’Arthur. Mais l’arrivée d’un mystérieux cadavre va les faire basculer dans l’horreur : la dépouille contient une entité surnaturelle, Abyzou, qui une fois libérée, veut posséder l’enfant à venir du couple. Face à ce démon, personne n’est à l’abri…', '/jUT3VPju4nDrNyZjUbyc17gpQH6.jpg', 0, '2023-01-11 00:00:00'),
(86, 438695, 'Tous en scène 2', 'Dans le nouveau théâtre Moon, la troupe interprète sa version musicale d\'Alice au pays des merveilles. Buster Moon tient à avoir l\'avis de Suki Lane. Elle est celle qui décide quels talents peuvent auditionner devant Jimmy Crystal, grand producteur de spectacles à Redshore City. Pour elle, le niveau n\'est pas suffisant et l\'insistance de Buster Moon n\'y fait rien.Remotivé par Nana Noodleman, le koala rassemble ses artistes et part infiltrer les auditions.', '/xsjgiztyEu9cEZetxFlvJz6Yibw.jpg', 0, '2021-12-22 00:00:00'),
(87, 790496, 'Bad Luck Banging or Loony Porn', 'Emi, une enseignante, voit sa carrière et sa réputation menacées après la diffusion sur Internet d’une sextape tournée avec son mari. Forcée de rencontrer les parents d\'élèves qui exigent son renvoi, Emi refuse de céder à leur pression, questionnant ce qui est obscène dans nos sociétés.', '/QT82lXCZyaro5Yu2sTkpiis81U.jpg', 0, '2021-12-15 00:00:00'),
(88, 10144, 'La Petite Sirène', 'Ariel, une sirène fascinée par l\'univers des humains, défie l\'interdiction de son père de rester sous la surface. Lors d\'une tempête, elle sauve le prince de ses rêves. Elle conclut un pacte avec la sorcière des mers : des jambes en échange de sa queue de sirène et de sa jolie voix. Ariel entame une course contre la montre pour conquérir le cœur de son prince et sauver le royaume de son père.', '/mNUCr8XjBjMqe9N51fp3NtMuuUX.jpg', 0, '1990-11-28 00:00:00'),
(89, 1114590, 'Celle que vous croyez connaître : Anna Nicole Smith', 'Ce documentaire dévoile la vie d\'Anna Nicole Smith, du sommet de sa carrière de mannequin à sa tragique disparition, à travers les yeux de ses proches.', '/mybL2Hd3PvsY7Qyjf7W6BKsoECu.jpg', 0, '2023-05-16 00:00:00'),
(90, 324786, 'Tu ne tueras point', 'Quand la Seconde Guerre mondiale a éclaté, Desmond, un jeune américain, s’est retrouvé confronté à un dilemme: comme n’importe lequel de ses compatriotes, il voulait servir son pays, mais la violence était incompatible avec ses croyances et ses principes moraux. Il s’opposait ne serait-ce qu’à tenir une arme et refusait d’autant plus de tuer. Il s’engagea tout de même dans l’infanterie comme médecin. Son refus d’infléchir ses convictions lui valut d’être rudement mené par ses camarades et sa hiérarchie, mais c’est armé de sa seule foi qu’il est entré dans l’enfer de la guerre pour en devenir l’un des plus grands héros. Lors de la bataille d’Okinawa sur l’imprenable falaise de Maeda, il a réussi à sauver des dizaines de vies seul sous le feu de l’ennemi, ramenant en sureté, du champ de bataille, un à un les soldats blessés.', '/zyxSZvaA7mU7mwnO1lR2cXUdQdV.jpg', 0, '2016-11-09 00:00:00'),
(91, 717728, 'Jeepers Creepers: Reborn', 'Lorsqu\'une jeune femme commence à avoir des prémonitions inquiétantes liées à la légende du Jeeper Creeper, elle devient persuadée d\'être la cible de cette entité surnaturelle en quête de sang.', '/aGBuiirBIQ7o64FmJxO53eYDuro.jpg', 0, '2022-11-17 00:00:00'),
(92, 1101799, 'Reines en fuite', 'Arrivées à un tournant de leur vie, quatre amies de toujours quittent tout et partent à l\'aventure en se lançant dans un road trip encore plus fou qu\'elles ne l\'auraient jamais imaginé.', '/j81hA3A9joomnO748zyqomq1FxR.jpg', 0, '2023-04-14 00:00:00'),
(93, 338958, 'Il était une fois 2', 'La suite des aventures de Giselle, la princesse d’Andalasia, chassée de ce royaume imaginaire et contrainte de s’installer à Manhattan. Elle a fini par y trouver son prince charmant en la personne de Robert Philip, un avocat spécialisé dans les procédures de divorce. Quinze ans plus tard, alors qu’elle emménage dans le quartier résidentiel de Monroeville avec son mari et leur fille adolescente, Morgan, elle va devoir redonner un sens à l’expression « … et ils vécurent heureux ».', '/6djieHJEPqfYAV2Kyz2fK3QY3Du.jpg', 0, '2022-11-18 00:00:00'),
(94, 585083, 'Hôtel Transylvanie : Changements monstres', 'Johnny est dépité car, en plus d\'avoir gâché la fête d\'anniversaire de son beau-père Dracula, il pense qu\'il ne l\'aime pas car il n\'est pas un monstre. Van Helsing peut l\'aider : grâce à son \"rayon Monstrificateur\" il transforme Johnny en dragon ! Mais le rayon se détraque, touche les monstres de l\'hôtel y compris Dracula, et les transforme en humains !!! Ils vont devoir sillonner la planète en quête d\'un remède pour inverser la mutation avant qu\'il ne soit trop tard... et que ces transformations ne deviennent définitives !', '/yFwFp5QVHazxTklKGiJ0G59pVab.jpg', 0, '2022-01-14 00:00:00'),
(95, 298618, 'The Flash', 'Flash utilise ses super pouvoirs pour voyager dans le temps afin de changer les événements du passé. Cependant, lorsque sa tentative de sauver sa famille modifie par inadvertance l\'avenir, il se retrouve piégé dans une réalité dans laquelle le général Zod est revenu, menaçant l\'anéantissement. En l\'absence d\'autres superhéros vers qui se tourner, le Flash cherche à faire sortir un Batman très différent de sa retraite et à sauver un Kryptonien emprisonné.', '/kIHEPNYLWnG2fSwsAPmJkHdwce6.jpg', 0, '2023-06-14 00:00:00'),
(96, 566525, 'Shang-Chi et la Légende des Dix Anneaux', 'Shang-Chi va devoir affronter un passé qu’il pensait avoir laissé derrière lui lorsqu’il est pris dans la toile de la mystérieuse organisation des dix anneaux.', '/g54eUtuCTAOQaNlVpr7Kpr7sVoH.jpg', 0, '2021-09-01 00:00:00'),
(97, 245891, 'John Wick', 'Depuis la mort de sa femme bien‐aimée, John Wick passe ses journées à retaper sa Ford Mustang de 1969, avec pour seule compagnie sa chienne Daisy. Il mène une vie sans histoire, jusqu’à ce qu’un malfrat sadique nommé Iosef Tarasof remarque sa voiture. John refuse de la lui vendre. Iosef n’acceptant pas qu’on lui résiste, s’introduit chez John avec deux complices pour voler la Mustang, et tuer sauvagement Daisy… John remonte la piste de Iosef jusqu’à New York. Un ancien contact, Aurelio, lui apprend que le malfrat est le fils unique d’un grand patron de la pègre, Viggo Tarasof. La rumeur se répand rapidement dans le milieu : le légendaire tueur cherche Iosef. Viggo met à prix la tête de John : quiconque l’abattra touchera une énorme récompense. John a désormais tous les assassins de New York aux trousses.', '/orB4dHfZ9rOJbKYow7W0etezchl.jpg', 0, '2014-10-29 00:00:00'),
(98, 718930, 'Bullet Train', 'Coccinelle est un assassin malchanceux et particulièrement déterminé à accomplir sa nouvelle mission paisiblement après que trop d\'entre elles aient déraillé. Mais le destin en a décidé autrement et l\'embarque dans le train le plus rapide au monde aux côtés d\'adversaires redoutables qui ont tous un point commun, mais dont les intérêts divergent radicalement... Il doit alors tenter par tous les moyens de descendre du train.', '/uJvMXO1DNEER2lZocNjJy2zXtYs.jpg', 0, '2022-08-03 00:00:00'),
(99, 406759, 'Moonfall', 'Un astéroïde percute la Lune. L\'orbite de cette dernière est déviée et se dirige vers la Terre. Une équipe d\'astronautes, composée entre autres de l\'administratrice de la NASA et d\'un génie scientifique, se rend sur l\'astre afin de sauver la planète. Mais sur place, ils devront faire face à une force inconnue qui pourrait bien changer notre vision de l\'Univers.', '/pP2d05Ybd6rt8vG6kxE6xSDLVq9.jpg', 0, '2022-02-09 00:00:00'),
(100, 873126, 'My name is Vendetta', 'Entre ses matchs de hockey, un sport dans lequel elle excelle, et ses leçons de conduite hors route, Sofia mène une vie d\'adolescente tranquille. Jusqu\'au jour où, désobéissant à Santo, son père, elle le prend secrètement en photo et publie le cliché sur Instagram. Cette simple action suffit à bouleverser leur univers à jamais. Deux criminels remontent cette piste virtuelle, pénètrent dans leur maison et tuent sauvagement la mère et l\'oncle de Sofia, déclenchant un règlement de comptes qui couve depuis près de vingt ans. Sofia découvrira la vérité qui lui a toujours été cachée et le sombre passé de Santo en tant que membre de la N\'drangheta. Non sans heurts, elle assumera son héritage de rage et de violence et s\'alliera à son père pour obtenir vengeance.', '/5Vusv0Lt74FaFs8FgQXEr92sq29.jpg', 0, '2022-11-30 00:00:00'),
(101, 760741, 'Beast', 'Le Dr. Nate Daniels, revient en Afrique du Sud, où il a autrefois rencontré sa femme aujourd’hui décédée, pour y passer des vacances prévues de longue date avec ses deux filles dans une réserve naturelle, tenue par Martin Battles, un vieil ami de la famille, biologiste spécialiste de la vie sauvage. Mais ce repos salvateur va se transformer en épreuve de survie quand un lion assoiffé de vengeance, unique rescapé de la traque sanguinaire d’ignobles braconniers, se met à dévorer tout humain sur sa route et prend en chasse le docteur et sa famille.', '/vFDsXsHKtsGvhnoZBaUq8USqOjG.jpg', 0, '2022-08-24 00:00:00'),
(102, 580175, 'Drunk', 'Quatre amis décident de mettre en pratique la théorie d’un psychologue norvégien selon laquelle l’homme aurait dès la naissance un déficit d’alcool dans le sang. Avec une rigueur scientifique, chacun relève le défi en espérant tous que leur vie n’en sera que meilleure! Si dans un premier temps les résultats sont encourageants, la situation devient rapidement hors de contrôle.', '/l7PXvcip4OpVsQ5mTRgd4BQ1Nel.jpg', 117, '2020-09-24 00:00:00'),
(103, 25866, 'Le Corniaud', 'Modeste représentant de commerce, Antoine Maréchal s’apprête à partir en vacances en Italie lorsque, en plein Paris, sa 2CV est mise en pièces par la Bentley d’un homme d’affaires, Léopold Saroyan. Antoine, désespéré, dit adieu à ses congés. Mais dès le lendemain, il est convoqué par Saroyan. Celui‐ci lui offre un billet d’avion pour Naples et le charge de récupérer une Cadillac pour le compte de riches clients américains. Ébloui, Antoine accepte, sans se douter un seul instant que la superbe voiture qu’il conduit dissimule une véritable fortune illégale. Un pactole que certains aimeraient beaucoup récupérer pour bénéficier d’une retraite dorée…', '/wmxzMpuW8Eq7MmPHn6jLDU8Q9ft.jpg', 110, '1965-03-24 00:00:00'),
(104, 458220, 'Palmer', 'Après 12 ans en prison, l’ex-prodige du football Eddie Palmer revient chez lui pour repartir de zéro. Il se lie d’amitié avec un jeune garçon malmené par la vie, mais son passé trouble menace de réduire en cendres ce nouveau départ.', '/xSDdRAjxKAGi8fUBLOqSrBhJmF0.jpg', 0, '2021-01-29 00:00:00'),
(105, 10484, 'Les Compères', 'Tristan Martin, un adolescent de 17 ans, fait une fugue, au désespoir de sa mère Christine. Pour le retrouver, celle-ci envoie deux de ses anciens amants, en leur faisant croire que l\'un d\'entre eux est peut-être le père. Transportés par leur soudaine paternité, ces derniers deviennent de fins limiers.', '/wcgFmCOSYdhWh6b1lvvcHYuldRl.jpg', 92, '1983-11-23 00:00:00'),
(106, 71524, 'L\'As des as', 'Jo Cavalier, entraîneur national, doit accompagner l\'équipe de boxe aux J.O. de Berlin. Durant le voyage il prend en charge un enfant de dix ans poursuivi par la Gestapo.', '/kuQb63zXvgHMOZYmC8D2NfnDe5w.jpg', 100, '1982-10-27 00:00:00'),
(107, 1672, 'Le Professionnel', 'Issu de l\'élite de l\'armée française, Joss Beaumont est chargé d\'exécuter le président du Malagawi. Un contre-ordre tombe, la cible est devenue un ami de l\'Etat. Pour l\'empêcher de nuire, Beaumont est incarcéré, mais ne tarde pas à s\'évader, décidé à  mener à  bien l\'opération malgré l\'opposition de sa hiérarchie.', '/1Crro6hN91lXc1sWXkU52tfjpAs.jpg', 105, '1981-10-21 00:00:00'),
(108, 51163, 'Effroyables Jardins', 'Lucien, un adolescent de quatorze ans, ne comprend pas pourquoi son père, un instituteur sérieux et respecté, se ridiculise, à ses yeux, dans un numéro de clown amateur. Un jour, André, le meilleur ami de son père, lui dévoile l\'origine de cette vocation.', '/xMrcSLn5UioeSuek4FldkFlnOgF.jpg', 89, '2003-03-26 00:00:00'),
(109, 9421, 'Le Dîner de Cons', 'Tous les mercredis, Pierre Brochant et ses amis organisent un dîner où chacun doit amener un con. Celui qui a trouvé le plus spectaculaire est déclaré vainqueur. Ce soir, Brochant exulte, il est sûr d’avoir trouvé la perle rare, un con de classe mondiale: François Pignon, comptable au ministère des Finances et passionné de modèles réduits en allumettes. Ce qu’il ignore c’est que Pignon est passé maître dans l’art de déclencher des catastrophes.', '/7ukFDHExWul2Zz3L0OH8CaZCp2Z.jpg', 80, '1998-04-15 00:00:00'),
(110, 60030, 'Malabar Princess', 'L\'année scolaire qu\'il passe chez son grand-père dans le massif du Mont-Blanc a pour objectif d\'apaiser Tom, 8 ans, enfant très perturbé par la disparition de sa mère. Tenace, curieux et imaginatif, le petit citadin poussera les adultes qui l\'entourent dans le chaos figé des secrets de famille que le séjour au grand air libère un à un, comme le grand glacier rejette les morceaux du Malabar Princess, l\'avion d\'Air India qui a percuté le sommet il y a 50 ans. Avec l\'aide de son institutrice, Tom ira au bout de lui-même et saura enfin tout sur sa mère...', '/9Ve4CmIEgh61QEIFRsMmJy34EHL.jpg', 94, '2004-03-03 00:00:00'),
(111, 360638, 'L\'Étudiante et Monsieur Henri', 'À cause de sa santé vacillante, Monsieur Henri ne peut plus vivre seul dans son appartement parisien. Particulièrement bougon, il finit néanmoins par accepter la proposition de son fils Paul de louer une chambre à une jeune étudiante. Loin de tomber sous le charme, Henri va se servir d\'elle pour créer un véritable chaos familial…', '/9JUuHvbwsX93b9h8SJjFDY73EsI.jpg', 99, '2015-10-07 00:00:00'),
(112, 54544, 'Un crime au Paradis', 'Jojo Braconnier ne peut plus supporter sa femme alcoolique, mauvaise et littéralement invivable. Il découvre à la télévision un reportage sur Maître Jacquard, un avocat brillant qui vient d\'obtenir son vingt-cinquième acquittement. Jojo le rencontre et lui avoue le meurtre de sa femme, un crime qu\'il n\'a pas commis. De façon très adroite, il obtient des explications de l\'avocat sur la façon dont il aurait dû agir pour obtenir les circonstances atténuantes, voire même l\'acquittement. De retour chez lui, Jojo suit à la lettre les \"recommandations\" de Maître Jacquard et tue son épouse.', '/umh4zuxGoEWuKwy2Sz7hHxFIzsy.jpg', 92, '2001-02-28 00:00:00'),
(113, 36719, 'Les Enfants du marais', '«On est des gagne-misère, mais on n\'est pas des peigne-culs», telle est la philosophie de Garris, homme simple, généreux et quelque peu poète qui vit au bord d\'un étang avec son ami Riton, qui élève trois enfants turbulents issus de son second mariage. Riton, de temps en temps, noie son chagrin dans le vin rouge pour tenter d\'oublier sa première femme et grand amour. Autour d\'eux il y a également Amédée, un rêveur passionné de lecture, Pépé, un ancien du marais devenu riche et Tane, le conducteur du petit train local. Un jour, Garris rencontre une jeune femme, Marie.', '/9tEvO0H3Eg43MJQm4t1ChukCu8d.jpg', 115, '1999-03-03 00:00:00'),
(114, 49838, 'L\'Antidote', 'Jacques-Alain Marty, dit \"Jam\", est le patron de Vladis Entreprises, un grand groupe multipôle français. Tout lui réussit, mais depuis quelques semaines, Jam n\'est plus dans son état normal. Il est sujet à des crises d\'angoisse, liées à un traumatisme d\'enfance dont il doit trouver l\'antidote. André Morin est comptable dans une petite fabrique de jouets anciens. Il possède quelques actions du groupe Vladis dont il suit assidûment l\'évolution du cours. Toujours présent dans les assemblées générales des grands groupes, Morin est l\'icône connue et reconnue des petits porteurs. La route de Jam va croiser celle d\'André Morin au cours de la grande messe de l\'assemblée générale de Vladis. Jam réalise alors qu\'en présence du petit comptable, il retrouve tous ses moyens et son charisme qui ont fait de lui l\'un des maîtres du monde... Jam décide de ne plus lâcher ce Morin.', '/h1v8ApDX25sS6vbSL8GoEmYExJY.jpg', 107, '2005-03-30 00:00:00'),
(115, 1000572, 'Les Choses simples', 'Vincent est un célèbre entrepreneur à qui tout réussit. Un jour, une panne de voiture sur une route de montagne interrompt provisoirement sa course effrénée. Pierre, qui vit à l’écart du monde moderne au milieu d’une nature sublime, lui vient en aide et lui offre l’hospitalité. La rencontre entre ces deux hommes que tout oppose va bouleverser leurs certitudes respectives. Et ils vont se surprendre à rire. Au fond, vivent-ils vraiment chacun les vies qu’ils ont envie de vivre ?', '/lm4D555GnwAuOQHipk7ENHUcXAi.jpg', 95, '2023-02-22 00:00:00'),
(116, 335977, 'Indiana Jones et le Cadran de la Destinée', 'En 1969, l\'archéologue et aventurier américan Indiana Jones est opposé à la course à l\'espace en raison du fait que les États-Unis ont recruté d\'anciens nazis pour battre l\'Union Soviétique dans cette compétition. Sa filleule Helena l\'accompagne dans ce combat. Pendant ce temps, Jürgen Voller, un employé de la NASA et ex-nazi impliqué dans le programme lunaire cherche à rendre le monde meilleur à son idée.', '/anNuKgtQlxyfvvEFXz9QV2FrWDG.jpg', 154, '2023-06-28 00:00:00'),
(117, 89, 'Indiana Jones et la dernière croisade', 'Indiana Jones se lance cette fois‐ci à la recherche du Saint Graal, accompagné de l’éminent et très maladroit Dr Henry Jones, son père. Malheureusement, ils ne sont pas les seuls lancés sur la trace du trésor, les nazis le convoitent également.', '/uE0aVKGfBEeGpTgcnz4MFZrkc95.jpg', 127, '1989-05-24 00:00:00'),
(118, 87, 'Indiana Jones et le Temple maudit', 'L’archéologue Indiana Jones est obligé de fuir un cabaret de Shanghai après une négociation houleuse. En compagnie de la chanteuse Willie Scott et du petit Short Round, il se retrouve sur un glacier himalayen, dans un village dont une secte a dérobé le diamant magique et enlevé les enfants afin de les sacrifier.', '/oiUd1KUXWZeDPGMr8TrtZcXzpQU.jpg', 118, '1984-05-23 00:00:00'),
(119, 217, 'Indiana Jones et le royaume du crâne de cristal', 'La nouvelle aventure d’Indiana Jones débute dans un désert du sud‐ouest des États‐Unis. Nous sommes en 1957, en pleine guerre froide. Indy et son copain Mac viennent tout juste d’échapper à une bande d’agents soviétiques à la recherche d’une mystérieuse relique surgie du fond des temps. De retour au Marshall College, le Professeur Jones apprend une très mauvaise nouvelle : ses récentes activités l’ont rendu suspect aux yeux du gouvernement américain. Le doyen Stanforth, qui est aussi un proche ami, se voit contraint de le licencier. À la sortie de la ville, Indiana fait la connaissance d’un jeune motard rebelle, Mutt, qui lui fait une proposition inattendue.', '/89K11uRFxxPpYbWE6zSgkrnbZtD.jpg', 122, '2008-05-21 00:00:00');
INSERT INTO `movies` (`id`, `movieID`, `title`, `overview`, `poster_path`, `runtime`, `release_date`) VALUES
(120, 85, 'Les Aventuriers de l\'arche perdue', '1936. Parti à la recherche d’une idole sacrée en pleine jungle péruvienne, l’aventurier Indiana Jones échappe de justesse à une embuscade tendue par son plus coriace adversaire: le Français René Belloq. Revenu à la vie civile à son poste de professeur universitaire d’archéologie, il est mandaté par les services secrets et par son ami Marcus Brody, conservateur du National Museum de Washington, pour mettre la main sur le Médaillon de Râ, en possession de son ancienne amante Marion Ravenwood, désormais tenancière d’un bar au Tibet. Cet artefact égyptien serait en effet un premier pas sur le chemin de l’Arche d’Alliance, celle‐là même où Moïse conserva les Dix Commandements. Une pièce historique aux pouvoir inimaginables dont Hitler cherche à s’emparer.', '/pb6ZqNK1luGnkILnkONicFXwNeW.jpg', 115, '1981-06-12 00:00:00'),
(121, 481848, 'L\'appel de la forêt', 'Alliant prises de vues réelles et animation, L\'appel de la forêt raconte l’histoire de Buck, un chien au grand cœur, dont la paisible vie domestique bascule lorsqu’il est brusquement arraché de sa maison en Californie et se retrouve enrôlé comme chien de traîneau dans les étendues sauvages du Yukon en Alaska, pendant la ruée vers l’or, dans les années 1890. Buck va devoir s’adapter et lutter pour survivre, jusqu’à finalement vivre l’aventure de sa vie et trouver sa véritable place dans le monde en devenant son propre maître…', '/gNrZ3LYexKfoH63Y4rYNdhwyLsW.jpg', 100, '2020-02-19 00:00:00'),
(122, 958219, 'Pour la France', 'Aïssa Saïdi est un jeune officier de 23 ans d’origine algérienne. Lors d’un rituel d’intégration dans la prestigieuse école militaire française de Saint-Cyr, il perd la vie. Son grand frère Ismaël, le mouton noir de la famille, se retrouve à la pointe du combat pour l’organisation de ses funérailles... Une intrigue issue d’un drame très personnel vécu par le réalisateur en 2012.', '/qvmCPv4Zqu7BAdEOGEFeJWBOt3l.jpg', 113, '2023-02-08 00:00:00'),
(123, 458302, 'Rémi sans famille', 'Les aventures du jeune Rémi, orphelin recueilli par la douce Madame Barberin. A l’âge de 10 ans, il est arraché à sa mère adoptive et confié au Signor Vitalis, un mystérieux musicien ambulant. A ses côtés, il va apprendre la rude vie de saltimbanque et à chanter pour gagner son pain. Accompagné du fidèle chien Capi et du petit singe Joli-Cœur, son long voyage à travers la France, fait de rencontres, d’amitiés et d’entraide, le mène au secret de ses origines…', '/aQNq7qk6gJYSFN1JMCnhwgOmDxV.jpg', 109, '2018-12-12 00:00:00'),
(124, 9317, 'La Soupe aux choux', 'Au hameau de Gourdifflots, en plein Bourbonnais, deux paysans retraités, « le Glaude » et « le Bombé », se tiennent volontairement à l’écart du monde extérieur, plus occupés à faire bombance et à honorer la dive bouteille qu’à se soucier de la marche du siècle. Un soir, après bien des excès alimentaires et un formidable concours de pets, ils voient avec étonnement une soucoupe volante se poser dans leur jardin. Le Glaude accueille comme un vieil ami le curieux et débonnaire extraterrestre et lui offre un peu de sa fameuse soupe aux choux, si délectable que « la Denrée », surnom de l’extraterrestre, va fidèlement revenir, conquis par le goût exquis du potage…', '/3Eym65PSArfU89O15Cct0JiaPHl.jpg', 98, '1981-12-02 00:00:00'),
(125, 11530, 'La Zizanie', 'Industriel ambitieux, Guillaume Daubray‐Lacaze agrandit son usine de matériel de dépollution, détruisant du même coup le jardin de sa femme Bernadette, férue d’horticulture. Décidée à se venger de son mari, elle quitte le domicile conjugal, en se présentant contre lui aux élections municipales.', '/lQ3IUf65maoUtVIhfHurD0KzduD.jpg', 97, '1978-03-16 00:00:00'),
(126, 2594, 'Monsieur Batignole', 'Sous la France occupée de 1942, à Paris, Edmond Batignole, un boucher sans histoire, tente de survivre comme tant d\'autres. Il peut se laisser entraîner par son entourage et sa lâcheté sur les pentes de l\'infamie. Mais il va choisir de lutter pour sauver la vie de Simon, un petit enfant juif.', '/8K9x7kTqJigbb2Zw5wFaehkyuY0.jpg', 100, '2002-03-06 00:00:00'),
(127, 916224, 'Suzume', 'Dans une petite ville paisible de Kyushu, une jeune fille de 17 ans, Suzume, rencontre un homme qui dit voyager afin de chercher une porte. Décidant de le suivre dans les montagnes, elle découvre une unique porte délabrée trônant au milieu des ruines, seul vestige ayant survécu au passage du temps. Cédant à une inexplicable impulsion, Suzume tourne la poignée, et d\'autres portes s\'ouvrent alors aux quatre coins du Japon, laissant entrer toutes les catastrophes qu\'elles renferment. L\'homme est formel : toute porte ouverte doit être fermée. Là où elle s\'est égarée se trouvent les étoiles, le crépuscule et l\'aube, une voûte céleste où tous les temps se confondent. Guidée par des portes nimbées de mystère, Suzume entame un périple en vue de toutes les refermer.', '/hOJYwkVSgXtE3BJFN0bRPKdLJLj.jpg', 0, '2023-04-12 00:00:00'),
(128, 840326, 'Sisu : de l\'or et du sang', 'Au cours des derniers jours de la Seconde Guerre mondiale, un prospecteur solitaire croise la route de nazis lors d\'une retraite sur la Terre brûlée dans le nord de la Finlande. Lorsque les soldats décident de voler son or, ils découvrent rapidement qu\'ils viennent de s\'emmêler avec un mineur ordinaire.', '/7U5ytZz3eInnBJaJUMFTdIqyZjj.jpg', 0, '2023-06-21 00:00:00'),
(129, 605886, 'Misanthrope', 'La veille du jour de l\'An, dans la ville de Baltimore, une agente de police au passé trouble est recrutée par l\'enquêteur en chef du FBI pour tenter de dresser le profil psychologique du tueur en série qui terrorise la ville. Le duo veut mettre la main au collet du dangereux psychopathe avant qu\'il ne fasse d\'autres victimes.', '/2DVMYCEjZGJDBWD5zDfeD8NNDTk.jpg', 0, '2023-04-26 00:00:00'),
(130, 799379, 'Projet Wolf Hunting', 'Un groupe de criminels dangereux sur un cargo transporté des Philippines à la Corée du Sud, alors qu\'ils déchaînent une force sinistre après qu\'une tentative d\'évasion a conduit à une émeute.', '/fj3OLrY1LOi1b8EUo3cBL53AFYV.jpg', 0, '2023-02-15 00:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `movie_favorite_actors`
--

CREATE TABLE `movie_favorite_actors` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `actorID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `movie_favorite_actors`
--

INSERT INTO `movie_favorite_actors` (`id`, `userID`, `movieID`, `actorID`) VALUES
(1, 2, 19123, 24501),
(2, 2, 10484, 24501),
(3, 2, 761, 11187),
(4, 2, 71524, 3829),
(5, 2, 1672, 3829),
(6, 2, 51163, 35323),
(7, 2, 9421, 35323),
(8, 2, 60030, 35323),
(9, 2, 360638, 1958),
(10, 2, 54544, 35323),
(11, 2, 36719, 35323),
(12, 2, 49838, 28781),
(13, 2, 89, 3),
(14, 2, 87, 3),
(15, 2, 217, 3),
(16, 2, 481848, 3),
(17, 2, 9317, 11187),
(18, 2, 11530, 11187),
(19, 3, 19123, 24501),
(20, 3, 9317, 11187),
(21, 3, 335977, 3);

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `redirection` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `userID`, `title`, `content`, `redirection`, `created_at`, `seen_date`) VALUES
(1, 2, 'Nouvelle réponse', 'Un utilisateur a répondu à votre commentaire', 'index.php?view=movie&movieID=19123', '2023-05-24 07:24:29', NULL),
(2, 3, 'Nouvelle réponse', 'Un utilisateur a répondu à votre commentaire', 'index.php?view=movie&movieID=9317', '2023-05-24 07:26:38', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `content` text NOT NULL,
  `reactions` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `replies`
--

INSERT INTO `replies` (`id`, `commentID`, `userID`, `content`, `reactions`, `created_at`, `updated_at`) VALUES
(21, 20, 3, 'Un film amusant, qui fait rires les jeunes et les vieux', 0, '2023-05-24 07:24:29', NULL),
(22, 33, 2, 'Tout à fait ! ', 0, '2023-05-24 07:26:38', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `replies_reactions`
--

CREATE TABLE `replies_reactions` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `replyID` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ordre` int(10) NOT NULL,
  `permission_level` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`, `ordre`, `permission_level`) VALUES
(1, 'Créateur', 'Ce rôle est celui du ou des créateurs du site', 1, 4),
(2, 'Administrateur', 'Ce rôle est celui du ou des administrateurs du site', 2, 3),
(3, 'Modérateur', 'Ce rôle est celui du ou des modérateurs du site', 3, 2),
(4, 'Membre', 'Ce rôle est celui du ou des membres du site', 4, 1);

-- --------------------------------------------------------

--
-- Structure de la table `towatch_movies`
--

CREATE TABLE `towatch_movies` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `add_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `towatch_movies`
--

INSERT INTO `towatch_movies` (`id`, `userID`, `movieID`, `add_date`) VALUES
(1, 2, 1000572, '2023-05-24 07:15:04'),
(2, 2, 967874, '2023-05-24 07:15:24'),
(3, 2, 335977, '2023-05-24 07:15:41'),
(4, 2, 796185, '2023-05-24 07:19:40'),
(5, 2, 958219, '2023-05-24 07:19:47');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `profil_picture` varchar(255) NOT NULL DEFAULT 'default.jpg',
  `role` int(2) NOT NULL DEFAULT '4',
  `blocked` int(11) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `last_connexion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `profil_picture`, `role`, `blocked`, `created_at`, `updated_at`, `last_connexion`) VALUES
(1, 'admin', 'admin', 'default.jpg', 1, 0, '2023-04-13 20:36:26', NULL, '2023-05-23 20:23:18'),
(2, 'Remi', 'remi', '1684779904image.png', 4, 0, '2023-04-13 20:36:26', '2023-05-22 20:25:04', '2023-05-31 13:54:14'),
(3, 'Charles-Augustin', 'charlesaugustin', 'default.jpg', 4, 0, '2023-04-13 20:36:26', NULL, '2023-05-24 07:23:41');

-- --------------------------------------------------------

--
-- Structure de la table `warning`
--

CREATE TABLE `warning` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `reason` int(11) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `warns`
--

CREATE TABLE `warns` (
  `id` int(11) NOT NULL,
  `reporterID` int(11) NOT NULL,
  `authorID` int(11) NOT NULL,
  `commentID` int(11) NOT NULL,
  `reported_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `treat_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `warns`
--

INSERT INTO `warns` (`id`, `reporterID`, `authorID`, `commentID`, `reported_at`, `treat_at`) VALUES
(1, 2, 3, 34, '2023-05-24 07:25:59', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `watched_movies`
--

CREATE TABLE `watched_movies` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `multiple` int(2) NOT NULL DEFAULT '1',
  `seen_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `watched_movies`
--

INSERT INTO `watched_movies` (`id`, `userID`, `movieID`, `multiple`, `seen_date`) VALUES
(2, 2, 19123, 3, '2023-05-23 20:38:28'),
(3, 2, 10484, 3, '2023-05-23 20:43:06'),
(4, 2, 761, 3, '2023-05-24 06:55:14'),
(5, 2, 71524, 3, '2023-05-24 06:56:13'),
(6, 2, 1672, 3, '2023-05-24 06:57:26'),
(7, 2, 51163, 3, '2023-05-24 07:01:08'),
(8, 2, 9421, 3, '2023-05-24 07:03:31'),
(9, 2, 60030, 3, '2023-05-24 07:04:27'),
(10, 2, 360638, 3, '2023-05-24 07:05:38'),
(11, 2, 54544, 3, '2023-05-24 07:06:49'),
(12, 2, 36719, 3, '2023-05-24 07:07:23'),
(13, 2, 49838, 3, '2023-05-24 07:08:52'),
(14, 2, 89, 1, '2023-05-24 07:15:53'),
(15, 2, 87, 1, '2023-05-24 07:16:06'),
(16, 2, 217, 1, '2023-05-24 07:16:14'),
(17, 2, 85, 1, '2023-05-24 07:16:55'),
(18, 2, 481848, 1, '2023-05-24 07:18:50'),
(19, 2, 458302, 1, '2023-05-24 07:20:30'),
(20, 2, 9317, 1, '2023-05-24 07:20:44'),
(21, 2, 11530, 1, '2023-05-24 07:21:05'),
(22, 2, 2594, 1, '2023-05-24 07:22:13'),
(23, 3, 19123, 1, '2023-05-24 07:23:55'),
(24, 3, 9317, 1, '2023-05-24 07:24:46'),
(25, 3, 335977, 1, '2023-05-24 07:25:17');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `comments_ibfk_1` (`movieID`);

--
-- Index pour la table `comments_reactions`
--
ALTER TABLE `comments_reactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentID` (`commentID`),
  ADD KEY `userID` (`userID`);

--
-- Index pour la table `favorites_movies`
--
ALTER TABLE `favorites_movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `movieID` (`movieID`),
  ADD KEY `userID` (`userID`);

--
-- Index pour la table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `movieID_2` (`movieID`),
  ADD KEY `movieID` (`movieID`);

--
-- Index pour la table `movie_favorite_actors`
--
ALTER TABLE `movie_favorite_actors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `movie_favorite_actors_ibfk_1` (`movieID`);

--
-- Index pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Index pour la table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentID` (`commentID`),
  ADD KEY `userID` (`userID`);

--
-- Index pour la table `replies_reactions`
--
ALTER TABLE `replies_reactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `replyID` (`replyID`),
  ADD KEY `userID` (`userID`);

--
-- Index pour la table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `towatch_movies`
--
ALTER TABLE `towatch_movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `towatch_movies_ibfk_1` (`movieID`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `role` (`role`);

--
-- Index pour la table `warning`
--
ALTER TABLE `warning`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`);

--
-- Index pour la table `warns`
--
ALTER TABLE `warns`
  ADD PRIMARY KEY (`id`),
  ADD KEY `commentID` (`commentID`),
  ADD KEY `authorID` (`authorID`),
  ADD KEY `reporterID` (`reporterID`);

--
-- Index pour la table `watched_movies`
--
ALTER TABLE `watched_movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `watched_movies_ibfk_1` (`movieID`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `comments_reactions`
--
ALTER TABLE `comments_reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `favorites_movies`
--
ALTER TABLE `favorites_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT pour la table `movie_favorite_actors`
--
ALTER TABLE `movie_favorite_actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `replies_reactions`
--
ALTER TABLE `replies_reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `towatch_movies`
--
ALTER TABLE `towatch_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `warning`
--
ALTER TABLE `warning`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `warns`
--
ALTER TABLE `warns`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `watched_movies`
--
ALTER TABLE `watched_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `comments_reactions`
--
ALTER TABLE `comments_reactions`
  ADD CONSTRAINT `comments_reactions_ibfk_1` FOREIGN KEY (`commentID`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `comments_reactions_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `favorites_movies`
--
ALTER TABLE `favorites_movies`
  ADD CONSTRAINT `favorites_movies_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`),
  ADD CONSTRAINT `favorites_movies_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `movie_favorite_actors`
--
ALTER TABLE `movie_favorite_actors`
  ADD CONSTRAINT `movie_favorite_actors_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`),
  ADD CONSTRAINT `movie_favorite_actors_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `replies`
--
ALTER TABLE `replies`
  ADD CONSTRAINT `replies_ibfk_1` FOREIGN KEY (`commentID`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `replies_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `replies_reactions`
--
ALTER TABLE `replies_reactions`
  ADD CONSTRAINT `replies_reactions_ibfk_1` FOREIGN KEY (`replyID`) REFERENCES `replies` (`id`),
  ADD CONSTRAINT `replies_reactions_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `towatch_movies`
--
ALTER TABLE `towatch_movies`
  ADD CONSTRAINT `towatch_movies_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`),
  ADD CONSTRAINT `towatch_movies_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`id`);

--
-- Contraintes pour la table `warning`
--
ALTER TABLE `warning`
  ADD CONSTRAINT `warning_ibfk_1` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `warns`
--
ALTER TABLE `warns`
  ADD CONSTRAINT `warns_ibfk_1` FOREIGN KEY (`commentID`) REFERENCES `comments` (`id`),
  ADD CONSTRAINT `warns_ibfk_2` FOREIGN KEY (`authorID`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `warns_ibfk_3` FOREIGN KEY (`reporterID`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `watched_movies`
--
ALTER TABLE `watched_movies`
  ADD CONSTRAINT `watched_movies_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`),
  ADD CONSTRAINT `watched_movies_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
