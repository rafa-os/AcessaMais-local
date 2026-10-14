CREATE DATABASE IF NOT EXISTS acessibilidade
  DEFAULT CHARACTER SET utf8mb4;

USE acessibilidade;

CREATE TABLE IF NOT EXISTS mensagens (
  id INT AUTO_INCREMENT PRIMARY KEY,           
  nome VARCHAR(100) NOT NULL,                  
  email VARCHAR(150) NOT NULL,                 
  tema VARCHAR(50),                            -- Selecionar: TDAH, Daltonismo ou Acessibilidade em geral
  recurso VARCHAR(50),                         -- recurso do painel que a pessoa mais gostou
  mensagem TEXT NOT NULL,                      
  data_envio DATETIME DEFAULT CURRENT_TIMESTAMP -- data e hora do envio, automático
);

SELECT * FROM mensagens;