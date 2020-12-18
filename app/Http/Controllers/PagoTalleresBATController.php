<?php
date_default_timezone_set("America/Mexico_City");

Class PagoTalleresBATController
{
	private $PDO;
    public $env;

    public function __construct(){
        $this->env = parse_ini_file(dirname(__FILE__)."\..\..\..\.env");
    }

	public function generate_report()
	{
		$day = date("d");
		$year = date("Y");
        $month = date("m");

        switch ($month)
        {
            case '01':
                $month = 1;
                break;

            case '02':
                $month = 2;
                break;

            case '03':
                $month = 3;
                break;

            case '04':
                $month = 4;
                break;

            case '05':
                $month = 5;
                break;

            case '06':
                $month = 6;
                break;

            case '07':
                $month = 7;
                break;

            case '08':
                $month = 8;
                break;

            case '09':
                $month = 9;
                break;

            default:
                # code...
                break;
        }

        if($day == '01')
        {
        	if($month == '01')
        	{
        		$year = $year - 1;
        		$month = '12';
        	}
        	else
        	{
        		$month = $month - 1;
        	}
        }

        $table = $year."_".$month."_claims_aprobados";
       	$this->PDO = $this->conn_pdo();

        try
        {
           $query_txt = "
                    SELECT distinct (".$table.".claim),
                    UPPER(DATE_FORMAT(".$table.".claim_app_date,'%M')) AS MES,
                    DATE_FORMAT(".$table.".claim_app_date,'%c') AS MESNUM,
                    ".$table.".clasificacion,
                    ".$table.".dispatch,
                    ".$table.".total_approved_parts,
                    ".$table.".total_approved_claim_amount,
                    ".$table.".reference,
                    ".$table.".taller,
                    talleres.nombre,
                    talleres.ciudad,
                    talleres.subzona,
                    talleres.estado,
                    talleres.estado,
                    ".$table.".service_req_date,
                    ".$table.".serv_complete_date,
                    ".$table.".service_code,
                    ".$table.".modelo,
                    ".$table.".serie,
                    ".$table.".marca,
                   IF(".$table.".repeat_repair='SI','W',
                        IF(".$table.".extra_status='706','CNX',
                            IF(".$table.".extra_status='704','CNX',
                                IF(".$table.".extra_status='703','CNX',
                                    IF(".$table.".clasificacion='CONEXION','X',
                                        IF(".$table.".clasificacion='ENTREGA POLIZA' OR ".$table.".clasificacion='EXTENDED WARRANTIES','P',
                                            IF(".$table.".clasificacion='NEG RENTABLE','C','G')
                                        )
                                    )
                                )
                            )
                        )
                    )   AS IDWARRTYPE,
                    IF(".$table.".extra_status='702','Y','N') AS UTB,
                    IF(".$table.".clasificacion='ATT A DISTRIBUIDOR','Y','N') AS DISTRIBUIDOR,
                    IF(".$table.".extra_status='714','Y','N') AS PEX,
                    ".$table.".fecha_compra,
                    ".$table.".muebleria,
                    ".$table.".repeat_repair,
                    IF(pex_acp.cc ='', talleres.cc, if(pex_acp.cc is null,talleres.cc,pex_acp.cc )) as cc,
                    IF(talleres.tipo LIKE 'MODU%','INTERNO','EXTERNO') AS tipo,
                    ".$table.".tipo_servicio as tipo_servicio
                    FROM
                    ".$table."
                    LEFT JOIN talleres ON ".$table.".taller = talleres.taller
                    LEFT JOIN zonas ON talleres.zona = zonas.id
                    LEFT JOIN pex_acp ON ".$table.".dispatch = pex_acp.dispatch
                    GROUP BY claim";

            $QUERY_SLCT = $this->PDO->prepare($query_txt);
            $QUERY_SLCT->execute();

            if($QUERY_SLCT->rowCount() > 0)
            {
                $result = $QUERY_SLCT->fetchAll(PDO::FETCH_ASSOC);

                if($this->create_file($result, 'Reporte-ts-'.$year."-".$month))
                {
                	$this->set_log("bat_process", date("Y-m-d H:i:s"), 'Reporte-ts-'.$year."-".$month, $table, $QUERY_SLCT->rowCount(), $month);
                }
            }

        }
        catch(PDOException $e)
        {
            exit(); // exit("SLCT Claims ".$e->getMessage());
        }
	}

	//Conn PDO
    public function conn_pdo()
    {        
        
        $db_host = $this->env['DB_HOST'];
        $db_port = $this->env['DB_PORT'];
        $db_name = $this->env['DB_DATABASE'];
        $db_user = $this->env['DB_USERNAME'];
        $db_pass = $this->env['DB_PASSWORD'];

        $dbh =  new PDO('mysql:host=' . $db_host . ';port=' . $db_port . ';dbname=' . $db_name,
                         $db_user,
                         $db_pass,
                         array(PDO::ATTR_PERSISTENT => false, PDO::MYSQL_ATTR_LOCAL_INFILE => 1, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')
                         );
        return $dbh;
    }

    public function create_file($result, $file_name)
    {
        $valid = false;
        $fp = fopen($this->env['PAGO_A_TALLERES_PATH'].$file_name.'.csv', 'w');

        $final_data = "MES , MESNUM , TIPOSERVICIO , DISPATCH , TOTALPARTS_PRORRATEO , TOTALLABOR_PRORRATEO , REFERENCENUM , NUMTALLER , NOMBRETALLER , CIUDAD , REGION , CABECERA , ESTADO , FECHAOS , FECHACOMPLETADO , CODIGODEFECTO , MODELO , MARCA , LINEA , CODPLANTA , PLANTA , IDWARRANTYTYPE , UTB , DISTRIBUIDOR , PEX , DPURCHASEDATE , SCLAIMNUM , MUEBLERIA , GARSAW , CC , TIPO , ZONA , TIPODEPAGO \n";

        foreach ($result as $result)
        {
            //sacamos los codigos de planta
            $id_planta = $result['serie'];
            $id_planta = str_replace("0", "", $id_planta);
            $id_planta = str_replace("1", "", $id_planta);
            $id_planta = str_replace("2", "", $id_planta);
            $id_planta = str_replace("3", "", $id_planta);
            $id_planta = str_replace("4", "", $id_planta);
            $id_planta = str_replace("5", "", $id_planta);
            $id_planta = str_replace("6", "", $id_planta);
            $id_planta = str_replace("7", "", $id_planta);
            $id_planta = str_replace("8", "", $id_planta);
            $id_planta = str_replace("9", "", $id_planta);

            $n_char_id_planta = strlen($id_planta);

            if($n_char_id_planta == 3)
            {
                $id_planta = substr($id_planta, 0, -1);
            }

            $this->PDO = $this->conn_pdo();

            try
            {
                $query_txt = "SELECT * FROM ts_plantas_inf WHERE id_planta = '".$id_planta."'";
                $QUERY_SLCT = $this->PDO->prepare($query_txt);
                $QUERY_SLCT->execute();

                if($QUERY_SLCT->rowCount() > 0)
                {
                    $result_plnt = $QUERY_SLCT->fetchAll(PDO::FETCH_ASSOC);
                }
                else
                {
                    $result_plnt[0]['id_planta'] = "";
                    $result_plnt[0]['planta'] = "";
                    $result_plnt[0]['linea_producto'] = "";
                }
            }
            catch(PDOException $e)
            {
                exit(); // exit("SLCT plantas_inf ".$e->getMessage());
            }


            $final_data .=
            $this->clean_string($result['MES']).",".
            $this->clean_string($result['MESNUM']).",".
            $this->clean_string($result['clasificacion']).",".
            $this->clean_string($result['dispatch']).",".
            $this->clean_string($result['total_approved_parts']).",".
            $this->clean_string($result['total_approved_claim_amount']).",".
            $this->clean_string($result['reference']).",".
            $this->clean_string($result['taller']).",".
            $this->clean_string($result['nombre']).",".
            $this->clean_string($result['ciudad']).",".
            $this->clean_string($result['subzona']).",".
            $this->clean_string($result['estado']).",".
            $this->clean_string($result['estado']).",".
            $this->clean_string($result['service_req_date']).",".
            $this->clean_string($result['serv_complete_date']).",".
            $this->clean_string($result['service_code']).",".
            $this->clean_string($result['modelo']).",".
            $this->clean_string($result['marca']).",".
            $this->clean_string($result_plnt[0]['linea_producto']).",".
            $this->clean_string($result_plnt[0]['id_planta']).",".
            $this->clean_string($result_plnt[0]['planta']).",".
            $this->clean_string($result['IDWARRTYPE']).",".
            $this->clean_string($result['UTB']).",".
            $this->clean_string($result['DISTRIBUIDOR']).",".
            $this->clean_string($result['PEX']).",".
            $this->clean_string($result['fecha_compra']).",".
            $this->clean_string($result['claim']).",".
            $this->clean_string($result['muebleria']).",".
            $this->clean_string($result['repeat_repair']).",".
            $this->clean_string($result['cc']).",".
            $this->clean_string($result['tipo']).",,".
            $this->clean_string($result['tipo_servicio'])." \n ";
        }

        if(fwrite($fp, $final_data.PHP_EOL))
        {
            $valid = true;
        }

        fclose($fp);

        return $valid;
    }

    public function set_log($username, $date, $label_name, $table, $total_reg, $month)
    {
    	$this->PDO = $this->conn_pdo();

        try
        {
           	$query_txt = "SELECT report_table FROM claims_reports WHERE report_table = '".$table."'";
	        $QUERY_SLCT = $this->PDO->prepare($query_txt);
	        $QUERY_SLCT->execute();

            if($QUERY_SLCT->rowCount() > 0)
            {
                $query = "UPDATE claims_reports SET report_n_reg = :report_n_reg, updated_at = :updated_at WHERE report_table = :report_table";
				$update = $this->PDO->prepare($query);
				$update->bindParam(':report_n_reg', $total_reg);
				$update->bindParam(':updated_at', $date);
				$update->bindParam(':report_table', $table);
				$update->execute();
            }
            else
            {
            	switch ($month)
            	{
            		case '01':
            			$month_name = 'Enero';
            			break;

            		case '02':
            			$month_name = 'Febrero';
            			break;

            		case '03':
            			$month_name = 'Marzo';
            			break;

            		case '04':
            			$month_name = 'Abril';
            			break;

            		case '05':
            			$month_name = 'Mayo';
            			break;

            		case '06':
            			$month_name = 'Junio';
            			break;

            		case '07':
            			$month_name = 'Julio';
            			break;

            		case '08':
            			$month_name = 'Agosto';
            			break;

            		case '09':
            			$month_name = 'Septiembre';
            			break;

            		case '10':
            			$month_name = 'Octubre';
            			break;

            		case '11':
            			$month_name = 'Noviembre';
            			break;

            		case '12':
            			$month_name = 'Diciembre';
            			break;

            		default:
            			# code...
            			break;
            	}

	    		$query = "INSERT INTO claims_reports
									(report_table,
									report_label_name,
									report_n_reg,
									month,
									user,
									created_at,
									updated_at)
									VALUES
									(:report_table,
									:report_label_name,
									:report_n_reg,
									:month,
									:user,
									:created_at,
									:updated_at)";
				$insert = $this->PDO->prepare($query);
				$insert->bindParam(':report_table', $table);
				$insert->bindParam(':report_label_name', $label_name);
				$insert->bindParam(':report_n_reg', $total_reg);
				$insert->bindParam(':month', $month_name);
				$insert->bindParam(':user', $username);
				$insert->bindParam(':created_at', $date);
				$insert->bindParam(':updated_at', $date);
				$insert->execute();
            }

        }
        catch(PDOException $e)
        {
            report($e);
        }
    }

    public function clean_string($string)
    {
        return trim(strip_tags($string));
    }
}

$PagoTalleresBATController = new PagoTalleresBATController;
$PagoTalleresBATController->generate_report();
?>
