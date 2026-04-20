# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Commands

```bash
# Full project setup (install, .env, key gen, migrate, npm)
composer setup

# Development server (PHP serve + queue + logs + Vite, all concurrent)
composer dev

# Run tests (clears config cache first)
composer test

# Run a single test file
php artisan test --filter=ProductoRepositoryTest

# PHP linting
./vendor/bin/pint

# Frontend build
npm run build
```

Tests use an in-memory SQLite database (configured in `phpunit.xml`), separate from the development MySQL database.

## Architecture

This is a **Laravel 12** app organized around **Domain-Driven Design (DDD)** with Clean Architecture. All business logic lives in `app/Modules/`, not in the standard `app/Http/` or `app/Models/` locations.

### Module structure

Each module follows this layout:

```
app/Modules/{Domain}/{Module}/
  Domain/
    Entities/          # Pure business objects (no framework/DB dependencies)
    Interfaces/        # Repository contracts
    ValueObjects/
  Application/
    UseCases/          # One class per operation (Create, List, Show, Update, Delete)
    Services/          # Orchestrator — wraps use cases in DB::transaction()
    DTOs/              # Per-operation DTOs (StoreProductDTO, UpdateProductDTO, etc.)
    Mappers/           # Entity ↔ DTO conversion
    Queries/           # Read repository interfaces (separate from write interfaces)
  Infrastructure/
    Persistence/Eloquent/
      Models/          # Eloquent models (named Tbl* e.g. TblProduct)
      Repositories/    # Implements domain interfaces
    Providers/         # Module ServiceProvider (DI bindings + route loading)
    Exceptions/        # ExceptionHandler subclass for this module
  Presentation/
    Http/
      Controllers/
      Requests/        # Form request validation
      Routes/          # router.php loaded by ServiceProvider
    UI/Views/          # Blade templates (namespaced as e.g. catalog::product.index)
```

**Dependency flow:** `Controller → Service → UseCase → Domain Interface → Eloquent Repository → DB`

Controllers call the Application Service. Services orchestrate Use Cases. Use Cases interact only with domain interfaces. Infrastructure (Eloquent) implements those interfaces.

### Registering a new module

Two places require manual registration:

1. **`bootstrap/providers.php`** — add the module's `ServiceProvider` class.
2. **`bootstrap/app.php`** — call `MyModuleExceptionHandler::register($exceptions)` inside the `withExceptions()` callback.

Routes and views are loaded by the ServiceProvider itself (not from `routes/web.php`).

### Read/Write repository split

Repositories are split into write (`ProductInterface`) and read (`ProductReadRepository` / Queries). Use Cases receive the appropriate contract — writes via the domain interface, reads via the query class.

### Current modules

- `Catalog/Product` — products, images, prices, discounts, dimensions
- `Catalog/Category`
- `Catalog/Brand`

All views are server-rendered Blade. There is no REST API layer yet.
