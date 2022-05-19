## Overview 

Este projeto um SDK em PHP (7+) para facilitar a integração entre o Agregador da Sysgaming e Operadores. Ele consiste em basicamente em um conjunto de interfaces que devem ser implementadas pelo Operador e algumas implementações abstratas em que o Operador pode se basear para implementar os métodos/interfaces requeridas. O Operador tem liberdade de substituir as implementações que julgar necessárias, devendo se atentar as dependências requeridas para o funcionamento adequado da integração. 

Todo o fluxo da comunicação entre Agregador e Operador segue o que esta documentado aqui (TODO link da doc). De acordo com essa documentação este SDK provê varios DTOs, exceptions e o tratamento de erros adequados e necessários para a comunicação entre as partes fluir corretamente.


## Instalação

Apesar de este SDK ter sido implementado de forma mais **standard** possível, ou seja, sem muitas dependências externas para não obrigar a instalação de bibliotecas extras ou ainda conflitar com as dependências já existentes do Operador, optamos ainda assim utilizar o Composer como gerenciador de dependências. 

### Via Composer Install

No arquivo `composer.json`:

``` JSON
{
    "repositories": [
        {
            "type": "vcs",
            "url": "git@github.com:sysgaming/aggregator-sdk-operator-php"
        }
    ],
    
    "require": {
        "sysgaming/aggregator-sdk-php": "main"
    }
}
```

Execute `composer install` para instalar as dependências. A dependência virá da **branch main** do repositório do Github, como foi configurado em `repositories` do `composer.json`.

### Via Git Submodules

Na raíz do seu projeto (local do `composer.json` ou da pasta `.git`), adicione o submodule via terminal:

``` SHELL
git submodule add git@github.com:sysgaming/aggregator-sdk-operator-php folder/lib/aggregator-sdk
git pull --recurse-submodules
```

Altere o **Autoload PSR-4** do `composer.json`:

``` JSON
{
    "autoload": {
        "psr-4": {
            "Sysgaming\\AggregatorSdkPhp\\": "folder/lib/aggregator-sdk/src"
        }
    }
}
```

Execute `composer install` se ainda não o executou. Se já possuí as dependências do projeto instaladas, então execute `composer dump` para atualizar o autoload do projeto.

## Utilização

Basicamente a utilização deste SDK se dá pela implementação da interface `AggregatorController`. Ela é responsável por definir como a comunicação com o Agregador deve ser feita e com quais dados. 

A implementação deve suprir todos os métodos descritos na interface, porém existe uma implementação base que abstrai alguns métodos desta interface `AggregatorGenericControllerImpl` o que torna necessário a implementação de ao menos 6 métodos obrigatórios, segue um exemplo:

``` PHP
class AggregatorControllerImpl extends AggregatorGenericControllerImpl {

    //... outros métodos estão implementados na classe abstrata

    function doHttpPost(AggregatorHttpOutboundRequest $request) { /* ... */ }

    function handleBalance(AggregatorBalance $balance, AggregatorPlayerWallet $player) { /* ... */ }

    function handleBet(AggregatorBet $bet, AggregatorPlayerWallet $player, AggregatorOperatorTransaction $existedTr = null) { /* ... */ }

    function handleWin(AggregatorWin $win, AggregatorPlayerWallet $player, AggregatorOperatorTransaction $existedTr = null) { /* ... */ }

    function handleRollback(AggregatorRollback $rollback, AggregatorPlayerWallet $player, AggregatorOperatorTransaction $existedTr = null) { /* ... */ }

    function findExistedAggregatorTransaction($transactionId) { /* ... */ }

    //... outros métodos estão implementados na classe abstrata

}
```

Uma breve explicação sobre o que cada método deve fazer:

