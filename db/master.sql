/*==============================================================*/
/* Nom de SGBD :  MySQL 5.0                                     */
/* Date de création :  02/08/2016 15:31:30                      */
/*==============================================================*/
CREATE USER 'bdauser'@'localhost' IDENTIFIED BY 'secret';

CREATE DATABASE IF NOT EXISTS greentecbda;

/*==============================================================*/
/* Table : ANSWER                                               */
/*==============================================================*/
create table IF NOT EXISTS ANSWER
(
   ANSWERID             bigint not null AUTO_INCREMENT,
   QUESTIONID           bigint,
   ANSWERCONTENT        longtext,
   primary key (ANSWERID)
);

/*==============================================================*/
/* Table : PATTERN                                              */
/*==============================================================*/
create table IF NOT EXISTS PATTERN
(
   PATTERNID            bigint not null AUTO_INCREMENT,
   PATTERNCONTENT       longtext not null,
   PATTERNINDEX         bigint,
   primary key (PATTERNID)
);

/*==============================================================*/
/* Table : QUESTION                                             */
/*==============================================================*/
create table IF NOT EXISTS QUESTION
(
   QUESTIONID           bigint not null AUTO_INCREMENT,
   PATTERNID            bigint,
   SURVEYID             bigint,
   QUESTIONCONTENT      longtext,
   QUESTIONTYPE         varchar(20),
   REQUIRED             int,
   QUESTIONORDER        int,
   primary key (QUESTIONID)
);

/*==============================================================*/
/* Table : SURVEY                                               */
/*==============================================================*/
create table IF NOT EXISTS SURVEY
(
   SURVEYID             bigint not null AUTO_INCREMENT,
   USERBDAID            bigint not null,
   CLIENTBDAID          bigint,
   SURVEYNAME           varchar(255),
   SURVEYEXPIRATION     bigint,
   SURVYINCENTIVE       double,
   SURVEYDATECREATION   bigint,
   primary key (SURVEYID)
);

/*==============================================================*/
/* Table : USER                                                 */
/*==============================================================*/
create table IF NOT EXISTS USER
(
   USERBEBOUNDID        bigint not null,
   USENAME              varchar(35),
   USERPHONENUMBER      varchar(20),
   USERCOUNTRY          varchar(35),
   USERCITY             varchar(35),
   USERCARRIER          varchar(35),
   USERGENDER           int,
   USEROCCUPATION       varchar(35),
   USERAGE              int,
   USERDATEOFBIRTH      bigint,
   USERPLACEOFBIRTH     varchar(35),
   USERRELIGION         varchar(35),
   USERRELATIONSHIP     varchar(35),
   USERNUMBERPARTNER    int,
   USERMARTIALSTATUS    varchar(35),
   primary key (USERBEBOUNDID)
);

/*==============================================================*/
/* Table : USERBDA                                              */
/*==============================================================*/
create table IF NOT EXISTS USERBDA
(
   USERBDAID            bigint not null AUTO_INCREMENT,
   USERBDALOGIN         varchar(35),
   USERBDAPWD           varchar(35),
   USERTYPE             int,
   primary key (USERBDAID)
);

/*==============================================================*/
/* Table : USERSUBMITTEDANSWERS                                 */
/*==============================================================*/
create table IF NOT EXISTS USERSUBMITTEDANSWERS
(
   QUESTIONID           bigint not null,
   ANSWERID             bigint not null,
   USERBEBOUNDID        bigint not null,
   primary key (QUESTIONID, ANSWERID, USERBEBOUNDID)
);

/*==============================================================*/
/* Table : USERSURVEY                                           */
/*==============================================================*/
create table IF NOT EXISTS USERSURVEY
(
   USERBEBOUNDID        bigint not null,
   SURVEYID             bigint not null,
   SUBMISSIONDATE       bigint,
   primary key (USERBEBOUNDID, SURVEYID)
);

alter table ANSWER add constraint FK_REFERENCE_13 foreign key (QUESTIONID)
      references QUESTION (QUESTIONID) on delete restrict on update restrict;

alter table QUESTION add constraint FK_REFERENCE_12 foreign key (SURVEYID)
      references SURVEY (SURVEYID) on delete restrict on update restrict;

alter table QUESTION add constraint FK_REFERENCE_5 foreign key (PATTERNID)
      references PATTERN (PATTERNID) on delete restrict on update restrict;

alter table SURVEY add constraint FK_REFERENCE_16 foreign key (CLIENTBDAID)
      references USERBDA (USERBDAID) on delete restrict on update restrict;

alter table SURVEY add constraint FK_REFERENCE_4 foreign key (USERBDAID)
      references USERBDA (USERBDAID) on delete restrict on update restrict;

alter table USERSUBMITTEDANSWERS add constraint FK_REFERENCE_14 foreign key (ANSWERID)
      references ANSWER (ANSWERID) on delete restrict on update restrict;

alter table USERSUBMITTEDANSWERS add constraint FK_REFERENCE_15 foreign key (QUESTIONID)
      references QUESTION (QUESTIONID) on delete restrict on update restrict;

alter table USERSUBMITTEDANSWERS add constraint FK_REFERENCE_9 foreign key (USERBEBOUNDID)
      references USER (USERBEBOUNDID) on delete restrict on update restrict;

alter table USERSURVEY add constraint FK_REFERENCE_10 foreign key (USERBEBOUNDID)
      references USER (USERBEBOUNDID) on delete restrict on update restrict;

alter table USERSURVEY add constraint FK_REFERENCE_11 foreign key (SURVEYID)
      references SURVEY (SURVEYID) on delete restrict on update restrict;

