# Overview 

Este projeto um SDK em PHP (7+) para facilitar a integração entre o Agregador da Sysgaming e Operadores. Ele consiste em basicamente em um conjunto de interfaces que devem ser implementadas pelo Operador e algumas implementações abstratas em que o Operador pode se basear para implementar os métodos/interfaces requeridas. O Operador tem liberdade de substituir as implementações que julgar necessárias, devendo se atentar as dependências requeridas para o funcionamento adequado da integração. 

Todo o fluxo da comunicação entre Agregador e Operador segue o que esta documentado aqui (TODO link da doc). De acordo com essa documentação este SDK provê varios DTOs, exceptions e o tratamento de erros adequados e necessários para a comunicação entre as partes fluir corretamente.


# Instalação

Apesar de este SDK ter sido implementado de forma mais "standard" possível, ou seja, sem muitas dependências externas para não obrigar a instalação de bibliotecas extras ou ainda conflitar com as dependências já existentes do Operador, optamos ainda assim utilizar o Composer como gerenciador de dependências. 

## Via Composer Install

> TODO

## Via Git Submodules

> TODO


# Utilização

Basicamente a utilização deste SDK se dá pela implementação da interface `AggregatorController`. Ela é responsável por definir como a comunicação com o Agregador deve ser feita e com quais dados. 

A implementação deve suprir todos os métodos descritos na interface, porém existe uma implementação base que abstrai alguns métodos desta interface `AggregatorGenericControllerImpl` o que torna necessário a implementação de ao menos 6 métodos obrigatórios, segue um exemplo:

``` PHP
class AggregatorControllerImpl extends AggregatorGenericControllerImpl {

	//... outros métodos estão implementados na classe pai

    function doHttpPost(AggregatorHttpOutboundRequest $request) { /* ... */ }

    function handleBalance(AggregatorBalance $balance, AggregatorPlayerWallet $player) { /* ... */ }

    function handleBet(AggregatorBet $bet, AggregatorPlayerWallet $player) { /* ... */ }

    function handleWin(AggregatorWin $win, AggregatorPlayerWallet $player) { /* ... */ }

    function handleRollback(AggregatorRollback $rollback, AggregatorPlayerWallet $player) { /* ... */ }

    function getPlayerFromToken($token) { /* ... */ }

	//... outros métodos estão implementados na classe pai

}
```

Uma breve explicação sobre o que cada método deve fazer:

- `doHttpPost(...)`: deve implementar uma chamada Http ao Agregador. O SDK invoca este método dentro da implementação do `AggregatorController::buildGameUrl()` ;

> TODO exemplo

- `handleBalance(...)`: deve implementar a lógica de busca e retorno do saldo atual do jogador. O SDK invoca este método dentro da implementação do `AggregatorController::balanceFromRequest()`;

> TODO exemplo

- `handleBet(...)`: deve implementar a lógica de **débito** de uma aposta do saldo do jogador. O SDK invoca este método dentro da implementação do `AggregatorController::betFromRequest()`;

> TODO exemplo

- `handleWin(...)`: deve implementar a lógica de **crédito** de uma premiação ao saldo do jogador. O SDK invoca este método dentro da implementação do `AggregatorController::winFromRequest()`;

> TODO exemplo

- `handleRollback(...)`: deve implementar a lógica de **cancelamento** de uma determinada transação (quando possível), **crédito** ou **débito** do saldo do jogador. O SDK invoca este método dentro da implementação do `AggregatorController::rollbackFromRequest()`;

> TODO exemplo

- `getPlayerFromToken(...)`: deve retornar um `AggregatorPlayerWallet` com base no `$token` recebido como parâmetro. O SDK invoca este método dentro da implementação dos métodos `handleBalance`, `handleBet`, `handleWin` e `handleRollback`;

> TODO exemplo

## Roteamento/Endpoints

**Atenção**: É nessário que o Operador crie/configure rotas/endpoints em sua aplicação de acordo com a Documentação para Operadores (TODO link da doc). E dentro de cada método que aceita as requisições dessas rotas/endpoints o Operador deve utilizar os métodos implementados da interface `AggregatorController` descritos anteriormente. **Este SDK não cria/configura nenhuma rota/endpoint**.

