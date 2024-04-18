<?php
  header("Content-Type: application/json; charset=UTF-8");
  
  $nomeUsuario = $_POST['nome'];
  $mensagemUsuario = $_POST['mensagem'];
  $emailUsuario = $_POST['email'];

  $email = $_POST['email'];

  // As duas primeiras linhas permitem a informação de erros
  ini_set( 'display_errors', 1 );
  error_reporting( E_ALL );

  // De quem é a mensagem
  $from = $emailUsuario;
  // Para quem é a mensagem
  $to = $email;
  // assunto da mensagem
  $subject = "Mensagem de Contato !IMPORTANTE!";
  // Conteúdo da mensagem
  $mensagem = "
    <!DOCTYPE html>
    <html lang='en'>
    <head>
      <meta charset='UTF-8'>
      <meta name='viewport' content='width=device-width, initial-scale=1.0'>
      <title>Mensagem</title>
    
      <style>
        * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }
    
        .container {
          max-width: 1000px;
          width: 90%;
          margin: 0 auto;
        }
        .bg-dark {
          background: #343a40;
          margin-top: 40px;
          padding: 20px 0;
        }
        .alert {
          font-size: 1.5em;
          position: relative;
          padding: .75rem 1.25rem;
          margin-bottom: 2rem;
          border: 1px solid transparent;
          border-radius: .25rem;
        }
        .alert-primary {
          color: #004085;
          background-color: #cce5ff;
          border-color: #b8daff;
        }
    
        .img-fluid {
          max-width: 100%;
          height: auto;
        }
    
        .mensagem {
          width: 80%;
          font-size: 20px;
          margin: 0 auto 40px;
          color: #eee;
        }
    
        .texto {
          margin-top: 20px;
        }
    
        .footer {
          width: 100%;
          background: #48494a;
          text-align: center;
          color: #ddd;
          padding: 10px;
          font-size: 14px;
        }

        .footer span {
          text-decoration: underline;
        }
      </style>
    </head>
    <body>
      <div class='container'>
        <div class='bg-dark'>
          <div class='alert alert-primary'>
            <strong>Mensagem de: </strong> $nomeUsuario
          </div>
    
          <div class='mensagem'>
            <div class='texto'>$mensagemUsuario</div>
          </div>
    
          <div class='footer'>
            Pode mandar mensagem no <span>$emailUsuario</span>
          </div>
        </div>
      </div>
    </body>
    </html>
  ";

  //Para o envio em formato HTML 
  
  // Configurações do cabeçalho do email
  $headers = "MIME-Version: 1.0" . "\r\n";
  $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
  $headers .= "From: <$emailUsuario>" . "\r\n";
  $headers .= "Cc: $to" . "\r\n";
  

  // Enviar o email
  $sendMail = mail($to, $subject, $mensagem, $headers);

  // Verificar se o email foi enviado com sucesso
  if ($sendMail) {
      // Enviar resposta JSON de sucesso
      echo json_encode(array(
          'success' => true,
          'message' => 'Mensagem Enviada'
      ));
  } else {
      // Enviar resposta JSON de erro
      echo json_encode(array(
          'success' => false,
          'message' => 'Houve um problema ao enviar a sua mensagem. Por favor, tente mais tarde.'
      ));
  } 

  //echo($nombre);
?>