- `doHttpPost(...)`: deve implementar uma chamada Http ao Agregador, utilizando um HTTP Client de sua preferência ou mesmo via _curl_. O SDK invoca este método dentro da implementação do `AggregatorController::buildGameUrl()`. Exemplo:
    
    ```PHP
    function doHttpPost(AggregatorHttpOutboundRequest $request) {
    
        $client = new HttpClient();
    
        $endpoint = $request->getEndpoint();
        $contents = $request->getContents();
        $signature = $request->getSignature();
    
        $headers = array(
            self::SIGNATURE_OUTBOUND_HEADER_NAME => $signature,
            'Content-Type' => 'application/json',
        );
    
        try{
        
            $response = $client->post($endpoint, ['body' => $contents, 'headers' => $headers]);
      
            $statusCode = $response->getStatusCode();
            $contents = $response->getContents()
            
        }
        catch(RequestException $exception) {
    
            $statusCode = $exception->getResponse()->getStatusCode();
            $contents = $exception->getResponse()->getContents()
    
        }
        
        return (new AggregatorHttpOutboundResponse())
            ->setStatusCode($statusCode)
            ->setContents($contents);
    
    }
    ```

- `handleBalance(...)`: deve implementar a lógica de busca e retorno do saldo atual do jogador. O SDK invoca este método dentro da implementação do `AggregatorController::balanceFromRequest()`. Esta implementação é opcional, uma vez que a classe abstrata já a implementa:

    ```PHP
    function handleBalance(AggregatorBalance $balance, AggregatorPlayerWallet $player) {
  
        // Perceba que este método somente retorna as infos já contidas nos argumentos da chamada ao método mapeadas em um objeto `AggregatorBalanceResponse`. 
        // Isso ocorre porque já existe algumas validações que o próprio SDK faz
        // e os recursos necessários para essas validações incluem buscar um AggregatorPlayerWallet que já contém o saldo do jogador
    
        return new AggregatorBalanceResponse(
            $balance->getRequestUUID(),
            $player->getCurrency(),
            $player->getBalance()
        );
    
    }
    ```    

- `handleBet(...)`: deve implementar a lógica de **débito** de uma aposta do saldo do jogador. O SDK invoca este método dentro da implementação do `AggregatorController::betFromRequest()`;

    ```PHP
    function handleBet(AggregatorBet $bet, AggregatorPlayerWallet $player, AggregatorOperatorTransaction $existedTr = null) {
    
        // diversas validações já são realizadas pelo SDK antes de invocar este método
        // como: validação de assinatura das requests, token, jogador, currency, saldo insuficiente, 
        // transações fora de ordem e/ou conflitantes e respostas idempotentes (para evitar processamento duplo)
        // então, aqui deve-se ao menos debitar o valor da transação do saldo do jogador e persistir as infos necessários no banco de dados
        // também pode entrar alguma regra de negócio especifica se necessário
        
        $wallet = $this->findUserWallet($player);
        
        // se atentar que os valores monetários utilizados pelo SDK são inteiros e multiplicados por 1000000 (Um Milhão);
        $betAmount = $bet->getAmount(); // exemplo: $23.69 é representado por 23690000
        
        $wallet->setBalance($wallet->getBalance() - $betAmount);
        
        $wallet->save();
      
        // persiste a transação 
        $this->saveTransaction($bet, $player);
        
        // retorna o saldo atualizado do jogador
        return $this->makeAggregatorFreshBalanceResponse($tr, $player);
        
    }
    ```

- `handleWin(...)`: deve implementar a lógica de **crédito** de uma premiação ao saldo do jogador. O SDK invoca este método dentro da implementação do `AggregatorController::winFromRequest()`;

    ```PHP
    function handleWin(AggregatorWin $win, AggregatorPlayerWallet $player, AggregatorOperatorTransaction $existedTr = null) {
    
        // diversas validações já são realizadas pelo SDK antes de invocar este método
        // como: validação de assinatura das requests, token, jogador, currency, 
        // transações fora de ordem e/ou conflitantes e respostas idempotentes (para evitar processamento duplo)
        // então, aqui deve-se ao menos creditar o valor da transação ao saldo do jogador e persistir as infos necessários no banco de dados
        // também pode entrar alguma regra de negócio especifica se necessário
        
        $wallet = $this->findUserWallet($player);
        
        // se atentar que os valores monetários utilizados pelo SDK são inteiros e multiplicados por 1000000 (Um Milhão);
        $winAmount = $win->getAmount(); // exemplo: $23.69 é representado por 23690000
        
        $wallet->setBalance($wallet->getBalance() + $winAmount);
        
        $wallet->save();
      
        // persiste a transação 
        $this->saveTransaction($win, $player);
        
        // retorna o saldo atualizado do jogador
        return $this->makeAggregatorFreshBalanceResponse($tr, $player);
        
    }
    ```

