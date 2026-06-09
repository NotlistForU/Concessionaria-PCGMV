# AutoMotors — Sistema de Concessionária Premium

O **AutoMotors** (também denominado Concessionária PCGMV) é uma plataforma web para exibição e gerenciamento de um catálogo de veículos premium. O sistema é dividido em duas frentes principais: uma área pública voltada para clientes interessados em conhecer os modelos, simular propostas e agendar test drives, e um painel administrativo seguro para os vendedores gerenciarem o estoque, imagens e propostas de clientes.

---

## 1. Visão Geral do Aplicativo

* **Objetivo:** Facilitar a exibição digital de veículos de luxo e intermediar o contato inicial de clientes com a equipe de vendas de forma intuitiva e segura.
* **Problema que resolve:** 
  * Reduz a fricção na captação de clientes interessados em test drive ou propostas de compra, coletando dados estruturados.
  * Organiza o estoque de veículos da concessionária em um painel unificado, permitindo atualizações em tempo real com controle de imagens associadas.
  * Valida automaticamente informações críticas como CNH e telefone antes de enviar os dados ao banco.
* **Usuários-alvo:**
  * **Clientes:** Entusiastas e compradores de veículos premium que buscam especificações detalhadas, visualização de galerias e agendamentos diretos.
  * **Administradores / Vendedores:** Funcionários autorizados da concessionária responsáveis pelo cadastro e atualização de estoque (CRUD), além de gerenciar propostas e agendamentos.

---

## 2. Principais Funcionalidades

### Área Pública (Cliente)
* **Vitrine Dinâmica:** Visualização de veículos com filtros de pesquisa por modelo, categoria e preço máximo.
* **Detalhes do Veículo:** Ficha técnica completa de cada automóvel (quilometragem, potência, motorização, aceleração, transmissão, etc.), acompanhada de uma descrição detalhada de interior e exterior.
* **Carrossel Interativo:** Exibição de imagens exclusivas do veículo (foto de vitrine, banner e fotos adicionais do interior/galeria).
* **Agendamento de Test Drive:** Solicitação que exige o preenchimento de dados de contato, data de preferência e validação algorítmica de CNH e número de WhatsApp.
* **Proposta de Compra:** Envio de interesse de compra com detalhes de forma de pagamento e se o cliente deseja incluir um veículo na troca.

### Área Administrativa (Restrita)
* **Autenticação Segura:** Login para vendedores com senhas criptografadas.
* **Cadastro de Novos Administradores:** Sistema de registro restrito a funcionários que possuam chaves de autorização de uso único (`keys_usuarios_autorizados`).
* **CRUD de Veículos:** Controle total de inserção, edição e exclusão de modelos no estoque.
* **Upload e Otimização de Imagens:** Suporte para múltiplos uploads com renomeação inteligente voltada para SEO (gerando slugs amigáveis) e remoção física de arquivos do servidor ao excluir imagens ou veículos.
* **Painel de Controle de Solicitações:** Visualização organizada de todos os agendamentos e propostas recebidas, permitindo alterar o status de atendimento (ex: *Pendente*, *Em Negociação*, *Aprovado*, *Recusado*, *Contatado*).

---

## 3. Tecnologias Utilizadas

