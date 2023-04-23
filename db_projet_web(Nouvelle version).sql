-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : dim. 23 avr. 2023 à 16:07
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
-- Base de données : `db_projet_web`
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
(1, 638974, 2, 'test', 0, '2021-07-05 16:18:14', '2023-04-19 16:18:14'),
(2, 638974, 2, 'Nouveau comm\r\n', 0, '2023-04-19 16:57:07', '2023-04-19 16:57:07');

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
(61, 15357, 'Banlieue 13 : Ultimatum', 'Banlieue 13, deux ans plus tard. Le gouvernement a changé, pas le reste... Le mur d\'isolement - toujours plus haut, toujours plus grand, toujours plus loin - s\'est étendu autour des cités ghettos et les gangs qui y prolifèrent ont encore accru leur influence. Le trafic se répartit désormais entre cinq quartiers ethniques, chacun dirigé par un redoutable chef de gang. Plus que jamais déterminés à \"régler le problème\", les services secrets mettent volontairement le feu aux poudres. Damien, flic expert en arts martiaux, et Leïto, capable de se faufiler dans les moindres recoins de la banlieue, font à nouveau équipe. Leur objectif : sauver la cité du chaos. Leur programme : combats musclés et course-poursuites défiant les lois de la gravité...', '/xDaapoHh6OrPqBPVx0wOFjSglQD.jpg', 98, '2009-02-18 00:00:00');

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

-- --------------------------------------------------------

--
-- Structure de la table `note_movies`
--

CREATE TABLE `note_movies` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `movieID` int(11) NOT NULL,
  `note` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `userID` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `seen_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `notifications`
--

INSERT INTO `notifications` (`id`, `userID`, `title`, `content`, `created_at`, `seen_date`) VALUES
(1, 2, 'Test', 'Ceci est le contenu de la notifications de test', '2023-04-23 16:29:12', NULL);

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
(2, 1, 1, 'Test réponse', 0, '2023-04-19 16:35:22', NULL),
(3, 1, 2, 'Test répo 44', 0, '2023-04-19 16:45:14', NULL),
(4, 1, 2, 'Test', 0, '2023-04-19 16:57:14', NULL),
(5, 1, 2, 'Test', 0, '2023-04-19 16:57:26', NULL),
(6, 2, 2, 'test', 0, '2023-04-19 16:58:15', NULL);

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
(1, 2, 796185, '2023-04-18 15:25:59'),
(2, 2, 967874, '2023-04-18 15:48:30');

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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL,
  `last_connexion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `profil_picture`, `role`, `created_at`, `updated_at`, `last_connexion`) VALUES
(1, 'admin', 'admin', 'default.jpg', 1, '2023-04-13 20:36:26', NULL, NULL),
(2, 'Remi', 'remi', 'default.jpg', 4, '2023-04-13 20:36:26', NULL, '2023-04-23 17:36:02'),
(3, 'Charles-Augustin', 'charlesaugustin', 'default.jpg', 4, '2023-04-13 20:36:26', NULL, NULL);

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
(3, 2, 19123, 2, '2023-04-18 15:22:52'),
(4, 2, 61864, 1, '2023-04-18 15:24:34'),
(14, 2, 761, 1, '2023-04-21 13:26:58'),
(15, 2, 39514, 3, '2023-04-22 18:22:21'),
(16, 2, 10939, 1, '2023-04-22 18:39:50'),
(17, 2, 61852, 1, '2023-04-22 18:40:19');

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
-- Index pour la table `note_movies`
--
ALTER TABLE `note_movies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userID` (`userID`),
  ADD KEY `note_movies_ibfk_1` (`movieID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `comments_reactions`
--
ALTER TABLE `comments_reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `movies`
--
ALTER TABLE `movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT pour la table `movie_favorite_actors`
--
ALTER TABLE `movie_favorite_actors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `note_movies`
--
ALTER TABLE `note_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `replies_reactions`
--
ALTER TABLE `replies_reactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `towatch_movies`
--
ALTER TABLE `towatch_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `watched_movies`
--
ALTER TABLE `watched_movies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

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
-- Contraintes pour la table `movie_favorite_actors`
--
ALTER TABLE `movie_favorite_actors`
  ADD CONSTRAINT `movie_favorite_actors_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`),
  ADD CONSTRAINT `movie_favorite_actors_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `note_movies`
--
ALTER TABLE `note_movies`
  ADD CONSTRAINT `note_movies_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`),
  ADD CONSTRAINT `note_movies_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);

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
-- Contraintes pour la table `watched_movies`
--
ALTER TABLE `watched_movies`
  ADD CONSTRAINT `watched_movies_ibfk_1` FOREIGN KEY (`movieID`) REFERENCES `movies` (`movieID`),
  ADD CONSTRAINT `watched_movies_ibfk_2` FOREIGN KEY (`userID`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
