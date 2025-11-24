CREATE DATABASE IF NOT EXISTS `deck_royale` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `deck_royale`;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuario` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `perfil` varchar(50) NOT NULL DEFAULT 'User',
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (1,'Murilo','User','murilo@gmail.com','1234'),(5,'Luan','Admin','luan@gmail.com','$2y$10$zWR6g7meegMeYPgvO3kjMOaU4eqwYtZ4aG9DbXOTOgHwsyYJrZdY2'),(7,'Matheus','User','marheus@gmail.com','$2y$10$xFOOzMFuGwGFsSppFahu9uJE63GQ4eJzRnSVc06sGX1xmdcXzl/c6');
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `deck`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deck` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `id_usuario` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT fk_deck_usuario FOREIGN KEY (`id_usuario`) REFERENCES `usuario`(`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deck`
--

LOCK TABLES `deck` WRITE;
/*!40000 ALTER TABLE `deck` DISABLE KEYS */;
INSERT INTO `deck` VALUES (1, 'Deckgostoso');
/*!40000 ALTER TABLE `deck` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `carta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carta` (
  `id` varchar(20) NOT NULL, -- Chave primária é VARCHAR
  `custo` int NOT NULL,
  `srcImagem` varchar(40) NOT NULL,
  `raridade` varchar(15) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `carta`
--

LOCK TABLES `carta` WRITE;
/*!40000 ALTER TABLE `carta` DISABLE KEYS */;
INSERT INTO `carta` VALUES ('ariete',4,'ariete.png','rara'),('arqueiras',3,'arqueira.png','comum'),('arqueiro-magico',4,'arqueiro_magico.png','lendaria'),('balao',5,'balao.png','epica'),('bandida',3,'bandida.png','lendaria'),('bandida-l ider',6,'bandida_lider.png','campeao'),('barbaros',5,'barbaros.png','comum'),('barbaros-elite',6,'barbaro_elite.png','comum'),('barril-barbaros',2,'barril_barbaro.png','epica'),('barril-esqueletos',3,'skelly_barrel.png','comum'),('barril-goblin',3,'barril_goblin.png','epica'),('bebe-dragao',4,'bebe_Dragao.png','epica'),('berzerk',2,'berzerk.png','comum'),('bola-fogo',4,'bola_fogo.png','rara'),('bola-neve',2,'bola_neve.png','comum'),('bombardeiro',2,'bombardeiro.png','comum'),('bowler',5,'bowler.png','epica'),('bruxa',5,'bruxa.png','epica'),('bruxa-mae',4,'bruxa_mae.png','lendaria'),('bruxa-sombria',4,'bruxa_sombria.png','lendaria'),('bush',2,'bush.png','rara'),('cabana-barbaros',6,'cabana_barbaro.png','rara'),('cabana-goblin',4,'cabana_goblin.png','rara'),('cacador',4,'cacador.png','epica'),('canhao',3,'canhao.png','comum'),('canhao-movel',5,'canhao_movel.png','epica'),('cavaleiro',3,'cavaleiro.png','comum'),('cemiterio',5,'cemiterio.png','lendaria'),('clone',3,'clone.png','epica'),('coletor-elixir',6,'coletor_elixir.png','rara'),('corredor',4,'corredor.png','rara'),('curandeira',4,'curandeira.png','rara'),('domadora-de-cabras',5,'domadora_cabra.png','lendaria'),('dragao-eletrico',5,'dragao_eletrico.png','epica'),('dragao-infernal',4,'dragao_infernal.png','lendaria'),('dragoes-esqueleto',4,'skelly_dragon.png','comum'),('entrega-real',3,'royal_delivery.png','comum'),('espelho',1,'espelho.png','epica'),('espirito-cura',1,'cure_spirit.png','rara'),('espirito-eletrico',1,'e_spirit.png','comum'),('espirito-fogo',1,'fire_spirit.png','comum'),('espirito-gelo',1,'ice_spirit.png','comum'),('esqueletos',1,'skellys.png','comum'),('executor',5,'executor.png','epica'),('exercito-esqueletos',3,'exercito_esqueleto.png','epica'),('fantasma-real',3,'fantasma_real.png','lendaria'),('fenix',4,'fenix.png','lendaria'),('flechas',3,'flechas.png','comum'),('flying-machine',4,'flying_maching.png','rara'),('foguete',6,'foguete.png','rara'),('fornalha',4,'fornalha.png','rara'),('furia',2,'furia.png','epica'),('gangue-goblins',3,'goblin_gang.png','comum'),('gelo',4,'gelo.png','epica'),('gigante',5,'gigante.png','rara'),('gigante-das-runas',4,'gigante_Runas.png','epica'),('gigante-eletrico',7,'gigante_eletrico.png','epica'),('gigante-esqueleto',6,'gigante_Esqueleto.png','epica'),('gigante-real',6,'gigante_real.png','comum'),('gobinstein',5,'goblinstein.png','campeao'),('goblin-dardo',3,'goblin_Dardo.png','rara'),('goblin-drill',4,'drill.png','epica'),('goblin-gigante',6,'gobling_gigante.png','epica'),('goblin-machine',5,'globlin_machine.png','lendaria'),('goblins',2,'goblins.png','comum'),('goblins-lanceiros',2,'goblin_lanceiros.png','comum'),('golden-knight',4,'golden_knight.png','campeao'),('golem',8,'golem.png','epica'),('golem-elixir',3,'golem_elixir.png','rara'),('golem-gelo',2,'ice_golem.png','rara'),('guardas',3,'guardas.png','epica'),('guardas-reais',7,'royal_guards.png','comum'),('horda-servos',5,'horda_servos.png','comum'),('jaula-goblin',4,'jaula_goblin.png','rara'),('kamikaze',4,'kamizake.png','rara'),('lapide',3,'lapide.png','rara'),('lava-hound',7,'lava_hound.png','lendaria'),('lenhador',4,'lenhador.png','lendaria'),('little-prince',3,'little_prince.png','campeao'),('mago',5,'mago.png','rara'),('mago-eletrico',4,'mago_eletrico.png','lendaria'),('mago-gelo',3,'mago_gelo.png','lendaria'),('maldicao-goblin',2,'maldicao_goblin.png','epica'),('mega-cavaleiro',7,'mega_cavaleiro.png','lendaria'),('mega-servo',3,'megaservo.png','rara'),('mighty-miner',4,'mighty_miner.png','campeao'),('mineiro',3,'mineiro.png','lendaria'),('mini-pekka',4,'mini_pekka.png','rara'),('monge',5,'monge.png','campeao'),('morcegos',2,'morcegos.png','comum'),('morteiro',4,'mortero.png','comum'),('mosqueteira',4,'mosqueteira.png','rara'),('pekka',7,'pekka.png','epica'),('pescador',3,'pescador.png','lendaria'),('pirotecnica',3,'pirotecnica.png','comum'),('porcos',5,'porcos.png','rara'),('princesa',3,'princesa.png','lendaria'),('princesa-dragao',6,'princesa_dragao.png','lendaria'),('principe',5,'principe.png','epica'),('principe-trevas',4,'principe_trevas.png','epica'),('rainha-arqueiro',5,'rainha_arqueira.png','campeao'),('rascals',5,'rascals.png','comum'),('rei-esqueleto',4,'esqueleton_king.png','campeao'),('relampago',6,'relampago.png','epica'),('servos',3,'servos.png','comum'),('sparky',6,'sparky.png','lendaria'),('terremoto',3,'terremoto.png','rara'),('teste',4,'tesla.png','comum'),('tornado',3,'tornado.png','epica'),('tornado-void',3,'void.png','epica'),('torre-bombardeiro',4,'torre_bombardeiro.png','rara'),('torre-inferno',5,'torre_inferno.png','rara'),('tres-mosqueteiras',9,'tres_mosqueteiras.png','rara'),('tronco',2,'tronco.png','lendaria'),('valkyria',4,'valkiria.png','rara'),('veneno',4,'veneno.png','epica'),('vinhas',3,'vinha','epica'),('wall-breakers',2,'wall_Breakers.png','epica'),('x-besta',6,'besta.png','epica'),('zap',2,'zap.png','comum'),('zappies',4,'zappies.png','rara');
/*!40000 ALTER TABLE `carta` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `deckCarta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `deckCarta` (
    `id_deck` INT NOT NULL,
    `id_carta` varchar(20) NOT NULL,
    
    PRIMARY KEY (`id_deck`, `id_carta`),
    
    CONSTRAINT fk_dc_deck
        FOREIGN KEY (`id_deck`) REFERENCES `deck`(`id`)
        ON DELETE CASCADE,
        
    CONSTRAINT fk_dc_carta
        FOREIGN KEY (`id_carta`) REFERENCES `carta`(`id`)
        ON DELETE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `deckCarta`
--

LOCK TABLES `deckCarta` WRITE;
/*!40000 ALTER TABLE `deckCarta` DISABLE KEYS */;
INSERT INTO `deckCarta` (`id_deck`, `id_carta`) VALUES (1, 'ariete'),(1, 'balao'); 
/*!40000 ALTER TABLE `deckCarta` ENABLE KEYS */;
UNLOCK TABLES;


/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;