/*==============================================================*/
/* Table : ALIMENT                                              */
/*==============================================================*/
create table ALIMENT
(
   CODE_BARRES          BIGINT NOT NULL,
   NOM                VARCHAR(80),
   MARQUE               VARCHAR(80),
   CATEGORIE            VARCHAR(160),
   ENERGIE_100G         INT,
   PRIMARY KEY (CODE_BARRES)
);

/*==============================================================*/
/* Table : A_BESOIN_DE                                          */
/*==============================================================*/
create table A_BESOIN_DE
(
   ID_USER              INT NOT NULL,
   ID_NUTRIMENT         INT NOT NULL,
   QUANTITE_JOUR        INT,
   PRIMARY KEY (ID_USER, ID_NUTRIMENT)
);

/*==============================================================*/
/* Table : ELEMENT_DE                                           */
/*==============================================================*/
create table ELEMENT_DE
(
   CODE_BARRES          BIGINT NOT NULL,
   ID_REPAS             INT NOT NULL,
   QUANTITE_G           INT,
   PRIMARY KEY (CODE_BARRES, ID_REPAS)
);

/*==============================================================*/
/* Table : INGREDIENT_DE                                        */
/*==============================================================*/
create table INGREDIENT_DE
(
   CODE_BARRES          BIGINT NOT NULL,
   ALI_CODE_BARRES      BIGINT NOT NULL,
   PROPORTION           FLOAT,
   PRIMARY KEY (CODE_BARRES, ALI_CODE_BARRES)
);

/*==============================================================*/
/* Table : NUTRIMENT                                            */
/*==============================================================*/
create table NUTRIMENT
(
   ID_NUTRIMENT         INT NOT NULL AUTO_INCREMENT,
   QUANTITE_100G        INT,
   NOM_NUTRIMENT        VARCHAR(256),
   PRIMARY KEY (ID_NUTRIMENT)
);

/*==============================================================*/
/* Table : PRESENT_DANS                                         */
/*==============================================================*/
create table PRESENT_DANS
(
   CODE_BARRES          BIGINT NOT NULL,
   ID_NUTRIMENT         INT NOT NULL,
   QUANTITE_G           INT,
   PRIMARY KEY (CODE_BARRES, ID_NUTRIMENT)
);

/*==============================================================*/
/* Table : REPAS                                                */
/*==============================================================*/
create table REPAS
(
   ID_REPAS             INT NOT NULL AUTO_INCREMENT,
   ID_USER              INT NOT NULL,
   DATE                 TIMESTAMP,
   PRIMARY KEY (ID_REPAS)
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
   ID_USER              INT NOT NULL AUTO_INCREMENT,
   NOM                VARCHAR(30),
   AGE                  INT,
   SEXE                 INT,
   SPORT                VARCHAR(30),
   KCAL_JOUR            INT,
   PRIMARY KEY (ID_USER)
);

/* Clés étrangères adaptées pour les nouvelles colonnes BIGINT */

alter table A_BESOIN_DE add constraint FK_A_BESOIN_A_BESOIN__UTILISAT foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;

alter table A_BESOIN_DE add constraint FK_A_BESOIN_A_BESOIN__NUTRIMEN foreign key (ID_NUTRIMENT)
      references NUTRIMENT (ID_NUTRIMENT) on delete restrict on update restrict;

alter table ELEMENT_DE add constraint FK_ELEMENT__ELEMENT_D_ALIMENT foreign key (CODE_BARRES)
      references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table ELEMENT_DE add constraint FK_ELEMENT__ELEMENT_D_REPAS foreign key (ID_REPAS)
      references REPAS (ID_REPAS) on delete restrict on update restrict;

alter table INGREDIENT_DE add constraint FK_INGREDIE_INGREDIEN_ALIMENT1 foreign key (CODE_BARRES)
  references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table INGREDIENT_DE add constraint FK_INGREDIE_INGREDIEN_ALIMENT2 foreign key (ALI_CODE_BARRES)
  references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table PRESENT_DANS add constraint FK_PRESENT__PRESENT_D_ALIMENT foreign key (CODE_BARRES)
      references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table PRESENT_DANS add constraint FK_PRESENT__PRESENT_D_NUTRIMEN foreign key (ID_NUTRIMENT)
      references NUTRIMENT (ID_NUTRIMENT) on delete restrict on update restrict;

alter table REPAS add constraint FK_REPAS_MANGE_UTILISAT foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;

/*==============================================================*/
/* Insertions de données dans la Table : ALIMENT                                              */
/*==============================================================*/
INSERT INTO ALIMENT (CODE_BARRES, NOM, MARQUE, CATEGORIE, ENERGIE_100G)
VALUES
  (7612345678901, 'Pomme', 'Del Monte', 'Fruits, Fruits frais, Pommes', 52.0),
  (2001000000011, 'Pain complet', 'Harrys', 'Pains, Pains complets', 250.0),
  (5000159493444, 'Yaourt à la vanille', 'Danone', 'Produits laitiers, Yaourts, Yaourts à la vanille', 112.0),
  (1234567890123, 'Riz basmati', 'Uncle Ben''s', 'Céréales, Riz, Riz basmati', 360.0),
  (5410983045300, 'Saumon fumé', 'Norwegian Seafood', 'Poissons, Poissons fumés, Saumon fumé', 250.0),
  (8033857421237, 'Pizza Margherita', 'Dr. Oetker', 'Plats préparés, Pizzas, Pizzas Margherita', 260.0),
  (2034567890128, 'Salade César', 'Fresh Express', 'Salades, Salades César', 180.0),
  (4002536541230, 'Barre de chocolat', 'Nestlé', 'Snacks, Chocolats, Barres de chocolat', 530.0),
  (8718901156309, "Jus d'orange", 'Tropicana', "Boissons, Jus de fruits, Jus d'orange", 43.0),
  (2054345678123, 'Pâtes spaghetti', 'Barilla', 'Céréales, Pâtes, Pâtes spaghetti', 350.0);

