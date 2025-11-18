# Sistema de Estacionamento — SOLID + PHP

Este projeto implementa um sistema de controle de estacionamento seguindo princípios do **SOLID**, utilizando **PHP**, **SQLite** e **Composer**.  
O objetivo é demonstrar arquitetura limpa, baixo acoplamento e uso de padrões como Strategy, Repository e separação por camadas.

---

# Arquitetura e Decisões

O projeto segue uma arquitetura em camadas, possibilitando fácil manutenção e aplicação dos princípios SOLID.

## 🔹Domain  
Contém **entidades** e **regras de negócio puras**, sem dependências externas.

- `Vehicle` – representa um veículo genérico.  
- `ParkingRecord` – registra entrada, saída e tempo de permanência.

## 🔹 Application  
Contém casos de uso em forma de serviços:

- `CheckinService` – realiza a entrada do veículo.  
- `CheckoutService` – processa a saída e calcula valor.

## 🔹 Infra  
A camada de infraestrutura implementa detalhes concretos:

### Banco de Dados
- `Connection.php` – gerencia conexão com SQLite.  
- Repositório:
  - `ParkingRepositoryInterface`
  - `SQLiteParkingRepository` (implementação concreta)

### Pricing — Strategy Pattern
Cálculo do valor usando **Strategy + Factory**:

- `PricingStrategy` – interface base  
- `CarPricing`  
- `MotoPricing`  
- `TruckPricing`  
- `PricingFactory` – retorna a estratégia certa conforme o tipo do veículo

## 🔹 bootstrap.php  
Centraliza carregamento do autoloader e configuração/injeção de dependências.

## 🔹 scripts/init_db.php  
Cria a tabela `parking_records` e inicializa o arquivo `database.sqlite`.

---

# Como rodar o projeto

## Pré-requisitos
- PHP 8+
- Extensão SQLite habilitada  
- Composer instalado  
- XAMPP/WAMP (opcional no Windows)

- **Instalar dependências**

  composer install

- **Inicializar o banco de dados**
  
  php scripts/init_db.php

- **Inicie o Xampp**
  
- **Clique em "Start" no Apache**
Status muda de vermelho para verde
PID (Process ID) é atribuído
Portas ficam ativas

- **Teste o PHP:**
Digite: http://localhost/dashboard
Verifique informações do sistema

**A pasta C:\xampp\htdocs\ é onde você deve colocar o projeto**

**Abra o navegador**
. Digite na barra de endereço: http://localhost/solid-estacionamento-p2/
. Resultado: Sua página PHP deve ser carregada e exibida




