<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once('tcpdf.php');
require 'NumerosEnLetras.php';
class Programas extends CI_Controller{
    function index(){
        if ($_SESSION['idusuario']==""){
            header('Location: '.base_url());
        }
        $data['title']='Controlar Programas';
        $this->load->View('templates/header',$data);
        $this->load->View('programas',$data);
        $data['js']="";
        $this->load->View('templates/footer',$data);
    }
    function subirarchivo($idprograma,$status){
        if ($status==1){
            $this->db->query("UPDATE programa SET subirarchivo='1' WHERE idprograma='$idprograma'");
        }else{
            $this->db->query("UPDATE programa SET subirarchivo='0' WHERE idprograma='$idprograma'");
        }
        header("Location: ".base_url()."Programas");
    }
    function insert(){
        echo json_encode($_POST);
        $nombre=$_POST['nombre'];
        $version=$_POST['version'];
        $costo=$_POST['costo'];
        $this->db->query("INSERT INTO programa SET nombre='$nombre', version='$version', costo='$costo'");
        $idprograma=$this->db->insert_id();
        for ($i=1;$i<100;$i++){
            if (isset($_POST['Cuota'.$i])){
                $cuota=$_POST['Cuota'.$i];
                $nombre='CUOTA '.($i);
                $sql="INSERT INTO tipopago SET idprograma='$idprograma', nombre='$nombre', monto='$cuota'";
                $this->db->query($sql);
            }
        }
        header("Location: ".base_url()."Programas");
    }
    function archivo($id){
        header('Content-Type: application/pdf');
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetTitle('CERTIFICADO DE CALIFICACIONES');
//        $pdf->SetCreator(PDF_CREATOR);
//        $pdf->SetAuthor('Nicola Asuni');
//        $pdf->SetTitle('TCPDF Example 002');
//        $pdf->SetSubject('TCPDF Tutorial');
//        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');

        $query = $this->db->query("SELECT max(fechainicio) as fechainicio, max(fechafin) as fechafin
FROM programa INNER JOIN modulo ON programa.idprograma=modulo.idprograma
WHERE programa.idprograma='$id'");
        $fechaInicio=$query->row()->fechainicio;
        $fechaFin=$query->row()->fechafin;

        $query=$this->db->query("SELECT nombres,nombre,paterno,materno,e.idestudiante  FROM estudiante e
INNER JOIN estudianteprograma ep ON ep.idestudiante=e.idestudiante
INNER JOIN programa p ON p.idprograma=ep.idprograma
INNER JOIN persona pe ON e.idpersona=pe.idpersona
WHERE p.idprograma='$id'
ORDER BY paterno,materno,nombres
");
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);


        foreach ($query->result() as $row){
            $pdf->AddPage();
            $this->header($pdf);
            $pdf->Text(0, 18, "CERTIFICADO DE CALIFICACIONES", 0, 0, true, 0, 0, 'C');
            $pdf->SetFont('times', 'B', 8);
            $pdf->Text(15,28 , "NOMBRES Y APELLIDOS: $row->nombres $row->paterno $row->materno", 0, 0, true,0,0,'L');
            $pdf->Text(150,28 , "N: ", 0, 0, true,0,0,'L');
            $pdf->SetFillColor(255, 255, 255);
            $pdf->MultiCell(1, 5, "PROGRAMA: $row->nombre", 0, 'L');
            $txt = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.';
//            $pdf->SetFillColor(255, 255, 127);
            $pdf->MultiCell(15, 5, "", 0, 'L', 1, 0, '', '', true);
            $pdf->MultiCell(180, 5, "PROGRAMA: $row->nombre", 0, 'L', 1, 0, '', '', true);

            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
            $pdf->Ln();
//            fecha del primer modulo
//            $pdf->Text(15,32 , "FECHA DE INICIO: ", 0, 0, true,0,0,'L');
//            $pdf->Text(60,32 , "$fechaInicio", 0, 0, true,0,0,'L');
//            $pdf->Text(120,32 , "FECHA DE FIN: ", 0, 0, true,0,0,'L');
//            $pdf->Text(160,32 , "$fechaFin", 0, 0, true,0,0,'L');

            $pdf->Text(15,37 , "FECHA INICIO ".$fechaInicio, 0, 0, true,0,0,'L');
            $pdf->Text(83,37 , "", 0, 0, true,0,0,'L');
            $pdf->Text(155,37 , "FECHA FIN ".$fechaFin, 0, 0, true,0,0,'L');
            $pdf->Ln();
            $pdf->Cell(15,5 , "", 0, 0, 'C');
            $pdf->Cell(120,5 , "MODULOS ", 1, 0, 'C');
            $pdf->Cell(60,5 , "CALIFICACIONES ", 1, 0, 'C');
            $pdf->Cell(15,5 , "", 0, 0, 'C');
            $pdf->Ln();
            $pdf->Cell(15,5 , "", 0, 0, 'C');
            $pdf->Cell(10,5 , "SIGLA ", 1, 0, 'C');
            $pdf->Cell(90,5 , "NOMBRE ", 1, 0, 'C');
            $pdf->Cell(20,5 , "FEC. APROBA. ", 1, 0, 'C');
            $pdf->Cell(10,5 , "NÚM ", 1, 0, 'C');
            $pdf->Cell(50,5 , "LITERAL ", 1, 0, 'C');
            $pdf->Cell(15,5 , "", 0, 0, 'C');
            $query2=$this->db->query("SELECT idmodulo,m.nombre,m.codigo FROM modulo m INNER JOIN programa p ON m.idprograma=p.idprograma where p.idprograma='$id'");
            $pdf->SetFont('times', '', 8);
            $idestudiante=$row->idestudiante;
            foreach ($query2->result() as $row2){
                $idmodulo=$row2->idmodulo;
                $query3=$this->db->query("SELECT * FROM estudiantemodulo WHERE idestudiante='$idestudiante' AND  idmodulo='$idmodulo'");
                if ($query3->num_rows()>0){
                    $nota=$query3->row()->nota;

                    $fechaAprovacion=$query3->row()->fechaAprovacion;
                    //sacar primero 10 caracteres
                    $fechaAprovacion=substr($fechaAprovacion,0,10);
                }else{
                    $nota=0;
                    $fechaAprovacion="";
                }
                $pdf->Ln();
                $pdf->Cell(15,5 , "", 0, 0, 'C');
                $pdf->Cell(10,5 , "$row2->codigo", 1, 0, 'C');
                $pdf->Cell(90,5 , " $row2->nombre", 1, 0, 'L');
                $pdf->Cell(20,5 , "$fechaAprovacion", 1, 0, 'L');
                $pdf->Cell(10,5 , " $nota", 1, 0, 'C');
                $pdf->Cell(50,5 , NumerosEnLetras::convertir($nota), 1, 0, 'C');
                $pdf->Cell(15,5 , "", 0, 0, 'C');
            }

        }


        $pdf->Output('example_002.pdf', 'I');

    }
    function lista($id){
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//        $pdf->SetCreator(PDF_CREATOR);
//        $pdf->SetAuthor('Nicola Asuni');
//        $pdf->SetTitle('TCPDF Example 002');
//        $pdf->SetSubject('TCPDF Tutorial');
//        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetTitle('ESTUDIANTES REGISTRADOS');
        $estudiantes=$this->db->query("SELECT nombres,nombre,paterno,materno,e.idestudiante,pe.ci,pe.celular,pe.email  FROM estudiante e
INNER JOIN estudianteprograma ep ON ep.idestudiante=e.idestudiante
INNER JOIN programa p ON p.idprograma=ep.idprograma
INNER JOIN persona pe ON e.idpersona=pe.idpersona
WHERE p.idprograma='$id'
ORDER BY paterno,materno,nombres
");
        $programa=$this->db->query("SELECT * FROM programa WHERE idprograma='$id'")->row();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $this->header($pdf);

        // Configura el padding de las celdas
//        $pdf->SetCellPadding(2); // Puedes ajustar este valor según sea necesario

        $pdf->Text(0, 18, "ESTUDIANTES REGISTRADOS", 0, 0, true, 0, 0, 'C');
        $pdf->SetFont('times', 'B', 8);
        $pdf->Text(10,28 , "PROGRAMA:", 0, 0, true,0,0,'L');
        $pdf->SetFont('times', '', 8);
        $pdf->Text(30,28 , "$programa->nombre", 0, 0, true,0,0,'L');
        $pdf->SetFont('times', 'B', 8);
        $pdf->Text(15,32 , "VERSIÓN: $programa->version   GESTIÓN:".date('Y'), 0, 0, true,0,0,'L');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->Cell(15,5 , "", 0, 0, 'C');
        $pdf->Cell(5,5 , "#", 1, 0, 'C');
        $pdf->Cell(85,5 , "NOMBRE COMPLETO", 1, 0, 'C');
//        $pdf->Cell(70,5 , "APELLIDOS ", 1, 0, 'C');
        $pdf->Cell(25,5 , "CI / DNI", 1, 0, 'C');
        $pdf->Cell(25,5 , "TELEFONO ", 1, 0, 'C');
        $pdf->Cell(45 ,5 , "EMAIL", 1, 0, 'C');
        $pdf->Cell(15,5 , "", 0, 0, 'C');
        $pdf->SetFont('times', '', 8);
        $con=0;
        foreach ($estudiantes->result() as $row){
            $con++;
            $pdf->Ln();
            if ($con==46){
                $pdf->AddPage();
                $this->header($pdf);
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->Ln();
                $pdf->SetFont('times', '', 8);
            }
            $pdf->Cell(15,5 , "", 0, 0, 'C');
            $pdf->Cell(5,5 , "$con", 1, 0, 'C');
            $pdf->Cell(85,5 , "$row->paterno $row->materno $row->nombres", 1, 0, 'L');
            $pdf->Cell(25,5 , "$row->ci", 1, 0, 'L');
            $pdf->Cell(25,5 , "$row->celular", 1, 0, 'L');
            $pdf->Cell(45,5 , "$row->email", 1, 0, 'L');
            $pdf->Cell(15,5 , "", 0, 0, 'C');
        }

        $pdf->Output('example_002.pdf', 'I');

    }
    function listaNotas($idprograma,$idmodulo){
        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
//        $pdf->SetCreator(PDF_CREATOR);
//        $pdf->SetAuthor('Nicola Asuni');
//        $pdf->SetTitle('TCPDF Example 002');
//        $pdf->SetSubject('TCPDF Tutorial');
//        $pdf->SetKeywords('TCPDF, PDF, example, test, guide');
        $pdf->SetTitle('ESTUDIANTES REGISTRADOS');
        $estudiantes=$this->db->query("SELECT nombres,nombre,paterno,materno,e.idestudiante,pe.ci,pe.celular,pe.email  FROM estudiante e
INNER JOIN estudianteprograma ep ON ep.idestudiante=e.idestudiante
INNER JOIN programa p ON p.idprograma=ep.idprograma
INNER JOIN persona pe ON e.idpersona=pe.idpersona
WHERE p.idprograma='$idprograma'
ORDER BY paterno,materno,nombres
");
        $programa=$this->db->query("SELECT * FROM programa WHERE idprograma='$idprograma'")->row();
        $modulo = $this->db->query("SELECT * FROM modulo WHERE idmodulo='$idmodulo'")->row();
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->AddPage();
        $this->header($pdf);
        $pdf->Text(0, 18, "ESTUDIANTES REGISTRADOS", 0, 0, true, 0, 0, 'C');
        $pdf->SetFont('times', 'B', 10);
        $pdf->Text(10,28 , "PROGRAMA:", 0, 0, true,0,0,'L');
        $pdf->SetFont('times', '', 10);
        $pdf->Text(35,28 , "$programa->nombre", 0, 0, true,0,0,'L');
        $pdf->SetFont('times', 'B', 10);
        $pdf->Text(15,32 , "MÓDULO:", 0, 0, true,0,0,'L');
        $pdf->SetFont('times', '', 10);
        $pdf->Text(35,32 , "$modulo->nombre", 0, 0, true,0,0,'L');
        $pdf->Ln();
        $pdf->Ln();
        $pdf->SetFont('times', 'B', 10);
        $pdf->Cell(15,5 , "", 0, 0, 'C');
        $pdf->Cell(10,5 , "#", 1, 0, 'C');
        $pdf->Cell(80,5 , "NOMBRE COMPLETO", 1, 0, 'C');
        $pdf->Cell(25,5 , "CI / DNI", 1, 0, 'C');
//        $pdf->Cell(25,5 , "TELEFONO ", 1, 0, 'C');
        $pdf->Cell(50 ,5 , "EMAIL", 1, 0, 'C');
        //notas cell
        $pdf->Cell(15 ,5 , "NOTAS", 1, 0, 'C');
        $pdf->Cell(15,5 , "", 0, 0, 'C');
        $pdf->SetFont('times', '', 10);
        $cont=0;
        foreach ($estudiantes->result() as $row){
            $notaModulo = $this->db->query("SELECT * FROM estudiantemodulo WHERE idestudiante='$row->idestudiante' AND idmodulo='$modulo->idmodulo'")->row();
            $nota = isset($notaModulo->nota)?$notaModulo->nota:0;
            $cont++;
            $pdf->Ln();
            $pdf->Cell(15,5 , "", 0, 0, 'C');
            $pdf->Cell(10,5 , "$cont", 1, 0, 'C');
            $pdf->Cell(80,5 , "$row->paterno $row->materno $row->nombres", 1, 0, 'L');
            $pdf->Cell(25,5 , "$row->ci", 1, 0, 'L');
            $pdf->Cell(50,5 , "$row->email", 1, 0, 'L');
            $pdf->Cell(15 ,5 , "$nota", 1, 0, 'C');
            $pdf->Cell(15,5 , "", 0, 0, 'C');
        }

        $pdf->Output('example_002.pdf', 'I');

    }
    function update(){
        $idprograma=$_POST['idprograma'];
        $nombre=$_POST['nombre'];
        $version=$_POST['version'];
        $costo=$_POST['costo'];
        $estado=$_POST['estado'];
        $query = $this->db->query("UPDATE  programa
SET nombre='$nombre', version='$version', estado='$estado', costo='$costo'
WHERE idprograma='$idprograma'");

        $this->db->query("DELETE FROM tipopago WHERE idprograma='$idprograma'");

        for ($i=1;$i<100;$i++){
            if (isset($_POST['Cuota'.$i])){
                $cuota=$_POST['Cuota'.$i];
                $nombre='CUOTA '.($i);
                $sql="UPDATE tipopago SET monto='$cuota' WHERE idprograma='$idprograma' AND nombre='$nombre'";
                $this->db->query($sql);
            }
        }

        header("Location: ".base_url()."Programas");
    }
    function delete($id){
        $count=$this->db->query("SELECT * FROM estudianteprograma WHERE idprograma='$id'")->num_rows();
        if ($count>0){
            echo "No se puede eliminar el programa porque tiene estudiantes registrados";
            return;
        }
        $query = $this->db->query("DELETE FROM programa WHERE idprograma='$id'");
        header("Location: ".base_url()."Programas");

    }

    function datos(){
        $table=$_POST['table'];
        $where=$_POST['where'];
        $dato=$_POST['dato'];
        $query = $this->db->query("SELECT * FROM $table WHERE $where='$dato'");
        $row=$query->result_array()[0];
        echo json_encode($row);
    }
    function insertmodulo(){
        $nombre=$_POST['nombre'];
        $codigo=$_POST['codigo'];
        $fechainicio=$_POST['fechainicio'];
        $fechafin=$_POST['fechafin'];
        $iddocente=$_POST['iddocente'];
        $idprograma=$_POST['idprograma'];
        $query = $this->db->query("INSERT INTO modulo SET 
        nombre='$nombre',
        codigo='$codigo',
        fechainicio='$fechainicio',
        fechafin='$fechafin',
        iddocente='$iddocente',
        idprograma='$idprograma'
        ");
        header("Location: ".base_url()."Programas");
    }
    public function deletemodulo($idmodulo)
    {
        $query = $this->db->query("DELETE FROM modulo WHERE idmodulo='$idmodulo'");
        header("Location: ".base_url()."Programas");
    }

    /**
     * @param TCPDF $pdf
     * @return void
     */
    public function header(TCPDF $pdf)
    {
        $pdf->Image('assets/images/uto.png', 10, 5, 20);
        $pdf->SetMargins(0, 0, 0);
        $pdf->SetFont('times', 'BI', 12);
        $pdf->Text(0, 5, "UNIVERSIDAD TÉCNICA DE ORURO", 0, 0, true, 0, 0, 'C');
        $pdf->Text(0, 10, "DIRECCIÓN DE POSTGRADO", 0, 0, true, 0, 0, 'C');
        $pdf->SetFont('times', 'BI', 15);
    }
}
