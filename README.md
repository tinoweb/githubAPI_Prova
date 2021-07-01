

## Requisitos para Instalacao

- Prepara o ambiente com php versao > 7
- Instalar o Composer php
- Se for usar Windows - Recomendo Wamp64 que ja vem com o mysql, Apache, php e outros recursos para rodar aplicacao
- Rodar os comandos de (migrate e seed) para enviar as migrations para o mysql e popularizar elas com dados iniciais
- Rodar o npm install para carregar as Dependencias para Front-end -> vuejs, bootstrap, laravel-mix ...
- Rodar Aplicacao laravel com o comando Padrao "php artisan serve"
- Voila...

[Nota: 
- Ao rodar a Migration - caso houver problema com innodb_large_prefix
foi adicionado Schema::defaultStringLength(191) no servive provide para resolver
- Ao rodar o composer update ou composer install, caso nao estaja numa maquina local linux ou Mac OS, 
e´ importante que a sua configuracao do php.ini esteja habilitado > curl.cainfo="caminho absoluto onde esta o seu arquivo cacert.pem" isso para permitir que o guzzle funcione adequadamente permetindo assim fazer requisiçoes para api.
- Caso essa configuraçao nao funcionar, tem como alterar as configuracoes dentro da classe Client.php do pacote guzzle que fica dentro da pasta Guzzle/src no vendor. Atençao isso so pode ser feito no ambiente local isso e uma brecha de Segurança. Nunca faça isso em PRODUCAO.
]

## License
