<?php

ob_start();
require_once 'fpdf181/fpdf.php';
require_once 'rotation.php';

class PDF extends PDF_Rotate {

    function RotatedText($x, $y, $txt, $angle) {
        $txt = utf8_decode($txt);
        //Text rotated around its origin
        $this->Rotate($angle, $x, $y);
        $this->Text($x, $y, $txt);
        $this->Rotate(0);
    }

}
// Instanciation of inherited class
$pdf = new PDF();
$pdf->SetLeftMargin(10);
$pdf->SetAutoPageBreak(false);
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 8);
$pdf->RotatedText(70, 9, 'HISTÓRICO ESCOLAR DO ENSINO FUNDAMENTAL', 0);
$pdf->SetFont('Arial', '', 7);
$pdf->Cell(20, 30, '', 1, 0, 'L');
$pdf->RotatedText(15, 35, 'COMPONENTES  ', 90);
$pdf->RotatedText(20, 35, 'CURRICULARES', 90);
for ($i = 0; $i < 5; $i++) {
    $pdf->Cell(10, 30, '', 1, 0, 'L');
}
$pdf->RotatedText(36, 39, 'LÍNGUA PORTUGUESA', 90);
$pdf->RotatedText(44, 39, 'ESTUDOS SOCIAIS', 90);
$pdf->RotatedText(56, 39, 'HISTÓRIA', 90);
$pdf->RotatedText(66, 39, 'GEOGRAFIA', 90);
$pdf->RotatedText(76, 39, 'CIÊNCIAS', 90);
$pdf->Cell(15, 30, '', 1, 0, 'L');
$pdf->RotatedText(86, 39, 'CIÊNCIAS FISÍCAS BIO.', 90);
$pdf->RotatedText(89, 39, 'E PROGRAMAS', 90);
$pdf->RotatedText(92, 39, 'DE SAÚDE', 90);
for ($i = 0; $i < 5; $i++) {
    $pdf->Cell(10, 30, '', 1, 0, 'L');
}
$pdf->RotatedText(102, 39, 'ARTE', 90);
$pdf->RotatedText(112, 39, 'EDUCAÇÃO ARTISTÍCA', 90);
$pdf->RotatedText(122, 39, 'EDUCAÇÃO FÍSICA', 90);
$pdf->RotatedText(132, 39, 'ENSINO RELIGIOSO', 90);
$pdf->RotatedText(142, 39, 'MATEMÁTICA', 90);
$pdf->Cell(15, 30, '', 1, 0, 'L');
$pdf->RotatedText(150, 39, 'LINGUA ESTRANGEIRA', 90);
$pdf->RotatedText(154, 39, 'MODERNA INGLÊS', 90);
$pdf->Cell(10, 30, '', 1, 0, 'L');
$pdf->RotatedText(165, 39, 'REDAÇÃO', 90);
$pdf->Cell(15, 30, '', 1, 0, 'L');
$pdf->RotatedText(175, 39, 'ELEMENTOS DE', 90);
$pdf->RotatedText(178, 39, 'DESENHOS', 90);
$pdf->RotatedText(181, 39, 'GEOMETRICOS', 90);
$pdf->Cell(15, 30, '', 1, 1, 'L');
$pdf->RotatedText(193, 39, 'DHC', 90);
//
$pdf->Cell(10, 20, '', 1, 0, 'L');
$pdf->RotatedText(15, 57, "1° ANO ( $marcar )", 90);
$pdf->RotatedText(18, 57, "1° SERIE (  )", 90);
$pdf->Cell(10, 4, "Notas", 1, 0, 'L');
//
$escola_horas = "";
$frequencia = "";
$dias = "";
$escola = "";
$cidade = "";
$uf = "";
$i = 0;
if ($ano1 == "") {
    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $i++;
        $disciplina = $linha['disciplina'];
        $id = $linha['id'];
        if ($i == "15") {
            $pdf->Cell(15, 4, '', 1, 1, 'L');
        } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
            $pdf->Cell(15, 4, '', 1, 0, 'L');
        } else {
            $pdf->Cell(10, 4, '', 1, 0, 'L');
        }
    }
} else {
    $consulta = "SELECT bimestre_media.*,disciplinas.disciplina FROM `bimestre_media`,`disciplinas` WHERE `id_bimestre_media_aluno` = '$id_aluno' AND `ano` = '$ano1' AND disciplinas.id = `id_bimestre_media_disciplina` AND `bnc` = 'S' ORDER BY ficha_descritiva ";
    $Consulta2 = mysqli_query($Conexao, $consulta);
    while ($linhaConsulta2 = mysqli_fetch_array($Consulta2, MYSQLI_BOTH)) {
        $recupera = $linhaConsulta2['bimestre_recupera'];
    }
    if (!$recupera == "N") {
        //No caso dos alunos passarem por média
        include_once 'montar_transferencia_server_1ano.php';
    } else {
        //No caso dos alunos irem para recuperação
        include_once 'montar_transferencia_server_1ano_final.php';
    }
}
$pdf->Cell(10, 4, "", 0, 0, 'C');
$pdf->Cell(10, 4, "CH", 1, 0, 'C');
$pdf->Cell(10, 4, "   $dias", 1, 0, 'C');
$pdf->Cell(10, 4, "   D", 1, 0, 'C');
$pdf->Cell(10, 4, "   I", 1, 0, 'C');
$pdf->Cell(10, 4, "   A", 1, 0, 'C');
$pdf->Cell(10, 4, "   S", 1, 0, 'C');
$pdf->Cell(15, 4, " -----", 1, 0, 'C');
$pdf->Cell(10, 4, "   L", 1, 0, 'C');
$pdf->Cell(10, 4, "   E", 1, 0, 'C');
$pdf->Cell(10, 4, "   T", 1, 0, 'C');
$pdf->Cell(10, 4, "   I", 1, 0, 'C');
$pdf->Cell(10, 4, "   V", 1, 0, 'C');
$pdf->Cell(15, 4, "   O", 1, 0, 'C');
$pdf->Cell(10, 4, "   S", 1, 0, 'C');
$pdf->Cell(15, 4, " -----", 1, 0, 'C');
$pdf->Cell(15, 4, " -----", 1, 1, 'C');
$pdf->Cell(10, 4, " ", 0, 0, 'C');
$pdf->Cell(180, 4, "Horas Letivas: $escola_horas                 Frequencia: $frequencia                         Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "Estabelecimento: $escola", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "Ano:  $ano1_conv                   Cidade:   $cidade                         Estado:  $uf", 1, 1, 'L');

// <!--2 ano-->      <!--2 ano-->       <!--2 ano-->     <!--2 ano-->         <!--2 ano-->                
// <!--EJA-->      <!--EJA-->       <!--EJA-->     <!--EJA-->         <!--EJA-->                
$pdf->Cell(10, 24, '', 1, 0, 'L');
$pdf->RotatedText(13, 77, "2° ANO (  $marcar2 )", 90);
$pdf->RotatedText(16, 77, "2° SERIE (   )", 90);
$pdf->RotatedText(19, 77, "I FASE ( $marcareja1  )", 90);
$pdf->Cell(10, 4, "Notas", 1, 0, 'L');
$escola_horas = "";
$frequencia = "";
$dias = "";
$escola = "";
$cidade = "";
$uf = "";
$recupera = "";
if (!$ano2 == "") {
    //No caso dos alunos irem para recuperação
    include_once 'montar_transferencia_server_2ano_final_1.php';
} elseif (!$eja1 == "") {
    //No caso dos alunos irem para recuperação
    include_once 'montar_transferencia_server_eja1_final_1.php';
} else {
    $i = 0;
    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $i++;
        $disciplina = $linha['disciplina'];
        $id = $linha['id'];
        if ($i == "15") {
            $pdf->Cell(15, 4, '', 1, 1, 'L');
        } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
            $pdf->Cell(15, 4, '', 1, 0, 'L');
        } else {
            $pdf->Cell(10, 4, '', 1, 0, 'L');
        }
    }
}
$pdf->Cell(10, 4, "", 0, 0, 'L');
$pdf->Cell(10, 4, "CH", 1, 0, 'L');
$pdf->Cell(10, 4, "   $dias", 1, 0, 'L');
$pdf->Cell(10, 4, "   D", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   A", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(10, 4, "   L", 1, 0, 'L');
$pdf->Cell(10, 4, "   E", 1, 0, 'L');
$pdf->Cell(10, 4, "   T", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   V", 1, 0, 'L');
$pdf->Cell(15, 4, "   O", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "Horas Letivas: $escola_horas                 Frequencia: $frequencia                         Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Estabelecimento: $escola", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Ano:  $ano2_conv  $eja1_conv                  Cidade:   $cidade                   Estado:  $uf", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
//            <!--2 ano fim-->
//            <!--3 ano--> <!--3 ano--> <!--3 ano--> <!--3 ano--> <!--3 ano-->
$pdf->Cell(10, 24, '', 1, 0, 'L');
$pdf->RotatedText(15, 101, "3° ANO ( $marcar3 )", 90);
$pdf->RotatedText(18, 101, "3° SERIE (  )", 90);
$pdf->Cell(10, 4, "Notas", 1, 0, 'L');
$escola_horas = "";
$frequencia = "";
$dias = "";
$escola = "";
$cidade = "";
$uf = "";
if (!$ano3 == "") {
    //No caso dos alunos irem para recuperação
    include_once 'montar_transferencia_server_3ano_final_1.php';
} else {
    $i = 0;
    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $i++;
        $disciplina = $linha['disciplina'];
        $id = $linha['id'];
        if ($i == "15") {
            $pdf->Cell(15, 4, '', 1, 1, 'L');
        } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
            $pdf->Cell(15, 4, '', 1, 0, 'L');
        } else {
            $pdf->Cell(10, 4, '', 1, 0, 'L');
        }
    }
}
$pdf->Cell(10, 4, "", 0, 0, 'L');
$pdf->Cell(10, 4, "CH", 1, 0, 'L');
$pdf->Cell(10, 4, "   $dias", 1, 0, 'L');
$pdf->Cell(10, 4, "   D", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   A", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(10, 4, "   L", 1, 0, 'L');
$pdf->Cell(10, 4, "   E", 1, 0, 'L');
$pdf->Cell(10, 4, "   T", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   V", 1, 0, 'L');
$pdf->Cell(15, 4, "   O", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "Horas Letivas: $escola_horas                 Frequencia: $frequencia                         Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Estabelecimento: $escola", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Ano:  $ano3_conv                   Cidade:   $cidade                     Estado:  $uf", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
//<!--3 ano fim-->
//            <!--4 ano -->               <!--4 ano -->                   <!--4 ano -->                   <!--4 ano -->
$pdf->Cell(10, 24, '', 1, 0, 'L');
$pdf->RotatedText(13, 126, "4° ANO ( $marcar4  )", 90);
$pdf->RotatedText(16, 126, "4° SERIE (   )", 90);
$pdf->RotatedText(19, 126, "II FASE ( $marcareja2  )", 90);
$pdf->Cell(10, 4, "Notas", 1, 0, 'L');
$escola_horas = "";
$frequencia = "";
$dias = "";
$escola = "";
$cidade = "";
$uf = "";
$recupera = "";
if (!$ano4 == "") {
    //No caso dos alunos irem para recuperação
    include_once 'montar_transferencia_server_4ano_final_1.php';
} elseif (!$eja2 == "") {
    //No caso dos alunos irem para recuperação
    include_once 'montar_transferencia_server_eja2_final_1.php';
} else {
    $i = 0;
    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $i++;
        $disciplina = $linha['disciplina'];
        $id = $linha['id'];
        if ($i == "15") {
            $pdf->Cell(15, 4, '', 1, 1, 'L');
        } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
            $pdf->Cell(15, 4, '', 1, 0, 'L');
        } else {
            $pdf->Cell(10, 4, '', 1, 0, 'L');
        }
    }
}
$pdf->Cell(10, 4, "", 0, 0, 'L');
$pdf->Cell(10, 4, "CH", 1, 0, 'L');
$pdf->Cell(10, 4, " $dias", 1, 0, 'L');
$pdf->Cell(10, 4, "   D", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   A", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(10, 4, "   L", 1, 0, 'L');
$pdf->Cell(10, 4, "   E", 1, 0, 'L');
$pdf->Cell(10, 4, "   T", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   V", 1, 0, 'L');
$pdf->Cell(15, 4, "   O", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "Horas Letivas: $escola_horas                 Frequencia: $frequencia                         Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Estabelecimento: $escola", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Ano:  $ano4_conv $eja2_conv                 Cidade:   $cidade                   Estado:  $uf", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
//<!--4 ano fim-->
//            <!--5 ano -->                     <!--5 ano -->                       <!--5 ano -->                     <!--5 ano -->                 <!--5 ano -->
$pdf->Cell(10, 24, '', 1, 0, 'L');
$pdf->RotatedText(15, 150, "5° ANO ( $marcar5 )", 90);
$pdf->RotatedText(18, 150, "5° SERIE (  )", 90);
$pdf->Cell(10, 4, "Notas", 1, 0, 'L');
$escola_horas = "";
$frequencia = "";
$dias = "";
$escola = "";
$cidade = "";
$uf = "";
$recupera = "";
if (!$ano5 == "") {    
    //No caso dos alunos irem para recuperação
    include_once 'montar_transferencia_server_5ano_final_1.php';
} else {
    $i = 0;
    $Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
    while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
        $i++;
        $disciplina = $linha['disciplina'];
        $id = $linha['id'];
        if ($i == "15") {
            $pdf->Cell(15, 4, '', 1, 1, 'L');
        } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
            $pdf->Cell(15, 4, '', 1, 0, 'L');
        } else {
            $pdf->Cell(10, 4, '', 1, 0, 'L');
        }
    }
}
$pdf->Cell(10, 4, "", 0, 0, 'L');
$pdf->Cell(10, 4, "CH", 1, 0, 'L');
$pdf->Cell(10, 4, "    ", 1, 0, 'L');
$pdf->Cell(10, 4, "   D", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   A", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(10, 4, "   L", 1, 0, 'L');
$pdf->Cell(10, 4, "   E", 1, 0, 'L');
$pdf->Cell(10, 4, "   T", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   V", 1, 0, 'L');
$pdf->Cell(15, 4, "   O", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "Horas Letivas: $escola_horas                 Frequencia: $frequencia                         Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Estabelecimento: $escola", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Ano: $ano5_conv                       Cidade:  $cidade                           Estado: $uf  ", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
// <!--5 ano fim-->
//            <!--6 ano-->                  <!--6 ano fim-->              <!--6 ano fim-->                 <!--6 ano fim-->
$pdf->Cell(10, 24, '', 1, 0, 'L');
$pdf->RotatedText(13, 174, "6° ANO (  )", 90);
$pdf->RotatedText(16, 174, "6° SERIE (  )", 90);
$pdf->RotatedText(19, 174, "III FASE (  )", 90);
$pdf->Cell(10, 4, "Notas", 1, 0, 'L');
$i = 0;
$Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
    $i++;
    $disciplina = $linha['disciplina'];
    $id = $linha['id'];
    if ($i == "15") {
        $pdf->Cell(15, 4, '', 1, 1, 'L');
    } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
        $pdf->Cell(15, 4, '', 1, 0, 'L');
    } else {
        $pdf->Cell(10, 4, '', 1, 0, 'L');
    }
}

$pdf->Cell(10, 4, "", 0, 0, 'L');
$pdf->Cell(10, 4, "CH", 1, 0, 'L');
$pdf->Cell(10, 4, "   ", 1, 0, 'L');
$pdf->Cell(10, 4, "   D", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   A", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(10, 4, "   L", 1, 0, 'L');
$pdf->Cell(10, 4, "   E", 1, 0, 'L');
$pdf->Cell(10, 4, "   T", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   V", 1, 0, 'L');
$pdf->Cell(15, 4, "   O", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "Horas Letivas:                  Frequencia:                          Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Estabelecimento: ", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Ano:                               Cidade:                              Estado:          ", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
// <!--6 ano fim-->
//            <!--7 ano -->                                        <!--7 ano -->                                           <!--7 ano --> 
$pdf->Cell(10, 24, '', 1, 0, 'L');
$pdf->RotatedText(15, 200, "7° ANO (  )", 90);
$pdf->RotatedText(18, 200, "7° SERIE (  )", 90);
$pdf->Cell(10, 4, "Notas", 1, 0, 'L');
$i = 0;
$Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
    $i++;
    $disciplina = $linha['disciplina'];
    $id = $linha['id'];
    if ($i == "15") {
        $pdf->Cell(15, 4, '', 1, 1, 'L');
    } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
        $pdf->Cell(15, 4, '', 1, 0, 'L');
    } else {
        $pdf->Cell(10, 4, '', 1, 0, 'L');
    }
}

$pdf->Cell(10, 4, "", 0, 0, 'L');
$pdf->Cell(10, 4, "CH", 1, 0, 'L');
$pdf->Cell(10, 4, " ", 1, 0, 'L');
$pdf->Cell(10, 4, "   D", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   A", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(10, 4, "   L", 1, 0, 'L');
$pdf->Cell(10, 4, "   E", 1, 0, 'L');
$pdf->Cell(10, 4, "   T", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   V", 1, 0, 'L');
$pdf->Cell(15, 4, "   O", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "Horas Letivas:                  Frequencia:                          Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Estabelecimento: $escola", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Ano:                     Cidade:                       Estado:  ", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
//Fim do 7 ano  
//<!--8 ano--> <!--8 ano--> <!--8 ano--> <!--8 ano--> 
$pdf->Cell(10, 24, '', 1, 0, 'L');
$pdf->RotatedText(13, 220, "8° ANO (  )", 90);
$pdf->RotatedText(16, 220, "8° SERIE (  )", 90);
$pdf->RotatedText(19, 220, "IV FASE (  )", 90);
$pdf->Cell(10, 4, "Notas", 1, 0, 'L');
$i = 0;
$Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
    $i++;
    $disciplina = $linha['disciplina'];
    $id = $linha['id'];
    if ($i == "15") {
        $pdf->Cell(15, 4, '', 1, 1, 'L');
    } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
        $pdf->Cell(15, 4, '', 1, 0, 'L');
    } else {
        $pdf->Cell(10, 4, '', 1, 0, 'L');
    }
}

$pdf->Cell(10, 4, "", 0, 0, 'L');
$pdf->Cell(10, 4, "CH", 1, 0, 'L');
$pdf->Cell(10, 4, "   ", 1, 0, 'L');
$pdf->Cell(10, 4, "   D", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   A", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(10, 4, "   L", 1, 0, 'L');
$pdf->Cell(10, 4, "   E", 1, 0, 'L');
$pdf->Cell(10, 4, "   T", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   V", 1, 0, 'L');
$pdf->Cell(15, 4, "   O", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "Horas Letivas:                  Frequencia:                          Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Estabelecimento: ", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Ano:                               Cidade:                                        Estado:          ", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "RESULTADO APÓS A PROGRESSÃO PARCIAL", 1, 1, 'L');
//Fim do 8 ano 
//  9 ano 9ano 9ano 9ano  
$pdf->Cell(10, 20, '', 1, 0, 'L');
$pdf->RotatedText(15, 245, "9° ANO (  )", 90);
$pdf->RotatedText(18, 245, "9° SERIE (  )", 90);
$pdf->Cell(10, 4, "Notas", 1, 0, 'L');
$i = 0;
$Consulta = mysqli_query($Conexao, "SELECT * FROM `disciplinas` WHERE  `bnc` = 'S' OR `bnc` = 'N' ORDER BY ficha_descritiva");
while ($linha = mysqli_fetch_array($Consulta, MYSQLI_BOTH)) {
    $i++;
    $disciplina = $linha['disciplina'];
    $id = $linha['id'];
    if ($i == "15") {
        $pdf->Cell(15, 4, '', 1, 1, 'L');
    } elseif ($i == "6" || $i == "12" || $i == "14" || $i == "15") {
        $pdf->Cell(15, 4, '', 1, 0, 'L');
    } else {
        $pdf->Cell(10, 4, '', 1, 0, 'L');
    }
}

$pdf->Cell(10, 4, "", 0, 0, 'L');
$pdf->Cell(10, 4, "CH", 1, 0, 'L');
$pdf->Cell(10, 4, "   ", 1, 0, 'L');
$pdf->Cell(10, 4, "   D", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   A", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(10, 4, "   L", 1, 0, 'L');
$pdf->Cell(10, 4, "   E", 1, 0, 'L');
$pdf->Cell(10, 4, "   T", 1, 0, 'L');
$pdf->Cell(10, 4, "   I", 1, 0, 'L');
$pdf->Cell(10, 4, "   V", 1, 0, 'L');
$pdf->Cell(15, 4, "   O", 1, 0, 'L');
$pdf->Cell(10, 4, "   S", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 0, 'L');
$pdf->Cell(15, 4, " -----", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, "Horas Letivas:                  Frequencia:                          Progressão Plena (  )                     Progressão Parcial (  )                       Reprovado (  )", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Estabelecimento: ", 1, 1, 'L');
$pdf->Cell(10, 4, " ", 0, 0, 'L');
$pdf->Cell(180, 4, " Ano:                               Cidade:                              Estado:          ", 1, 1, 'L');
$pdf->Cell(190, 6, "REGISTRO DA PROGRESSÃO PARCIAL E EXAME ESPECIAL", 0, 1, 'C');
$pdf->Cell(23.7, 4, "ANO", 1, 0, 'C');
$pdf->Cell(23.7, 4, "SÉRIE", 1, 0, 'C');
$pdf->Cell(35.7, 4, "DISCIPLINA", 1, 0, 'C');
$pdf->Cell(23.7, 4, "NOTA", 1, 0, 'C');
$pdf->Cell(23.7, 4, "RESULTADO", 1, 0, 'C');
$pdf->Cell(59.1, 4, "UNIDADE DE ENSINO", 1, 1, 'C');

$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(35.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(59.1, 3, "", 1, 1, 'C');
//
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(35.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(59.1, 3, "", 1, 1, 'C');
//
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(35.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(59.1, 3, "", 1, 1, 'C');
//
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(35.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(23.7, 3, "", 1, 0, 'C');
$pdf->Cell(59.1, 3, "", 1, 1, 'C');
//
$pdf->Cell(190, 4, "Alagoinha, $dia de $mes de $ano .", 0, 1, 'C');
$pdf->Cell(190, 4, "", 0, 1, 'C');
$pdf->Cell(190, 4, "", 0, 1, 'C');
$pdf->Cell(85, 8, "Secretario - Registro ou Matricula", 0, 0, 'C');
$pdf->Line(15, 281, 85, 281);
$pdf->Cell(85, 8, "Diretor(a) - Registro ou Matricula", 0, 0, 'C');
$pdf->Line(100, 281, 180, 281);
//
$pdf->Output(utf8_decode('Histórico Escolar'), 'I');
 