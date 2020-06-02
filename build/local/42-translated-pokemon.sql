-- MariaDB dump 10.17  Distrib 10.4.12-MariaDB, for Linux (x86_64)
--
-- Host: mariadb    Database: symfodex
-- ------------------------------------------------------
-- Server version	10.4.12-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (1,'Seed'),(2,'Lizard'),(3,'Flame'),(4,'Tiny Turtle'),(5,'Turtle'),(6,'Shellfish'),(7,'Worm'),(8,'Cocoon'),(9,'Butterfly'),(10,'Hairy Bug'),(11,'Poison Bee'),(12,'Tiny Bird'),(13,'Bird'),(14,'Mouse'),(16,'Beak'),(17,'Snake'),(18,'Cobra'),(19,'Poison Pin'),(20,'Drill'),(21,'Fairy'),(22,'Fox'),(23,'Balloon'),(24,'Bat');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ext_translations`
--

DROP TABLE IF EXISTS `ext_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ext_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locale` varchar(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `object_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreign_key` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `lookup_unique_idx` (`locale`,`object_class`,`field`,`foreign_key`),
  KEY `translations_lookup_idx` (`locale`,`object_class`,`foreign_key`)
) ENGINE=InnoDB AUTO_INCREMENT=123 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ext_translations`
--

