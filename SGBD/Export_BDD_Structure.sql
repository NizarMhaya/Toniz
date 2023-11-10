/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  10/11/2023 17:25:02                      */
/*==============================================================*/


alter table ALIMENTS_FAVORIS 
   drop foreign key FK_ALIMENTS_ALIMENTS__UTILISAT;

alter table ALIMENTS_FAVORIS 
   drop foreign key FK_ALIMENTS_ALIMENTS__ALIMENT;

alter table A_BESOIN_DE 
   drop foreign key FK_A_BESOIN_A_BESOIN__NUTRIMEN;

alter table A_BESOIN_DE 
   drop foreign key FK_A_BESOIN_A_BESOIN__UTILISAT;

alter table A_MANGE 
   drop foreign key FK_A_MANGE_A_MANGE_REPAS;

alter table A_MANGE 
   drop foreign key FK_A_MANGE_A_MANGE2_UTILISAT;

alter table ELEMENT_DE 
   drop foreign key FK_ELEMENT__ELEMENT_D_ALIMENT;

alter table ELEMENT_DE 
   drop foreign key FK_ELEMENT__ELEMENT_D_REPAS;

alter table INGREDIENT_DE 
   drop foreign key FK_INGREDIE_INGREDIEN_ALIMENT;

alter table INGREDIENT_DE 
   drop foreign key FK_INGREDIE_INGREDIEN_ALIMENT;

alter table PRESENT_DANS 
   drop foreign key FK_PRESENT__PRESENT_D_ALIMENT;

alter table PRESENT_DANS 
   drop foreign key FK_PRESENT__PRESENT_D_NUTRIMEN;

drop table if exists ALIMENT;


alter table ALIMENTS_FAVORIS 
   drop foreign key FK_ALIMENTS_ALIMENTS__UTILISAT;

alter table ALIMENTS_FAVORIS 
   drop foreign key FK_ALIMENTS_ALIMENTS__ALIMENT;

drop table if exists ALIMENTS_FAVORIS;


alter table A_BESOIN_DE 
   drop foreign key FK_A_BESOIN_A_BESOIN__NUTRIMEN;

alter table A_BESOIN_DE 
   drop foreign key FK_A_BESOIN_A_BESOIN__UTILISAT;

drop table if exists A_BESOIN_DE;


alter table A_MANGE 
   drop foreign key FK_A_MANGE_A_MANGE_REPAS;

alter table A_MANGE 
   drop foreign key FK_A_MANGE_A_MANGE2_UTILISAT;

drop table if exists A_MANGE;


alter table ELEMENT_DE 
   drop foreign key FK_ELEMENT__ELEMENT_D_ALIMENT;

alter table ELEMENT_DE 
   drop foreign key FK_ELEMENT__ELEMENT_D_REPAS;

drop table if exists ELEMENT_DE;


alter table INGREDIENT_DE 
   drop foreign key FK_INGREDIE_INGREDIEN_ALIMENT;

alter table INGREDIENT_DE 
   drop foreign key FK_INGREDIE_INGREDIEN_ALIMENT;

drop table if exists INGREDIENT_DE;

drop table if exists NUTRIMENT;


alter table PRESENT_DANS 
   drop foreign key FK_PRESENT__PRESENT_D_ALIMENT;

alter table PRESENT_DANS 
   drop foreign key FK_PRESENT__PRESENT_D_NUTRIMEN;

drop table if exists PRESENT_DANS;

drop table if exists REPAS;

drop table if exists UTILISATEUR;

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
   MAT_GRASSES          decimal  comment '',
   GRAISSES_SATUREES    decimal  comment '',
   GLUCIDES             decimal  comment '',
   SUCRES               decimal  comment '',
   FIBRES               decimal  comment '',
   PROTEINES            decimal  comment '',
   SEL                  decimal  comment '',
   SODIUM               decimal  comment '',
   CALCIUM              decimal  comment '',
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
/* Table : A_MANGE                                              */
/*==============================================================*/
create table A_MANGE
(
   ID_REPAS             int not null  comment '',
   ID_USER              int not null  comment '',
   primary key (ID_REPAS, ID_USER)
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
   CODE_BARRES          bigint not null  comment '',
   ALI_CODE_BARRES      bigint not null  comment '',
   primary key (CODE_BARRES, ALI_CODE_BARRES)
);

/*==============================================================*/
/* Table : NUTRIMENT                                            */
/*==============================================================*/
create table NUTRIMENT
(
   ID_NUTRIMENT         int not null  comment '',
   NOM_NUTRIMENT        varchar(80)  comment '',
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
   NOM_REPAS            varchar(80)  comment '',
   DATE                 datetime  comment '',
   primary key (ID_REPAS)
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

alter table A_MANGE add constraint FK_A_MANGE_A_MANGE_REPAS foreign key (ID_REPAS)
      references REPAS (ID_REPAS) on delete restrict on update restrict;

alter table A_MANGE add constraint FK_A_MANGE_A_MANGE2_UTILISAT foreign key (ID_USER)
      references UTILISATEUR (ID_USER) on delete restrict on update restrict;

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

