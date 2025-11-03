-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: deck_royale
-- ------------------------------------------------------
-- Server version	8.3.0

CREATE DATABASE IF NOT EXISTS deck_royale;
USE deck_royale;


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

--
-- Table structure for table `carta`
--

DROP TABLE IF EXISTS `carta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `carta` (
  `id` varchar(20) NOT NULL,
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
INSERT INTO `carta` VALUES ('ariete',4,'img/raras/ariete.png','rara'),('arqueiras',3,'img/comuns/arqueira.png','comum'),('arqueiro-magico',4,'img/lendaria/arqueiro_magico.png','lendaria'),('balao',5,'img/epicas/balao.png','epica'),('bandida',3,'img/lendaria/bandida.png','lendaria'),('bandida-l ider',6,'img/campeoes/bandida_lider.png','campeao'),('barbaros',5,'img/comuns/barbaros.png','comum'),('barbaros-elite',6,'img/comuns/barbaro_elite.png','comum'),('barril-barbaros',2,'img/epicas/barril_barbaro.png','epica'),('barril-esqueletos',3,'img/comuns/skelly_barrel.png','comum'),('barril-goblin',3,'img/epicas/barril_goblin.png','epica'),('bebe-dragao',4,'img/epicas/bebe_Dragao.png','epica'),('berzerk',2,'img/comuns/berzerk.png','comum'),('bola-fogo',4,'img/raras/bola_fogo.png','rara'),('bola-neve',2,'img/comuns/bola_neve.png','comum'),('bombardeiro',2,'img/comuns/bombardeiro.png','comum'),('bowler',5,'img/epicas/bowler.png','epica'),('bruxa',5,'img/epicas/bruxa.png','epica'),('bruxa-mae',4,'img/lendaria/bruxa_mae.png','lendaria'),('bruxa-sombria',4,'img/lendaria/bruxa_sombria.png','lendaria'),('bush',2,'img/raras/bush.png','rara'),('cabana-barbaros',6,'img/raras/cabana_barbaro.png','rara'),('cabana-goblin',4,'img/raras/cabana_goblin.png','rara'),('cacador',4,'img/epicas/cacador.png','epica'),('canhao',3,'img/comuns/canhao.png','comum'),('canhao-movel',5,'img/epicas/canhao_movel.png','epica'),('cavaleiro',3,'img/comuns/cavaleiro.png','comum'),('cemiterio',5,'img/lendaria/cemiterio.png','lendaria'),('clone',3,'img/epicas/clone.png','epica'),('coletor-elixir',6,'img/raras/coletor_elixir.png','rara'),('corredor',4,'img/raras/corredor.png','rara'),('curandeira',4,'img/raras/curandeira.png','rara'),('domadora-de-cabras',5,'img/lendaria/domadora_cabra.png','lendaria'),('dragao-eletrico',5,'img/epicas/dragao_eletrico.png','epica'),('dragao-infernal',4,'img/lendaria/dragao_infernal.png','lendaria'),('dragoes-esqueleto',4,'img/comuns/skelly_dragon.png','comum'),('entrega-real',3,'img/comuns/royal_delivery.png','comum'),('espelho',1,'img/epicas/espelho.png','epica'),('espirito-cura',1,'img/raras/cure_spirit.png','rara'),('espirito-eletrico',1,'img/comuns/e_spirit.png','comum'),('espirito-fogo',1,'img/comuns/fire_spirit.png','comum'),('espirito-gelo',1,'img/comuns/ice_spirit.png','comum'),('esqueletos',1,'img/comuns/skellys.png','comum'),('executor',5,'img/epicas/executor.png','epica'),('exercito-esqueletos',3,'img/epicas/exercito_esqueleto.png','epica'),('fantasma-real',3,'img/lendaria/fantasma_real.png','lendaria'),('fenix',4,'img/lendaria/fenix.png','lendaria'),('flechas',3,'img/comuns/flechas.png','comum'),('flying-machine',4,'img/raras/flying_maching.png','rara'),('foguete',6,'img/raras/foguete.png','rara'),('fornalha',4,'img/raras/fornalha.png','rara'),('furia',2,'img/epicas/furia.png','epica'),('gangue-goblins',3,'img/comuns/goblin_gang.png','comum'),('gelo',4,'img/epicas/gelo.png','epica'),('gigante',5,'img/raras/gigante.png','rara'),('gigante-das-runas',4,'img/epicas/gigante_Runas.png','epica'),('gigante-eletrico',7,'img/epicas/gigante_eletrico.png','epica'),('gigante-esqueleto',6,'img/epicas/gigante_Esqueleto.png','epica'),('gigante-real',6,'img/comuns/gigante_real.png','comum'),('gobinstein',5,'img/campeoes/goblinstein.png','campeao'),('goblin-dardo',3,'img/raras/goblin_Dardo.png','rara'),('goblin-drill',4,'img/epicas/drill.png','epica'),('goblin-gigante',6,'img/epicas/gobling_gigante.png','epica'),('goblin-machine',5,'img/lendaria/globlin_machine.png','lendaria'),('goblins',2,'img/comuns/goblins.png','comum'),('goblins-lanceiros',2,'img/comuns/goblin_lanceiros.png','comum'),('golden-knight',4,'img/campeoes/golden_knight.png','campeao'),('golem',8,'img/epicas/golem.png','epica'),('golem-elixir',3,'img/raras/golem_elixir.png','rara'),('golem-gelo',2,'img/raras/ice_golem.png','rara'),('guardas',3,'img/epicas/guardas.png','epica'),('guardas-reais',7,'img/comuns/royal_guards.png','comum'),('horda-servos',5,'img/comuns/horda_servos.png','comum'),('jaula-goblin',4,'img/raras/jaula_goblin.png','rara'),('kamikaze',4,'img/raras/kamizake.png','rara'),('lapide',3,'img/raras/lapide.png','rara'),('lava-hound',7,'img/lendaria/lava_hound.png','lendaria'),('lenhador',4,'img/lendaria/lenhador.png','lendaria'),('little-prince',3,'img/campeoes/little_prince.png','campeao'),('mago',5,'img/raras/mago.png','rara'),('mago-eletrico',4,'img/lendaria/mago_eletrico.png','lendaria'),('mago-gelo',3,'img/lendaria/mago_gelo.png','lendaria'),('maldicao-goblin',2,'img/epicas/maldicao_goblin.png','epica'),('mega-cavaleiro',7,'img/lendaria/mega_cavaleiro.png','lendaria'),('mega-servo',3,'img/raras/megaservo.png','rara'),('mighty-miner',4,'img/campeoes/mighty_miner.png','campeao'),('mineiro',3,'img/lendaria/mineiro.png','lendaria'),('mini-pekka',4,'img/raras/mini_pekka.png','rara'),('monge',5,'img/campeoes/monge.png','campeao'),('morcegos',2,'img/comuns/morcegos.png','comum'),('morteiro',4,'img/comuns/mortero.png','comum'),('mosqueteira',4,'img/raras/mosqueteira.png','rara'),('pekka',7,'img/epicas/pekka.png','epica'),('pescador',3,'img/lendaria/pescador.png','lendaria'),('pirotecnica',3,'img/comuns/pirotecnica.png','comum'),('porcos',5,'img/raras/porcos.png','rara'),('princesa',3,'img/lendaria/princesa.png','lendaria'),('princesa-dragao',6,'img/lendaria/princesa_dragao.png','lendaria'),('principe',5,'img/epicas/principe.png','epica'),('principe-trevas',4,'img/epicas/principe_trevas.png','epica'),('rainha-arqueiro',5,'img/campeoes/rainha_arqueira.png','campeao'),('rascals',5,'img/comuns/rascals.png','comum'),('rei-esqueleto',4,'img/campeoes/esqueleton_king.png','campeao'),('relampago',6,'img/epicas/relampago.png','epica'),('servos',3,'img/comuns/servos.png','comum'),('sparky',6,'img/lendaria/sparky.png','lendaria'),('terremoto',3,'img/raras/terremoto.png','rara'),('teste',4,'img/comuns/tesla.png','comum'),('tornado',3,'img/epicas/tornado.png','epica'),('tornado-void',3,'img/epicas/void.png','epica'),('torre-bombardeiro',4,'img/raras/torre_bombardeiro.png','rara'),('torre-inferno',5,'img/raras/torre_inferno.png','rara'),('tres-mosqueteiras',9,'img/raras/tres_mosqueteiras.png','rara'),('tronco',2,'img/lendaria/tronco.png','lendaria'),('valkyria',4,'img/raras/valkiria.png','rara'),('veneno',4,'img/epicas/veneno.png','epica'),('vinhas',3,'vinha','epica'),('wall-breakers',2,'img/epicas/wall_Breakers.png','epica'),('x-besta',6,'img/epicas/besta.png','epica'),('zap',2,'img/comuns/zap.png','comum'),('zappies',4,'img/raras/zappies.png','rara');
/*!40000 ALTER TABLE `carta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-10-04  0:18:15
