# 🚀 Guia de Setup - CRUD de Categorias com Laravel e Docker

## ✅ Pré-requisitos

- Docker e Docker Compose instalados
- Git instalado
- Editor de texto/IDE (VS Code recomendado)

## 📦 Estrutura do Projeto

```
P2-Backend/
├── docker-compose.yml          # Orquestração de containers
├── Dockerfile                  # Imagem customizada PHP 8.2
├── .env                        # Variáveis de ambiente
├── .env.example                # Template do .env
├── start.sh                    # Script de inicialização
├── app/
│   ├── Models/
│   │   └── Category.php        # Model da categoria
│   └── Http/
│       └── Controllers/
│           └── CategoryController.php  # Controller CRUD
├── database/
│   └── migrations/
│       └── 2024_11_24_000000_create_categories_table.php  # Migration
├── resources/
│   └── views/
│       └── categories/
│           ├── index.blade.php     # Listagem
│           ├── create.blade.php    # Formulário criar
│           └── edit.blade.php      # Formulário editar
└── routes/
    └── web.php                 # Rotas RESTful

```

## 🎯 Início Rápido

### 1. **Clone ou acesse o diretório do projeto**

```bash
cd P2-Backend
```

### 2. **Inicie os containers Docker**

```bash
docker-compose up -d
```

Isso irá:
- Construir a imagem Laravel/PHP 8.2
- Iniciar container da aplicação
- Iniciar container do MySQL 8.0
- Instalar dependências do Composer
- Gerar APP_KEY
- Executar migrations automaticamente

### 3. **Acesse a aplicação**

Abra no navegador:  
👉 **http://localhost:8000**

A raiz `/` redireciona automaticamente para `/categories`

## 📋 Operações CRUD Disponíveis

### Listar Categorias
- **URL:** `http://localhost:8000/categories`
- **Método:** GET
- **Descrição:** Exibe todas as categorias em uma tabela com opções de editar e deletar

### Criar Categoria
- **URL:** `http://localhost:8000/categories/create`
- **Método:** GET (formulário) → POST (envio)
- **Campos:**
  - `nome` (obrigatório, máx 255 caracteres)
  - `descricao` (opcional)

### Editar Categoria
- **URL:** `http://localhost:8000/categories/{id}/edit`
- **Método:** GET (formulário) → PUT (envio)
- **Campos:** mesmo como criar

### Deletar Categoria
- **URL:** `http://localhost:8000/categories/{id}`
- **Método:** DELETE
- **Nota:** Requer confirmação na interface

## 🔧 Comandos Úteis do Docker

### Parar containers
```bash
docker-compose down
```

### Ver logs em tempo real
```bash
docker-compose logs -f app
```

### Executar comando Laravel
```bash
docker-compose exec app php artisan <comando>
```

### Acessar terminal do container
```bash
docker-compose exec app bash
```

### Ver status do banco de dados
```bash
docker-compose exec app php artisan db
```

### Resetar banco de dados
```bash
docker-compose exec app php artisan migrate:reset
docker-compose exec app php artisan migrate
```

## 🗄️ Banco de Dados

### Configuração
- **Tipo:** MySQL 8.0
- **Host:** `laravel_db` (dentro do Docker)
- **Porta:** 3306
- **Database:** `laravel_db`
- **Usuário:** `laravel_user`
- **Senha:** `laravel_password`

### Tabela: categories

| Campo | Tipo | Atributos | Descrição |
|-------|------|-----------|-----------|
| id | BIGINT | PK, AUTO_INCREMENT | Identificador único |
| nome | VARCHAR(255) | NOT NULL | Nome da categoria |
| descricao | TEXT | NULLABLE | Descrição opcional |
| created_at | TIMESTAMP | | Data de criação |
| updated_at | TIMESTAMP | | Data de atualização |

## 📝 Detalhes da Implementação

### CategoryController
Implementa as 7 ações RESTful:

```php
- index()      // GET /categories (Listagem)
- create()     // GET /categories/create (Formulário)
- store()      // POST /categories (Salvar novo)
- show()       // GET /categories/{id} (Detalhes)
- edit()       // GET /categories/{id}/edit (Formulário edição)
- update()     // PUT /categories/{id} (Atualizar)
- destroy()    // DELETE /categories/{id} (Deletar)
```

### Model Category
```php
protected $fillable = ['nome', 'descricao'];
```

### Rotas
```php
Route::redirect('/', '/categories');           // Redireciona raiz
Route::resource('categories', CategoryController::class);  // 7 rotas automáticas
```

## 🎨 Interface

- **Tema:** Dark Plus (CSS customizado)
- **Responsivo:** Compatível com mobile/tablet
- **Validação:** Lado do servidor e do cliente
- **Feedback:** Mensagens de sucesso/erro após ações

## 🔐 Segurança

- ✅ Validação de entrada de dados
- ✅ CSRF protection (tokens Laravel)
- ✅ Mass assignment protection (`$fillable`)
- ✅ SQL injection prevention (Eloquent ORM)
- ✅ XSS prevention (Blade escaping)

## 📚 Boas Práticas Implementadas

✅ MVC Pattern (Model-View-Controller)  
✅ RESTful API Design  
✅ Eloquent ORM  
✅ Blade Templating  
✅ Database Migrations  
✅ Resource Controllers  
✅ Docker Containerization  
✅ Environment Variables  
✅ Code Organization  
✅ Validation Rules  

## 🐛 Troubleshooting

### Porta 8000 já está em uso
```bash
docker-compose down
# Ou usar outra porta no docker-compose.yml
```

### Banco de dados não conecta
```bash
docker-compose logs db
# Verificar se MySQL está rodando
```

### Permissions denied (Linux/Mac)
```bash
sudo chmod +x start.sh
```

### Limpar cache
```bash
docker-compose exec app php artisan cache:clear
docker-compose exec app php artisan config:clear
```

## 📞 Suporte

Para mais informações sobre Laravel, visite:
- [Laravel Documentation](https://laravel.com/docs)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Blade Templating](https://laravel.com/docs/blade)

---

**Desenvolvido como trabalho avaliativo de Backend com Laravel e Docker** 🎓
