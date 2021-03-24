<?php
require_once "{$_SERVER['DOCUMENT_ROOT']}/gestao/vendor/autoload.php";
use NFePHP\Mail\Mail;


#Parâmetros do envio
$config = new stdClass();
$config->smtpdebug      = 0; //0-no 1-client 2-server 3-connection 4-lowlevel
$config->host           = 'smtp.servidor-email.com'; //SMPT, no google deve-se habilitar a utilização de atividades de segurança
$config->port           = 587; //25 ou 465 ou 587
$config->smtpauth       = true;
$config->user           = 'email@email.com';
$config->password       = 'password'; //Senha
$config->secure         = 'tls'; // Forma de segurança
$config->authtype       = ''; //CRAM-MD5, PLAIN, LOGIN, XOAUTH2
$config->from           = 'from@from.com'; //Verificar, pois não está enviado para esse e-mail
$config->fantasy        = 'Descrição de envio para Teste'; // Cabeçalho da mensagem
$config->replyTo        = '';
$config->replyName      = '';
$config->smtpoptions    = null; 
$config->timeout        = 130; //Quanto tempo aguardar a conexão para abrir, em segundos. O padrão de 5 minutos (300s) 


try {
    #Instanciação da Classe Mail
    $mail = new Mail($config);
    
    //Corpo do E-mail ( Elaborar de acordo com sua necessidade )
    $htmlTemplate = '';
    $mail->loadTemplate($htmlTemplate);

    //XML e PDF inserir o caminho ou o Path / EmailXML - true para enviar os e-mails vinculados ao XML e false para não enviar.
    $xml        = ""; // Obrigatório
    $pdf        = '';
    $emailXMl   = false; // Obrigatório TRUE  para enviar a mensagem aos e-mails do XML e FALSE para enviar somente aos e-mails escolhidos
    $mail->loadDocuments($xml, $pdf, $emailXMl);
    
    //Atribui os emails que deverão ser entregues
    $addresses = [
            'email1@email.com.br'
        ,   'email2@email.com.br'
        ];            
   
    if ( $mail->send($addresses,true) ){
        echo "Email enviado com sucesso!";
    }
    
} catch (\Exception $e) {
    echo "Falha: " . $e->getMessage();
}  
