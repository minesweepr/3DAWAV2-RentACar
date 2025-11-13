document.addEventListener("DOMContentLoaded", ()=>{
  const input=document.getElementById("pesquisa");
  const lupa=document.querySelector(".fa-magnifying-glass");

  function pesquisar(){
    const termo=input.value.trim();
    if(termo) window.location.href=`listar.html?pesquisa=${encodeURIComponent(termo)}`;
  }

  input.addEventListener("keydown", (e) => {
    if (e.key==="Enter") {
      e.preventDefault();
      pesquisar();
    }
  });
  lupa.addEventListener("click", pesquisar);
});