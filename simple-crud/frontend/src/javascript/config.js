//tbody para inserir os valores
const tbody = document.querySelector("tbody");

//read do CRUD
const READ = () => {
  fetch("../../../backend/config/read.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erro! Status: " + response.status);
      }
      return response.json();
    })
    .then((data) => {
      data.forEach((item) => {
        tbody.innerHTML += `
                <tr id="row_${item.id}">
                    <th scope="row">${item.id}</th>
                    <td>${item.produto}</td>
                    <td>${item.quantidade_estoque}</td>
                    <td>R$ ${item.valor}</td>
                    <td>
                        <button class="btn btn-warning btn-sm" onclick="cardModal('block', ${item.id})">Editar</button>
                        <button class="btn btn-danger btn-sm" onclick="DELETE(${item.id})">Excluir</button>
                    </td>
                </tr>
            `;
      });
    })
    .catch((error) => {
      console.error(error);
    });
};

//variável no escopo global para o UPDATE conseguir acessá-la
let editID = null;

const cardModal = (action, id) => {
  const card = document.querySelector("#editCard");

  card.style.display = action;

  if(id != null) {
    editID = id
  }
};

//update do CRUD
const UPDATE = (event) => {
  event.preventDefault();

  //gambiarra para pegar o id
  const id = editID;

  //valores atualizados
  const nome = document.querySelector("#nome").value;
  const valor = document.querySelector("#valor").value;
  const quantidade_estoque = document.querySelector(
    "#quantidade_estoque"
  ).value;

  //reenvio do formulário via formdata
  const formData = new FormData();
  formData.append("id", id);
  formData.append("nome", nome);
  formData.append("valor", valor);
  formData.append("quantidade_estoque", quantidade_estoque);

  fetch("../../../backend/config/update.php", {
    method: "POST",
    body: formData,
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erro ao tentar fazer a conexão!");
      }
      return response.text();
    })
    .then((data) => {
      window.location.reload()
    })
    .catch((error) => {
      console.error("Segue o Erro: " + error);
    });
};

//delete do CRUD
const DELETE = (id) => {
  fetch(`../../../backend/config/delete.php?id=${id}`, {
    method: "DELETE",
  })
    .then((response) => {
      if (!response.ok) {
        throw new Error("Erro! Status: " + response.status);
      }

      const row = document.querySelector(`#row_${id}`);

      if (row) {
        row.remove();
      }
    })
    .catch((error) => console.log(error));
};

READ();
