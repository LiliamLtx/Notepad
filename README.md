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

<img width="1920" height="958" alt="image" src="https://github.com/user-attachments/assets/47fbd227-1d81-4704-a9cf-43b3eaa827c8" />
<br>

### 02- Cadastro

<img width="1920" height="952" alt="image" src="https://github.com/user-attachments/assets/63d5137f-1cce-499d-b672-7fb0aa85edea" />
<br>

### 03- Tela incial (sem notas)

<img width="1920" height="940" alt="image" src="https://github.com/user-attachments/assets/b7e91287-c9e1-457b-8620-00654e51a24a" />
<br>

### 03.1 Tela inicial (com notas)

<img width="1920" height="940" alt="image" src="https://github.com/user-attachments/assets/2881cc95-f10e-4794-a8d5-3c6071469c01" />


### 04- Tela de criação de nota

<img width="1920" height="940" alt="image" src="https://github.com/user-attachments/assets/dbcc7610-7551-4fec-99c3-d59409bef463" />
<br>

### 05- Tela de edição de nota

<img width="1920" height="943" alt="image" src="https://github.com/user-attachments/assets/1e435564-81ac-4819-bc14-a914608f761c" />
<br>

### 06- Tela de exclusão de nota

<img width="1920" height="945" alt="image" src="https://github.com/user-attachments/assets/3326c21a-f406-4587-a4eb-1a532a865cf7" />




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
