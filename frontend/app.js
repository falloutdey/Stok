fetch("http://localhost:8000/produtos")
.then(res => res.json())
.then(res => {
  const produtos = res.data; // <- acessar o array corretamente
  const lista = document.getElementById("lista-produtos");

  produtos.forEach(produto => {
    const item = document.createElement("li");
    item.className = "list-group-item";
    item.textContent = `${produto.nome} - ${produto.quantidade} unidades`;
    lista.appendChild(item);
  });
});
