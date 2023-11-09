
/*==============================================================*/
/* Table : ALIMENT                                              */
/*==============================================================*/


create table ALIMENT
(
   CODE_BARRES          BIGINT NOT NULL,
   NOM                  VARCHAR(80),
   MARQUE               VARCHAR(80),
   CATEGORIE            VARCHAR(160),
   ENERGIE_100G         INT,
   MATIERES_GRASSES     FLOAT,
   GRAISSES_SATUREES    FLOAT,
   GLUCIDES             FLOAT,
   SUCRES               FLOAT,
   FIBRES               FLOAT,
   PROTEINES            FLOAT,
   SEL                  FLOAT,
   SODIUM               FLOAT,
   CALCIUM              FLOAT,
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
   ID_USER_CONNECTE     INT NOT NULL,
   NOM_REPAS            varchar(80)  comment '',
   DATE                 TIMESTAMP,
   PRIMARY KEY (ID_REPAS)
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
   ID_USER              INT NOT NULL AUTO_INCREMENT,
   LOGIN                VARCHAR(50) NOT NULL UNIQUE,
   MDP                  VARCHAR(100) NOT NULL,
   AGE                  INT,
   TAILLE               INT,
   POIDS                INT,
   SEXE                 INT,
   ACTIVITE             INT,
   KCAL_JOUR            INT,
   PRIMARY KEY (ID_USER)
);

create table ALIMENTS_FAVORIS
(
   ID_USER              int not null  comment '',
   CODE_BARRES          bigint not null  comment '',
   primary key (ID_USER, CODE_BARRES)
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


-- alter table REPAS add constraint FK_REPAS_MANGE_UTILISAT foreign key (ID_USER)
--       references UTILISATEUR (ID_USER) on delete restrict on update restrict;


/*==============================================================*/
/* Insertions de données dans la Table : ALIMENT                                         */
/*==============================================================*/
INSERT INTO ALIMENT (CODE_BARRES, NOM, MARQUE, CATEGORIE, ENERGIE_100G, MATIERES_GRASSES, GRAISSES_SATUREES, GLUCIDES, SUCRES, FIBRES, PROTEINES, SEL, SODIUM, CALCIUM)
VALUES
  (7612345678901, 'Pomme', 'Del Monte', 'Fruits, Fruits frais, Pommes', 52.0, 0.2, 0.0, 14.0, 9.0, 2.4, 0.4, 0.0, 0.0, 11.0),
  (2001000000011, 'Pain complet', 'Harrys', 'Pains, Pains complets', 250.0, 3.5, 0.6, 46.0, 3.2, 6.5, 10.0, 0.72, 0.29, 34.0),
  (5000159493444, 'Yaourt à la vanille', 'Danone', 'Produits laitiers, Yaourts, Yaourts à la vanille', 112.0, 3.5, 2.3, 14.0, 12.0, 0.0, 5.2, 0.13, 0.05, 130.0),
  (1234567890123, 'Riz basmati', 'Uncle Ben''s', 'Céréales, Riz, Riz basmati', 360.0, 0.7, 0.2, 79.0, 0.3, 1.0, 6.7, 0.01, 0.003, 4.0),
  (5410983045300, 'Saumon fumé', 'Norwegian Seafood', 'Poissons, Poissons fumés, Saumon fumé', 250.0, 17.0, 3.7, 0.0, 0.0, 0.0, 24.0, 2.0, 0.79, 0.0),
  (8033857421237, 'Pizza Margherita', 'Dr. Oetker', 'Plats préparés, Pizzas, Pizzas Margherita', 260.0, 10.0, 4.3, 32.0, 3.3, 2.0, 10.0, 1.2, 0.47, 200.0),
  (2034567890128, 'Salade César', 'Fresh Express', 'Salades, Salades César', 180.0, 13.0, 2.6, 12.0, 2.6, 2.0, 6.0, 0.52, 0.2, 72.0),
  (4002536541230, 'Barre de chocolat', 'Nestlé', 'Snacks, Chocolats, Barres de chocolat', 530.0, 29.0, 16.0, 57.0, 51.0, 7.0, 6.7, 0.43, 0.17, 76.0),
  (8718901156309, "Jus d'orange", 'Tropicana', "Boissons, Jus de fruits, Jus d'orange", 43.0, 0.2, 0.0, 8.2, 8.2, 0.2, 0.8, 0.01, 0.005, 11.0),
  (2054345678123, 'Pâtes spaghetti', 'Barilla', 'Céréales, Pâtes, Pâtes spaghetti', 350.0, 1.5, 0.2, 71.0, 3.4, 2.7, 12.0, 0.01, 0.004, 13.0);
