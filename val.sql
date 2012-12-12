LOCK TABLES `GbIden` WRITE;
INSERT INTO `GbIden` VALUES (1,'NULL','NULL');
UNLOCK TABLES;

LOCK TABLES `GbCnae` WRITE;
INSERT INTO `GbCnae` VALUES (1,'0000','NULL','NULL');
UNLOCK TABLES;

LOCK TABLES `GbPais` WRITE;
INSERT INTO `GbPais` VALUES (1,'000','SYSTEM');
UNLOCK TABLES;

LOCK TABLES `GbDepa` WRITE;
INSERT INTO `GbDepa` VALUES (1,1,'00','SYSTEM');
UNLOCK TABLES;

LOCK TABLES `GbCiud` WRITE;
INSERT INTO `GbCiud` VALUES (1,1,'00000','SYSTEM');
UNLOCK TABLES;

LOCK TABLES `GbCarg` WRITE;
INSERT INTO `GbCarg` VALUES (1,'SYSTEM ADMIN');
UNLOCK TABLES;

LOCK TABLES `GbEmpr` WRITE;
INSERT INTO `GbEmpr` VALUES (1,'0000',1,1,'','SYSTEM','NULL','NULL','NULL');
UNLOCK TABLES;

LOCK TABLES `GbSucu` WRITE;
INSERT INTO `GbSucu` VALUES (1,1,1,'SYSTEM','NULL','NULL','NULL','NULL','NULL','NULL');
UNLOCK TABLES;

LOCK TABLES `GbPers` WRITE;
INSERT INTO `GbPers` VALUES (1,1,1,1,'0000','SYSTEM',NULL,'ADMIN',NULL,'1970-01-01','NULL','NULL','NULL',1,NULL,'1970-01-01',0,'A');
UNLOCK TABLES;

LOCK TABLES `GbUsua` WRITE;
INSERT INTO `GbUsua` VALUES (1,1,'root','wg1HV7zlQXAkgYpMBDyviLg9jGo2eb5KuASDH0j9+pP3v9ex3lUTbf6J36lcJvxsThuE6F581+R8eiCBn1EFig==');
UNLOCK TABLES;

