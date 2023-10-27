/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  27/10/2023 09:53:52                      */
/*==============================================================*/


drop table if exists ALIMENT;


/*==============================================================*/
/* Table : ALIMENT                                              */
/*==============================================================*/
create table ALIMENT
(
   CODE_BARRES          int not null  comment '',
   LOGIN                varchar(30)  comment '',
   MARQUE               varchar(30)  comment '',
   CATEGORIE            varchar(30)  comment '',
   ENERGIE_100G         int  comment '',
   primary key (CODE_BARRES)
);

/*==============================================================*/
/* Table : A_BESOIN_DE                                          */
/*==============================================================*/
create table A_BESOIN_DE
(
   ID_USER              int not null  comment '',
   ID_NUTRIMENT         int not null  comment '',
   QUANTITE_JOUR        int  comment '',
   primary key (ID_USER, ID_NUTRIMENT)
);

/*==============================================================*/
/* Table : ELEMENT_DE                                           */
/*==============================================================*/
create table ELEMENT_DE
(
   CODE_BARRES          int not null  comment '',
   ID_REPAS             int not null  comment '',
   QUANTITE_G           int  comment '',
   primary key (CODE_BARRES, ID_REPAS)
);

/*==============================================================*/
/* Table : INGREDIENT_DE                                        */
/*==============================================================*/
create table INGREDIENT_DE
(
   CODE_BARRES          int not null  comment '',
   ALI_CODE_BARRES      int not null  comment '',
   PROPORTION           float  comment '',
   primary key (CODE_BARRES, ALI_CODE_BARRES)
);

/*==============================================================*/
/* Table : NUTRIMENT                                            */
/*==============================================================*/
create table NUTRIMENT
(
   ID_NUTRIMENT         int not null auto_increment  comment '',
   QUANTITE_100G        int  comment '',
   NOM_NUTRIMENT        varchar(256)  comment '',
   primary key (ID_NUTRIMENT)
);

/*==============================================================*/
/* Table : PRESENT_DANS                                         */
/*==============================================================*/
create table PRESENT_DANS
(
   CODE_BARRES          int not null  comment '',
   ID_NUTRIMENT         int not null  comment '',
   QUANTITE_G           int  comment '',
   primary key (CODE_BARRES, ID_NUTRIMENT)
);

/*==============================================================*/
/* Table : REPAS                                                */
/*==============================================================*/
create table REPAS
(
   ID_REPAS             int not null auto_increment  comment '',
   ID_USER              int not null  comment '',
   DATE                 timestamp  comment '',
   primary key (ID_REPAS)
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
   ID_USER              int not null auto_increment  comment '',
   LOGIN                varchar(30)  comment '',
   AGE                  int  comment '',
   SEXE                 int  comment '',
   SPORT                varchar(30)  comment '',
   KCAL_JOUR            int  comment '',
   primary key (ID_USER)
);

alter table A_BESOIN_DE add constraint FK_A_BESOIN_A_BESOIN__UTILISAT foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;

alter table A_BESOIN_DE add constraint FK_A_BESOIN_A_BESOIN__NUTRIMEN foreign key (ID_NUTRIMENT)
      references NUTRIMENT (ID_NUTRIMENT) on delete restrict on update restrict;

alter table ELEMENT_DE add constraint FK_ELEMENT__ELEMENT_D_ALIMENT foreign key (CODE_BARRES)
      references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table ELEMENT_DE add constraint FK_ELEMENT__ELEMENT_D_REPAS foreign key (ID_REPAS)
      references REPAS (ID_REPAS) on delete restrict on update restrict;

alter table INGREDIENT_DE add constraint FK_INGREDIE_INGREDIEN_ALIMENT foreign key (CODE_BARRES)
      references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table INGREDIENT_DE add constraint FK_INGREDIE_INGREDIEN_ALIMENT foreign key (ALI_CODE_BARRES)
      references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table PRESENT_DANS add constraint FK_PRESENT__PRESENT_D_ALIMENT foreign key (CODE_BARRES)
      references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table PRESENT_DANS add constraint FK_PRESENT__PRESENT_D_NUTRIMEN foreign key (ID_NUTRIMENT)
      references NUTRIMENT (ID_NUTRIMENT) on delete restrict on update restrict;

alter table REPAS add constraint FK_REPAS_MANGE_UTILISAT foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;

