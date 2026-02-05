# 📋 Plano de Testes – Notepad

## 1. Introdução
Este documento descreve o **Plano de Testes** do projeto Notepad, 
definindo escopo, abordagem, recursos e critérios de aceitação.

---

## 2. Escopo de Testes

### Funcionalidades Testadas
- Autenticação de usuário (login/logout)
- Criação de notas
- Edição de notas
- Exclusão de notas
- Listagem de notas

### Fora do Escopo
- Testes de performance
- Testes de segurança avançados

---
## 3. Tipos de Teste

- Testes Funcionais
- Testes End-to-End (E2E)
- Testes de API REST

---

## 4. Ambiente de Testes

- Backend: Laravel
- Frontend: Vue.js
- Banco de Dados: PostgreSQL
- Ambiente: Docker

## 5. Critérios de Aceitação

- Todas as funcionalidades principais devem passar nos testes automatizados
- Nenhum bug crítico ou alto em produção
- Testes de regressão executados a cada alteração relevante

---

## 6. Critérios de Entrada e Saída

### Entrada
- Funcionalidade implementada
- Requisitos definidos

### Saída
- Casos de teste executados
- Bugs registrados e validados
