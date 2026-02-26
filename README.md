# Sistema de Gerenciamento Escolar com Laravel

![PHP](https://img.shields.io/badge/PHP-8.2-blue)
![Laravel](https://img.shields.io/badge/Laravel-10-red)
![HTML](https://img.shields.io/badge/HTML5-orange)
![CSS](https://img.shields.io/badge/CSS3-blue)
![JavaScript](https://img.shields.io/badge/JavaScript-yellow)
![Bootstrap](https://img.shields.io/badge/Bootstrap-5-purple)
![SQLite](https://img.shields.io/badge/Database-SQLite-lightgrey)

---

## Descrição do Projeto

O Senac App é um Sistema de Gerenciamento Escolar (SGE) desenvolvido como parte do Projeto Integrador do curso Técnico em Informática no Senac São Bernardo do Campo.

A aplicação foi construída utilizando framework Laravel com arquitetura MVC, com o objetivo de centralizar e automatizar processos acadêmicos como cadastro de alunos, docentes, cursos, turmas e avaliações.

O sistema implementa controle de autenticação para diferentes perfis (Administrador, Docente e Aluno), gerenciamento de vínculos entre entidades, lançamento de avaliações e organização das unidades curriculares.

Durante o desenvolvimento foram aplicados conceitos de modelagem de banco de dados, relacionamentos utilizando Eloquent ORM (hasMany, belongsTo, belongsToMany), migrations, validações e manipulação estruturada de dados, garantindo integridade e organização das informações.

O projeto propõe substituir o sistema interno de gerenciamento escolar do Senac por uma solução digital estruturada, moderna e centralizada, promovendo maior eficiência com foco de automatizar processos facilitando todos os usuários promovendo transparência e melhor acompanhamento da jornada acadêmica.

## Funcionalidades

### Autenticação e Controle de Acesso
- Login com três perfis distintos: Administrador, Docente e Aluno  
- Controle de permissões baseado em perfil  
- Redirecionamento dinâmico conforme tipo de usuário  

### Administrador
O Administrador possui controle total do sistema.

- CRUD completo de alunos
- CRUD completo de docentes
- CRUD de cursos, turmas e Unidades Curriculares (UCs)
- Gerenciamento de vínculos entre entidades
- Organização da estrutura acadêmica

### Docente
O Docente atua diretamente no processo pedagógico.

- Realização de chamada (controle de presença)
- Lançamento de avaliações parciais
- Lançamento de avaliações finais
- Registro de notas por Unidade Curricular
- Acompanhamento acadêmico das turmas vinculadas

### Aluno
O Aluno possui acesso restrito às suas próprias informações acadêmicas.

- Visualização de faltas e presenças
- Consulta do total de aulas por Unidade Curricular
- Acompanhamento de desempenho acadêmico por UC

O aluno pode selecionar a Unidade Curricular desejada para visualizar seu histórico de frequência e progresso.

### Sistema de Vínculos
- Relacionamento Aluno × Turma
- Relacionamento UC × Curso
- Relacionamento Docente × Curso
- Relacionamento Docente × UC
- Relacionamento Docente × Turma
- Implementação de tabelas pivot utilizando Eloquent ORM para gerenciar relacionamentos muitos-para-muitos

### Regras de Negócio e Integridade
- Validação automática de CPF
- Geração automática de RA único
- Validação de campos obrigatórios
- Aplicação de regras de consistência no backend
- Garantia de integridade referencial entre as entidades do sistema

## Tecnologias Utilizadas

- PHP 8.x
- Laravel 10
- Eloquent ORM
- SQLite (ambiente de desenvolvimento)
- HTML5
- CSS3
- JavaScript
- Bootstrap 5

## Status do Projeto

Este projeto foi desenvolvido como parte de um Projeto Integrador e encontra-se em fase de aprimoramento.

Atualmente, algumas funcionalidades ainda não estão finalizadas:

- O sistema completo de cálculo e exibição de faltas.
- As funcionalidades relacionadas às avaliações (parciais e finais).

---
