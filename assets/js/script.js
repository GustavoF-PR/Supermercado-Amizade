document.addEventListener("DOMContentLoaded", function() {
    const formCadastro = document.getElementById("form-cadastro");

    if (formCadastro) {
        formCadastro.addEventListener("submit", function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            formData.append("acao", "cadastrar"); 

            fetch("../ajax/usuario.php", {
                method: "POST",
                body: formData
            })
            .then(resposta => resposta.text())
            .then(dados => {
                alert(dados);
                if(dados.includes("sucesso")) {
                    window.location.href = "../index.php";
                }
            })
            .catch(erro => {
                console.error("Erro de comunicação:", erro);
                alert("Erro ao tentar conectar com o servidor.");
            });
        });
    }

    const formLogin = document.getElementById("form-login");

        if (formLogin) {
            formLogin.addEventListener("submit", function(e) {
                e.preventDefault();

                const formData = new FormData(this);
                formData.append("acao", "logar");

                fetch("ajax/usuario.php", {
                    method: "POST",
                    body: formData
                })
                .then(resposta => resposta.text())
                .then(dados => {

                    if (dados.trim() === "sucesso") {
                        window.location.href = "Views/inicio.php";
                    } else {

                        alert(dados);
                    }
                })
                .catch(erro => {
                    console.error("Erro:", erro);
                });
            });
        }

    const tabelaFornecedores = document.getElementById("tabela-fornecedores");

    function carregarFornecedores() {
        if (!tabelaFornecedores) return;

        const formData = new FormData();
        formData.append("acao", "listar");

        fetch("../ajax/fornecedor.php", {
            method: "POST",
            body: formData
        })
        .then(resposta => resposta.json())
        .then(dados => {
            tabelaFornecedores.innerHTML = "";

            if (dados.length === 0) {
                tabelaFornecedores.innerHTML = "<tr><td colspan='4' class='text-center'>Nenhum fornecedor listado ainda.</td></tr>";
                return;
            }

            dados.forEach(forn => {
                const tr = document.createElement("tr");
                tr.innerHTML = `
                    <td>${forn.id}</td>
                    <td>${forn.nome_fornecedor}</td>
                    <td>${forn.cnpj}</td>
                    <td>${forn.telefone}</td>
                `;
                tabelaFornecedores.appendChild(tr);
            });
        })
        .catch(erro => console.error("Erro ao carregar lista:", erro));
    }

    if (tabelaFornecedores) {
        carregarFornecedores();
    }
});