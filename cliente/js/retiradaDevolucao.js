function salvarFiltrosRetirada() {
    const form = document.getElementById("retdev");
    if (!form) return;

    const btn = document.getElementById("rdCheck");
    if (!btn) return;

    btn.addEventListener("click", (e) => {
        e.preventDefault();

        const selects = form.querySelectorAll("select");
        const datas = form.querySelectorAll("input[type='date']");
        const horas = form.querySelectorAll("input[type='time']");

        const filtrosRetirada = {
            retiradaCidade: selects[0]?.value || "",
            retiradaData: datas[0]?.value || "",
            retiradaHora: horas[0]?.value || "",
            devolucaoCidade: selects[1]?.value || "",
            devolucaoData: datas[1]?.value || "",
            devolucaoHora: horas[1]?.value || ""
        };

        sessionStorage.setItem("filtrosRetirada", JSON.stringify(filtrosRetirada));
        window.location.href = "listar.html";
    });
}

function pegarFiltrosRetirada() {
    const dados = sessionStorage.getItem("filtrosRetirada");
    if (!dados) return null;
    return JSON.parse(dados);
}

function preencherFiltrosRetirada(locPath) {
    const filtros = pegarFiltrosRetirada();
    if (!filtros) return;

    const form = document.getElementById("retdev");
    const ret = document.getElementById("retirada");
    const dev = document.getElementById("devolucao");
    if (!form) return;

    let selects;
    let datas;
    let horas;
    
    if(locPath.includes("pagamento.html")) {
        const selectRet = ret.querySelector("select");
        const selectDev = dev.querySelector("select");

        const dataRet = ret.querySelector("input[type='date']");
        const dataDev = dev.querySelector("input[type='date']");

        const horaRet = ret.querySelector("input[type='time']");
        const horaDev = dev.querySelector("input[type='time']");

        if (selectRet) selectRet.value = filtros.retiradaCidade;
        if (dataRet) dataRet.value = filtros.retiradaData;
        if (dataDev) horaRet.value = filtros.retiradaHora;

        if (selectDev) selectDev.value = filtros.devolucaoCidade;
        if (horaRet) dataDev.value = filtros.devolucaoData;
        if (horaDev) horaDev.value = filtros.devolucaoHora;

    } else {
        selects = form.querySelectorAll("select");
        datas = form.querySelectorAll("input[type='date']");
        horas = form.querySelectorAll("input[type='time']");
    
        if (selects[0]) selects[0].value = filtros.retiradaCidade;
        if (datas[0]) datas[0].value = filtros.retiradaData;
        if (horas[0]) horas[0].value = filtros.retiradaHora;

        if (selects[1]) selects[1].value = filtros.devolucaoCidade;
        if (datas[1]) datas[1].value = filtros.devolucaoData;
        if (horas[1]) horas[1].value = filtros.devolucaoHora;
    }
}

document.addEventListener("DOMContentLoaded", () => {
    if (window.location.pathname.includes("home.html") || window.location.pathname.includes("listar.html")) {
        salvarFiltrosRetirada();
    }
    if (window.location.pathname.includes("listar.html") || window.location.pathname.includes("pagamento.html")) {
        preencherFiltrosRetirada(window.location.pathname);
    }
});
