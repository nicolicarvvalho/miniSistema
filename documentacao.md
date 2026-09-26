# Documentação: Sistema de Gestão de Alunos

## 1. Introdução
### 1.1 Propósito
Este documento especifica os requisitos para o Sistema de Gestão de Alunos desenvolvido em PHP, mantendo o mapeamento de prioridades, critérios de aceitação e dependências estruturadas de acordo com as diretrizes da norma ISO/IEC/IEEE 29148.

### 1.2 Escopo
O Sistema de Gestão de Alunos é uma aplicação web para gestão acadêmica. Suas funções centrais são:

Cadastrar novos alunos gravando nome, turma, e-mail, data de nascimento e status de atividade.

Exibir relatórios e listagens completas dos alunos cadastrados.

Permitir a busca individualizada de alunos por identificador (ID).

Remover registros de alunos da base de dados por meio da digitação do ID.

### 1.3 Definições
SGA: Sistema de Gestão de Alunos

RF: Requisito Funcional

RNF: Requisito Não-Funcional

RN: Regra de Negócio

ID: Identificador único numérico (Chave Primária) do aluno no banco de dados.

CRUD: Acrônimo para Create (Criar), Read (Ler/Consultar), Update (Atualizar) e Delete (Excluir).

### 1.4 Referências
ISO/IEC/IEEE 29148:2018 - Systems and software engineering — Requirements engineering

## 2. Descrição Geral
### 2.1 Perspectiva do Produto
O sistema é feito em PHP e organizado em pastas (app, database, includes e login). Para acessar as páginas, primeiro o usuário precisa fazer login para que consiga fazer o uso da aplicação. Todas as informações do sistema são salvas no banco de dados.

### 2.2 Funções Principais
Formulário de cadastro executando a função cadastrar().

Consulta de relatório geral executando a função relatorio().

Exclusão direta de registros pela função apagar().

Controle de acesso às rotas por meio da verificação de sessão.

## 3. Requisitos Específicos
### 3.1 Requisitos Funcionais
RF-001 - Cadastrar Aluno (Create)
Prioridade: Alta

Versão: 1.0 | Data: 2026-09-25

História de Usuário
Como usuário autenticado, eu quero preencher o formulário com dados do aluno para cadastrar um novo estudante no banco de dados.

Critérios de Aceitação
Interface contendo os campos: nome (text), turma (text), email (email), nascimento (date) e ativo (true/false).

A requisição HTTP utilizada é do tipo POST.

Ao submeter o formulário, o sistema invoca a função PHP cadastrar(`$conexao`, `$nome`, `$turma`, `$nascimento`, `$ativo`, `$email`).

Restrição de acesso: O arquivo inclui obrigatoriamente a verificação de sessão `verifica_user.php`.

RF-002 - Consultar Relatório de Alunos (Read)
Prioridade: Alta

Rastreabilidade: Necessidade de visualização dos dados cadastrados

Dependências: RF-001

Versão: 1.0 | Data: 2026-09-25

História de Usuário
Como usuário autenticado, eu quero acessar a tela de relatório para listar todos os alunos cadastrados no sistema.

Critérios de Aceitação
A página executa automaticamente a função PHP relatorio($conexao) dentro da tag <main>.

A renderização HTML inclui dinamicamente o cabeçalho (header.php) e o rodapé (footer.php).

Bloqueia acessos não autorizados redirecionando usuários sem sessão ativa.

RF-003 - Apagar Aluno (Delete)
Prioridade: Média

Rastreabilidade: Exclusão de cadastros indevidos por ID

Dependências: RF-001, RF-002

Versão: 1.0 | Data: 2026-09-25

História de Usuário
Como usuário autenticado, eu quero informar o ID de um aluno para remover seu registro da base de dados.

Critérios de Aceitação
Formulário com campo numérico id de preenchimento obrigatório (required).

Disparo de requisição POST chamando a função `apagar($conexao, $_POST['id'])`.

A exclusão é processada diretamente na base de dados por meio da conexão $conexao.

### 3.2 Regras de Negócio (RN)
RN-001: Autenticação de Sessão Obrigatória
Todas as páginas de operação do CRUD exigem a execução inicial de `session_start()` e a validação do usuário através do arquivo `verifica_user.php`.

RN-002: Passagem do Objeto de Conexão
Todas as funções operacionais do banco de dados (cadastrar, relatorio, apagar) exigem a injeção da variável de conexão `$conexao` como primeiro parâmetro.

RN-003: Mapeamento do Status Ativo
O status do aluno é determinado por campo do tipo radio enviando os valores textuais "true" ou "false".

### 3.3 Requisitos Não-Funcionais (RNF)
RNF-001: Segurança — Proteção de Rotas
Categoria: Segurança | Prioridade: Crítica

História de Usuário: Como administrador, eu quero que usuários não autenticados sejam impedidos de acessar os arquivos do CRUD diretamente pela URL.


RNF-002: Modularidade do Código
Categoria: Manutenibilidade | Prioridade: Alta

História de Usuário: Como desenvolvedor, eu quero que as funções SQL fiquem isoladas no arquivo functions.php, para manter a camada de visão (HTML) separada da regra de acesso a dados.


## Resumo de Prioridades
|ID|Nome|Prioridade|Justificativa|
|--|----|----------|-------------|
|RNF-001|Segurança (Verificação de Sessão)|Crítica|Protege as rotas contra acessos não autorizados|
|RF-001|Cadastrar Aluno|Alta|Entrada de dados principal do sistema|
|RF-002|Consultar Relatório|Alta|Visualização das informações salvas no banco|
|RNF-002|Modularidade|Alta|Reuso de código com includes e require_once|
|RF-003|Apagar Aluno|Média|Exclusão pontual de registros por ID|