* **Linguagem Principal:** [PHP 8.x](https://www.php.net/) (Vanilla, estruturado no padrão MVC com Front Controller e roteamento dinâmico).
* **Banco de Dados:** [MySQL / MariaDB](https://www.mysql.com/) (conexão segura utilizando a extensão `PDO`).
* **Interface e Estilização:** 
  * [Bootstrap 5](https://getbootstrap.com/) (para layout responsivo e componentes nativos).
  * [Bootstrap Icons](https://icons.getbootstrap.com/) (para iconografia geral).
  * CSS Customizado (estilizações premium, suporte para transições dinâmicas de cores e micro-animações).
  * JavaScript Vanilla (manipulação de tema escuro/claro, validações dinâmicas nos formulários e uploads de imagem).
* **Segurança:**
  * Algoritmo de Hashing de Senhas (`password_hash` e `password_verify`).
  * Validador algorítmico oficial para CNH (conforme regras do Detran).
  * Validador estrutural de WhatsApp (com verificação de DDD e nono dígito).

---

## 4. Como Executar o Projeto Localmente

### Pré-requisitos
* Servidor local Apache com suporte para PHP 8.0 ou superior (ex: **XAMPP**, **WampServer** ou **Laragon**).
* Banco de dados MySQL/MariaDB.
* Navegador de internet moderno.

### Passo a Passo para Configuração

1. **Clonar ou Mover o Repositório:**
   Mova a pasta do projeto para o diretório de documentos do seu servidor local. No caso do XAMPP:
   ```bash
   C:\xampp\htdocs\Concessionaria-PCGMV
   ```

2. **Iniciar o Servidor:**
   Abra o painel de controle do seu servidor local (ex: XAMPP Control Panel) e inicie os módulos **Apache** e **MySQL**.

3. **Configurar o Banco de Dados:**
   * Acesse a ferramenta de gerenciamento do banco (geralmente `http://localhost/phpmyadmin/`).
   * Crie um banco de dados chamado `concessionaria` com a colação `utf8mb4_unicode_ci`.
   * Importe primeiro o arquivo de criação de tabelas:
     ```markdown
     [Create.sql](file:///c:/xampp/htdocs/Concessionaria-PCGMV/app/Database/Create.sql)
     ```
     *(Este script criará a estrutura de tabelas, inserirá as chaves de cadastro de funcionários e criará o usuário admin padrão).*
   * Em seguida, importe o arquivo de dados de exemplo para popular a vitrine inicial:
     ```markdown
     [InsertExemplos.sql](file:///c:/xampp/htdocs/Concessionaria-PCGMV/app/Database/InsertExemplos.sql)
     ```

4. **Verificar a Conexão com o Banco:**
   O arquivo de conexão padrão está localizado em:
   ```markdown
   [Conexao.php](file:///c:/xampp/htdocs/Concessionaria-PCGMV/app/Database/Conexao.php)
   ```
   Caso as suas credenciais locais do MySQL sejam diferentes das padrão do XAMPP (Usuário: `root` e Senha vazia `""`), ajuste as variáveis `$usuario` e `$senha` no arquivo indicado.

5. **Configurar Permissões de Escrita (Uploads):**
   Certifique-se de que a pasta `public/uploads/` tem permissão de escrita para o servidor Apache, permitindo que o upload de novas fotos de veículos funcione corretamente.

6. **Acessar a Aplicação:**
   Abra o navegador e acesse a URL:
   ```url
   http://localhost/Concessionaria-PCGMV/public/
   ```

### Credenciais Padrão de Acesso

* **Acesso do Vendedor (Admin):**
  * Acesse `http://localhost/Concessionaria-PCGMV/public/?pagina=login`
  * **Usuário:** `admin`
  * **Senha:** `admin123`
* **Chaves de Registro de Novo Funcionário:**
  Caso queira registrar um novo vendedor no sistema na rota `?pagina=register-admin`, utilize uma das seguintes chaves de ativação pré-cadastradas:
  * `0931`, `3111`, `3134`, `6774`, `0903`

---

## 5. Estrutura do Projeto

Abaixo estão detalhados os principais arquivos e diretórios da aplicação:

```text
Concessionaria-PCGMV/
├── app/                              # Código lógico do backend (PHP)
│   ├── Config/
│   │   └── Root.php                  # Definição do ROOT_PATH físico do projeto
│   ├── Controller/
│   │   ├── Agendamentos/             # Gerenciamento de propostas e test drives
│   │   ├── User/                     # Gerenciamento de sessão e cadastro de admins
│   │   └── Veiculo/                  # Operações e upload de fotos dos veículos
│   ├── Database/
│   │   ├── Conexao.php               # Estabelece a conexão via PDO com o banco de dados
│   │   ├── Create.sql                # Estrutura do banco de dados e dados iniciais
│   │   └── InsertExemplos.sql        # Massa de dados de veículos e caminhos de imagens
│   ├── Helpers/
│   │   └── Validadores.php           # Auxiliares de validação (CNH, WhatsApp e Slugify)
│   ├── Model/                        # Entidades e classes de representação de dados
│   ├── Repository/                   # Comunicação direta e queries SQL (PDO)
│   ├── Service/                      # Regras de negócios intermediárias
│   └── Views/                        # Interfaces gráficas renderizadas para o usuário
│       ├── admin/                    # Telas administrativas (login, painel, cadastro, edição)
│       ├── components/               # Elementos compartilhados (header, footer, nav)
│       └── public/                   # Telas visíveis para visitantes (vitrine, detalhes, sobre)
└── public/                           # Diretório público de acesso web
    ├── assets/                       # Arquivos estáticos (CSS, JS, Imagens institucionais)
    ├── uploads/                      # Pasta de destino das imagens enviadas via upload admin
    └── index.php                     # Front Controller e Roteador das páginas
```

---

## 6. Boas Práticas e Observações

* **Slugs de URL e Nomes de Arquivos:** Ao cadastrar ou editar um carro, o sistema gera dinamicamente slugs com base no modelo do veículo (usando a função `slugify`). Isso garante nomes de arquivos limpos e organizados no servidor, o que melhora o SEO.
* **Gerenciamento de Imagens Órfãs:** O sistema foi programado para limpar imagens do servidor físico sempre que uma imagem específica é editada/deletada ou quando o próprio veículo é removido, prevenindo o acúmulo desnecessário de arquivos.
* **Exigência de Foto Principal:** O sistema exige o envio de imagens obrigatórias (`foto_1` - Vitrine e `foto_2` - Banner) para manter a integridade visual da vitrine. Fotos adicionais para a galeria interna (`foto_3`) são opcionais.

---

*Nota: Caso precise rodar o sistema sob um ambiente de produção real, lembre-se de alterar o arquivo [Conexao.php](file:///c:/xampp/htdocs/Concessionaria-PCGMV/app/Database/Conexao.php) para ler variáveis de ambiente seguras (`.env`) ou utilizar configurações protegidas para a string de conexão PDO.*