LOCK TABLES `ext_translations` WRITE;
/*!40000 ALTER TABLE `ext_translations` DISABLE KEYS */;
INSERT INTO `ext_translations` VALUES (1,'fr','App\\Entity\\Category','name','1','Graine'),(2,'fr','App\\Entity\\Category','name','2','Lézard'),(3,'fr','App\\Entity\\Category','name','3','Flamme'),(4,'fr','App\\Entity\\Category','name','4','Minitortue'),(5,'fr','App\\Entity\\Category','name','5','Tortue'),(6,'fr','App\\Entity\\Category','name','6','Carapace'),(7,'fr','App\\Entity\\Category','name','7','Ver'),(8,'fr','App\\Entity\\Category','name','8','Cocon'),(9,'fr','App\\Entity\\Category','name','9','Papillon'),(10,'fr','App\\Entity\\Category','name','10','Insectopic'),(11,'fr','App\\Entity\\Category','name','11','Guêpoison'),(12,'fr','App\\Entity\\Category','name','12','Minoiseau'),(13,'fr','App\\Entity\\Category','name','13','Oiseau'),(14,'fr','App\\Entity\\Category','name','14','Souris'),(15,'fr','App\\Entity\\Category','name','16','Bec-Oiseau'),(16,'fr','App\\Entity\\Category','name','17','Serpent'),(17,'fr','App\\Entity\\Category','name','19','Vénépic'),(18,'fr','App\\Entity\\Category','name','20','Perceur'),(19,'fr','App\\Entity\\Category','name','21','Fée'),(20,'fr','App\\Entity\\Category','name','22','Renard'),(21,'fr','App\\Entity\\Category','name','23','Bouboule'),(22,'fr','App\\Entity\\Category','name','24','Chovsouris'),(23,'fr','App\\Entity\\Type','name','1','Plante'),(24,'fr','App\\Entity\\Type','description','1',NULL),(25,'fr','App\\Entity\\Type','name','3','Feu'),(26,'fr','App\\Entity\\Type','description','3',NULL),(27,'fr','App\\Entity\\Type','name','4','Vol'),(28,'fr','App\\Entity\\Type','description','4',NULL),(29,'fr','App\\Entity\\Type','name','5','Eau'),(30,'fr','App\\Entity\\Type','description','5',NULL),(31,'fr','App\\Entity\\Type','name','6','Insecte'),(32,'fr','App\\Entity\\Type','description','6',NULL),(33,'fr','App\\Entity\\Type','name','8','Électrik'),(34,'fr','App\\Entity\\Type','description','8',NULL),(35,'fr','App\\Entity\\Type','name','9','Sol'),(36,'fr','App\\Entity\\Type','description','9',NULL),(37,'fr','App\\Entity\\Type','name','10','Fée'),(38,'fr','App\\Entity\\Type','description','10',NULL),(39,'fr','App\\Entity\\Pokemon','name','1','Bulbizarre'),(40,'fr','App\\Entity\\Pokemon','description','1','Bulbizarre passe son temps à faire la sieste sous le soleil. Il y a une graine sur son dos. Il absorbe les rayons du soleil pour faire doucement pousser la graine.'),(41,'fr','App\\Entity\\Pokemon','name','2','Herbizarre'),(42,'fr','App\\Entity\\Pokemon','description','2','Un bourgeon a poussé sur le dos de ce Pokémon. Pour en supporter le poids, Herbizarre a dû se muscler les pattes. Lorsqu\'il commence à se prélasser au soleil, ça signifie que son bourgeon va éclore, donnant naissance à une fleur.'),(43,'fr','App\\Entity\\Pokemon','name','3','Florizarre'),(44,'fr','App\\Entity\\Pokemon','description','3','Une belle fleur se trouve sur le dos de Florizarre. Elle prend une couleur vive lorsqu\'elle est bien nourrie et bien ensoleillée. Le parfum de cette fleur peut apaiser les gens.'),(45,'fr','App\\Entity\\Pokemon','name','4','Salamèche'),(46,'fr','App\\Entity\\Pokemon','description','4','La flamme qui brûle au bout de sa queue indique l\'humeur de ce Pokémon. Elle vacille lorsque Salamèche est content. En revanche, lorsqu\'il s\'énerve, la flamme prend de l\'importance et brûle plus ardemment.'),(47,'fr','App\\Entity\\Pokemon','name','5','Reptincel'),(48,'fr','App\\Entity\\Pokemon','description','5','Reptincel lacère ses ennemis sans pitié grâce à ses griffes acérées. S\'il rencontre un ennemi puissant, il devient agressif et la flamme au bout de sa queue s\'embrase et prend une couleur bleu clair.'),(49,'fr','App\\Entity\\Pokemon','name','6','Dracaufeu'),(50,'fr','App\\Entity\\Pokemon','description','6','Dracaufeu parcourt les cieux pour trouver des adversaires à sa mesure. Il crache de puissantes flammes capables de faire fondre n\'importe quoi. Mais il ne dirige jamais son souffle destructeur vers un ennemi plus faible.'),(51,'fr','App\\Entity\\Pokemon','name','7','Carapuce'),(52,'fr','App\\Entity\\Pokemon','description','7','La carapace de Carapuce ne sert pas qu\'à le protéger. La forme ronde de sa carapace et ses rainures lui permettent d\'améliorer son hydrodynamisme. Ce Pokémon nage extrêmement vite.'),(53,'fr','App\\Entity\\Pokemon','name','8','Carabaffe'),(54,'fr','App\\Entity\\Pokemon','description','8','Carabaffe a une large queue recouverte d\'une épaisse fourrure. Elle devient de plus en plus foncée avec l\'âge. Les éraflures sur la carapace de ce Pokémon témoignent de son expérience au combat.'),(55,'fr','App\\Entity\\Pokemon','name','9','Tortank'),(56,'fr','App\\Entity\\Pokemon','description','9','Tortank dispose de canons à eau émergeant de sa carapace. Ils sont très précis et peuvent envoyer des balles d\'eau capables de faire mouche sur une cible située à plus de 50 m.'),(57,'fr','App\\Entity\\Pokemon','name','10','Chenipan'),(58,'fr','App\\Entity\\Pokemon','description','10','C\'est peut-être parce qu\'il a envie de grandir le plus vite possible qu\'il est si vorace. Il engloutit une centaine de feuilles par jour.'),(59,'fr','App\\Entity\\Pokemon','name','11','Chrysacier'),(60,'fr','App\\Entity\\Pokemon','description','11','Sa carapace contient un liquide gluant. Sa structure cellulaire est en cours de modification en vue de son évolution prochaine.'),(61,'fr','App\\Entity\\Pokemon','name','12','Papilusion'),(62,'fr','App\\Entity\\Pokemon','description','12','Lorsqu\'il surprend un Pokémon oiseau attaquant un Chenipan, il répand les écailles très toxiques qui recouvrent ses ailes sur l\'assaillant.'),(63,'fr','App\\Entity\\Pokemon','name','13','Aspicot'),(64,'fr','App\\Entity\\Pokemon','description','13','L\'odorat d\'Aspicot est extrêmement développé. Il lui suffit de renifler ses feuilles préférées avec son gros appendice nasal pour les reconnaître entre mille.'),(65,'fr','App\\Entity\\Pokemon','name','14','Coconfort'),(66,'fr','App\\Entity\\Pokemon','description','14','Coconfort est la plupart du temps immobile et reste accroché à un arbre. Cependant, intérieurement, il est très actif, car il se prépare pour sa prochaine évolution. En touchant sa carapace, on peut sentir sa chaleur.'),(67,'fr','App\\Entity\\Pokemon','name','15','Dardargnan'),(68,'fr','App\\Entity\\Pokemon','description','15','Dardargnan est extrêmement possessif. Il vaut mieux ne pas toucher son nid si on veut éviter d\'avoir des ennuis. Lorsqu\'ils sont en colère, ces Pokémon attaquent en masse.'),(69,'fr','App\\Entity\\Pokemon','name','16','Roucool'),(70,'fr','App\\Entity\\Pokemon','description','16','Roucool a un excellent sens de l\'orientation. Il est capable de retrouver son nid sans jamais se tromper, même s\'il est très loin de chez lui et dans un environnement qu\'il ne connaît pas.'),(71,'fr','App\\Entity\\Pokemon','name','17','Roucoups'),(72,'fr','App\\Entity\\Pokemon','description','17','Roucoups utilise une vaste surface pour son territoire. Ce Pokémon surveille régulièrement son espace aérien. Si quelqu\'un pénètre sur son territoire, il corrige l\'ennemi sans pitié d\'un coup de ses terribles serres.'),(73,'fr','App\\Entity\\Pokemon','name','18','Roucarnage'),(74,'fr','App\\Entity\\Pokemon','description','18','Ce Pokémon est doté d\'un plumage magnifique et luisant. Bien des Dresseurs sont captivés par la beauté fatale de sa huppe et décident de choisir Roucarnage comme leur Pokémon favori.'),(75,'fr','App\\Entity\\Pokemon','name','19','Rattata'),(76,'fr','App\\Entity\\Pokemon','description','19','Ses incisives poussent tout au long de sa vie. Si elles dépassent une certaine longueur, il ne peut plus s\'alimenter et meurt de faim.'),(77,'fr','App\\Entity\\Pokemon','name','21','Rattatac'),(78,'fr','App\\Entity\\Pokemon','description','21','Les petites palmes de ses pattes postérieures lui permettraient de se rendre d\'île en île à la nage afin d\'échapper à ses prédateurs.'),(79,'fr','App\\Entity\\Pokemon','name','22','Piafabec'),(80,'fr','App\\Entity\\Pokemon','description','22','Un Pokémon téméraire qui n\'hésite pas à affronter des Pokémon plus gros que lui pour protéger son territoire.'),(81,'fr','App\\Entity\\Pokemon','name','23','Rapasdepic'),(82,'fr','App\\Entity\\Pokemon','description','23','Si vous vous promenez sur le territoire d\'un Rapasdepic en transportant de la nourriture, vous risquez de vite la voir s\'envoler !'),(83,'fr','App\\Entity\\Pokemon','name','24','Abo'),(84,'fr','App\\Entity\\Pokemon','description','24','Il peut se déboîter la mâchoire pour avaler tout rond des proies plus grosses que lui. Il se replie ensuite sur lui-même pour digérer.'),(85,'fr','App\\Entity\\Pokemon','name','25','Arbok'),(86,'fr','App\\Entity\\Pokemon','description','25','Une étude récente aurait recensé plus de vingt motifs différents pouvant orner le devant du capuchon des Arbok.'),(87,'fr','App\\Entity\\Pokemon','name','26','Pikachu'),(88,'fr','App\\Entity\\Pokemon','description','26','Son corps peut accumuler de l\'électricité. Les forêts abritant des groupes de Pikachu sont d\'ailleurs souvent frappées par la foudre.'),(89,'fr','App\\Entity\\Pokemon','name','27','Raichu'),(90,'fr','App\\Entity\\Pokemon','description','27','Plus il est chargé en électricité, plus il se montre agressif. D\'aucuns pensent que ce courant électrique le stresse.'),(91,'fr','App\\Entity\\Pokemon','name','28','Sabelette'),(92,'fr','App\\Entity\\Pokemon','description','28','Il vit dans les régions où il pleut rarement. Quand il est en danger, il se roule en boule pour protéger son ventre, qui est son point faible.'),(93,'fr','App\\Entity\\Pokemon','name','29','Sablaireau'),(94,'fr','App\\Entity\\Pokemon','description','29','Ses épines et ses griffes se cassent souvent. Ces pointes brisées peuvent servir d\'outils pour creuser le sol.'),(95,'fr','App\\Entity\\Pokemon','name','30','Nidoran♀'),(96,'fr','App\\Entity\\Pokemon','description','30','Nidoran♀ est couvert de pointes qui sécrètent un poison puissant. On pense que ce petit Pokémon a développé ces pointes pour se défendre. Lorsqu\'il est en colère, une horrible toxine sort de sa corne.'),(97,'fr','App\\Entity\\Pokemon','name','31','Nidorina'),(98,'fr','App\\Entity\\Pokemon','description','31','Lorsqu\'un Nidorina est avec ses amis ou sa famille, il replie ses pointes pour ne pas blesser ses proches. Ce Pokémon devient vite nerveux lorsqu\'il est séparé de son groupe.'),(99,'fr','App\\Entity\\Pokemon','name','32','Nidoqueen'),(100,'fr','App\\Entity\\Pokemon','description','32','Le corps de Nidoqueen est protégé par des écailles extrêmement dures. Il aime envoyer ses ennemis voler en leur fonçant dessus. Ce Pokémon utilise toute sa puissance lorsqu\'il protège ses petits.'),(101,'fr','App\\Entity\\Pokemon','name','33','Nidoran♂'),(102,'fr','App\\Entity\\Pokemon','description','33','Nidoran♂ a développé des muscles pour bouger ses oreilles. Ainsi, il peut les orienter à sa guise. Ce Pokémon peut entendre le plus discret des bruits.'),(103,'fr','App\\Entity\\Pokemon','name','34','Nidorino'),(104,'fr','App\\Entity\\Pokemon','description','34','Nidorino dispose d\'une corne plus dure que du diamant. S\'il sent une présence hostile, toutes les pointes de son dos se hérissent d\'un coup, puis il défie son ennemi.'),(105,'fr','App\\Entity\\Pokemon','name','35','Nidoking'),(106,'fr','App\\Entity\\Pokemon','description','35','L\'épaisse queue de Nidoking est d\'une puissance incroyable. En un seul coup, il peut renverser une tour métallique. Lorsque ce Pokémon se déchaîne, plus rien ne peut l\'arrêter.'),(107,'fr','App\\Entity\\Pokemon','name','36','Mélofée'),(108,'fr','App\\Entity\\Pokemon','description','36','Il est très rare en dépit de sa popularité. Ne le laissez pas sans surveillance, car il risquerait de se faire dérober par un voleur de Pokémon !'),(109,'fr','App\\Entity\\Pokemon','name','37','Mélodelfe'),(110,'fr','App\\Entity\\Pokemon','description','37','Il préfère vivre au fond des montagnes, loin des humains et des Pokémon, car il peut entendre une aiguille tomber à un kilomètre de distance.'),(111,'fr','App\\Entity\\Pokemon','name','38','Goupix'),(112,'fr','App\\Entity\\Pokemon','description','38','Ses queues magnifiques en font un Pokémon très populaire. Il faut toutefois les lui brosser fréquemment pour éviter les nœuds.'),(113,'fr','App\\Entity\\Pokemon','name','39','Feunard'),(114,'fr','App\\Entity\\Pokemon','description','39','Un Pokémon très rancunier. S\'il est offensé, son ressentiment peut poursuivre le coupable et sa descendance pendant un millénaire.'),(115,'fr','App\\Entity\\Pokemon','name','40','Rondoudou'),(116,'fr','App\\Entity\\Pokemon','description','40','Les rayons literie des magasins proposent généralement des CD de berceuses chantées par des Rondoudou.'),(117,'fr','App\\Entity\\Pokemon','name','41','Grodoudou'),(118,'fr','App\\Entity\\Pokemon','description','41','Il est célébré pour son corps élastique et son pelage soyeux. Quel bonheur que de faire une sieste en serrant un Grodoudou contre soi !'),(119,'fr','App\\Entity\\Pokemon','name','42',' Dépourvu d\'yeux, il se repère dans l\'espace grâce aux ultrasons qu\'il émet avec sa bouche.'),(120,'fr','App\\Entity\\Pokemon','description','42','Bulbizarre'),(121,'fr','App\\Entity\\Pokemon','name','43','Nosferalto'),(122,'fr','App\\Entity\\Pokemon','description','43','On rencontre parfois des Nosferalto édentés que la faim a poussés à attaquer un Pokémon de type Acier.');
/*!40000 ALTER TABLE `ext_translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migration_versions`
--

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;
INSERT INTO `migration_versions` VALUES ('20200408032331','2020-04-08 03:24:55'),('20200408033427','2020-04-08 03:35:46'),('20200429222721','2020-04-29 22:32:41'),('20200429234118','2020-04-29 23:41:24');
/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pokemon`
--

DROP TABLE IF EXISTS `pokemon`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pokemon` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `height` double NOT NULL,
  `weight` double NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_62DC90F312469DE2` (`category_id`),
  CONSTRAINT `FK_62DC90F312469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pokemon`
--

LOCK TABLES `pokemon` WRITE;
/*!40000 ALTER TABLE `pokemon` DISABLE KEYS */;
INSERT INTO `pokemon` VALUES (1,1,'Bulbasaur','Bulbasaur can be seen napping in bright sunlight. There is a seed on its back. By soaking up the sun\'s rays, the seed grows progressively larger.',700,6900,1),(2,2,'Ivysaur','There is a bud on this Pokémon\'s back. To support its weight, Ivysaur\'s legs and trunk grow thick and strong. If it starts spending more time lying in the sunlight, it\'s a sign that the bud will bloom into a large flower soon.',1000,13000,1),(3,3,'Venusaur','There is a large flower on Venusaur\'s back. The flower is said to take on vivid colors if it gets plenty of nutrition and sunlight. The flower\'s aroma soothes the emotions of people.',2000,100000,1),(4,4,'Charmander','The flame that burns at the tip of its tail is an indication of its emotions. The flame wavers when Charmander is enjoying itself. If the Pokémon becomes enraged, the flame burns fiercely.',600,8500,2),(5,5,'Charmeleon','Charmeleon mercilessly destroys its foes using its sharp claws. If it encounters a strong foe, it turns aggressive. In this excited state, the flame at the tip of its tail flares with a bluish white color.',1100,19000,3),(6,6,'Charizard','Charizard flies around the sky in search of powerful opponents. It breathes fire of such great heat that it melts anything. However, it never turns its fiery breath on any opponent weaker than itself.',1700,90500,3),(7,7,'Squirtle','Squirtle\'s shell is not merely used for protection. The shell\'s rounded shape and the grooves on its surface help minimize resistance in water, enabling this Pokémon to swim at high speeds.',500,9000,4),(8,8,'Wartortle','Its tail is large and covered with a rich, thick fur. The tail becomes increasingly deeper in color as Wartortle ages. The scratches on its shell are evidence of this Pokémon\'s toughness as a battler.',1000,22500,5),(9,9,'Blastoise','Blastoise has water spouts that protrude from its shell. The water spouts are very accurate. They can shoot bullets of water with enough accuracy to strike empty cans from a distance of over 160 feet.',1600,85500,6),(10,10,'Caterpie','Caterpie has a voracious appetite. It can devour leaves bigger than its body right before your eyes. From its antenna, this Pokémon releases a terrifically strong odor.',300,2900,7),(11,11,'Metapod','The shell covering this Pokémon\'s body is as hard as an iron slab. Metapod does not move very much. It stays still because it is preparing its soft innards for evolution inside the hard shell.',700,9900,8),(12,12,'Butterfree','Butterfree has a superior ability to search for delicious honey from flowers. It can even search out, extract, and carry honey from flowers that are blooming over six miles from its nest.',1100,32000,9),(13,13,'Weedle','Weedle has an extremely acute sense of smell. It is capable of distinguishing its favorite kinds of leaves from those it dislikes just by sniffing with its big red proboscis (nose).',300,3200,10),(14,14,'Kakuna','Kakuna remains virtually immobile as it clings to a tree. However, on the inside, it is extremely busy as it prepares for its coming evolution. This is evident from how hot the shell becomes to the touch.',600,10000,8),(15,15,'Beedrill','Beedrill is extremely territorial. No one should ever approach its nest—this is for their own safety. If angered, they will attack in a furious swarm.',1000,29500,11),(16,16,'Pidgey','Pidgey has an extremely sharp sense of direction. It is capable of unerringly returning home to its nest, however far it may be removed from its familiar surroundings.',300,1800,12),(17,17,'Pidgeotto','Pidgeotto claims a large area as its own territory. This Pokémon flies around, patrolling its living space. If its territory is violated, it shows no mercy in thoroughly punishing the foe with its sharp claws.',1100,30000,13),(18,18,'Pidgeot','This Pokémon has a dazzling plumage of beautifully glossy feathers. Many Trainers are captivated by the striking beauty of the feathers on its head, compelling them to choose Pidgeot as their Pokémon.',1500,39500,13),(19,19,'Rattata','Rattata is cautious in the extreme. Even while it is asleep, it constantly listens by moving its ears around. It is not picky about where it lives—it will make its nest anywhere.',300,3500,14),(21,20,'Raticate','Raticate\'s sturdy fangs grow steadily. To keep them ground down, it gnaws on rocks and logs. It may even chew on the walls of houses.',700,18500,14),(22,21,'Spearow','Spearow has a very loud cry that can be heard over half a mile away. If its high, keening cry is heard echoing all around, it is a sign that they are warning each other of danger.',300,2000,12),(23,22,'Fearow','Fearow is recognized by its long neck and elongated beak. They are conveniently shaped for catching prey in soil or water. It deftly moves its long and skinny beak to pluck prey.',1200,38000,16),(24,23,'Ekans','Ekans curls itself up in a spiral while it rests. Assuming this position allows it to quickly respond to a threat from any direction with a glare from its upraised head.',2000,6900,17),(25,24,'Arbok','This Pokémon is terrifically strong in order to constrict things with its body. It can even flatten steel oil drums. Once Arbok wraps its body around its foe, escaping its crunching embrace is impossible.',3500,65000,18),(26,25,'Pikachu','Whenever Pikachu comes across something new, it blasts it with a jolt of electricity. If you come across a blackened berry, it\'s evidence that this Pokémon mistook the intensity of its charge.',400,6000,14),(27,26,'Raichu','If the electrical sacs become excessively charged, Raichu plants its tail in the ground and discharges. Scorched patches of ground will be found near this Pokémon\'s nest.',800,30000,14),(28,27,'Sandshrew','Sandshrew\'s body is configured to absorb water without waste, enabling it to survive in an arid desert. This Pokémon curls up to protect itself from its enemies.',600,12000,14),(29,28,'Sandslash','Sandslash\'s body is covered by tough spikes, which are hardened sections of its hide. Once a year, the old spikes fall out, to be replaced with new spikes that grow out from beneath the old ones.',1000,29500,14),(30,29,'Nidoran♀','Nidoran♀ has barbs that secrete a powerful poison. They are thought to have developed as protection for this small-bodied Pokémon. When enraged, it releases a horrible toxin from its horn.',400,7000,19),(31,30,'Nidorina','When Nidorina are with their friends or family, they keep their barbs tucked away to prevent hurting each other. This Pokémon appears to become nervous if separated from the others.',800,20000,19),(32,31,'Nidoqueen','Nidoqueen\'s body is encased in extremely hard scales. It is adept at sending foes flying with harsh tackles. This Pokémon is at its strongest when it is defending its young.',1300,60000,20),(33,32,'Nidoran♂','Nidoran♂ has developed muscles for moving its ears. Thanks to them, the ears can be freely moved in any direction. Even the slightest sound does not escape this Pokémon\'s notice.',500,9000,19),(34,33,'Nidorino','Nidorino has a horn that is harder than a diamond. If it senses a hostile presence, all the barbs on its back bristle up at once, and it challenges the foe with all its might.',900,19500,19),(35,34,'Nidoking','Nidoking\'s thick tail packs enormously destructive power. With one swing, it can topple a metal transmission tower. Once this Pokémon goes on a rampage, there is no stopping it.',1400,62000,20),(36,35,'Clefairy','On every night of a full moon, groups of this Pokémon come out to play. When dawn arrives, the tired Clefairy return to their quiet mountain retreats and go to sleep nestled up against each other.',600,7500,21),(37,36,'Clefable','Clefable moves by skipping lightly as if it were flying using its wings. Its bouncy step lets it even walk on water. It is known to take strolls on lakes on quiet, moonlit nights.',1300,40000,21),(38,37,'Vulpix','At the time of its birth, Vulpix has one white tail. The tail separates into six if this Pokémon receives plenty of love from its Trainer. The six tails become magnificently curled.',600,9900,22),(39,38,'Ninetales','Ninetales casts a sinister light from its bright red eyes to gain total control over its foe\'s mind. This Pokémon is said to live for a thousand years.',1100,19900,22),(40,39,'Jigglypuff','Jigglypuff\'s vocal cords can freely adjust the wavelength of its voice. This Pokémon uses this ability to sing at precisely the right wavelength to make its foes most drowsy.',500,5500,23),(41,40,'Wigglytuff','Wigglytuff has large, saucerlike eyes. The surfaces of its eyes are always covered with a thin layer of tears. If any dust gets in this Pokémon\'s eyes, it is quickly washed away.',1000,12000,23),(42,41,'Zubat','It has no eyeballs, so it can\'t see. It checks its surroundings via the ultrasonic waves it emits from its mouth.',800,7500,24),(43,42,'Golbat','Every once in a while, you\'ll see a Golbat that\'s missing some fangs. This happens when hunger drives it to try biting a Steel-type Pokémon.',1600,55000,24);
/*!40000 ALTER TABLE `pokemon` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pokemon_type`
--

DROP TABLE IF EXISTS `pokemon_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pokemon_type` (
  `pokemon_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  PRIMARY KEY (`pokemon_id`,`type_id`),
  KEY `IDX_B077296A2FE71C3E` (`pokemon_id`),
  KEY `IDX_B077296AC54C8C93` (`type_id`),
  CONSTRAINT `FK_B077296A2FE71C3E` FOREIGN KEY (`pokemon_id`) REFERENCES `pokemon` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B077296AC54C8C93` FOREIGN KEY (`type_id`) REFERENCES `type` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pokemon_type`
--

LOCK TABLES `pokemon_type` WRITE;
/*!40000 ALTER TABLE `pokemon_type` DISABLE KEYS */;
INSERT INTO `pokemon_type` VALUES (1,1),(1,2),(2,1),(2,2),(3,1),(3,2),(4,3),(5,3),(6,3),(6,4),(7,5),(8,5),(9,5),(10,6),(11,6),(12,4),(12,6),(13,2),(13,6),(14,2),(14,6),(15,2),(15,6),(16,4),(16,7),(17,4),(17,7),(18,4),(18,7),(19,7),(21,7),(22,4),(22,7),(23,4),(23,7),(24,2),(25,2),(26,8),(27,8),(28,9),(29,9),(30,2),(31,2),(32,2),(32,9),(33,2),(34,2),(35,2),(35,9),(36,10),(37,10),(38,3),(39,3),(40,7),(40,10),(41,7),(41,10),(42,2),(42,4),(43,2),(43,4);
/*!40000 ALTER TABLE `pokemon_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type`
--

DROP TABLE IF EXISTS `type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bootstrap_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type`
--

LOCK TABLES `type` WRITE;
/*!40000 ALTER TABLE `type` DISABLE KEYS */;
INSERT INTO `type` VALUES (1,'Grass',NULL,'#9bcc50','light'),(2,'Poison',NULL,'#b97fc9','dark'),(3,'Fire',NULL,'#fd7d24','dark'),(4,'Flying',NULL,'#3dc7ef,#bdb9b8','light'),(5,'Water',NULL,'#4592c4','dark'),(6,'Bug',NULL,'#729f3f','dark'),(7,'Normal',NULL,'#a4acaf','dark'),(8,'Electric',NULL,'#eed535','light'),(9,'Ground',NULL,'#f7de3f,#ab9842','light'),(10,'Fairy',NULL,'#fdb9e9','dark');
/*!40000 ALTER TABLE `type` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-01 23:43:21