- `handleRollback(...)`: deve implementar a lógica de **cancelamento** de uma determinada transação (quando possível), **crédito** ou **débito** do saldo do jogador. O SDK invoca este método dentro da implementação do `AggregatorController::rollbackFromRequest()`;

    ```PHP
    function handleRollback(AggregatorRollback $rollback, AggregatorPlayerWallet $player, AggregatorOperatorTransaction $existedTr = null) {
    
        // diversas validações já são realizadas pelo SDK antes de invocar este método
        // como: validação de assinatura das requests, token, jogador, currency, saldo insuficiente, 
        // transações fora de ordem e/ou conflitantes e respostas idempotentes (para evitar processamento duplo)
        // então, aqui deve-se ao menos creditar/debitar o valor da transação do saldo do jogador e persistir as infos necessários no banco de dados
        // também pode entrar alguma regra de negócio especifica se necessário
      
        if( !$existedTr ) {
      
            // se a transação que se pretende cancelar NÃO existir
            // então é necessário salvar essa informação 
            // para que quando a transação que se pretende cancelar chegar 
            // ela NÃO tenha efeito no saldo do jogador, pois leva-se em conta que já existe um cancelamento prévio para ela
            // verifique a implementação do método AggregatorGenericControllerImpl::rollbackFromRequest(...)
            
            $this->saveRollbackTransaction($rollback, $player);
          
            return $this->makeAggregatorFreshBalanceResponse($tr, $player);
          
        }
      
        // se a transação que se pretende cancelar existir
      
        // determina se é uma operação de crédito ou débito
        $isCredit = $existedTr->getType() == AggregatorOperatorTransaction::TR_TYPE_WIN;
            
        $wallet = $this->findUserWallet($player);
              
        // se atentar que os valores monetários utilizados pelo SDK são inteiros e multiplicados por 1000000 (Um Milhão);
        $amount = $existedTr->getAmount(); // exemplo: $23.69 é representado por 23690000
        
        $wallet->setBalance($wallet->getBalance() + ($amount * ($isCredit ? 1 : -1)));
        
        $wallet->save($wallet);
      
        // cancela a transação 
        $this->cancelTransaction($rollback, $player);
        
        // retorna o saldo atualizado do jogador
        return $this->makeAggregatorFreshBalanceResponse($tr, $player);
        
    }
    ```

- `findExistedAggregatorTransaction(...)`: TODO ;

> TODO exemplo

### Roteamento/Endpoints

**Atenção**: É nessário que o Operador crie/configure rotas/endpoints em sua aplicação de acordo com a Documentação para Operadores (TODO link da doc). E dentro de cada método que aceita as requisições dessas rotas/endpoints o Operador deve utilizar os métodos implementados da interface `AggregatorController` descritos anteriormente. **Este SDK não cria/configura nenhuma rota/endpoint**.

Exemplo de rotas/endpoints:

``` PHP
Route::post('/balance', 'ApplicationSysgamingController@postBalance');
Route::post('/bet', 'ApplicationSysgamingController@postBet');
Route::post('/win', 'ApplicationSysgamingController@postWin');
Route::post('/rollback', 'ApplicationSysgamingController@postRollback');
```

Exemplo de utilização do SDK:

