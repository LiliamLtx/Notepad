# 📝 Notepad Project

Sistema de gerenciamento de notas desenvolvido com **Laravel** no backend e **Vue.js 3** no frontend.  
O projeto tem como objetivo aplicar boas práticas de desenvolvimento web, testes de software automatizados, autenticação segura e organização de código, simulando um cenário real de aplicação fullstack.

O **Docker é utilizado exclusivamente para subir o banco de dados PostgreSQL**, enquanto o backend e o frontend rodam localmente.

---

## 🛠️ Tecnologias e Ferramentas

- **Backend:** PHP 8.2 + Laravel 12  
- **Frontend:** Vue.js 3 (Vite)  
- **Banco de Dados:** PostgreSQL  
- **Containerização:** Docker & Docker Compose (apenas para o banco)  
- **Autenticação:** Laravel Sanctum (API Token)  
- **Testes:** Cypress (E2E)  
- **UI:** Bootstrap  

---

## 🚀 Funcionalidades

- Cadastro e login de usuários

- Autenticação via API com token
- Criação, listagem, edição e exclusão de notas
- Soft delete de notas
- Proteção de rotas no frontend
- Tratamento de sessão expirada (401)
- Interface responsiva

---

## Telas
### 01- Login
<img width="1920" height="958" alt="image" src="https://github.com/user-attachments/assets/4bfca36e-a5db-4cc1-a320-1ac3fd0c4593" />
### 02- Login
<img width="1920" height="955" alt="image" src="https://github.com/user-attachments/assets/7cb6e15e-6855-425b-8b27-eb62c79db954" />



## 📦 Pré-requisitos

Antes de começar, você precisa ter instalado:

- [PHP 8.2+](https://www.php.net/)
- [Composer](https://getcomposer.org/)
- [Node.js](https://nodejs.org/)
- [Docker](https://www.docker.com/) e Docker Compose

---

## 1. Clonando o Repositório

``` Bash
git clone https://github.com/LiliamLtx/Notepad.git
cd Notepad
```
## 2. Fazendo o backend
``` Bash
cd backend
composer install
php artisan key:generate
php artisan migrate
```
Para rodar o servidor: 
```Bash
php artisan serve
```

## 3. Fazendo o frontend
``` Bash
cd frontend
npm install
```
Para rodar o servidor:
```Bash
npm run dev
```

## 4. Subindo o banco de dados com Docker
```bash
docker compose up -d
