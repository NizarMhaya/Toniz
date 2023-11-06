/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de cr�ation :  06/11/2023 14:11:27                      */
/*==============================================================*/

/*==============================================================*/
/* Table : ALIMENT                                              */
/*==============================================================*/
create table ALIMENT
(
   CODE_BARRES          bigint not null  comment '',
   NOM                  varchar(80)  comment '',
   MARQUE               varchar(80)  comment '',
   CATEGORIE            varchar(160)  comment '',
   ENERGIE_100G         int  comment '',
   primary key (CODE_BARRES)
   
);

/*==============================================================*/
/* Table : ALIMENTS_FAVORIS                                     */
/*==============================================================*/
create table ALIMENTS_FAVORIS
(
   ID_USER              int not null  comment '',
   CODE_BARRES          bigint not null  comment '',
   primary key (ID_USER, CODE_BARRES)
);

/*==============================================================*/
/* Table : A_BESOIN_DE                                          */
/*==============================================================*/
create table A_BESOIN_DE
(
   ID_NUTRIMENT         int not null  comment '',
   ID_USER              int not null  comment '',
   QUANTITE_JOUR        int  comment '',
   primary key (ID_NUTRIMENT, ID_USER)
);


/*==============================================================*/
/* Table : ELEMENT_DE                                           */
/*==============================================================*/
create table ELEMENT_DE
(
   CODE_BARRES          bigint not null  comment '',
   ID_REPAS             int not null  comment '',
   QUANTITE_G           int  comment '',
   primary key (CODE_BARRES, ID_REPAS)
);

/*==============================================================*/
/* Table : INGREDIENT_DE                                        */
/*==============================================================*/
create table INGREDIENT_DE
(
   ALI_CODE_BARRES      bigint not null  comment '',
   ALI_CODE_BARRES2     bigint not null  comment '',
   CODE_BARRES          bigint  comment '',
   primary key (ALI_CODE_BARRES, ALI_CODE_BARRES2)
);

/*==============================================================*/
/* Table : NUTRIMENT                                            */
/*==============================================================*/
create table NUTRIMENT
(
   ID_NUTRIMENT         int not null  comment '',
   NOM_NUTRIMENT        varchar(80)  comment '',
   QUANTITE_100G        int  comment '',
   primary key (ID_NUTRIMENT)
);

/*==============================================================*/
/* Table : PRESENT_DANS                                         */
/*==============================================================*/
create table PRESENT_DANS
(
   CODE_BARRES          bigint not null  comment '',
   ID_NUTRIMENT         int not null  comment '',
   QUANTITE_G           int  comment '',
   primary key (CODE_BARRES, ID_NUTRIMENT)
);

/*==============================================================*/
/* Table : REPAS                                                */
/*==============================================================*/
create table REPAS
(
   ID_REPAS             int not null  comment '',
   ID_USER              int not null comment '',
   NOM_REPAS            varchar(80)  comment '',
   DATE                 timestamp  comment '',
   primary key (ID_REPAS),
      -- KEY FK_REPAS_MANGE_UTILISAT (ID_USER)
);

/*==============================================================*/
/* Table : UTILISATEUR                                          */
/*==============================================================*/
create table UTILISATEUR
(
   ID_USER              int not null  comment '',
   LOGIN                varchar(50)  comment '',
   MDP                  varchar(100)  comment '',
   AGE                  int  comment '',
   TAILLE               int  comment '',
   POIDS                int  comment '',
   SEXE                 int  comment '',
   ACTIVITE             int  comment '',
   KCAL_JOUR            int  comment '',
   primary key (ID_USER)
);

alter table ALIMENTS_FAVORIS add constraint FK_ALIMENTS_ALIMENTS__UTILISAT foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;

alter table ALIMENTS_FAVORIS add constraint FK_ALIMENTS_ALIMENTS__ALIMENT foreign key (CODE_BARRES)
      references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table A_BESOIN_DE add constraint FK_A_BESOIN_A_BESOIN__NUTRIMEN foreign key (ID_NUTRIMENT)
      references NUTRIMENT (ID_NUTRIMENT) on delete restrict on update restrict;

alter table A_BESOIN_DE add constraint FK_A_BESOIN_A_BESOIN__UTILISAT foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;

alter table ELEMENT_DE add constraint FK_ELEMENT__ELEMENT_D_ALIMENT foreign key (CODE_BARRES)
      references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table ELEMENT_DE add constraint FK_ELEMENT__ELEMENT_D_REPAS foreign key (ID_REPAS)
      references REPAS (ID_REPAS) on delete restrict on update restrict;

alter table INGREDIENT_DE add constraint FK_INGREDIE_INGREDIEN_ALIMENT foreign key (ALI_CODE_BARRES)
      references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table INGREDIENT_DE add constraint FK_INGREDIE_INGREDIEN_ALIMENT foreign key (ALI_CODE_BARRES2)
      references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table PRESENT_DANS add constraint FK_PRESENT__PRESENT_D_ALIMENT foreign key (CODE_BARRES)
      references ALIMENT (CODE_BARRES) on delete restrict on update restrict;

alter table PRESENT_DANS add constraint FK_PRESENT__PRESENT_D_NUTRIMEN foreign key (ID_NUTRIMENT)
      references NUTRIMENT (ID_NUTRIMENT) on delete restrict on update restrict;