``` PHP
class ApplicationSysgamingController extends SomeSuperController {

    /**
     * @var AggregatorController
     */
    private $sdkController;

    function __construct() {

        $sdkController = new SysgamingAggregatorSDK(
            // algumas implementações/configurações necessárias da classe abstrata
        );

        $this->sdkController = $sdkController;

    }

    public function buildGameUrl($user, $token, $wallet, $gameCode) {

        $startPlaying = new AggregatorStartPlaying();

        // ... adicionar infos ao $startPlaying

        return $this->sdkController->buildGameUrl($startPlaying);

    }

    public function postBalance() {

        $aggRequest = new AggregatorHttpInboundRequest(
            $this->extractPayloadFromRequest(), 
            $this->signatureHolderFromRequest()
        );

        $responseDTO = $this->sdkController->balanceFromRequest($aggRequest);

        return $this->responseJson($responseDTO);

    }

    public function postBet() {

        $aggRequest = new AggregatorHttpInboundRequest(
            $this->extractPayloadFromRequest(), 
            $this->signatureHolderFromRequest()
        );

        $responseDTO = $this->sdkController->betFromRequest($aggRequest);

        return $this->responseJson($responseDTO);

    }

    public function postWin() {

        $aggRequest = new AggregatorHttpInboundRequest(
            $this->extractPayloadFromRequest(), 
            $this->signatureHolderFromRequest()
        );

        $responseDTO = $this->sdkController->winFromRequest($aggRequest);

        return $this->responseJson($responseDTO);

    }

    public function postRollback() {

        $aggRequest = new AggregatorHttpInboundRequest(
            $this->extractPayloadFromRequest(), 
            $this->signatureHolderFromRequest()
        );

        $responseDTO = $this->sdkController->rollbackFromRequest($aggRequest);

        return $this->responseJson($responseDTO);

    }

    private function extractPayloadFromRequest() {
        //... extrai o payload da requisição
    }

    private function signatureHolderFromRequest() {

        // no caso de Http Basic Auth
        $user = Request::getUser();
        $password = Request::getPassword();

        // no caso de outros formas de autenticação
        $signature = $request->header(AggregatorController::SIGNATURE_INBOUND_HEADER_NAME);
        $signature = $this->sdkController->getBase64Handler()->base64Decode($signature);

        return (new AggregatorSignatureHolder())
            ->setUser($user)
            ->setPassword($password)
            ->setSignature($signature);

    }
    
    private function responseJson($dto) {

        return Response::json(
            $dto->toArray(),
            $dto instanceof ExceptionDTO ? 400 : 200
        );
        
    }

}
```


## Tratamento de erros/exceptions

Ao extender à classe abstrata e implementar somente os métodos obrigatórios descritos acima, o Operador não precisa se preocupar com vários tratamentos de erros e validações, uma vez que a classe abstrata já gerencia essa parte, mas não tudo, algumas validações devem ser feitas juntamente com a implementação destes métodos e se necessário disparar exceptions apropriadas.

Pode-se verificar que existem várias exceptions que podem ser disparadas de dentro do SDK, no entanto elas serão mapeadas adequadamente a um `ExceptionDTO` que pode ser retornado diretamente como resposta às requisições do Agregador, passando por serializador Json primeiro é claro.

## Outras implementações

Ao extender à classe abstrata o Operador verá que ela requer algumas implementações em seu método construtor. Todos são necessário para o funcionamento adequado do SDK. Existem implementações base de todas dependências requeridas, no entanto o Operador pode prover as que julgar ser melhor para sua operação.

Ao optar por não utilizar a classe abstrata, o Operador pode implementar todas as interfaces como quiser, no entanto o objetivo da classe abstrata e das implementações base são justamente reduzir o esforço necessário e facilitar o processo de integração com o Agregador.

Se houver alguma dúvida não exite em entrar em contato conosco (TODO link do contato) e/ou para sugestôes relacionadas a este SDK pode ser feito via Pull Requests, elas serão analisadas e se forem apropriadas ficaramos felizes em incorporá-las ao projeto. 

