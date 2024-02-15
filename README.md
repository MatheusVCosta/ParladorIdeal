# Parlador Ideal

<div align="center">
  <img src="https://github.com/MatheusVCosta/ParladorIdeal/assets/38003078/94397aa3-c193-4414-b14c-6499cb72063d" width=400>
</div>

## Objetivo
Desenvolver uma aplicação para interação através de posts sobre economia deu origem ao 'Parlador Ideal', que propõe permitir que os usuários expressem suas opiniões sobre o mercado financeiro.

## Desenvolvimento

Back-end - PHP 8
 - Framework Laravel 10
 - Biblioteca de autenticalçao Sanctum

Front-end - JS
 - Framework Vue.js + Vite
 - TailWindCss para ajudar na estilização (Optei por esse framework, pois nunca tinha usado e achei bem bonitos os seus componentes)
 - axios para fazer a requisições HTTP para a API
 - pinia para ajudar no gerenciamento de estado
 - vue-router para criar as rotas da aplicação

Banco de dados - Mysql
 Tabelas
 - User
 - Post

## O que foi desenvolvido
  A aplicação em si é bem simples, com poucas funcionalidades, tendo somente, autenticação, criar usuários e gerenciamento dos posts publicados pelo o usuário.
  Sendo assim, a aplicação conta com:

  Autenticação:
  - [x] Fazer login 
  - [x] Fazer logout
  - [x] Gerar token de autenticação
  Usuários:
  - [x] Criar novas usuários
  Posts:
  - [x] Listar posts recentes
  - [x] Listar posts criado pelo usuário
  - [x] Publicar um novo post
  - [x] Editar um post criado pelo usuário
  - [x] Deletar um post criado pelo usuário

## Sobre o Desenvolvimento
  
  ### Back-end  
  A aplicação foi desenvolvido seguindo o padrão de projetos MVC que é adotado pelo próprio laravel, unica coisa que me preocupei foi com a reutilização de código e tentar não acoplar lógica de código junto com a lógica de negocio
  Então usei as Facades do laravel Juntos com ServiceProviders, assim criei meus próprios services para gerenciar as interações entre a API e o Banco de dados.
  Assim deixei a lógico de código mais contida dentro dos services, facilitando também em futuras manutenções.
  Na UserController ao invés de tratar a request, validando os parâmetros passados e fazendo a chamado direto para a model
  Separei da seguinte maneira, na controller me preocupei em validar a request usando o próprio `Validator` do laravel e caso tenha erro retorno com as mensagens devidamentes adaptadas para o client, deixando mais amigável
  Então após validar a request, chamo o service passando a request, assim na controller só me preocupo em conferir se o email informado já existe na base e caso não tenha, crio o usuário

  UserController.php
  `
  public function createUser(User $user): User| array
    {
    
        if (empty($user) && !is_a($user, User::class)) {
            throw new Exception("Error when create user");
        }

        if (!$this->_verifyEmailExist($user->email)) {
            return [
                'message' => 'Já existe um usuário registrado com esse email!'
            ];
        }

        $user->password = Hash::make($user->password);
        $userSaved = $user->save();
        
        if (!$userSaved) {
            throw new Exception("User not created");
        }

        return $user;
    }
  
  `
  UserService.php
  `
  
    public function createUser(User $user): User| array
    {
        if (empty($user) && !is_a($user, User::class)) {
            throw new Exception("Error when create user");
        }

        if (!$this->_verifyEmailExist($user->email)) {
            return [
                'message' => 'Já existe um usuário registrado com esse email!'
            ];
        }

        $user->password = Hash::make($user->password);
        $userSaved = $user->save();
        
        if (!$userSaved) {
            throw new Exception("User not created");
        }

        return $user;
    }`
  
  Acredito que poderia ter feito melhor essa separação de código, criando services para cada função como, CreateUserService ou DeleteUserService, isso iria facilitar mais ainda uma manutenção, pois seria mais fácil de identificar algum erro
  até mesmo na hora de criar os testes unitários.

  ### Front-end
  No front-end foi onde tive mais dificuldade, pois nunca tinha usado o tailwind e demorei um tempo para entender como usar, mas quis esse framework como já dito antes, achei os seus componentes bem bonitos
  E no fim das contas achei ele muito mais facil de usar que o Vuex.
  
  O Front foi desenvolvido as seguites interfaces:
   - Login
   - Registrar-se

   - Home
   - Minhas Publicações
   - Criar novo Post
   - Editar Post


  No front-end me preocupei em componentizar alguns elementos que eu poderia reutilizar, um exemplo muito bom foi as "ModalSuccess.vue", que eu reutilizei bastante para apresentar uma mensagem de erro ou sucesso.

  Ex da modal criado:
  ![Captura de tela de 2024-02-15 04-10-31](https://github.com/MatheusVCosta/ParladorIdeal/assets/38003078/7ebe53e7-6408-4b6f-a682-4100783720d8)

  Na criação das telas me preocupei em adotar um layout mais simples, usando cores mais suaves
  A logo mostra as cores principais do sistema, o branco e o laranja que está presente em todo o sistema
  
  Laranja:
  
  ![image](https://github.com/MatheusVCosta/ParladorIdeal/assets/38003078/1d568480-189a-4a27-8f52-df2f7353cc01)

  
  Branco:
  
  ![image](https://github.com/MatheusVCosta/ParladorIdeal/assets/38003078/7ac2dc7b-b423-455e-97bb-6ed696b11035)

### TODOs
  Acredito que muita coisa pode ser melhorada, e gostaria de fazer isso ainda
  Separei algumas coisas que pretendo ajustar no futuro

  Teste: 
    Acho muito importante uma aplicações ter testes desenvolvidos, assim temos uma cobertura de possiveis falhas e bugs
    Então pretendo desenvolver essa parte ainda
    
  Melhorar estrutura:
    Mesmo me preocupando bastante com a estrutura do código, acho que ainda posso melhorar bastante coisa, principalemente no front-end 
    onde mutia coisa não ficou devidamente componentizado
  Gerar um apk:
    Infelizmente não consegui gerar um apk, pois enfrentei alguns erros na hora de fazer o build, de inicio tentei fazer o build usando o Cordova, pores tive muitos erros de compatibilidade entre as versões das ferramentas necessárias
    e perdi um tempo nisso, mas gostaria de fazer isso funcionar.

### Como iniciar o projeto
  Como citado logo acima, não consegui gerar um apk do código, então para compensar e facilitar na hora de executar, usei o docker para criar um container com a aplicação.
  Então ao invés de rodar diversos comandos para baixar os pacotes e iniciar o projeto.
  - Primeiro crie um banco de dados no mysql, sugiro chamar de "parlador"
  - Enrão execute o `docker-compose up --build` 
  Então após isso basta acessar  https://localhost:5173
  Recomendo rodar a aplicação usando o "modo de desenvolvimento responsivo" do navegador pois foi tudo desenvolvido pensando em uma aplicação mobile

Como o aplicativo tem bastamte tela, aqui tem um zip com os prints da aplicativo
[Prints.zip](https://github.com/MatheusVCosta/ParladorIdeal/files/14303331/Prints.zip)


