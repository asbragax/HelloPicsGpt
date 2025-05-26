## 📦 HelloPics API - Documentação Resumida

### 🔐 Autenticação (Sanctum)

* **POST** `/api/register` — Registrar novo cliente
* **POST** `/api/login` — Login do cliente
* **GET** `/api/me` — Dados do usuário autenticado
* **POST** `/api/logout` — Logout (revoga token)

---

### 🛍️ Produtos

* **GET** `/api/produtos` — Listar produtos (packs de polaroid) ativos

---

### 🛒 Pedidos

* **POST** `/api/pedidos`

  * Criar novo pedido
  * Requer: produtos (ids + quantidade), tipo de envio das fotos, link (se for via Drive), legenda ativada, endereço

* **GET** `/api/pedidos` — Listar pedidos do cliente autenticado

* **GET** `/api/pedidos/{id}` — Ver detalhes de um pedido

* **POST** `/api/pedidos/{id}/cancelar` — Cancelar pedido (apenas se ainda estiver como "aguardando\_pagamento" ou "pago")

* **GET** `/api/pedidos/{id}/status-log` — Ver histórico de status do pedido

---

### 📷 Upload de Fotos por Pack

* **POST** `/api/pedido-produto/{id}/fotos`

  * Multipart form
  * Campos: `fotos[]`, `caption[]`
  * Regras: arquivos imagem, até 5MB cada
  * Salvos em `public/uploads/`

---

### 🔐 Observações

* Todas as rotas protegidas exigem **token Sanctum** enviado em:

```http
Authorization: Bearer SEU_TOKEN_AQUI
```

* Respostas seguem formato JSON.

---

Essa estrutura cobre todo o fluxo de compra, envio de fotos, rastreio e cancelamento. Ideal para integração com frontend em React.
