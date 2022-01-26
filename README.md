# projeto_multiplataforma_laravel_lumen

<p align="justify">O presente projeto contando com um histórico de commits, mostra a tentativa de desenvolvimento de uma <b>API RestFul</b> criada utilizando o micro <b>Framework Lumen</b>.</p>
<p  align="justify">Essa é uma API de investimentos, onde será possível cadastrar ativos, registrar aportes para esses ativos e mesmo registrar resgates.</p>

<br>
<p align="justify">A api não somente proporciona Salvar, Alterar, Listar e Excluir registros dado determinado recurso, como seria um Rest básico.</p>

<br>
<p align="justify">Para utilizar a API é necessário <b>se autenticar</b>, assim o usuário receberá um token, e dessa forma em todas as requisições futuras
  para qualquer recurso, deverão ser passados duas chaves em <b>headers</b>, a saber <b>x-access-token</b> além do nome do usuário em <b>user</b>.</p>

<br>
<p align="justify">Além do conceito de Authenticate presente no desenvolvimento, temos também a aplicação prática do Authorization, pois em determinados momentos
se um usuário João tentar exlcuir ou alterar ou mesmo listar registros cadastrados pela usuária Maria, será retornando nos headers de resposta um status code
<b>http 401 unauthorizate</b>, simplesmente por ele não estar autorizado a interagir com registros alheios.</p>

<br>
<p align="justify">Outro ponto importante em se tratando de APIs, é a validação de dados. Para validar os dados vindos dos usuários nas requisições
foi utilizado o recurso presente no framework Lumen chamado <b>Validator</b>. Todas as classes controller extenderam a classe ControllerValidator,
cada classe controller filho, setava as regras de validação de acordo com sua necessidade, e invocam os métodos da classe pai ControllerValidator, 
facilitando assim a validação dos parâmetros vindos nas requisições. Caso os parêmetros não sejam válidos, um <b>http status code 400 bad request</b> será retornado,
com mensagem amigável é claro...</b>

<br>
<p align="justify">Merece destaque ainda, que o cálculo de resgate de um ativo, possui muitas variáveis e condições, sendo assim complexo, então para facilitar e reutilizar esse cálculo,
foi aplicado o <p>Design Pattern Builder</b> em <i>App\Http\Repositories\Builder</i> na classe <i>MontanteCalculoBuilder</b>. Dessa forma de maneira elegante
resolvemos o problema do cálculo do resgate de um aporte, criando um objeto complexo <i>MontanteCalculo</i> e um respectivo Builder para ele. Assim sempre que 
houver a mesma necessidade em diferentes lugares do código, essa classe utilizando padrão de projeto Builder, facilita e resolve a questão.</b>

<br>
<p align="justify">Por fim, o projeto ainda está sendo melhorado, e mais commits virão pora ai, mas podemos afirmar concerteza que o objetivo de construir uma API não somente
REST, mas uma API RESTFUL, foi atingido. Além disso, estratégias de desenvolvimento como Design Patterns podem ser conferidas nesse projeto.</b>
