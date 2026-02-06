# 🧾 Plano de Testes Funcionais – Projeto Notepad

Este documento descreve os cenários de teste para a aplicação Notepad, cobrindo fluxos críticos de autenticação e gerenciamento de notas (CRUD).

---

## 🔐 Autenticação e Usuário

### CT-01 – Login com credenciais válidas
**Tipo:** Funcional  
**Prioridade:** Alta  
**Pré-condição:** Usuário já cadastrado no sistema.  

**Passos:**
1. Acessar a página de login.
2. Informar um e-mail válido.
3. Informar a senha correta.
4. Clicar no botão "Entrar".

**Resultado Esperado:**
- Usuário autenticado com sucesso.
- Token de acesso armazenado no `localStorage`.
- Redirecionamento automático para a `/home`.

---

### CT-02 – Login com credenciais inválidas (Caminho Negativo)
**Tipo:** Funcional / Negativo  
**Prioridade:** Alta  

**Passos:**
1. Acessar a página de login.
2. Informar um e-mail não cadastrado ou senha incorreta.
3. Clicar em "Entrar".

**Resultado Esperado:**
- O sistema deve exibir a mensagem: "Credenciais inválidas"
- O usuário deve permanecer na tela de login.

---

### CT-03 – Logout do sistema
**Tipo:** Funcional  
**Prioridade:** Alta  

**Passos:**
1. Com o usuário logado, clicar no botão "Logout".
2. Tentar acessar manualmente a URL `/home`.

**Resultado Esperado:**
- O token de sessão deve ser destruído.
- O usuário deve ser redirecionado para a tela de login.
- O acesso direto à `/home` deve ser bloqueado (redirecionar para login).

---

## 📝 Gerenciamento de Notas (CRUD)

### CT-04 – Criar primeira nota com sucesso
**Tipo:** Funcional / E2E  
**Prioridade:** Alta  

**Passos:**
1. Acessar a /home.
2. Clicar no botão de criar primeira nota (ou "Nova Nota").
3. Preencher os campos "Título" e "Conteúdo".
4. Clicar em "Salvar".

**Resultado Esperado:**
- A requisição `POST` deve retornar Status 201 ou 200.
- A nota deve aparecer imediatamente na listagem com as informações corretas.

---

### CT-05 – Editar nota existente (Update)
**Tipo:** Funcional / E2E  
**Prioridade:** Alta  

**Passos:**
1. Identificar uma nota na listagem.
2. Clicar no botão "Editar" (Ícone de lápis).
3. Aguardar o carregamento dos dados no formulário.
4. Alterar o título e/ou o conteúdo.
5. Clicar em "Atualizar".

**Resultado Esperado:**
- O sistema deve enviar um `PUT` para a API e deve retornar Status 201 ou 200..
- A tela deve refletir as alterações sem necessidade de recarregar a página manualmente.

---

### CT-06 – Excluir nota com sucesso (Delete)
**Tipo:** Funcional  
**Prioridade:** Média  

**Passos:**
1. Na listagem de notas, clicar no botão "Excluir" (Ícone de lixeira).
2. (Se houver) Confirmar a ação no modal de confirmação.

**Resultado Esperado:**
- A requisição `DELETE` deve retornar sucesso.
- O card da nota deve ser removido da interface visual.

---

### CT-07 – Validação de campos obrigatórios (Caminho Negativo)
**Tipo:** Funcional  
**Prioridade:** Baixa  

**Passos:**
1. Abrir o formulário de "Nova Nota".
2. Deixar os campos vazios.
3. Clicar em "Salvar".

**Resultado Esperado:**
- O sistema não deve disparar a chamada de API.
- Mensagens de erro visuais (ex: "O campo título é obrigatório") devem ser exibidas.

---