LOCK TABLES `GbVars` WRITE;
INSERT INTO `GbVars` VALUES (1, 'M', 'msdic', 'ctcont=>Contratos|-|asprot=>Asistente De Protocolos|-|index=>Ingresar|-|show=>Ver|-|new=>Nuevo|-|create=>Guardar|-|edit=>Editar|-|update=>Actualizar|-|delete=>Eliminar|-|load=>Cargar|-|delproto=>Eliminar Protocolo|-|delexamen=>Borrar Examen|-|savexamen=>Guardar Examen|-|getexamen=>Obtener Examen|-|delrespuesta=>Borrar Respuesta|-|savrespuesta=>Guardar Respuesta|-|getpregunta=>Obtener Respuesta|-|getprotocolo=>Obtener Protocolo|-|deldiagnostico=>Borrar Diagnostico|-|getdiagnostico=>Obtener Diagnostico|-|newdiagnostico=>Nuevo Diagnostico|-|getpatologia=>Obtener Patologia|-|newcomentario=>Nuevo Comentario|-|newhistoria=>Nueva Historia|-|getruta=>Obtener Ruta|-|getpaciente=>Obtener Paciente');
INSERT INTO `GbVars` VALUES (2,'S','asprot','Asistente De Protocolos|-|*|-|asprot/index|:|asprot/getpuesto|:|asprot/newpuesto|:|asprot/newprotocolo|:|asprot/getques|:|asprot/delques|:|asprot/addques|:|asprot/getproceso|:|asprot/addproto|:|asprot/delproto');
INSERT INTO `GbVars` VALUES (3,'S','assecu','Asistente De Seguridad|-|*|-|assecu/index|:|assecu/addcargo|:|assecu/addusua|:|assecu/getcargo|:|assecu/getpers|:|assecu/getusua|:|assecu/getact|:|assecu/addacl|:|assecu/delacl|:|assecu/getacl|:|gbpers/new|:|gbpers/create');
INSERT INTO `GbVars` VALUES (4,'S','asubic','Asistente De Ubicaciones|-|*|-|asubic/index|:|asubic/getprovs|:|asubic/getpaises|:|asubic/addpais|:|asubic/addprov|:|asubic/getciuds|:|asubic/addciud|:|asubic/delciud');
INSERT INTO `GbVars` VALUES (5,'S','asempr','Asistente De Empresas|-|*|-|asempr/index');
INSERT INTO `GbVars` VALUES (6, 'S', 'asmaster', 'Asistente Maestro|-|*|-|asmaster/index|:|asmaster/load|:|asmaster/getpaciente|:|asmaster/getruta|:|asmaster/newhistoria|:|asmaster/newcomentario|:|asmaster/getpatologia|:|asmaster/newdiagnostico|:|asmaster/getdiagnostico|:|asmaster/deldiagnostico|:|asmaster/getprotocolo|:|asmaster/getpregunta|:|asmaster/savrespuesta|:|asmaster/delrespuesta|:|asmaster/getexamen|:|asmaster/savexamen|:|asmaster/delexamen|:|mdpaci/new|:|mdpaci/create|:|mdaudi/show|:|mdaudi/new|:|mdaudi/create|:|mdbiom/show|:|mdbiom/new|:|mdbiom/create|:|mdespi/show|:|mdespi/new|:|mdespi/create|:|mdextr/show|:|mdextr/new|:|mdextr/create|:|mdsist/show|:|mdsist/new|:|mdsist/create|:|mdvisu/show|:|mdvisu/new|:|mdvisu/create');
INSERT INTO `GbVars` VALUES (7,'S','ctcont','Contratos|-|!|-|ctcont/index=>Ingresar|:|ctcont/show=>Ver|:|ctcont/new=>Nuevo|:|ctcont/create=>Guardar|:|ctcont/edit=>Editar|:|ctcont/update=>Actualizar|:|ctcont/delete=>Borrar');
INSERT INTO `GbVars` VALUES (8,'S','ctcoti','Presupuestos|-|!|-|ctcoti/index=>Ingresar|:|ctcoti/show=>Ver|:|ctcoti/new=>Nuevo|:|ctcoti/create=>Guardar|:|ctcoti/edit=>Editar|:|ctcoti/update=>Actualizar|:|ctcoti/delete=>Borrar');
INSERT INTO `GbVars` VALUES (9,'S','ctfact','Facturas|-|!|-|ctfact/index=>Ingresar|:|ctfact/show=>Ver|:|ctfact/new=>Nuevo|:|ctfact/create=>Guardar|:|ctfact/edit=>Editar|:|ctfact/update=>Actualizar|:|ctfact/delete=>Borrar');
INSERT INTO `GbVars` VALUES (10,'S','ctserv','Servicios|-|!|-|ctserv/index=>Ingresar|:|ctserv/show=>Ver|:|ctserv/new=>Nuevo|:|ctserv/create=>Guardar|:|ctserv/edit=>Editar|:|ctserv/update=>Actualizar|:|ctserv/delete=>Borrar');
INSERT INTO `GbVars` VALUES (11,'S','cttari','Tarifas|-|!|-|cttari/index=>Ingresar|:|cttari/show=>Ver|:|cttari/new=>Nuevo|:|cttari/create=>Guardar|:|cttari/edit=>Editar|:|cttari/update=>Actualizar|:|cttari/delete=>Borrar');
INSERT INTO `GbVars` VALUES (12,'S','gbacls','Control de Acceso|-|!|-|gbacls/index=>Ingresar|:|gbacls/show=>Ver|:|gbacls/new=>Nuevo|:|gbacls/create=>Guardar|:|gbacls/edit=>Editar|:|gbacls/update=>Actualizar|:|gbacls/delete=>Borrar');
INSERT INTO `GbVars` VALUES (13,'S','gbcarg','Cargos|-|!|-|gbcarg/index=>Ingresar|:|gbcarg/show=>Ver|:|gbcarg/new=>Nuevo|:|gbcarg/create=>Guardar|:|gbcarg/edit=>Editar|:|gbcarg/update=>Actualizar|:|gbcarg/delete=>Borrar');
INSERT INTO `GbVars` VALUES (14,'S','gbciud','Ciudades|-|!|-|gbciud/index=>Ingresar|:|gbciud/show=>Ver|:|gbciud/new=>Nuevo|:|gbciud/create=>Guardar|:|gbciud/edit=>Editar|:|gbciud/update=>Actualizar|:|gbciud/delete=>Borrar');
INSERT INTO `GbVars` VALUES (15,'S','gbcnae','Actividad Económica|-|!|-|gbcnae/index=>Ingresar|:|gbcnae/show=>Ver|:|gbcnae/new=>Nuevo|:|gbcnae/create=>Guardar|:|gbcnae/edit=>Editar|:|gbcnae/update=>Actualizar|:|gbcnae/delete=>Borrar');
INSERT INTO `GbVars` VALUES (16,'S','gbcorp','Corporaciones|-|!|-|gbcorp/index=>Ingresar|:|gbcorp/show=>Ver|:|gbcorp/new=>Nuevo|:|gbcorp/create=>Guardar|:|gbcorp/edit=>Editar|:|gbcorp/update=>Actualizar|:|gbcorp/delete=>Borrar');
INSERT INTO `GbVars` VALUES (17,'S','gbdepa','Províncias|-|!|-|gbdepa/index=>Ingresar|:|gbdepa/show=>Ver|:|gbdepa/new=>Nuevo|:|gbdepa/create=>Guardar|:|gbdepa/edit=>Editar|:|gbdepa/update=>Actualizar|:|gbdepa/delete=>Borrar');
INSERT INTO `GbVars` VALUES (18,'S','gbempr','Empresas|-|!|-|gbempr/index=>Ingresar|:|gbempr/show=>Ver|:|gbempr/new=>Nuevo|:|gbempr/create=>Guardar|:|gbempr/edit=>Editar|:|gbempr/update=>Actualizar|:|gbempr/delete=>Borrar');
INSERT INTO `GbVars` VALUES (19,'S','gbiden','Identificaciones|-|!|-|gbiden/index=>Ingresar|:|gbiden/show=>Ver|:|gbiden/new=>Nuevo|:|gbiden/create=>Guardar|:|gbiden/edit=>Editar|:|gbiden/update=>Actualizar|:|gbiden/delete=>Borrar');
INSERT INTO `GbVars` VALUES (20,'S','gblogr','Logs|-|!|-|gblogr/index=>Ingresar');
INSERT INTO `GbVars` VALUES (21,'S','gbpais','Países|-|!|-|gbpais/index=>Ingresar|:|gbpais/show=>Ver|:|gbpais/new=>Nuevo|:|gbpais/create=>Guardar|:|gbpais/edit=>Editar|:|gbpais/update=>Actualizar|:|gbpais/delete=>Borrar');
INSERT INTO `GbVars` VALUES (22,'S','gbpers','Personal|-|!|-|gbpers/index=>Ingresar|:|gbpers/show=>Ver|:|gbpers/new=>Nuevo|:|gbpers/create=>Guardar|:|gbpers/edit=>Editar|:|gbpers/update=>Actualizar|:|gbpers/delete=>Borrar');
INSERT INTO `GbVars` VALUES (23,'S','gbptra','Puestos de Trabajo|-|!|-|gbptra/index=>Ingresar|:|gbptra/show=>Ver|:|gbptra/new=>Nuevo|:|gbptra/create=>Guardar|:|gbptra/edit=>Editar|:|gbptra/update=>Actualizar|:|gbptra/delete=>Borrar');
INSERT INTO `GbVars` VALUES (24,'S','gbsucu','Sucursales|-|!|-|gbsucu/index=>Ingresar|:|gbsucu/show=>Ver|:|gbsucu/new=>Nuevo|:|gbsucu/create=>Guardar|:|gbsucu/edit=>Editar|:|gbsucu/update=>Actualizar|:|gbsucu/delete=>Borrar');
INSERT INTO `GbVars` VALUES (25,'S','gbusua','Usuarios|-|!|-|gbusua/index=>Ingresar|:|gbusua/show=>Ver|:|gbusua/new=>Nuevo|:|gbusua/create=>Guardar|:|gbusua/edit=>Editar|:|gbusua/update=>Actualizar|:|gbusua/delete=>Borrar');
INSERT INTO `GbVars` VALUES (26,'S','hsfami','Antecedentes Familiares|-|!|-|hsfami/index=>Ingresar|:|hsfami/show=>Ver|:|hsfami/new=>Nuevo|:|hsfami/create=>Guardar|:|hsfami/edit=>Editar|:|hsfami/update=>Actualizar|:|hsfami/delete=>Borrar');
INSERT INTO `GbVars` VALUES (27,'S','hslabo','Antecedentes Laborales|-|!|-|hslabo/index=>Ingresar|:|hslabo/show=>Ver|:|hslabo/new=>Nuevo|:|hslabo/create=>Guardar|:|hslabo/edit=>Editar|:|hslabo/update=>Actualizar|:|hslabo/delete=>Borrar');
INSERT INTO `GbVars` VALUES (28,'S','hspers','Antecedentes Personales|-|!|-|hspers/index=>Ingresar|:|hspers/show=>Ver|:|hspers/new=>Nuevo|:|hspers/create=>Guardar|:|hspers/edit=>Editar|:|hspers/update=>Actualizar|:|hspers/delete=>Borrar');
INSERT INTO `GbVars` VALUES (29,'S','mdaudi','Audiometrías|-|!|-|mdaudi/index=>Ingresar|:|mdaudi/show=>Ver|:|mdaudi/new=>Nuevo|:|mdaudi/create=>Guardar|:|mdaudi/edit=>Editar|:|mdaudi/update=>Actualizar|:|mdaudi/delete=>Borrar');
INSERT INTO `GbVars` VALUES (30,'S','mdbiom','Biometrías|-|!|-|mdbiom/index=>Ingresar|:|mdbiom/show=>Ver|:|mdbiom/new=>Nuevo|:|mdbiom/create=>Guardar|:|mdbiom/edit=>Editar|:|mdbiom/update=>Actualizar|:|mdbiom/delete=>Borrar');
INSERT INTO `GbVars` VALUES (31,'S','mddiag','Diagnósticos|-|!|-|mddiag/index=>Ingresar|:|mddiag/show=>Ver|:|mddiag/new=>Nuevo|:|mddiag/create=>Guardar|:|mddiag/edit=>Editar|:|mddiag/update=>Actualizar|:|mddiag/delete=>Borrar');
INSERT INTO `GbVars` VALUES (32,'S','mdespi','Espirometrías|-|!|-|mdespi/index=>Ingresar|:|mdespi/show=>Ver|:|mdespi/new=>Nuevo|:|mdespi/create=>Guardar|:|mdespi/edit=>Editar|:|mdespi/update=>Actualizar|:|mdespi/delete=>Borrar');
INSERT INTO `GbVars` VALUES (33,'S','mdexam','Exámenes|-|!|-|mdexam/index=>Ingresar|:|mdexam/show=>Ver|:|mdexam/new=>Nuevo|:|mdexam/create=>Guardar|:|mdexam/edit=>Editar|:|mdexam/update=>Actualizar|:|mdexam/delete=>Borrar');
INSERT INTO `GbVars` VALUES (34,'S','mdextr','Extremidades|-|!|-|mdextr/index=>Ingresar|:|mdextr/show=>Ver|:|mdextr/new=>Nuevo|:|mdextr/create=>Guardar|:|mdextr/edit=>Editar|:|mdextr/update=>Actualizar|:|mdextr/delete=>Borrar');
INSERT INTO `GbVars` VALUES (35,'S','mdhist','Hístorias|-|!|-|mdhist/index=>Ingresar|:|mdhist/show=>Ver|:|mdhist/new=>Nuevo|:|mdhist/create=>Guardar|:|mdhist/edit=>Editar|:|mdhist/update=>Actualizar|:|mdhist/delete=>Borrar');
INSERT INTO `GbVars` VALUES (36,'S','mdlabo','Ordenes de Laboratorio|-|!|-|mdlabo/index=>Ingresar|:|mdlabo/show=>Ver|:|mdlabo/new=>Nuevo|:|mdlabo/create=>Guardar|:|mdlabo/edit=>Editar|:|mdlabo/update=>Actualizar|:|mdlabo/delete=>Borrar');
INSERT INTO `GbVars` VALUES (37,'S','mdpaci','Pacientes|-|!|-|mdpaci/index=>Ingresar|:|mdpaci/show=>Ver|:|mdpaci/new=>Nuevo|:|mdpaci/create=>Guardar|:|mdpaci/edit=>Editar|:|mdpaci/update=>Actualizar|:|mdpaci/delete=>Borrar');
INSERT INTO `GbVars` VALUES (38,'S','mdpato','Patologías|-|!|-|mdpato/index=>Ingresar|:|mdpato/show=>Ver|:|mdpato/new=>Nuevo|:|mdpato/create=>Guardar|:|mdpato/edit=>Editar|:|mdpato/update=>Actualizar|:|mdpato/delete=>Borrar');
INSERT INTO `GbVars` VALUES (39,'S','mdproc','Procedimientos|-|!|-|mdproc/index=>Ingresar|:|mdproc/show=>Ver|:|mdproc/new=>Nuevo|:|mdproc/create=>Guardar|:|mdproc/edit=>Editar|:|mdproc/update=>Actualizar|:|mdproc/delete=>Borrar');
INSERT INTO `GbVars` VALUES (40,'S','mdprot','Protocolos|-|!|-|mdprot/index=>Ingresar|:|mdprot/show=>Ver|:|mdprot/new=>Nuevo|:|mdprot/create=>Guardar|:|mdprot/edit=>Editar|:|mdprot/update=>Actualizar|:|mdprot/delete=>Borrar');
INSERT INTO `GbVars` VALUES (41,'S','mdques','Preguntas|-|!|-|mdques/index=>Ingresar|:|mdques/show=>Ver|:|mdques/new=>Nuevo|:|mdques/create=>Guardar|:|mdques/edit=>Editar|:|mdques/update=>Actualizar|:|mdques/delete=>Borrar');
INSERT INTO `GbVars` VALUES (42,'S','mdresp','Respuestas|-|!|-|mdresp/index=>Ingresar|:|mdresp/show=>Ver|:|mdresp/new=>Nuevo|:|mdresp/create=>Guardar|:|mdresp/edit=>Editar|:|mdresp/update=>Actualizar|:|mdresp/delete=>Borrar');
INSERT INTO `GbVars` VALUES (43,'S','mdsist','Revisión Sistemas|-|!|-|mdsist/index=>Ingresar|:|mdsist/show=>Ver|:|mdsist/new=>Nuevo|:|mdsist/create=>Guardar|:|mdsist/edit=>Editar|:|mdsist/update=>Actualizar|:|mdsist/delete=>Borrar');
INSERT INTO `GbVars` VALUES (44,'S','mdvisu','Agudeza Visual|-|!|-|mdvisu/index=>Ingresar|:|mdvisu/show=>Ver|:|mdvisu/new=>Nuevo|:|mdvisu/create=>Guardar|:|mdvisu/edit=>Editar|:|mdvisu/update=>Actualizar|:|mdvisu/delete=>Borrar');
INSERT INTO `GbVars` VALUES (45,'S','tcaspe','Aspectos Técnicos|-|!|-|tcaspe/index=>Ingresar|:|tcaspe/show=>Ver|:|tcaspe/new=>Nuevo|:|tcaspe/create=>Guardar|:|tcaspe/edit=>Editar|:|tcaspe/update=>Actualizar|:|tcaspe/delete=>Borrar');
INSERT INTO `GbVars` VALUES (46,'S','tccapa','Capacitaciones|-|!|-|tccapa/index=>Ingresar|:|tccapa/show=>Ver|:|tccapa/new=>Nuevo|:|tccapa/create=>Guardar|:|tccapa/edit=>Editar|:|tccapa/update=>Actualizar|:|tccapa/delete=>Borrar');
INSERT INTO `GbVars` VALUES (47,'S','tcchec','Lista de Chequeo|-|!|-|tcchec/index=>Ingresar|:|tcchec/show=>Ver|:|tcchec/new=>Nuevo|:|tcchec/create=>Guardar|:|tcchec/edit=>Editar|:|tcchec/update=>Actualizar|:|tcchec/delete=>Borrar');
INSERT INTO `GbVars` VALUES (48,'S','tccurs','Cursos|-|!|-|tccurs/index=>Ingresar|:|tccurs/show=>Ver|:|tccurs/new=>Nuevo|:|tccurs/create=>Guardar|:|tccurs/edit=>Editar|:|tccurs/update=>Actualizar|:|tccurs/delete=>Borrar');
INSERT INTO `GbVars` VALUES (49,'S','tcdeta','Detalles|-|!|-|tcdeta/index=>Ingresar|:|tcdeta/show=>Ver|:|tcdeta/new=>Nuevo|:|tcdeta/create=>Guardar|:|tcdeta/edit=>Editar|:|tcdeta/update=>Actualizar|:|tcdeta/delete=>Borrar');
INSERT INTO `GbVars` VALUES (50,'S','tcrevi','Revisión Técnica|-|!|-|tcrevi/index=>Ingresar|:|tcrevi/show=>Ver|:|tcrevi/new=>Nuevo|:|tcrevi/create=>Guardar|:|tcrevi/edit=>Editar|:|tcrevi/update=>Actualizar|:|tcrevi/delete=>Borrar');
INSERT INTO `GbVars` VALUES (51,'S','tcruta','Hoja de Ruta|-|!|-|tcruta/index=>Ingresar|:|tcruta/show=>Ver|:|tcruta/new=>Nuevo|:|tcruta/create=>Guardar|:|tcruta/edit=>Editar|:|tcruta/update=>Actualizar|:|tcruta/delete=>Borrar');
UNLOCK TABLES;