Exemplo de rotas/endpoints:

``` PHP
Route::post('/balance', 'ApplicationSysgamingController@balance');
Route::post('/win', 'ApplicationSysgamingController@win');
Route::post('/bet', 'ApplicationSysgamingController@bet');
Route::post('/rollback', 'ApplicationSysgamingController@rollback');
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
            // algumas implementações necessárias da classe abstrata
        );

        $this->sdkController = $sdkController;

    }

    public function balance() {

        $payload = $this->extractPayloadFromReques();
        $signatureHolder = $this->signatureHolderFromRequest();

        $aggRequest = new AggregatorHttpInboundRequest($payload, $signatureHolder);

        $responseDTO = $this->sdkController->balanceFromRequest($aggRequest);

        return $this->sdkController->getJsonHandler()->jsonEncode($responseDTO);

    }

    public function bet() {

        $payload = $this->extractPayloadFromReques();
        $signatureHolder = $this->signatureHolderFromRequest();

        $aggRequest = new AggregatorHttpInboundRequest($payload, $signatureHolder);

        $responseDTO = $this->sdkController->betFromRequest($aggRequest);

        return $this->sdkController->getJsonHandler()->jsonEncode($responseDTO);

    }

    public function win() {

        $payload = $this->extractPayloadFromReques();
        $signatureHolder = $this->signatureHolderFromRequest();

        $aggRequest = new AggregatorHttpInboundRequest($payload, $signatureHolder);

        $responseDTO = $this->sdkController->winFromRequest($aggRequest);

        return $this->sdkController->getJsonHandler()->jsonEncode($responseDTO);

    }

    public function rollback() {

        $payload = $this->extractPayloadFromReques();
        $signatureHolder = $this->signatureHolderFromRequest();

        $aggRequest = new AggregatorHttpInboundRequest($payload, $signatureHolder);

        $responseDTO = $this->sdkController->rollbackFromRequest($aggRequest);

        return $this->sdkController->getJsonHandler()->jsonEncode($responseDTO);

    }

    private function extractPayloadFromReques() {

        return Request::inputs();

    }

    private function signatureHolderFromRequest() {

        // no caso de Http Basic Auth
        $user = Request::getUser();
        $password = Request::getPassword();

        // no caso de outros formas de autenticação
        $signature = Request::header(AggregatorController::SIGNATURE_INBOUND_HEADER_NAME);

        return (new AggregatorSignatureHolder())
            ->setUser($user)
            ->setPassword($password)
            ->setSignature($signature);

    }

}
```


# Tratamento de erros/exceptions

Ao extender à classe abstrata e implementar somente os métodos obrigatórios descritos acima, o Operador não precisa se preocupar com vários tratamentos de erros e validações, uma vez que a classe abstrata já gerencia essa parte, mas não tudo, algumas validações devem ser feitas juntamente com a implementação destes métodos e se necessário disparar exceptions apropriadas.

Pode-se verificar que existem várias exceptions que podem ser disparadas de dentro do SDK, no entanto elas serão mapeadas adequadamente a um `ExceptionDTO` que pode ser retornado diretamente como resposta às requisições do Agregador, passando por serializador Json primeiro é claro.

# Outras implementações

Ao extender à classe abstrata o Operador verá que ela requer algumas implementações em seu método construtor. Todos são necessário para o funcionamento adequado do SDK. Existem implementações base de todas dependências requeridas, no entanto o Operador pode prover as que julgar ser melhor para sua operação.

Ao optar por não utilizar a classe abstrata, o Operador pode implementar todas as interfaces como quiser, no entanto o objetivo da classe abstrata e das implementações base são justamente reduzir o esforço necessário e facilitar o processo de integração com o Agregador.

Se houver alguma dúvida não exite em entrar em contato conosco (TODO link do contato) e/ou para sugestôes relacionadas a este SDK pode ser feito via Pull Requests, elas serão analisadas e se forem apropriadas ficaramos felizes em incorporá-las ao projeto. 

