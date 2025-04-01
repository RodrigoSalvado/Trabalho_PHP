📌 Guia de Utilização do Repositório

📢 Pré-requisitos

Para utilizares este repositório corretamente, deves ter instalado o XAMPP, uma aplicação que inclui o servidor Apache e a base de dados MySQL.

🔹 Download e Instalação do XAMPP

Faz download do XAMPP através do site oficial: https://www.apachefriends.org/index.html

Instala o XAMPP seguindo as instruções do instalador.

🚀 Configuração do Servidor

🔥 Iniciar Apache e MySQL

Abre o Painel de Controlo do XAMPP.

Inicia os serviços Apache e MySQL clicando nos botões "Start".

📂 Colocar o Repositório no Diretório Correto

Para que o Apache possa servir os ficheiros corretamente:

Localiza a pasta de instalação do XAMPP (por defeito: C:\xampp\htdocs no Windows, /opt/lampp/htdocs/ no Linux ou /Applications/XAMPP/htdocs/ no macOS).

Copia ou clona este repositório para dentro da pasta htdocs.

# Exemplo de clonagem via Git
cd C:\xampp\htdocs   # Windows

cd /opt/lampp/htdocs  # Linux

cd /Applications/XAMPP/htdocs  # macOS

git clone https://github.com/RodrigoSalvado/Trabalho_PHP.git

🛠️ Importar a Base de Dados

Para importar a base de dados do projeto:

Acede ao phpMyAdmin através do navegador: http://localhost/phpmyadmin

Escolhe a opção importar na página inicial, e seleciona o ficheiro basedados/criar_bd.sql

Carrega em Executar para completar a importação.

🎯 Aceder ao Projeto

Depois de tudo configurado, podes aceder ao projeto através do navegador, indo a:

http://localhost/Trabalho_PHP

Caso tenhas dúvidas ou problemas, verifica se os serviços do XAMPP estão ativos e se a base de dados foi importada corretamente! 🚀
