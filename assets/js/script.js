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
                    window.location.href = "views/produtos.php";
                } else {
                    alert(dados);
                }
            })
            .catch(erro => {
                console.error("Erro na autenticação:", erro);
                alert("Falha na comunicação com o servidor.");
            });
        });
    }
});