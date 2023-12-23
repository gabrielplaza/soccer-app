TAREFA
Para o processo seletivo precisamos que você desenvolva uma aplicação usando o framework LARAVEL em sua versão mais recente e um
banco de dados MySQL. Como a atividade tem por objetivo demonstrar suas habilidades como desenvolvedor Back End, o Front End precisa
apenas ser funcional.

DESCRIÇÃO DA APLICAÇÃO
Um grupo de amigos, desenvolvedores, resolveram jogar futebol toda semana em um campo Society de Poços de Caldas.
Após montar um grupo no WhatsApp com 25 pessoas, perceberam duas coisas:
1. Em média 15 a 17 pessoas confirmavam presença no jogo.
2. Sempre perdiam 10 minutos de jogo para escolher os times com 5 jogadores de linha e 1 goleiro. Logo ficou claro que poderiam
desenvolver uma aplicação que sorteasse as equipes, com base nas habilidades de cada jogador e assim poupar tempo.
Essa é sua tarefa.

REQUISITOS
* Armazenar dados dos jogadores: Nome, nível (de 1 a 5, sendo 1 o pior e 5 o melhor) e se o jogador é goleiro(sim/não).
* Permitir ao usuário marcar quem confirmou presença.
* Definir o número de jogadores por time.
* Sortear os jogadores em pelo menos dois times, considerando a quantidade de jogadores definidos e os que foram marcados como
presentes.
* Quando houver mais de dois times completos, é permitido ao último time ficar com o número de jogadores menor do que aquele definido
pelo usuário.
* Não permitir que um time tenha um número maior de jogadores do que foi determinado pelo usuário antes do sorteio.
* Não permitir o sorteio, caso o número total de confirmados seja menor que Nj*2, sendo 'Nj' o número de jogadores por time (ex: para
um sorteio com 5 jogadores por time, o mínimo de confirmados deve ser 10).
* Não permitir mais de 1 goleiro no mesmo time.

Tela Inicial Players

![Terminal](https://i.ibb.co/0KSvZ6f/Captura-de-tela-2023-12-23-034142.png)



Tela Adicionar Player

![Terminal](https://i.ibb.co/Qm85rQm/Captura-de-tela-2023-12-23-034338.png)



Tela Editar Player

![Terminal](https://i.ibb.co/SdZh2tj/Captura-de-tela-2023-12-23-034550.png)


Tela Resultado TImes

![Terminal](https://i.ibb.co/k9s0Csd/Captura-de-tela-2023-12-23-034715.png)


Requisitos
PHP 8.3 ou superior
Composer version 2.6.6 ou superior


Como rodar a aplicação ▶️

No terminal, clone o projeto:

git clone https://github.com/gabrielplaza/soccer-app.git
Entre na pasta do projeto com a IDE:

Instale as dependências:

composer install


Rode o Migrate para criar a tabela Player:

Php Artisan Migrate

Execute a aplicação e abra a porta que aparecer na web:

 php artisan serve
 
http://127.0.0.1:8000/


Tecnologias 💻
