# Projeto Coup API (Laravel)

Este é um projeto Laravel que serve como backend para gerenciar informações relacionadas ao jogo Coup. Ele fornece funcionalidades para criar, atualizar e consultar dados do jogo, como jogadores, partidas e estatísticas.

---

## 📋 **Funcionalidades**
- Gerenciamento de jogadores.
- Criação e acompanhamento de partidas.
- API RESTful para interagir com o jogo.

---

## ⚙️ **Requisitos**
- PHP >= 8.0
- Composer
- Banco de dados SQLite
- Node.js
---

## 🚀 **Como Instalar**

### 1. Clone o Repositório
```bash
git clone https://github.com/Ruan-Lazareti/coup_game-be.git
coup_game-be
```

### 2. Instale as Dependências do PHP
```bash
composer install
composer update
```

### 3. Configure o Ambiente
```bash
cp .env.example .env
```

### 4. Gere a Chave da Aplicação
```bash
php artisan key:generate
```

### 5. Configure o Banco de Dados   
```bash
php artisan migrate
```

### 6. Execute as Seeders
```bash
php artisan db:seed
```

### 7. Suba o Servidor Local
```bash
php artisan serve
```
