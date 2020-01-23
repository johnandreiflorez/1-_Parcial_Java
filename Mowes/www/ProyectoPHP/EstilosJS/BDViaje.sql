CREATE TABLE tblTIP_VEH(
	Id_TIP_VEH varchar(10) primary key NOT NULL,
	Descripcion varchar(50) NOT NULL
)


INSERT tblTIP_VEH VALUES ('10', 'Bus ')
INSERT tblTIP_VEH VALUES (N'20', 'Buseta ')
INSERT tblTIP_VEH VALUES (N'30', 'Colectivo ')

CREATE TABLE tblRUTa(
	Id_RUT varchar(10) primary key NOT NULL,
	Descripcion_RUT varchar(50) NULL
)
INSERT tblRUTa VALUES ('MY10', 'Medellin - Yarumal ')
INSERT tblRUTa VALUES ('YM20', 'Yarumal - Medellin ')

CREATE TABLE tblESTado(
	Id_EST int NOT NULL primary key,
	Descripcion varchar(50) NOT NULL
 )
INSERT tblESTado VALUES (1, 'Reserva')
INSERT tblESTado VALUES (2, 'Cancelacion')
INSERT tblESTado VALUES (3, 'Pago')




CREATE TABLE tblCLIente(
	Id_CLI varchar(10) NOT NULL primary key,
	Nombre_CLI varchar(50) NOT NULL,
	Telefono_CLI varchar(10) NOT NULL
)
INSERT tblCLIente VALUES ('10103002', 'Kim Ospina ', '2372480')
INSERT tblCLIente VALUES ('10208258', 'Jhonny Giraldo ', '4562178')
INSERT tblCLIente VALUES ('1020445328', 'Karen Muñoz ', '5967207')

CREATE TABLE tblVEHiculo(
	Id_VEHI varchar(10) NOT NULL primary key,
	Descripcion_VEH varchar(50) NOT NULL,
	Id_TIP_VEH varchar(10) NOT NULL
)


CREATE TABLE tblREServa(
	Id_RES int IDENTITY(1,1) NOT NULL PRIMARY KEY,
	Id_VIAje_RES int NOT NULL,
	Id_CLIente_RES varchar(10) NOT NULL,
	Cantidad_RES int NOT NULL,
	Id_ESTado_RES int NOT NULL
)

CREATE TABLE tblVIAJe(
	Id_VIAJ int NOT NULL,
	Id_RUT_VIAJ varchar(10) NOT NULL,
	Id_VEH_VIAJ varchar(10) NOT NULL,
	Fecha_VIAJ date NOT NULL,
	Hora_VIAJ time(0) NOT NULL
)


ALTER TABLE tblVEHiculo  ADD FOREIGN KEY(Id_TIP_VEH)
REFERENCES tblTIP_VEH (Id_TIP_VEH)


ALTER TABLE tblVIAJe  ADD FOREIGN KEY(Id_RUT_VIAJ)
REFERENCES tblRUTa (Id_RUT)


ALTER TABLE tblVIAJe ADD FOREIGN KEY(Id_VEH_VIAJ)
REFERENCES tblVEHiculo (Id_VEHI)

/****** Object:  ForeignKey [FK__tblREServ__Id_VI__4F7CD00D]    Script Date: 06/07/2012 14:01:25 ******/
ALTER TABLE tblREServa ADD FOREIGN KEY(Id_VIAje_RES)
REFERENCES tblVIAJe (Id_VIAJ)

/****** Object:  ForeignKey [FK_tblREServa_tblCLIente]    Script Date: 06/07/2012 14:01:25 ******/
ALTER TABLE tblREServa  ADD FOREIGN KEY(Id_CLIente_RES)
REFERENCES tblCLIente(Id_CLI)

/****** Object:  ForeignKey [FK_tblREServa_tblESTado]    Script Date: 06/07/2012 14:01:25 ******/
ALTER TABLE tblREServa ADD FOREIGN KEY(Id_ESTado_RES)
REFERENCES tblESTado(Id_EST)
