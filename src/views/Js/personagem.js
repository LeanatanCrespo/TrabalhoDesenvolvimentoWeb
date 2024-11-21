// personagem.js

async function registraPersonagem() {
    const personagem = {
        nome: document.getElementById('nome').value,
        raca: document.getElementById('raca').value,
        classe: document.getElementById('classe').value,
        usuarioId: document.getElementById('usuarioId').value,
    };

    let response = await fetch("http://localhost:8000/src/api/personagem", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(personagem)
    });

    let data = await response.text();
    console.log(data);
}

async function fetchPersonagem(id) {
    let response = await fetch(`http://localhost:8000/src/api/personagem?id=${id}`, { method: "GET" });
    return await response.json();
}

async function removePersonagem(id) {
    let response = await fetch("http://localhost:8000/src/api/personagem", {
        method: "DELETE",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ id: id })
    });

    let data = await response.text();
    console.log(data);
    window.location.reload();
}

async function carregarPersonagem() {
    const tabela = document.querySelector('#personagemTable tbody');
    tabela.innerHTML = '';

    let personagens = await fetchPersonagem();

    if (personagens && personagens.length > 0) {
        personagens.forEach(personagem => {
            const linha = `
                <tr>
                    <td>${personagem.nome}</td>
                    <td>${personagem.raca}</td>
                    <td>${personagem.classe}</td>
                    <td><button onclick="removePersonagem(${personagem.id})">Deletar</button></td>
                    <td><button onclick="window.location.href='cadastroPersonagem.html?id=${personagem.id}'">Editar</button></td>
                </tr>`;
            tabela.innerHTML += linha;
        });
    } else {
        tabela.innerHTML = '<tr><td colspan="4">Nenhum personagem encontrado.</td></tr>';
    }
}

document.addEventListener('DOMContentLoaded', carregarPersonagem);

async function onUpdate() {
    let fromGet = new URLSearchParams(window.location.search);
    if (fromGet.has("id")) {
        let id = fromGet.get("id");
        let personagemData = await fetchPersonagem(id);
        document.getElementById('nome').value = personagemData.nome;
        document.getElementById('raca').value = personagemData.raca;
        document.getElementById('classe').value = personagemData.classe;
        document.getElementById('usuarioId').value = personagemData.usuarioId;
    }
}

async function editPersonagem(id) {
    const personagem = {
        id: id,
        nome: document.getElementById('nome').value,
        raca: document.getElementById('raca').value,
        classe: document.getElementById('classe').value,
        usuarioId: document.getElementById('usuarioId').value,
    };

    let response = await fetch("http://localhost:8000/src/api/personagem", {
        method: "PUT",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(personagem)
    });

    if (response.ok) {
        alert("Personagem atualizado com sucesso!");
        window.location.href = "crud_personagens.html";
    } else {
        console.error("Erro ao editar personagem");
    }
}

function detectType() {
    let fromGet = new URLSearchParams(window.location.search);
    if (fromGet.has("id")) {
        editPersonagem(fromGet.get("id"));
    } else {
        registraPersonagem();
    }
}

function confirmDelete() {
    document.getElementById('confirma').style.display = 'flex';
}

function closePopup() {
    document.getElementById('confirma').style.display = 'none';
}
